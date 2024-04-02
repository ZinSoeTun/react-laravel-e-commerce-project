<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN PAGE</title>
      {{-- {-- favicon --}}
      <link rel="shortcut icon" href="{{ asset('admin/img/logo/logosn.png') }}" type="image/x-icon">
    {{-- bootstrap css cdn link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-dark">
    {{--login create card --}}
    <div class="container-fluid bg-dark mt-5">
        <div class="col-lg-6 offset-lg-3">
            <div class="card" style="background-color: rgba(255, 255, 255, 0.096)">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center text-primary">Login Form</h3>
                    </div>
                    {{-- horizontal line --}}
                    <br>
                    {{-- login form --}}
                    <form action="{{route('admin.login')}}" method="post" enctype="multipart/form-data">
                        @csrf
                          {{-- admin email --}}
                          <div class="form-group mb-3">
                            <label for="" class="form-label text-info">Admin Email:</label>
                            <input type="text" name="email"
                                class="form-control @error('email')  is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="please write your email...">
                            @error('email')
                                <div class="text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                          {{-- admin password --}}
                          <div class="form-group mb-3">
                            <label for="" class="form-label text-info">Admin Password:</label>
                            <input type="password" name="password"
                                class="form-control @error('password')  is-invalid @enderror"
                                value="{{ old('password') }}" placeholder="please write your password...">
                            @error('password')
                                <div class="text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-check">
                            <input class="form-check-input fs-5" type="checkbox" value="rememberMe" id="flexCheckIndeterminate">
                            <label class="form-check-label text-primary fs-5" for="flexCheckIndeterminate">
                              Remember Me
                            </label>
                          </div>
                          <div>
                            <a href="{{route('admin.register.page')}}">You don't have an account yet?</a>
                          </div>
                        {{-- button for card --}}
                        <div class="text-center">
                            <input type="submit" value="login" class="btn btn-primary px-3">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
