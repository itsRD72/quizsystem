<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\User;
use App\Models\Record;
use App\Models\MCQ_Record;
use App\Mail\VerifyUser;
use App\Mail\UserForgotPassword;


class UserController extends Controller
{
    function welcome()
    {
        $categories = Category::withCount('quizzes')->take(5)->orderBy('quizzes_count','desc')->get();
        $quizData = Quiz::withCount('Records')->take(5)->orderBy('Records_count','desc')->get();
        return view('welcome', ["categories" => $categories,"quizData" => $quizData]);
    }

    function categoryList(){
        $categories = Category::withCount('quizzes')->orderBy('quizzes_count','desc')->paginate(3);
        return view('user-category',["categories"=>$categories]);
    }

    function userQuizList($id, $category)
    {
        $quizData = Quiz::withCount('mcq')->where('category_id', $id)->get();
        return view('user-quiz-list', ["quizData" => $quizData, "category" => $category]);

    }

    function startQuiz($id, $name)
    {
        $quizCount = Mcq::where('quiz_id', $id)->count();
        $mcqs = Mcq::where('quiz_id', $id)->get();
        Session::put('firstMcq', $mcqs[0]);
        $quizName = $name;
        return view('start-quiz', ["quizName" => $quizName, "quizCount" => $quizCount]);
    }

    function userSignup(Request $request)
    {
        $validation = $request->validate([
            "username" => "required | min:3 | max:20",
            "email" => "required | email | unique:users",
            "password" => "required | min:4 | confirmed"
        ]);
        $user = User::create([
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        //
        $link = Crypt::encryptString($user->email);
        $link = url('/verify-user', $link);
        Mail::to($user->email)->send(new VerifyUser($link));
        //

        if ($user) {
            Session::put('user', $user);
            if (Session::has('quiz-url')) {
                $url = Session::get('quiz-url');
                Session::forget('quiz-url');
                return redirect($url)->with('message-success', "User Registered Successfully, Please Check Email to Verify Account");
            }
            return redirect('/')->with('message-success', "User Registered Successfully, Please Check Email to Verify Account");
        }
    }

    function userLogout()
    {
        Session::forget('user');
        return redirect('/  ');
    }

    function userSignupQuiz()
    {
        Session::put('quiz-url', url()->previous());
        return view('user-signup');
    }

    //login user 
    function userLogin(Request $request)
    {
        $validation = $request->validate([
            "email" => "required | email",
            "password" => "required"
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect('user-login')->with('message-error','User not Valid , Please Check Your Email and Password');
        }
        if ($user) {
            Session::put('user', $user);
            if (Session::has('quiz-url')) {
                $url = Session::get('quiz-url');
                Session::forget('quiz-url');
                return redirect($url);
            } else {
                return redirect('/');
            }
        }
    }

    function userLoginQuiz()
    {
        Session::put('quiz-url', url()->previous());
        return view('user-login');
    }

    function mcq($id, $quiz_name)
    {
        $record = new Record();
        $record->user_id = Session::get('user')->id;
        $record->quiz_id = Session::get('firstMcq')->quiz_id;
        $record->status = 1;
        if ($record->save()) {
            $currentQuiz = [];
            $currentQuiz['totalMcq'] = MCQ::where('quiz_id', Session::get('firstMcq')->quiz_id)->count();
            $currentQuiz['currentMcq'] = 1;
            $currentQuiz['quizName'] = $quiz_name;
            $currentQuiz['quizId'] = Session::get('firstMcq')->quiz_id;
            $currentQuiz['recordId'] = $record->id;
            Session::put('currentQuiz', $currentQuiz);
            $mcqData = MCQ::find($id);
            return view('mcq-page', ['quizName' => $quiz_name, 'mcqData' => $mcqData]);
        } else {
            return "Something Went Wrong";
        }

    }
    function submitAndNext(Request $request, $id)
    {
        $currentQuiz = Session::get('currentQuiz');
        $currentQuiz['currentMcq'] += 1;
        $mcqData = MCQ::where([
            ['id', '>', $id],
            ['quiz_id', '=', $currentQuiz['quizId']]
        ])->first();

        $isExist = MCQ_Record::where([
            ['record_id', '=', $currentQuiz['recordId']],
            ['mcq_id', '=', $request->id]
        ])->count();
        if ($isExist < 1) {
            $mcq_record = new MCQ_Record();
            $mcq_record->record_id = $currentQuiz['recordId'];
            $mcq_record->user_id = Session::get('user')->id;
            $mcq_record->mcq_id = $request->mcq_id;
            $mcq_record->select_answer = $request->answer;
            if ($request->answer == MCQ::find($request->mcq_id)->right_ans) {
                $mcq_record->is_correct = 1;
            } else {
                $mcq_record->is_correct = 0;
            }

            if (!$mcq_record->save()) {
                return "Something Went Wrong";
            }
        }
        Session::put('currentQuiz', $currentQuiz);
        if ($mcqData) {
            return view('mcq-page', ['quizName' => $currentQuiz['quizName'], 'mcqData' => $mcqData]);
        } else {
            $resultData = MCQ_Record::WithMCQ()->where('record_id', $currentQuiz['recordId'])->get();
            $correctAnswers = MCQ_Record::where([
                ['record_id', '=', $currentQuiz['recordId']],
                ['is_correct', '=', 1]

            ])->count();

            $record = Record::find($currentQuiz['recordId']);
            if ($record) {
                $record->status = 2;
                $record->update();
            }

            return view('quiz-result', ['resultData' => $resultData, 'correctAnswers' => $correctAnswers]);
        }
    }

    function userDetail()
    {
        $quizRecord = Record::WithQuiz()->where('user_id', Session::get('user')
            ->id)->get();
        return view('user-details', ['quizRecord' => $quizRecord]);
    }

    //search function
    function searchQuiz(Request $request)
    {
        $quizData = Quiz::withCount('Mcq')->where('quiz_name', 'like', '%' . $request->search . '%')->get();
        return view('search-quiz', ['quizData' => $quizData, 'quiz' => $request->search]);
    }

    function verifyUser($email)
    {
        $orgEmail = Crypt::decryptString($email);
        $user = User::where('email', $orgEmail)->first();
        if ($email) {
            $user->active = 2;
            if ($user->save()) {
                return redirect('/')->with('message-success', "User Verified Successfully,");
            }
        }
    }

    function userForgotPassword(Request $request)
    {
        $link = Crypt::encryptString($request->email);
        $link = url('/user-forgot-password', $link);
        Mail::to($request->email)->send(new UserForgotPassword($link));
        return redirect('/')->with('message-success','Please Check Your Email to Set Password');
    }

    function userResetForgotPassword($email)
    {
        $orgEmail = Crypt::decryptString($email);
        return view('user-set-forgot-password', ["email" => $orgEmail]);
    }

    function userSetForgotPassword(Request $request)
    {
        $validation = $request->validate([
            "email" => "required | email",
            "password" => "required | min:4 | confirmed"
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            if ($user->save()) {
                return redirect('user-login')->with('message-success','Password is Set, Please login with New Password');
            }
        }
    }

    function certificate(){
        $data=[];
        $data['quiz']=str_replace('-',' ',Session::get('currentQuiz')['quizName']);
        $data['name']=Session::get('user')->username;
        return view('certificate',['data'=>$data]);
    }
}


