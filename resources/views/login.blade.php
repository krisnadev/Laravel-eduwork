<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- Bootstrap -->
</head>

<body>
    <!-- Your Form here -->
    <div class="row justify-content-center">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    Login Form
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <label >Email</label>
                            <input type="email" name="email" class="form-control" required autofocus>
                        </div>
                        <div>
                            <label >Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <br>
                        <div>
                            <button class="btn btn-info" type="submit">Login</button>
                        </div>

                    </form>
                </div>

                @if ($errors->any())
                <div class="card-footer">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Your Form here -->
</body>

</html>