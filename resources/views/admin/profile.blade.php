@extends('admin.layout')
@section('title', ' Admin Profile Page')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<style>
    /* CSS for password hide and show */
    .password-input-container {
        position: relative;
    }

    .password-input {
        padding-right: 32px;
    }

    .toggle-password {
        position: absolute;
        top: 10px;
        right: 20px;
        cursor: pointer;
        z-index: 9999;
    }

    /* CSS for profile hide and show */
    .one,
    .two,
    .three {
        background-color: white;
    }
    .profile {
        padding-top: 110px
    }
</style>

@section('content')
    <section class="section profile">
        <div class="row justify-content-center" style="padding-bottom: 50px">
            {{-- profile update success messages --}}
            @if (session('success'))
        <div class="alert w-75 mx-auto" style="margin-top: 30px;background-color:rgba(13, 78, 13, 0.651)">
            <div class="text-light fs-5">
                <i class='fas fa-grin-beam fs-5 text-warning me-2'></i>
                <strong>{{ session('success') }}</strong>
              <button  class="button btn-close float-end" ></button>
            </div>
          </div>
          @endif
           {{-- profile update error message --}}
          @if (session('error'))
          <div class="alert w-75 mx-auto" style="margin-top: 30px;background-color:rgba(141, 8, 26, 0.87)">
              <div class="text-light fs-5">
                <i class='fas fa-exclamation-triangle text-white'></i>
                  <strong>{{ session('error') }}</strong>
                <button  class="button btn-close float-end" ></button>
              </div>
            </div>
            @endif
             <div class="row">
                     {{-- profile left side --}}
            <div class="hello col-md-4 ms-md-5 me-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                              {{-- profile image --}}
                        @if (Auth::user()->image == null)
                        <div class="text-center mb-4">
                            <img src="{{ asset('admin/img/noimage.png') }}" alt="noimage" width="150"
                                height="150">
                        </div>
                    @else
                        <div class="text-center mb-4">
                            <img class=" rounded-circle img-thumbnail"
                                src="{{ asset('storage/admin/' . Auth::user()->image) }}" alt="image" width="150"
                                height="150">
                        </div>
                    @endif
                        <h2>{{ Auth::user()->name }}</h2>
                        <div class="social-link mt-2">
                            <a href="" class="me-2"><i class="fa-brands fa-twitter"></i></a>
                            <a href="" class="me-2"><i class="fa-brands fa-facebook"></i></a>
                            <a href="" class="me-2"><i class="fa-brands fa-instagram"></i></a>
                            <a href="" class="me-2"><i class="fa-brands fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- profile right side --}}
            <div class="hello col-md-6  mt-lg-0 mt-xs-3 mt-3 mt-md-0">
                <div class="card">
                    <div class="card-body pt-3">

                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link one active" data-bs-toggle="tab" id="1">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link two" data-bs-toggle="tab" id="2">Edit
                                    Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link three" data-bs-toggle="tab" id="3">Change
                                    Password</button>
                            </li>

                        </ul>

                        <div class="tab-content pt-2">
                            <!-- Overview Tab -->
                            <div class="tab-pane active" id="profile-overview">

                                <h5 class="card-title my-3"><i class='fas fa-address-card me-2 text-success'></i>Profile
                                    Details</h5>

                                <div class="row mt-3">
                                    <div class="col-lg-3 col-md-4 label text-primary "><i
                                            class='fas fa-user-circle me-2 text-primary'></i>Name:</div>
                                    <div class="col-lg-9 col-md-8 text-md-start text-center">{{ Auth::user()->name }}</div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-3 col-md-4 label text-primary "><i
                                            class='far fa-address-book me-2 text-primary'></i></i>Email:</div>
                                    <div class="col-lg-9 col-md-8 text-md-start text-center">{{ Auth::user()->email }}</div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-3 col-md-4 label text-primary "><i
                                            class='fas fa-bell me-2 text-primary'></i>Phone:</div>
                                    <div class="col-lg-9 col-md-8 text-md-start text-center">{{ Auth::user()->phone }}</div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-3 col-md-4 label text-primary "><i
                                            class='fas fa-map-marker-alt me-2 text-primary'></i>Address:</div>
                                    <div class="col-lg-9 col-md-8 text-md-start text-center">{{ Auth::user()->address }}
                                    </div>
                                </div>
                            </div>
                            <!-- End Overview Tab -->

                            <!-- Edit Profile Tab -->
                            <div class="tab-pane pt-3" id="profile-edit">
                                {{-- profile image --}}
                                @if (Auth::user()->image == null)
                                    <div class="text-center mb-4">
                                        <img src="{{ asset('admin/img/noimage.png') }}" alt="noimage" width="150"
                                            height="150">
                                    </div>
                                @else
                                    <div class="text-center mb-4">
                                        <img class=" rounded-circle img-thumbnail"
                                            src="{{ asset('storage/admin/' . Auth::user()->image) }}" alt="image"
                                            width="150" height="150">
                                    </div>
                                @endif

                                <!-- Profile Edit Form -->
                                <form action="{{ route('admin.profile.editProfile') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    {{-- image upload --}}
                                    <div class="mb-3 row">
                                        <label class="form-label col-md-5 col-3">Image Upload:</label>
                                        <div class=" col-md-6 col-8">
                                            <input type="file"
                                                class="form-control  @error('image')is-invalid @enderror" name="image">
                                        </div>
                                        @error('image')
                                            <div class="text-danger offset-md-5 offset-3">*{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--Name -->
                                    <div class="mb-3 row">
                                        <label for="name" class="form-label col-md-5   col-3">Name:</label>
                                        <div class=" col-md-6 col-8">
                                            <input type="text" class="form-control  @error('name')is-invalid @enderror"
                                                id="name" name="name"
                                                value="{{ old('name', Auth::user()->name) }}">
                                        </div>
                                        @error('name')
                                            <div class="text-danger offset-md-5 offset-3">*{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--Phone -->
                                    <div class="mb-3 row">
                                        <label for ="phone" class="form-label col-md-5   col-3">Phone:</label>
                                        <div class=" col-md-6 col-8">
                                            <input type="text"
                                                class="form-control  @error('phone')is-invalid @enderror" id="phone"
                                                name="phone" value="{{ old('phone', Auth::user()->phone) }}">
                                        </div>
                                        @error('phone')
                                            <div class="text-danger offset-md-5 offset-3">*{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!--Address -->
                                    <div class="mb-3 row">
                                        <label for ="address" class="form-label col-md-5   col-3">Address:</label>
                                        <div class=" col-md-6 col-8">
                                            <textarea name="address" id="address" class="form-control" cols="30" rows="3">{{ old('address', Auth::user()->address) }}</textarea>
                                        </div>
                                    </div>
                                    <!--  Edit btn -->
                                    <div class=" float-end">
                                        <input type="submit" value="Edit" class="btn btn-warning">
                                    </div>
                                </form>

                            </div>

                            <!-- End Edit Profile Tab -->

                            <!-- Change Password Tab -->
                            <div class="tab-pane  pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form action="{{route('admin.profile.changePassword')}}" method="POST">
                                    @csrf
                                    <!--Old Password -->
                                    <div class=" mb-3 row">
                                        <label for="oldPassword" class="form-label col-md-5   col-3">Old Password:</label>
                                        <div class="password-input-container col-md-6 col-8">
                                            <input type="password"
                                                class="form-control password-input  @error('oldPassword')is-invalid @enderror"
                                                id="oldPassword" name="oldPassword"> <i
                                                class="toggle-password fa fa-eye"></i>
                                            <i class="toggle-password fa fa-eye-slash"></i>
                                        </div>
                                        @error('oldPassword')
                                            <div class=" col-md-6 col-8 text-danger offset-md-5 offset-3">*{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <!--New Password -->
                                    <div class="mb-3 row">
                                        <label for="newPassword" class="form-label col-md-5   col-3">New Password:</label>
                                        <div class="password-input-container col-md-6 col-8">
                                            <input type="password"
                                                class="form-control password-input  @error('newPassword')is-invalid @enderror"
                                                id="newPassword" name="newPassword"> <i
                                                class="toggle-password fa fa-eye"></i>
                                            <i class="toggle-password fa fa-eye-slash"></i>
                                        </div>
                                        @error('newPassword')
                                            <div class=" col-md-6 col-8 text-danger offset-md-5 offset-3">*{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <!--Comfirm Password -->
                                    <div class="mb-3 row">
                                        <label for="comfirmPassword" class="form-label col-md-5   col-3">Comfirm
                                            Password:</label>
                                        <div class="password-input-container col-md-6 col-8">
                                            <input type="password"
                                                class="form-control password-input  @error('comfirmPassword')is-invalid @enderror"
                                                id="comfirmPassword" name="comfirmPassword"> <i
                                                class="toggle-password fa fa-eye"></i>
                                            <i class="toggle-password fa fa-eye-slash"></i>
                                        </div>
                                        @error('comfirmPassword')
                                            <div class=" col-md-6 col-8 text-danger offset-md-5 offset-3">*{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <!--  Edit btn -->
                                    <div class=" float-end">
                                        <input type="submit" value="Save Change" class="btn btn-success">
                                    </div>
                                </form>

                            </div>
                            <!-- End Change Password Tab -->
                        </div>

                    </div>
                </div>
            </div>
             </div>
            <!-- End Card Layout-->
            <script>
                //jquery
                $(document).ready(function() {
                    $(".toggle-password").click(function() {
                        var passwordInput = $($(this).siblings(".password-input"));
                        var icon = $(this);
                        if (passwordInput.attr("type") == "password") {
                            passwordInput.attr("type", "text");
                            icon.removeClass("fa-eye-slash").addClass("fa-eye");
                        } else {
                            passwordInput.attr("type", "password");
                            icon.removeClass("fa-eye").addClass("fa-eye-slash");
                        }
                    });
                    $('#1').click(function() {
                        $('#profile-edit').hide();
                        $('#profile-change-password').hide();
                        $('#profile-overview').show();
                    });
                    $('#2').click(function() {
                        $('#profile-edit').show();
                        $('#profile-change-password').hide();
                        $('#profile-overview').hide();
                    });
                    $('#3').click(function() {
                        $('#profile-edit').hide();
                        $('#profile-change-password').show();
                        $('#profile-overview').hide();
                    });
                    $('.button').click(function() {
                        $('.alert').hide();
                        $('.hello').addClass('.profile');
                    });

                })
            </script>
        </div>
    </section>
@endsection
