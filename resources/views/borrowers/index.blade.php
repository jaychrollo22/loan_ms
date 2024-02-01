@extends('layouts.app2')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Borrowers</h4>
                <p class="card-description">
                    <a href="/borrowers/create" class="btn btn-outline-success btn-icon-text">
                        <i class="ti-plus btn-icon-prepend"></i>
                        New 
                    </a>
                </p>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered tablewithSearch">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Suffix</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($borrowers as $borrower)
                                <tr>
                                    <td> 
                                        <a href="/borrowers/edit/{{ $borrower->id }}" class="ml-3 mr-3">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <a href="/borrowers/view/{{ $borrower->id }}" class="ml-3 mr-3">
                                            <i class="ti-eye"></i>
                                        </a>
                                        {{ $borrower->first_name  }}
                                    </td>
                                    <td>{{ $borrower->middle_name }}</td>
                                    <td>{{ $borrower->last_name }}</td>
                                    <td>{{ $borrower->suffix }}</td>
                                    <td>{{ $borrower->status }}</td>
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
    {{-- <borrower></borrower> --}}
@endsection