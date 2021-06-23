<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/flatly/bootstrap.min.css" integrity="undefined" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/jpg" href="{{asset('favicon/book.png')}}"/>
</head>
<body class="bg-primary h-100 align-items-center">
    <div class="container w-100 h-100 d-flex justify-content-center align-items-center my-5">
        <div class="card card-lg text-center" style="width: 26rem;">
            <div class="card-body">
                <h3 class="card-title">Login</h3>
                <form method="POST" action="{{url('auth')}}">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>