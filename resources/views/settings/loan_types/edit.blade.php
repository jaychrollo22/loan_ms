@extends('layouts.app')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class='row'>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Loan Type : {{$loan_type->name}}</h4>
                        <div class="col-md-12">
                            <form method='POST' action='{{url('update-loan-type/'.$loan_type->id)}}' onsubmit='show()' enctype="multipart/form-data">
                                @csrf
                               
                                <div class="row">
                                    <div class='col-md-6 form-group'>
                                        Loan Type
                                        <input type="text" name="name" value="{{$loan_type->name}}" class="form-control">
                                    </div>
                                    <div class='col-md-6 form-group'>
                                        Description
                                        <input type="text" name="description" value="{{$loan_type->description}}" class="form-control">
                                    </div>
                                    <div class='col-md-6 form-group'>
                                        Status
                                        <select class="form-control" name="status">
                                            <option value="">Choose Role</option>
                                            <option value="Active" {{ $loan_type->status == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ $loan_type->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <a href='/loan-terms' type="button" class="btn btn-secondary">Close</a>
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