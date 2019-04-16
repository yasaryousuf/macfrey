@extends('admin.layouts.master') @section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Service table</h4>
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
                                Content
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                            @foreach ($services as $service)
                            <tr>
                                <td> {{++$i}}</td>
                                <td>{{$service->name}}</td>
                                <td>{{$service->slug}}</td>
                                <td>{{ substr($service->content,0,50) }}...</td>
                                <td>
                                    <a href="{{url('/service/'.$service->slug)}}" class="badge badge-success">FRONT</a>
                                    <a href="{{url('/admin/service/'.$service->slug.'/edit')}}" class="badge badge-primary">EDIT</a>

                                    <form action="{{ route('service.destroy',$service->id) }}" method="POST" style='display:inline'>
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