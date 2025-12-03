<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4 rounded-4" style="width: 350px;">
        <h1 class="text-center mb-4">Admin Login</h1>
        @error('user')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
        <form action="/admin-login" method="post"> 
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Admin Name</label>
                <input type="text" name="name" id="" class="form-control rounded-pill" placeholder="Enter Admin Name">
                @error('name')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Password</label>
                <input type="password" name="password" id="" class="form-control rounded-pill" placeholder="Enter Password">
                @error('password')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="d-grid">
                <button class="btn btn-primary rounded-pill">LogIn</button>
            </div>
        </form>
    </div>
</body>
</html>