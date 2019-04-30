@extends('admin.layouts.master') @section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Slider table</h4>
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
                                Subtitle
                            </th>
                            <th>
                                Title
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                            @foreach ($sliders as $slider)
                            <tr>
                                <td> {{++$i}}</td>
                                <td>{{$slider->title}}</td>
                                <td>{{$slider->subtitle}}</td>
                                <td>{{$slider->url}}</td>
                                <td>
                                    <a href="{{url('/admin/slider/'.$slider->id.'/edit')}}" class="badge badge-primary">EDIT</a>

                                    <form action="{{ route('slider.destroy',$slider->id) }}" method="POST" style='display:inline'>
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