<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Admin Categories</title>
    <style>
    .quiz-title:hover {
        color: #0d6efd !important;
        cursor: pointer;
    }
    </style>
</head>
<body class="pt-5">
    <x-navbar name={{$name}}></x-navbar>
            <div class="container mt-4">
               <div class="text-center my-4">
                    <h2 class="fw-bold text-primary">Quiz Name:{{$quizName}}</h2>
                        <a class="text-decoration-none text-warning" href="/add-quiz">BACK</a>
                </div>
                <table class="table table-bordered table-striped w-75 mx-auto text-center shadow-sm rounded-4">
                   <thead class="table-dark">
                        <tr>
                            <th>S. No</th>
                            <th>Question</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mcqs as $mcq)
                            <tr>
                                <td>{{$mcq->id}}</td>
                                <td>{{$mcq->question}}</td>
                                <td>
                                   <a href="">
                                     <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                                   </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
</body>
</html>