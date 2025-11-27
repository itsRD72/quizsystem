<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-lg" style="background: rgba(0, 0, 0, 0.75); backdrop-filter: blur(10px);">
  <div class="container-fluid px-4 py-2">

    <!-- Brand -->
    <a class="navbar-brand fs-3 fw-bold text-info" href="#">
      <span class="text-white logo-text">Quiz</span> System
    </a>

    <!-- Toggler for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu items -->
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto d-flex gap-3">

        <li class="nav-item">
          <a class="nav-link nav-link-custom" href="/">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link nav-link-custom" href="/category-list">Categories</a>
        </li>

        <li class="nav-item">
          <a class="nav-link nav-link-custom" href="">Blog</a>
        </li>

     @if(Session('user'))
        <li class="nav-item">
          <a class="nav-link nav-link-custom" href="/user-detail">Welcome:{{Session('user')->username}}</a>
        </li>

        <li class="nav-item">
          <a class="btn btn-logout" href="/user-logout">Logout</a>
        </li>
     @else
        <li class="nav-item">
          <a class="nav-link nav-link-custom" href="/user-login">Login</a>
        </li>

        <li class="nav-item">
          <a class="nav-link nav-link-custom" href="/user-signup">SignUp</a>
        </li>
     @endif
      </ul>
    </div>

  </div>
</nav>
