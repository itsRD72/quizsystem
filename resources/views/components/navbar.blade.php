
@props(['name'])
<nav class="navbar bg-dark navbar-dark shadow px-4 py-3 fixed-top">
        <div class="container-fluid d-flex justify-content-between">
            <div class="text-white m-0 fs-2 quiz-title">Quiz System</div>
        <div class="navbar-nav d-flex flex-row gap-3">
            <a class="nav-link link-primary text-white text-decoration-none" href="/dashboard">Dashboard</a>
            <a class="nav-link link-primary text-white text-decoration-none" href="/admin-categories">Categories</a>
            <a class="nav-link link-primary text-white text-decoration-none" href="/add-quiz">Quiz</a>
            <a class="nav-link link-primary text-white text-decoration-none" href="">Welcome <span>{{$name}}</span></a>
            <a class="nav-link link-primary text-white text-decoration-none" href="/admin-logout">LogOut</a>
        </div>
        </div>
    </nav>