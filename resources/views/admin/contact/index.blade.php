@extends('admin.layouts.master') @section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Contacts table</h4>
            <p class="card-description">
            </p>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Submitted on</th>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Position</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Fax</th>
                            <th>Street</th>
                            <th>Zip Code</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Comment</th>
                            <th>Page</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                            @foreach ($contacts as $contact)
                            <tr>
                                <td> {{++$i}}</td>
                                <td>{{ date("F j, Y g:i a", strtotime($contact->created_at)) }}</td>
                                <td>{{$contact->firstname}} {{$contact->lastname}}</td>
                                <td>{{$contact->company}}</td>
                                <td>{{$contact->position}}</td>
                                <td>{{$contact->email}}</td>
                                <td>{{$contact->phone}}</td>
                                <td>{{$contact->fax}}</td>
                                <td>{{$contact->street}}</td>
                                <td>{{$contact->zipcode}}</td>
                                <td>{{$contact->city}}</td>
                                <td>{{$contact->country}}</td>
                                <td>{{$contact->comment}}</td>
                                <td>
                                    <label class="badge badge-{{$contact->type == 'contact'? 'success' : 'info'}}">{{$contact->type}}</label>
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