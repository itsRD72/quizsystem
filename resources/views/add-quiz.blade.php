<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Add Quiz</title>
    <style>
    .quiz-title:hover {
        color: #0d6efd !important;
        cursor: pointer;
    }
    </style>
</head>
<body class="pt-5">
    <x-navbar name={{$name}}></x-navbar>
    <div class="container mt-5">
        <div class="d-flex justify-content-center mt-3 pt-3">
            <div class="card shadow-lg p-4 rounded-4" style="width: 350px;">
                @if(!Session('quizDetails'))
                <h1 class="text-center mb-4">Add Quiz</h1>
                <form action="/add-quiz" method="get">
                    <div class="mb-3 text-center">
                        <label for="" class="form-label">Enter Quiz Name</label>
                        <input type="text" name="quiz_name" id="" class="form-control rounded-pill" placeholder="Enter Quiz Name" required>
                    </div>
                    <div class="mb-3 text-center">
                        <label for="" class="form-label">Category Name</label>
                        <select name="category_id" id="" class="form-select rounded-pill" required>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->category}}</option>
                            @endforeach
                        </select>
                    </div>
                     <div class="d-grid">
                        <button class="btn btn-primary rounded-pill">ADD</button>
                    </div>
                </form>
                @else
                <span class="text-success fw-bold">Quiz: {{Session('quizDetails')->quiz_name}}</span>
                <p class="text-success fw-bold">Total MCQs: {{$totalMcqs}}
                    @if($totalMcqs>0)
                        <a class="text-decoration-none" href="/show-quiz/{{Session('quizDetails')->id}}">Show MCQs</a>
                    @endif
                </p>
                <h2 class="text-center mb-4">Add MCQs</h2>
                <form action="/add-mcq" method="post">
                    @csrf 
                    <div class="mb-3 text-center">
                        <textarea type="text" name="question" id="" class="form-control" placeholder="Enter Question">{{ old('question') }}</textarea>
                        @error('question')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3 text-center">
                        <input type="text" name="a" id="" class="form-control" value="{{ old('a') }}" placeholder="Enter First Option">
                        @error('a')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3 text-center">
                        <input type="text" name="b" id="" class="form-control" value="{{ old('b') }}" placeholder="Enter Second Option">
                        @error('b')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3 text-center">
                        <input type="text" name="c" id="" class="form-control" value="{{ old('c') }}" placeholder="Enter Third Option">
                        @error('c')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3 text-center">
                        <input type="text" name="d" id="" value="{{ old('d') }}" class="form-control" placeholder="Enter Fourth Option">
                        @error('d')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3 text-center">
                        <select name="right_ans" id="" class="form-select">
                            <option value="">Select Right Answer</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                        </select>
                        @error('right_ans')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="d-grid mb-3">
                        <button value="add-more" name="submit" class="btn btn-primary rounded-pill">ADD MORE</button>
                    </div>
                    <div class="d-grid mb-3">
                        <button value="done" name="submit" class="btn btn-success rounded-pill">ADD & SUBMIT</button>
                    </div>
                    <div class="d-grid">
                        <button value="exit" name="submit" class="btn btn-danger rounded-pill">FINISH & LEAVE</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</body>
</html>