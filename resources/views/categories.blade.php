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
    @if(session('category'))
        <div class="alert alert-success text-center mt-5 w-50 mx-auto" style="margin-top: 120px;">
            {{session('category')}}
        </div>
    @endif
    <div class="container mt-5">
        <div class="d-flex justify-content-center mt-3 pt-3">
            <div class="card shadow-lg p-4 rounded-4" style="width: 350px;">
                <h1 class="text-center mb-4">Add Category</h1>
                <form action="/add-category" method="post"> 
                    @csrf
                    <div class="mb-3 text-center">
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" name="category" id="" class="form-control rounded-pill" placeholder="Enter Category Name">
                        @error('category')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary rounded-pill">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
            <div class="container mt-4">
               <div class="text-center my-4">
                    <h2 class="fw-bold text-primary">Category List</h2>
                </div>
                <table class="table table-bordered table-striped w-75 mx-auto text-center shadow-sm rounded-4">
                   <thead class="table-dark">
                        <tr>
                            <th>S. No</th>
                            <th>Category</th>
                            <th>Creator</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->category}}</td>
                                <td>{{$category->creator}}</td>
                                <td>
                                   <a href="category/delete/{{$category->id}}">
                                     <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                                   </a>
                                   <a href="quiz-list/{{$category->id}}/{{$category->category}}">
                                     <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v333q-19-11-39-20t-41-16v-137H520v137q-46 14-86 40t-74 63H200v160h82q11 22 22 42t24 38H200Zm0-320h240v-160H200v160Zm0-240h560v-80H200v80Zm280 200Zm0 0Zm0 0Zm0 0ZM640-40q-91 0-168-48T360-220q35-84 112-132t168-48q91 0 168 48t112 132q-35 84-112 132T640-40Zm0-80q57 0 107.5-26t82.5-74q-32-48-82.5-74T640-320q-57 0-107.5 26T450-220q32 48 82.5 74T640-120Zm0-40q-25 0-42.5-17.5T580-220q0-25 17.5-42.5T640-280q25 0 42.5 17.5T700-220q0 25-17.5 42.5T640-160Z"/></svg>
                                   </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
</body>
</html>