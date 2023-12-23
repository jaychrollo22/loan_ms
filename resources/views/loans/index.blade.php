@extends('layouts.app2')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Loans</h4>
                <p class="card-description">

                    <a href="/create-loan" class="btn btn-outline-success btn-icon-text">
                      <i class="ti-plus btn-icon-prepend"></i>                                                    
                      New
                    </a>
          
                  </p>
             
                <div class="table-responsive">
                  <table class="table table-hover table-bordered tablewithSearch">
                    <thead>
                        <tr>
                            <th>Loan No.</th>
                            <th>Borrower No.</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Term</th>
                            <th>Amount</th>
                            <th>Interest</th>
                            <th>Total Interest</th>
                            <th>Total Amount</th>
                            <th>Release Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans as $item)
                        <tr>
                            <td> <a href="/edit-loan/{{$item->id}}" class="ml-3 mr-3">
                                <i class="ti-pencil"></i>
                            </a>{{$item->loan_number}}</td>
                            <td>{{$item->borrower ?  "BID-" . $item->borrower->id : "" }}</td>
                            <td>{{$item->borrower ?  $item->borrower->first_name . ' ' . $item->borrower->last_name  : "" }}</td>
                            <td>{{$item->type_info ? $item->type_info->name : "" }}</td>
                            <td>{{$item->term }}</td>
                            <td>{{$item->amount }}</td>
                            <td>{{$item->interest }}</td>
                            <td>{{$item->total_interest }}</td>
                            <td>{{$item->total_amount }}</td>
                            <td>{{$item->release_date }}</td>
                            <td>{{$item->status}}</td>
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
