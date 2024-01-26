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
                                    <div class='col-md-4'>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="search" placeholder="Search Loan Number / Borrower" value="{{$search}}">
                                        </div>
                                    </div>
                                    <div class='col-md-2'>
                                        <button type="submit" class="btn btn-primary">Search</button>
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
                                      <th>Total Payment</th>
                                      <th>Last Payment</th>
                                      <th>Amount to Pay</th>
                                      <th>Remaining Balance</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($loans as $item)
                                    <tr>
                                        <td> <a href="/edit-loan/{{$item->id}}" class="ml-3 mr-3" title="Edit">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        {{$item->loan_number}}</td>
                                        <td>{{$item->borrower ? $item->borrower->id : "" }}</td>
                                        <td>{{$item->borrower ?  $item->borrower->first_name . ' ' . $item->borrower->last_name  : "" }}</td>
                                        <td>
                                            @php
                                                $totalPayments = $item->payments->sum('actual_payment');
                                            @endphp
                                            {{ number_format($totalPayments, 2, '.', ',')}}
                                        </td>
                                        <td>
                                            @php
                                                $latestPayments = $item->payments->first();
                                            @endphp
                                            {{ $latestPayments ? number_format($latestPayments->actual_payment, 2, '.', ',') : "" }} <br>
                                            <small> {{ $latestPayments ? 'Date ' . date('Y-m-d', strtotime($latestPayments->created_at)) : "" }} </small>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td align="center">
                                            <button class="btn btn-primary" id="{{ $item->id }}" data-target="#pay-{{ $item->id }}" data-toggle="modal" title='Approve' onclick="openModal({{ $item->id }})">Pay</button>
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

