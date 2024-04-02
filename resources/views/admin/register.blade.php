<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REGISTER PAGE</title>
    {{-- {-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('admin/img/logo/logosn.png') }}" type="image/x-icon">

    {{-- bootstrap css cdn link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-dark">
    {{--register create card --}}
    <div class="container-fluid bg-dark mt-5">
        <div class="col-lg-6 offset-lg-3">
            <div class="card" style="background-color: rgba(255, 255, 255, 0.096)">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center text-primary">Register Form</h3>
                    </div>
                    {{-- horizontal line --}}
                    <br>
                    {{-- register form --}}
                    <form action="{{route('admin.register')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- admin image --}}
                        <div class="form-group mb-3">
                            <label for="" class="form-label text-info">Admin Image:</label>
                            <input type="file" name="adminImage"
                                class="form-control @error('adminImage')  is-invalid @enderror">
                            @error('adminImage')
                                <div class="text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- admin name --}}
                        <div class="form-group mb-3">
                            <label for="" class="form-label text-info">Admin Name:</label>
                            <input type="text" name="adminName"
                                class="form-control @error('adminName')  is-invalid @enderror"
                                value="{{ old('adminName') }}" placeholder="please write your name...">
                            @error('adminName')
                                <div class="text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                          {{-- admin email --}}
                          <div class="form-group mb-3">
                            <label for="" class="form-label text-info">Admin Email:</label>
                            <input type="text" name="adminEmail"
                                class="form-control @error('adminEmail')  is-invalid @enderror"
                                value="{{ old('adminEmail') }}" placeholder="please write your email...">
                            @error('adminEmail')
                                <div class="text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                          {{-- admin password --}}
                          <div class="form-group mb-3">
                            <label for="" class="form-label text-info">Admin Password:</label>
                            <input type="password" name="adminPassword"
                                class="form-control @error('adminPassword')  is-invalid @enderror"
                                value="{{ old('adminPassword') }}" placeholder="please write your password...">
                            @error('adminPassword')
                                <div class="text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- admin phone --}}
                        <div class="form-group mb-3">
                            <label for="" class="form-label text-info">Admin Phone:</label>
                            <input type="text" name="adminPhone"
                                class="form-control @error('adminPhone')  is-invalid @enderror"
                                value="{{ old('adminPhone') }}" placeholder="please write your phone number...">
                            @error('adminPhone')
                                <div class="text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <input type="hidden" value="admin" name="role">
                        </div>
                        {{-- admin address --}}
                        <div class="form-group mb-3">
                            <label for="" class="form-label text-info">Admin Address:</label>
                            <input type="text" name="adminAddress"
                                class="form-control @error('adminAddress')  is-invalid @enderror"
                                value="{{ old('adminAddress') }}" placeholder="please write your address...">
                            @error('adminAddress')
                                <div class="text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <a href="{{route('admin.login.page')}}" class="text-primary">You have Already Account?</a>
                        {{-- button for card --}}
                        <div class="text-center">
                            <input type="submit" value="register" class="btn btn-primary px-3">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
