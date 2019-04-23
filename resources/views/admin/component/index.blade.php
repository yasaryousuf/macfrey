@extends('admin.layouts.master') @section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Component table</h4>
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
                                Description
                            </th>
                            <th>
                                Created at
                            </th>
                            <th>
                                Type
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                            @foreach ($components as $component)
                            <tr>
                                <td> {{++$i}}</td>
                                <td>{{$component->name}}</td>
                                <td>{{substr($component->description, 0, 60)}}...</td>
                                <td>{{date('d/m/Y', strtotime($component->created_at))}}</td>
                                <td>{{$component->category->name}}</td>
                                <td>
                                    <a href="{{url('/admin/component/'.$component->id.'/edit')}}" class="badge badge-primary">EDIT</a>

                                    <form action="{{ route('component.destroy',$component->id) }}" method="POST" style='display:inline'>
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