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
    <title>Quiz Category Page</title>
</head>

<body>
    <x-user-navbar></x-user-navbar>
    <div class="container mt-5 pt-5 text-center">
        @if(session('message-success'))
            <div>
                <p class="text-success">{{ session('message-success') }}</p>
            </div>
        @endif
    </div>
    <div class="main-content">
        <div class="text-center my-4">
            <h2 class="sub-page-title">Categories</h2>
        </div>
        <table class="table w-75 mx-auto text-center shadow-sm rounded-4">
            <thead>
                <tr>
                    <th>S. No</th>
                    <th>Category</th>
                    <th>Quiz Count</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $key => $category)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$category->category}}</td>
                        <td>{{$category->quizzes_count}}</td>
                        <td>
                            <a href="user-quiz-list/{{$category->id}}/{{str_replace(' ', '-', $category->category)}}"
                                class="action-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                    fill="#1f1f1f">
                                    <path
                                        d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v333q-19-11-39-20t-41-16v-137H520v137q-46 14-86 40t-74 63H200v160h82q11 22 22 42t24 38H200Zm0-320h240v-160H200v160Zm0-240h560v-80H200v80Zm280 200Zm0 0Zm0 0Zm0 0ZM640-40q-91 0-168-48T360-220q35-84 112-132t168-48q91 0 168 48t112 132q-35 84-112 132T640-40Zm0-80q57 0 107.5-26t82.5-74q-32-48-82.5-74T640-320q-57 0-107.5 26T450-220q32 48 82.5 74T640-120Zm0-40q-25 0-42.5-17.5T580-220q0-25 17.5-42.5T640-280q25 0 42.5 17.5T700-220q0 25-17.5 42.5T640-160Z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> 
            <div class="">
                {{ $categories->links() }}
            </div>
    </div>

    <x-user-footer></x-user-footer>
</body>

</html>