@extends('layouts.app2')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Loans</h4>
                <div class="col-md-12">
                  <form method='GET' action='{{url('payments')}}' onsubmit='show()' enctype="multipart/form-data">
                      <div class=row>
                          <div class='col-md-3'>
                              <div class="form-group">
                                  <input type="text" class="form-control" name="search" placeholder="Search Loan Number / Borrower" value="{{$search}}">
                              </div>
                          </div>
                          <div class='col-md-3'>
                              <div class="form-group">
                                  
                                  <select data-placeholder="Select Groupings" class="form-control form-control-sm required js-example-basic-single" style='width:100%;' name='grouping'>
                                      <option value="">-- Select Groupings --</option>
                                      @foreach($groupings as $item)
                                      <option value="{{$item->id}}" @if ($item->id == $grouping) selected @endif>{{$item->name}} {{ $item->loanOfficer ? '- ' . $item->loanOfficer->name : ""}}</option>
                                      @endforeach
                                  </select>
                                  
                              </div>
                          </div>
                          <div class='col-md-2'>
                              <button type="submit" class="btn btn-primary">Search</button>
                              <a href="/loans" class="btn btn-warning">Clear Filter</a>
                          </div>
                      </div>
                  </form>
              </div>
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
                            <th>Borrower Code</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Term</th>
                            <th>Amount</th>
                            <th>Interest</th>
                            <th>Total Interest</th>
                            <th>Total Amount</th>
                            <th>Payment Start</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans as $item)
                        <tr>
                            <td>
                              @if($item->status == "For Approval")
                              <a href="/edit-loan/{{$item->id}}" class="ml-3 mr-3" title="Edit">
                                <i class="ti-pencil"></i>
                              </a>
                              @endif
                              {{$item->loan_number}}</td>
                            <td>{{$item->borrower ? $item->borrower->borrower_code : "" }}</td>
                            <td>
                              {{$item->borrower ?  $item->borrower->first_name . ' ' . $item->borrower->last_name  : "" }} <br>
                              <small>
                                {{$item->borrower->borrowerType ?  $item->borrower->borrowerType->name  : "" }}
                                @php
                                  $group = '';
                                  $borrower_type = $item->borrower->borrowerType ?  $item->borrower->borrowerType->name : "";
                                  if($borrower_type == 'Group'){
                                    $group = $item->borrower->grouping ?  ' : ' . $item->borrower->grouping->name : "";
                                  }
                                @endphp
                              </small>
                              <small>{{$group}}</small>
                            </td>
                            <td>{{$item->type_info ? $item->type_info->name : "" }}</td>
                            <td>{{$item->term }}</td>
                            <td>{{ '₱ ' . number_format($item->amount, 2, '.', ',') }}</td>
                            <td>{{$item->interest . '%' }}</td>
                            <td>{{ '₱ ' . number_format($item->total_interest, 2, '.', ',') }}</td>
                            <td>{{ '₱ ' . number_format($item->total_amount, 2, '.', ',') }}</td>
                            <td>{{$item->release_date }}</td>
                            <td><a href="/view-loan/{{$item->id}}" class="ml-3 mr-3"> {{$item->status}} </a></td>
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
