@extends('admin.layouts.master') @section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('common.errorMessage')
                @include('common.sessionMessage')
                <h4 class="card-title">Drive System category form</h4>
                <p class="card-description">
                    Add drive system category
                </p>
                <br/>  
                <form action="{{url('drive_system_category')}}" method="POST" name="create-drive-system-category">
                    @csrf                  
                    <div class="form-group">
                        <label for="exampleInputName1">Category Name:</label>
                        <input type="text" class="form-control" placeholder="Name" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection @section('script')

@endsection