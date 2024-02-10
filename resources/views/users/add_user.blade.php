@extends('layouts.app2')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class='row'>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add User </h4>
                        <div class="col-md-12">
                            <form method='POST' action='new-user' onsubmit='show()' enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class='col-md-12 form-group'>
                                        Name
                                        <input type="text" name='name' class="form-control" required placeholder="Name">
                                        @error('name')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                      </div>
                                      
                                      <div class='col-md-12 form-group'>
                                        Email  
                                        <input type="email" name='email' class="form-control" required placeholder="Email">
                                        @error('email')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                      </div>
                                      <div class='col-md-12 form-group'>
                                        Password  
                                        <input type="password" name='password' class="form-control" required placeholder="Password">
                                        @error('password')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                      </div>
                                      <div class='col-md-12 form-group'>
                                        Role  
                                        <select name="role" class="form-control" required>
                                            <option value="Administrator">Administrator</option>
                                            <option value="Encoder">Encoder</option>
                                            <option value="Loan Officer">Loan Officer</option>
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