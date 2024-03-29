@extends('layouts.app2')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class='row'>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Payments</h4>
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
                                        <a href="/payments" class="btn btn-warning">Clear Filter</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered tablewithSearch">
                              <thead>
                                  <tr>
                                      <th>Loan No.</th>
                                      <th>Borrower No.</th>
                                      <th>Name</th>
                                      <th>Loan Amount</th>
                                      <th>Total Payment</th>
                                      {{-- <th>Last Payment</th>
                                      <th>Amount to Pay</th> --}}
                                      <th>Remaining Balance</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($loans as $item)
                                    <tr>
                                        <td>
                                            {{$item->loan_number}}</td>
                                        <td>{{$item->borrower ? $item->borrower->borrower_code : "" }}</td>
                                        <td>{{$item->borrower ?  $item->borrower->first_name . ' ' . $item->borrower->last_name  : "" }}</td>
                                        <td>
                                            {{ number_format($item->total_amount, 2, '.', ',')}}
                                        </td>
                                        <td>
                                            @php
                                                $total_payments = $item->payments->sum('actual_payment');
                                            @endphp
                                            {{ number_format($total_payments, 2, '.', ',')}}
                                        </td>
                                        {{-- <td>
                                            @php
                                                $latestPayments = $item->payments->first();
                                            @endphp
                                            {{ $latestPayments ? number_format($latestPayments->actual_payment, 2, '.', ',') : "" }} <br>
                                            <small> {{ $latestPayments ? 'Date ' . date('Y-m-d', strtotime($latestPayments->created_at)) : "" }} </small>
                                        </td> --}}
                                        {{-- <td></td> --}}
                                        <td>
                                            @php
                                                $remaining_balance = $item->total_amount - $total_payments;
                                            @endphp
                                            {{ number_format($remaining_balance, 2, '.', ',')}}

                                        </td>
                                        <td align="center">
                                            @if($remaining_balance <= 0 )
                                                <button class="btn btn-primary" id="{{ $item->id }}" data-target="#pay-{{ $item->id }}" data-toggle="modal" title='Approve' onclick="openModal({{ $item->id }})">Paid</button>
                                            @else
                                                <button class="btn btn-primary" id="{{ $item->id }}" data-target="#pay-{{ $item->id }}" data-toggle="modal" title='Approve' onclick="openModal({{ $item->id }})">Pay</button>
                                            @endif
                                            
                                            <a href="view-loan/{{$item->id}}" target="_blank" class="btn btn-success">View</button>
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

@foreach ($loans as $loan)
  @include('payments.pay')
@endforeach

@endsection
<script>
    // Function to open the modal and autofocus on the input
    function openModal(id) {
        var modalInput = document.getElementById("input-" + id);
        modalInput.focus();
    }
</script>

