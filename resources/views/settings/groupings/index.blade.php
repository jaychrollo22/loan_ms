@extends('layouts.app2')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">Groupings</h4>
                <p class="card-description">
                    <a href="/groupings/create" class="btn btn-outline-success btn-icon-text">
                        <i class="ti-plus btn-icon-prepend"></i>
                        New
                    </a>
                </p>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered tablewithSearch">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Loan Officer</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groupings as $grouping)
                                <tr>
                                    <td> 
                                        <a href="/groupings/edit/{{ $grouping->id }}" class="ml-3 mr-3">
                                            <i class="ti-pencil"></i>
                                        </a> {{ $grouping->name  }}
                                    </td>
                                    <td>{{ $grouping->loanOfficer ? $grouping->loanOfficer->name : "" }}</td>
                                    <td>{{ $grouping->status }}</td>
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
{{-- <grouping></grouping> --}}
@endsection