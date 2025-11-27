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
    <title>User Detail Page</title>
</head>

<body class="pt-5">
    <x-user-navbar></x-user-navbar>
    <div class="main-content pt-5">
        <div class="text-center my-4">
            <h2 class="sub-page-title">Your Attempted Quiz</h2>
        </div>
        <table class="table w-75 mx-auto text-center shadow-sm rounded-4">
            <thead>
                <tr>
                    <th>S. No</th>
                    <th>Quiz Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quizRecord as $key => $record)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{ $record->quiz_name  }}</td>
                        <td>
                            @if($record->status == 2)
                            <span class="text-success">Completed</span>
                            @else
                            <span class="text-danger">Incomplete</span>
                            @endif
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-user-footer></x-user-footer>
</body>

</html>