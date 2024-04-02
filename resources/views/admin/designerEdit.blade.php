@extends('admin.layout')
@section('title', 'DESIGNER EDIT PAGE')
{{-- font aweson cdn link --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet" />
{{-- jquery cdn link --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
@section('content')
    <div class="container" style="height: 150vh">
        <p class="text-light fs-5" style="margin-top: 100px">
            DASHBOARD <span class="fs-3">></span> DESIGNERS <span class="fs-3">></span>
             DESIGNERS LIST
            <span class="fs-3">></span>
            <span class="text-info fs-5">
                DESIGNERS EDIT
            </span>
        </p>
        {{-- create designer success messages --}}
        @if (session('success'))
            <div class="alert w-75 mx-auto" style="margin-top: 30px;background-color:rgba(13, 78, 13, 0.651)">
                <div class="text-light fs-5">
                    <i class='fas fa-grin-beam fs-5 text-warning me-2'></i>
                    <strong>{{ session('success') }}</strong>
                    <button class="button btn-close float-end"></button>
                </div>
            </div>
        @endif
        {{-- create designer error message --}}
        @if (session('error'))
            <div class="alert w-75 mx-auto" style="margin-top: 30px;background-color:rgba(141, 8, 26, 0.87)">
                <div class="text-light fs-5">
                    <i class='fas fa-exclamation-triangle text-white'></i>
                    <strong>{{ session('error') }}</strong>
                    <button class="button btn-close float-end"></button>
                </div>
            </div>
        @endif
        {{-- designer update card --}}
        <div class="container-fluid">
            <div class="col-lg-6 offset-lg-3">
                <div class="card" style="background-color: rgba(255, 255, 255, 0.247)">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center text-primary">Update Designer</h3>
                        </div>
                        {{-- horizontal line --}}
                        <br>
                        {{-- designer form --}}
                        <form action="{{ route('create.designer.edit', $designerData->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- designer image --}}
                            <div class="form-group mb-3">
                                <label for="" class="form-label text-info">Designer Image:</label>
                                <input type="file" name="designerImage"
                                    class="form-control @error('designerImage')  is-invalid @enderror">
                                @error('designerImage')
                                    <div class="text-danger">
                                        *{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- designer name --}}
                            <div class="form-group mb-3">
                                <label for="" class="form-label text-info">Designer Name:</label>
                                <input type="text" name="designerName"
                                    class="form-control @error('designerName')  is-invalid @enderror"
                                    value="{{ old('designerName', $designerData->name) }}">
                                @error('designerName')
                                    <div class="text-danger">
                                        *{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- designer description --}}
                            <div class="form-group mb-3">
                                <label for="designerDescription" class="text-info">Designer Description:</label>
                                <textarea name="designerDescription" id="designerDescription" cols="30" rows="5"
                                    class="form-control @error('designerDescription')  is-invalid @enderror">{{ old('categoryDescription', $designerData->description) }}</textarea>
                                @error('designerDescription')
                                    <div class="text-danger">
                                        *{{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- button for card --}}
                            <div class="text-center">
                                <input type="submit" value="edit" class="btn btn-warning px-3">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- jquery codes --}}
    <script>
        $(document).ready(function() {
            $('.button').click(function() {
                $('.alert').hide();
            });
        });
    </script>
@endsection
