<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <title>Category Name: {{str_replace('-',' ',$category)}}</title>
</head>
<body class="pt-5">
    <x-user-navbar></x-user-navbar>
            
    <x-user-footer></x-user-footer>
</body><div class="main-content">
               <div class="text-center my-4">
                    <h2 class="sub-page-title mt-5">Category Name: {{str_replace('-',' ',$category)}}</h2>
                </div>
                <table class="table w-75 mx-auto text-center shadow-sm rounded-4">
                   <thead class="table-dark">
                        <tr>
                            <th>Quiz Id</th>
                            <th>Quiz Name</th>
                            <th>Mcq Count</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quizData as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->quiz_name}}</td>
                                <td>{{$item->mcq_count}}</td>
                                <td>
                                   <a href="/start-quiz/{{$item->id}}/{{str_replace(' ','-',$item->quiz_name)}}" class="action-btn">
                                     Attempt Quiz
                                   </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
</html>