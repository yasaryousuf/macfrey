@extends('admin.layouts.master') @section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Drive system category table</h4>
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
                                Slug
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
                            @foreach ($DriveSystemCategories as $DriveSystemCategory)
                            <tr>
                                <td> {{++$i}}</td>
                                <td>{{$DriveSystemCategory->name}}</td>
                                <td>{{$DriveSystemCategory->slug}}</td>
                                <td>{{date('d/m/Y', strtotime($DriveSystemCategory->created_at))}}</td>
                                <td>
                                    <a href="{{url('/admin/drive_system_category/'.$DriveSystemCategory->id.'/edit')}}" class="badge badge-primary">EDIT</a>

                                    <form action="{{ route('drive_system_category.destroy',$DriveSystemCategory->id) }}" method="POST" style='display:inline'>
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