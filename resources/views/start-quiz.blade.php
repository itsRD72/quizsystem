<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <title></title>
</head>
<body class="pt-5">
    <x-user-navbar></x-user-navbar>
    @if(session('message-success'))
            <div>
                <p class="text-success">{{ session('message-success') }}</p>
            </div>
        @endif
    <div class="main-content">
               <div class="text-center my-4">
                    <h2 class="sub-page-title mt-5">Quiz Name: {{str_replace('-',' ',$quizName)}}</h2>
                    <h2 class="sub-page-title small mt-5">
                        This Quiz Contain {{$quizCount}} Questions and No Limit to Attempt This Quiz.
                    </h2>
                    <h2 class="sub-page-title xsmall mt-5">Good Luck</h2>

                </div>
            @if(Session('user'))
                <div class="text-center mt-4">
                    <a href="/mcq/{{Session('firstMcq')->id.'/'.$quizName}}" class="start-btn">Start Quiz</a>
                </div>
            @else
                <div class="text-center mt-4">
                    <a href="/user-signup-quiz" class="start-btn">SignUp to Start Quiz</a>
                </div>
                <div class="text-center mt-4">
                    <a href="/user-login-quiz" class="start-btn">Login to Start Quiz</a>
                </div>
            @endif
    </div>
    <x-user-footer></x-user-footer>    
</body>
</html>