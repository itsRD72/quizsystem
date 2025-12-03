<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Admin login
    public function login(Request $request)
    {
        // Validate input
        $data = $request->validate([
            "name" => "required",
            "password" => "required|min:6"
        ]);

        // Attempt admin login using 'admin' guard
        if (Auth::guard('admin')->attempt($data)) {
            $request->session()->regenerate(); // secure the session
            return redirect()->route('dashboard'); // middleware will allow access
        } else {
            return back()->withErrors(['Invalid credentials'])->withInput();
        }
    }


    // Admin dashboard
    function dashboard()
    {
        $admin = Auth::guard('admin')->user(); // logged-in admin
        $users = User::paginate(4);            // fetch users with pagination
        return view('dashboard', compact('admin', 'users')); // pass data to view
    }


    function userList()
    {
        $admin = Auth::guard('admin')->user();
        if (!$admin) {
            return redirect('admin-login');
        }

        $users = User::paginate(4); // fetch 10 users per page

        return view('users', [
            'name' => $admin->name,
            'users' => $users
        ]);
    }


    // Categories list
    function categories()
    {
        $admin = Auth::guard('admin')->user();


        if (!$admin) {
            return redirect('admin-login');
        }

        $categories = Category::get();

        return view('categories', [
            "name" => $admin['name'],
            "categories" => $categories
        ]);
    }

    // Logout
    function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin-login');
    }

    // Add category
    function addCategory(Request $request)
    {
        $request->validate([
            "category" => "required|min:3|unique:categories,category"
        ]);

        $admin = Auth::guard('admin')->user();


        $category = new Category();
        $category->category = $request->category;
        $category->creator = $admin['name'];

        if ($category->save()) {
            Session::flash('category', "Category " . $request->category . " Added");
        }

        return redirect('admin-categories');
    }

    // Delete category
    function deleteCategory($id)
    {
        $isDeleted = Category::find($id)->delete();

        if ($isDeleted) {
            Session::flash('category', "Category Deleted");
        }

        return redirect('admin-categories');
    }

    // Add quiz
    function addQuiz()
    {
        $admin = Auth::guard('admin')->user();


        if (!$admin) {
            return redirect('admin-login');
        }

        $categories = Category::get();
        $totalMcqs = 0;

        $quizName = request('quiz_name');
        $category_id = request('category_id');

        if ($quizName && $category_id && !Session::has('quizDetails')) {
            $quiz = new Quiz();
            $quiz->quiz_name = $quizName;
            $quiz->category_id = $category_id;
            if ($quiz->save()) {
                Session::put('quizDetails', $quiz);
            }
        } else {
            $quiz = Session::get('quizDetails');
            $totalMcqs = $quiz ? Mcq::where('quiz_id', $quiz->id)->count() : 0;
        }

        return view('add-quiz', [
            "name" => $admin['name'],
            "categories" => $categories,
            "totalMcqs" => $totalMcqs
        ]);
    }

    // Add MCQs
    function addMCQs(Request $request)
    {
        $submitType = $request->submit;

        if ($submitType === 'exit') {
            return $this->endQuiz();
        }

        $request->validate([
            "question" => "required|min:5",
            "a" => "required",
            "b" => "required",
            "c" => "required",
            "d" => "required",
            "right_ans" => "required"
        ]);

        $mcq = new Mcq();
        $quiz = Session::get('quizDetails');
        $admin = Auth::guard('admin')->user();


        $mcq->question = $request->question;
        $mcq->a = $request->a;
        $mcq->b = $request->b;
        $mcq->c = $request->c;
        $mcq->d = $request->d;
        $mcq->right_ans = $request->right_ans;

        $mcq->admin_id = $admin['id'];
        $mcq->quiz_id = $quiz->id;
        $mcq->category_id = $quiz->category_id;

        if ($mcq->save()) {
            if ($submitType === "add-more") {
                return redirect(url()->previous());
            } else {
                Session::forget('quizDetails');
                return redirect('/admin-categories');
            }
        }
    }

    // End quiz session
    function endQuiz()
    {
        Session::forget('quizDetails');
        return redirect('/admin-categories');
    }

    // Show quiz MCQs
    function showQuiz($id)
    {
        $admin = Auth::guard('admin')->user();


        if (!$admin) {
            return redirect('admin-login');
        }

        $mcqs = Mcq::where('quiz_id', $id)->get();
        $quiz = Quiz::find($id);
        $quizName = $quiz ? $quiz->quiz_name : '';

        return view('show-quiz', [
            "name" => $admin['name'],
            "mcqs" => $mcqs,
            "quizName" => $quizName
        ]);
    }

    // Quiz list by category
    function quizList($id, $category)
    {
        $admin = Auth::guard('admin')->user();


        if (!$admin) {
            return redirect('admin-login');
        }

        $quizData = Quiz::where('category_id', $id)->get();

        return view('quiz-list', [
            "name" => $admin['name'],
            "quizData" => $quizData,
            "category" => $category
        ]);
    }
}
