@extends('layouts.app2')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Companies</h4>
                <p class="card-description">
                    <a href="/companies/create" class="btn btn-outline-success btn-icon-text">
                        <i class="ti-plus btn-icon-prepend"></i>
                        New
                    </a>
                </p>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered tablewithSearch">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Logo</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <td> 
                                        <a href="/companies/edit/{{ $company->id }}" class="ml-3 mr-3">
                                            <i class="ti-pencil"></i>
                                        </a> {{ $company->name  }}
                                    </td>
                                    <td>{{ $company->address }}</td>
                                    <td>{{ $company->file_path }}</td>
                                    <td>{{ $company->status }}</td>
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
@endsection