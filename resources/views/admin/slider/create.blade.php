@extends('admin.layouts.master') @section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('common.errorMessage')
                @include('common.sessionMessage')
                <h4 class="card-title">Slider form</h4>
                <p class="card-description">
                    Add latest slider
                </p>
                <form action="{{url('slider')}}" method="POST" name="create-slider" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputName1">Title</label>
                        <input type="text" class="form-control" placeholder="Title" name="title" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1">Subtitle</label>
                        <input type="text" class="form-control" placeholder="Subtitle" name="subtitle" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1">Link</label>
                        <input type="text" class="form-control" placeholder="link" name="link" required>
                    </div>

                    <img id="slider-image-preview" alt="your image"  height="200" style="margin-bottom:20px" src="{{asset('/images/No_Image.svg')}}"/>
                    <div class="form-group">

                        <label for="customFile">Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" onchange="document.getElementById('slider-image-preview').src = window.URL.createObjectURL(this.files[0])">
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
@section('script')

@endsection