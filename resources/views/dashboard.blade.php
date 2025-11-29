<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <title>Admin Dashboard</title>
    <style>
        .quiz-title:hover {
            color: #0d6efd !important;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <x-navbar :name="$name"></x-navbar>
    <div class="container mt-4">
        <div class="text-center my-4">
            <h2 class="fw-bold text-primary">Category List</h2>
        </div>
        <table class="table table-bordered table-striped w-75 mx-auto text-center shadow-sm rounded-4">
            <thead class="table-dark">
                <tr>
                    <th>S. No</th>
                    <th>User Name</th>
                    <th>EMail</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No users found.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        <div class="w-75 mx-auto d-flex justify-content-between align-items-center mt-3">
            <div>
                Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() ?? 0 }}
                results
            </div>
            <div>
                {{ $users->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</body>

</html>