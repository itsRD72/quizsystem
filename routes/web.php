<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


//this is users home page
Route::get('/', [UserController::class, 'welcome']);
Route::get('user-quiz-list/{id}/{category}', [UserController::class, 'userQuizList']);
Route::get('start-quiz/{id}/{name}', [UserController::class, 'startQuiz']);
//Route::view('user-signup', 'user-signup');
Route::post('user-signup', [UserController::class, 'userSignup']);
Route::get('user-logout', [UserController::class, 'userLogout']);
Route::get('user-signup-quiz', [UserController::class, 'userSignupQuiz']);
Route::get('category-list', [UserController::class, 'categoryList']);
Route::get('certificate', [UserController::class, 'certificate']);
Route::get('download-certificate', [UserController::class, 'downloadCertificate']);



Route::get('user-login', function(){
    if(!session()->has('user')){
       return view('user-login');
}else{
    return redirect('/');
}
});

Route::get('user-signup', function(){
    if(!session()->has('user')){
        return view('user-signup');
}else{
    return redirect('/');
}
});


//Route::view('user-login', 'user-login');
Route::post('user-login', [UserController::class, 'userLogin']);
Route::get('user-login-quiz', [UserController::class, 'userLoginQuiz']);
Route::get('search-quiz', [UserController::class, 'searchQuiz']);
Route::get('verify-user/{email}', [UserController::class, 'verifyUser']);
Route::view('user-forgot-password', 'user-forgot-password');
Route::post('user-forgot-password', [UserController::class, 'userForgotPassword']);
Route::get('user-forgot-password/{email}', [UserController::class, 'userResetForgotPassword']);
Route::post('user-set-forgot-password', [UserController::class, 'userSetForgotPassword']);


//using middleware on group for user side
Route::middleware('CheckUserAuth')->group(function () {
    Route::get('mcq/{id}/{quiz_name}', [UserController::class, 'mcq']);
    Route::post('submit-next/{id}', [UserController::class, 'submitAndNext']);
    Route::get('user-detail', [UserController::class, 'userDetail']);
});



//this is for admin login 
Route::view('admin-login', 'admin-login')->name('admin-login');
Route::post('login', [AdminController::class, 'login']);
//this is for admin dashboard


Route::middleware('CheckAdminAuth')->group(function () {

    Route::get('dashboard', [AdminController::class, 'dashboard']);    
    Route::get('admin-logout', [AdminController::class, 'logout']);
    //this is for categories
    Route::get('admin-categories', [AdminController::class, 'categories']);
    Route::post('add-category', [AdminController::class, 'addCategory']);
    Route::get('category/delete/{id}', [AdminController::class, 'deleteCategory']);

    //this is for add quiz
    Route::get('add-quiz', [AdminController::class, 'addQuiz']);

    //this is for mzq section
    Route::post('add-mcq', [AdminController::class, 'addMCQs']);

    //this is for quiz question list
    Route::get('show-quiz/{id}', [AdminController::class, 'showQuiz']);

    //this is for show quiz list
    Route::get('quiz-list/{id}/{category}', [AdminController::class, 'quizList']);

});