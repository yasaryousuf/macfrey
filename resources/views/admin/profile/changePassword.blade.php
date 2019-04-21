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
            <form class="forms-sample" action="{{url('admin/profile/change-password')}}" method="POST" name="create-news" enctype="multipart/form-data">
                    @csrf
                <div class="form-group">
                    <label for="exampleInputName1">Current pasword</label>
                <input type="password" class="form-control" id="exampleInputName1" placeholder="Current pasword" name="current-password" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">New pasword</label>
                <input type="password" class="form-control" id="exampleInputName1" placeholder="New pasword" name="password" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Enter new pasword again</label>
                <input type="password" class="form-control" id="exampleInputName1" placeholder="Enter new pasword again" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-success mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection