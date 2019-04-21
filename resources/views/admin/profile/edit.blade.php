@extends('admin.layouts.master')

@section('content')
<div class="row">
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
                @include('common.errorMessage')
                @include('common.sessionMessage')
            <h4 class="card-title">Profile form</h4>
            <p class="card-description">
                Edit user information
            </p>
            <form class="forms-sample" action="{{url('admin/profile')}}" method="POST" name="create-news" enctype="multipart/form-data">
                    @csrf
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                <input type="text" class="form-control" id="exampleInputName1" placeholder="Name" value="{{Auth::user()->name}}" name="name" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email" value="{{Auth::user()->email}}" name="email" required>
                </div>
                {{-- <div class="form-group">
                    <label>File upload</label>
                    <input type="file" name="img[]" class="file-upload-default">
                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                        </span>
                    </div>
                </div> --}}
                    <img id="profile-image-preview" alt="your image"  height="200" style="margin-bottom:20px" src="{{ Auth::user()->profile_image ? asset('/images/profile_image/'.Auth::user()->profile_image) : asset('/images/profile_image/avatar.png') }}"/>
                    <div class="form-group">

                        <label for="customFile">Thumbnail</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="profile_image" onchange="document.getElementById('profile-image-preview').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>                
                <button type="submit" class="btn btn-success mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection