@extends('layouts.app2')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class='row'>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Users 
                        </h4>
                        <p class="card-description">
                    
                            <a href="add-user" type="button" class="btn btn-outline-success btn-icon-text">
                              <i class="ti-plus btn-icon-prepend"></i>                                                    
                              New
                            </a>
                  
                          </p>
                          
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" style="display: block;margin:0px 0px 10px 0px;" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif

                        <h4 class="card-title">Filter</h4>
						<form method='get' onsubmit='show();' enctype="multipart/form-data">
							<div class=row>
                                <div class='col-md-6'>
									<div class="form-group">
                                        <input type="text" class="form-control" name="search" placeholder="Search Name" value="{{$search}}">
                                    </div>
                                </div>
                                <div class='col-md-6'>
									<button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="/users" class="btn btn-warning">Reset Filter</a>
								</div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table border="1" class="table table-hover table-bordered users_table" id='users_table'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role}}</td>
                                        <td>
                                            <a href="/edit-user/{{$user->id}}" target="_blank" class="btn btn-outline-info btn-icon-text btn-sm">
                                                Edit
                                                <i class="ti-file btn-icon-append"></i>
                                            </a>
                                            <a href="/change-password/{{$user->id}}" target="_blank" class="btn btn-outline-info btn-icon-text btn-sm">
                                                Change Password
                                                <i class="ti-key btn-icon-append"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection