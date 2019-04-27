@extends('admin.layouts.master') @section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Drive system table</h4>
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
                            @foreach ($DriveSystems as $DriveSystem)
                            <tr>
                                <td> {{++$i}}</td>
                                <td>{{$DriveSystem->name}}</td>
                                <td>{{$DriveSystem->slug}}</td>
                                <td>{{date('d/m/Y', strtotime($DriveSystem->created_at))}}</td>
                                <td>
                                    <a href="{{url('/admin/drive_system/'.$DriveSystem->id.'/edit')}}" class="badge badge-primary">EDIT</a>

                                    <form action="{{ route('drive_system.destroy',$DriveSystem->id) }}" method="POST" style='display:inline'>
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