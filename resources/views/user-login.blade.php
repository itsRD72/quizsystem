<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <title>Login Page</title>
</head>
<body class="pt-5">
    <x-user-navbar></x-user-navbar>

    <div class="d-flex justify-content-center align-items-center main-content">
        <div class="card signup-card p-4 shadow-lg border-0 rounded-4" style="width: 420px;">
            @if(session('message-error'))
            <div>
                <p class="text-danger">{{ session('message-error') }}</p>
            </div>
        @endif
        @if(session('message-success'))
            <div>
                <p class="text-success">{{ session('message-success') }}</p>
            </div>
        @endif
            <h2 class="signup-title text-center mb-4">Login</h2>

            <form action="/user-login" method="post">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">User Email</label>
                    <input type="email" name="email" class="form-control input-custom" value="{{old('email')}}" placeholder="Enter Your Email">
                    @error('email')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control input-custom" placeholder="Enter Password">
                    @error('password')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <button class="btn signup-btn w-100">Login</button>
                <a href="/user-forgot-password" class="forgot-link">Forgot Password?</a>
            </form>

        </div>
    </div>

    <x-user-footer></x-user-footer>
</body>
</html>
