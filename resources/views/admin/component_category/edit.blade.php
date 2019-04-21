@extends('admin.layouts.master') @section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('common.errorMessage')
                @include('common.sessionMessage')
                <h4 class="card-title">Component category form</h4>
                <p class="card-description">
                    Edit component category
                </p>
                <br>
                <form action="{{route('component_category.update', ['id' => $componentCategory->id])}}" method="POST" name="edit-component-category">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Parent Category:</label>
                        <select class="form-control" id="exampleFormControlSelect2" name="parent_id">
                            <option value="">Choose your option</option>
                            @foreach ($componentCategories as $category)
                                <option value="{{$category->id}}" {{$componentCategory->parent_id == $category->id ? ' selected' : ''}}>{{$category->name}}</option>
                            @endforeach

                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputName1">Category Name:</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{$componentCategory->name}}" required>
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