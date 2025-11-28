<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    function login(Request $request){

        $validation = $request->validate([
            "name"=>"required",
            "password"=>"required |min:6"
        ]);

        $admin = Admin::where([
            ['name',"=",$request->name],
            ['password',"=",$request->password]
        ])->first();

        if(!$admin){
            
        $validation = $request->validate([
            "user"=>"required"
        ],[
            "user.required"=>"User does not exist"
        ]);
        }

        Session::put('admin',$admin);
        return redirect('dashboard');
    }

    function dashboard(){
        $admin = Session::get('admin');
        if($admin){
            $users = User::orderBy('id','desc')->paginate(4);
            return view('admin',["name"=>$admin->name,'users'=>$users]);
        }else{
            return redirect('admin-login');
        }
        
    }

    function categories(){
        $categories = Category::get();
         $admin = Session::get('admin');
        if($admin){
            return view('categories',["name"=>$admin->name,"categories"=>$categories]);
        }else{
            return redirect('admin-login');
        }
    }

    function logout(){
        Session::forget('admin');
        return redirect('admin-login');
    }

    function addCategory(Request $request){
        //add validation
        $validation = $request->validate([
            "category"=>"required | min:3 | unique:categories,category"
        ]);

        $admin = Session::get('admin');
        $category = new Category();
        $category->category = $request->category;
        $category->creator = $admin->name;
        if($category->save()){
           Session::flash('category', "Category " . $request->category . " Added");
        }
        return redirect('admin-categories');
    }

    function deleteCategory($id){
        $isDeleted = Category::find($id)->delete();
        if($isDeleted){
            Session::flash('category', "Category Deleted");
        }
         return redirect('admin-categories');
    }

    //use to add quiz
    function addQuiz(){
         $admin = Session::get('admin');
         $categories = Category::get();
         $totalMcqs = 0;
        if($admin){
            $quizName = request('quiz_name');
            $category_id = request('category_id');

            if($quizName && $category_id && !Session::has('quizDetails')){
                $quiz = new Quiz();
                $quiz->quiz_name = $quizName;
                $quiz->category_id = $category_id;
                if($quiz->save()){
                    Session::put('quizDetails',$quiz);
                }
            }else{
                $quiz = Session::get('quizDetails');
                $totalMcqs =$quiz && Mcq::where('quiz_id',$quiz->id)->count();
            }
            return view('add-quiz',["name"=>$admin->name,"categories"=>$categories,"totalMcqs"=>$totalMcqs]);
        }else{
            return redirect('admin-login');
        }
    }

    //use to add questions
    function addMCQs(Request $request){

        $submitType = $request->submit;
        if($submitType == 'exit'){
                return $this->endQuiz();
            }

        $request->validate([
            "question"=>"required | min:5",
            "a"=>"required",
            "b"=>"required",
            "c"=>"required",
            "d"=>"required",
            "right_ans"=>"required"
        ]);

        $mcq = new Mcq();
        $quiz = Session::get('quizDetails');
        $admin = Session::get('admin');

        $mcq->question = $request->question;
        $mcq->a = $request->a;
        $mcq->b = $request->b;
        $mcq->c = $request->c;
        $mcq->d = $request->d;
        $mcq->right_ans = $request->right_ans;

        $mcq->admin_id = $admin->id;
        $mcq->quiz_id= $quiz->id;
        $mcq->category_id = $quiz->category_id;
        
        if($mcq->save()){
            if($request->submit == "add-more"){
                return redirect(url()->previous());
            }else{
                Session::forget('quizDetails');
                return redirect('/admin-categories');
            }
        }
    }

    function endQuiz(){
        Session::forget('quizDetails');
        return redirect('/admin-categories');
    }

    function showQuiz($id){
        $admin = Session::get('admin');
        $mcqs = Mcq::where('quiz_id',$id)->get();
        if($admin){
            $quizName = Quiz::find($id)->quiz_name;
            return view('show-quiz',["name"=>$admin->name,"mcqs"=>$mcqs,"quizName"=>$quizName]);
        }else{
            return redirect('admin-login');
        }
    }

    function quizList($id , $category){
        $admin = Session::get('admin');
        if($admin){
            $quizData = Quiz::where('category_id',$id)->get();
            return view('quiz-list',["name"=>$admin->name,"quizData"=>$quizData,"category"=>$category]);
        }else{
            return redirect('admin-login');
        }
    }
}
