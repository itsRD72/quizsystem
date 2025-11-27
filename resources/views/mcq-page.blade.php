<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <title>MCQ Page</title>
</head>

<body class="pt-3">
    <x-user-navbar></x-user-navbar>
    <div class="d-flex justify-content-center align-items-center vh-100">

        <div class="card signup-card p-4 shadow-lg border-0 rounded-4" style="width: 500px;">

            <!-- Quiz Info -->
            <div class="quiz-header text-center mb-3">
                <span class="quiz-name badge px-3 py-2 fs-5 fw-bold">
                    Quiz: {{$quizName}}
                </span>
                <p class="question-number mt-2 mb-0 fw-semibold">
                   Total Question: {{Session('currentQuiz')['currentMcq']}}
                   Of {{Session('currentQuiz')['totalMcq']}}
                </p>
            </div>

 <form action="/submit-next/{{ $mcqData->id }}" method="post">
    @csrf
    <input type="hidden" name="mcq_id" value="{{ $mcqData->id }}">
            <!-- Question -->
            <div class="question-box text-center mb-3">
                {{$mcqData->question}}
            </div>
            <!-- Options -->
           
                <label class="d-block mb-2" for="option_1">
                    <input class="form-check-input d-none" type="radio" name="answer" value="a" id="option_1">
                    <div class="option-box">Option A: {{$mcqData->a}}</div>
                </label>


                <label class="d-block mb-2" for="option_2">
                    <input class="form-check-input d-none" type="radio" value="b" name="answer" id="option_2">
                    <div class="option-box">Option B: {{$mcqData->b}}</div>
                </label>

                <label class="d-block mb-2" for="option_3">
                    <input class="form-check-input d-none" type="radio" value="c" name="answer" id="option_3">
                    <div class="option-box">Option C: {{$mcqData->c}}</div>
                </label>

                <label class="d-block mb-2" for="option_4">
                    <input class="form-check-input d-none" type="radio" value="d" name="answer" id="option_4">
                    <div class="option-box">Option D: {{$mcqData->d}}</div>
                </label>

                <div class="text-center">
                    <button class="next-btn">Next</button>

                </div>
            </form>


        </div>
    </div>

    <x-user-footer></x-user-footer>
</body>

</html>