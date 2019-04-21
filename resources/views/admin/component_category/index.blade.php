@extends('admin.layouts.master') @section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Component category table</h4>
            <p class="card-description">
            </p>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Parent (if any)
                            </th>
                            <th>
                                Created at
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                            @foreach ($componentCategories as $componentCategory)
                            <tr>
                                <td> {{++$i}}</td>
                                <td>{{$componentCategory->name}}</td>
                                <td>{{ $componentCategory->parent_id ? \App\ComponentCategory::find($componentCategory->parent_id)->name : '-' }}</td>
                                <td>{{date('d/m/Y', strtotime($componentCategory->created_at))}}</td>
                                <td>
                                    <a href="{{url('/admin/component_category/'.$componentCategory->id.'/edit')}}" class="badge badge-primary">EDIT</a>

                                    <form action="{{ route('component_category.destroy',$componentCategory->id) }}" method="POST" style='display:inline'>
                                        @csrf @method('DELETE')
                                        <button type="submit" class="badge badge-danger" onclick="return confirm('are you sure?')" style="cursor: pointer;" >Delete</button>

                                    </form>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection