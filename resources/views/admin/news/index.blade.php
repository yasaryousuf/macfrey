@extends('admin.layouts.master') @section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">News table</h4>
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
                                Title
                            </th>
                            <th>
                                Content
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
                            @foreach ($news as $singleNews)
                            <tr>
                                <td> {{++$i}}</td>
                                <td>{{$singleNews->title}}</td>
                                <td>{!!substr($singleNews->content, 0, 60)!!}...</td>
                                <td>{{date('d/m/Y', strtotime($singleNews->created_at))}}</td>
                                <td>
                                    <a href="{{url('/admin/news/'.$singleNews->id.'/edit')}}" class="badge badge-primary">EDIT</a>

                                    <form action="{{ route('news.destroy',$singleNews->id) }}" method="POST" style='display:inline'>
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