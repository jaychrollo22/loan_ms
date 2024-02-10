@extends('layouts.app2')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class='row'>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update User  : {{$user->name}}</h4>
                        <div class="col-md-12">
                            <form method='POST' action='{{url('update-user/' . $user->id)}}' onsubmit='show()' enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class='col-md-12 form-group'>
                                        Name
                                        <input type="text" name='name' class="form-control" required placeholder="Name" value="{{$user->name}}">
                                        @error('name')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                      </div>
                                      
                                    <div class='col-md-12 form-group'>
                                        Email  
                                        <input type="email" name='email' class="form-control" required placeholder="Email" value="{{$user->email}}">
                                        @error('email')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class='col-md-12 form-group'>
                                        Role  
                                        <select name="role" class="form-control" required>
                                            <option value="Administrator" {{$user->role == 'Administrator' ? 'selected' :""}}>Administrator</option>
                                            <option value="Encoder" {{$user->role == 'Encoder' ? 'selected' :""}}>Encoder</option>
                                            <option value="Loan Officer" {{$user->role == 'Loan Officer' ? 'selected' :""}}>Loan Officer</option>
                                        </select>
                                      </div>
                                </div>
                                <a href='/users' type="button" class="btn btn-secondary">Close</a>
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