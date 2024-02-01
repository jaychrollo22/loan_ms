@extends('layouts.app2')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class='row'>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Saving : {{$saving->name}}</h4>
                        <div class="col-md-12">
                            <form method='POST' action='{{url('update-saving/'.$saving->id)}}' onsubmit='show()' enctype="multipart/form-data">
                                @csrf
                               
                                <div class="row">
                                    <div class='col-md-6 form-group'>
                                        Name
                                        <input type="text" name="name" value="{{$saving->name}}" class="form-control">
                                    </div>
                                    <div class='col-md-6 form-group'>
                                        Amount
                                        <input type="number" name="amount" value="{{$saving->amount}}" class="form-control">
                                    </div>
                                    <div class='col-md-6 form-group'>
                                        Status
                                        <select class="form-control" name="status">
                                            <option value="">Choose Role</option>
                                            <option value="Active" {{ $saving->status == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ $saving->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <a href='/expenses' type="button" class="btn btn-secondary">Close</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                         
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection