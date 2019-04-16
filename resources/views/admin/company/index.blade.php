@extends('admin.layouts.master') @section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Company table</h4>
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
                            @foreach ($companies as $company)
                            <tr>
                                <td> {{++$i}}</td>
                                <td>{{$company->name}}</td>
                                <td>{{$company->slug}}</td>
                                <td>{{ substr($company->content,0,50) }}...</td>
                                <td>
                                    <a href="{{url('/company/'.$company->slug)}}" class="badge badge-success">FRONT</a>
                                    <a href="{{url('/admin/company/'.$company->slug.'/edit')}}" class="badge badge-primary">EDIT</a>

                                    <form action="{{ route('company.destroy',$company->id) }}" method="POST" style='display:inline'>
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