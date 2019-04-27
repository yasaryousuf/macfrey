@extends('admin.layouts.master') @section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('common.errorMessage')
                @include('common.sessionMessage')
                <h4 class="card-title">Drive System form</h4>
                <p class="card-description">
                    Edit drive system
                </p>
                <form action="{{route('drive_system.update', ['id' => $DriveSystem->id])}}" method="POST" name="edit-drive-system" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                 <div class="form-group">
                        <label for="exampleFormControlSelect2">Parent Category:</label>
                        <select class="form-control" id="exampleFormControlSelect2" name="drive_system_category_id" required>
                            <option value="" selected disabled>Choose your option</option>
                            @foreach ($DriveSystemCategories as $DriveSystemCategory)
                                <option value="{{$DriveSystemCategory->id}}" <?= ($DriveSystemCategory->id==$DriveSystem->drive_system_category_id ? ' selected' : '') ?>>{{$DriveSystemCategory->name}}</option>
                            @endforeach

                        </select>
                    </div>  

                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name" required value="{{$DriveSystem->name}}">
                    </div>

                    <img id="drive-system-thumbnail-preview" alt="your image"  height="200" style="margin-bottom:20px"  src="{{$DriveSystem->thumbnail_image ? asset('/images/drive_system/'.$DriveSystem->thumbnail_image) : asset('/images/No_Image.svg')}}"/>
                    <div class="form-group">
                        <label for="customFile">Thumbnail</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="thumbnail" onchange="document.getElementById('drive-system-thumbnail-preview').src = window.URL.createObjectURL(this.files[0])">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>

                    <img id="drive-system-image-preview" alt="your image"  height="200" style="margin-bottom:20px"  src="{{$DriveSystem->image ? asset('/images/drive_system/'.$DriveSystem->image) : asset('/images/No_Image.svg')}}"/>
                    <div class="form-group">
                        <label for="customFile">Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" onchange="document.getElementById('drive-system-image-preview').src = window.URL.createObjectURL(this.files[0])">
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
@endsection @section('script')

@endsection