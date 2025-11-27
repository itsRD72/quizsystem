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
    <title>Result Page</title>
</head>

<body class="pt-5">
    <x-user-navbar></x-user-navbar>
    <div class="main-content pt-5">
        <div class="text-center my-4">
            <h2 class="sub-page-title">
                Result {{ $correctAnswers }} Out Of {{ count($resultData) }}
                is Correct
            </h2>
            @if($correctAnswers*100/count($resultData)>70)
            <a href="/certificate" class="forgot-link">View And Download Certificate</a>
            @endif
        </div>
        <table class="table w-75 mx-auto text-center shadow-sm rounded-4">
            <thead>
                <tr>
                    <th>S. No</th>
                    <th>Questions</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                @foreach($resultData as $key => $item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{ $item->question  }}</td>
                        @if($item->is_correct)
                        <td class="text-success">Correct</td>
                       @else
                       <td class="text-danger">Incorrect</td>
                       @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-user-footer></x-user-footer>
</body>

</html>