@extends('layouts.app2')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Billing Sheets</h4>
                <div class="col-md-12">
                  <form method='GET' action='{{url('billing-sheets')}}' onsubmit='show()' enctype="multipart/form-data">
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
                              <a href="/billing-sheets" class="btn btn-warning">Clear Filter</a>
                          </div>
                      </div>
                  </form>
              </div>
             
                <div class="table-responsive">
                  <table class="table table-hover table-bordered tablewithSearch">
                    <thead>
                        <tr>
                            <th>Group</th>
                            <th>Name</th>
                            <th>Weekly Payment</th>
                            <th>Remaining Balance</th>
                            <th>Release Date</th>
                            <th>Maturity Date</th>
                            <th>Savings</th>
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
                              {{$item->borrower->grouping ? $item->borrower->grouping->name : ""}}
                            </td>
                            <td>
                              {{$item->borrower->last_name . ', ' . $item->borrower->first_name}}
                            </td>
                            <td>
                              
                            </td>
                            <td>
                              
                            </td>
                            <td>
                              
                            </td>
                            <td>
                              
                            </td>
                            <td>
                              
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
