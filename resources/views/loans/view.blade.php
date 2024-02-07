@extends('layouts.app2')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class='row'>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-md-6">
                                <h4>Loan Details</h4>

                                <table class="table-bordered" style="width:100%">
                                    <tr>
                                        <td width="200px">Type</td>
                                        <td>{{$loan->type_info ? $loan->type_info->name : ""}}</td>
                                    </tr>
                                    <tr>
                                        <td>Term</td>
                                        <td>{{$loan->term}}</td>
                                    </tr>
                                    <tr>
                                        <td>Loan Amount</td>
                                        <td>{{ '₱ ' . number_format($loan->amount, 2, '.', ',') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Interest</td>
                                        <td>{{ $loan->interest . '%'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Interest</td>
                                        <td>{{ '₱ ' . number_format($loan->total_interest, 2, '.', ',') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount</td>
                                        <td>{{ '₱ ' . number_format($loan->total_amount, 2, '.', ',') }}</td>
                                    </tr>

                                </table>

                                
                                    <form method='get' action='{{url('view-loan/' . $loan->id)}}' onsubmit='show()' enctype="multipart/form-data">
                                        <div class="row mt-3">

                                            @if($loan->payment_start)
                                                <div class="col-sm-12">
                                                    <h4>Payment Start Date : {{$loan->payment_start}}</h4>
                                                </div>    
                                            @else
                                                @if($loan->status == 'For Approval')
                                                    <div class="col-sm-12">
                                                        <h4>Payment Start Date</h4>
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <input type="date" name="payment_start_date" class="form-control" value="{{ $payment_start_date }}">
                                                    </div>
                                                    <div class="col-sm-6 form-group">
                                                        <select data-placeholder="Select Savings" class="form-control form-control-sm required js-example-basic-single "
                                                            style='width:100%;' name='saving' required>
                                                            <option value="">--Select Savings--</option>
                                                            @foreach ($savings as $item)
                                                            <option value="{{ $item->amount }}" {{ $saving == $item->amount ? 'selected' : '' }}>
                                                                {{ $item->amount }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button type="submit" class="btn btn-primary btn-md">Generate Schedule</button>
                                                    </div>
                                                @endif
                                            @endif
                                            
                                            @if($loan->payment_start || $payment_start_date)
                                                <div class="col-md-12 mt-3">
                                                    <table class="table-bordered" width="100%">
                                                        <thead>
                                                            <th class="text-center">Week</th>
                                                            <th class="text-center">Schedule Date</th>
                                                            <th class="text-center">Principal</th>
                                                            <th class="text-center">Interest</th>
                                                            <th class="text-center">Total Amount</th>
                                                            <th class="text-center">Savings</th>
                                                            <th class="text-center">Total Amount w/ Savings</th>
                                                        </thead>
                                                        <tbody>

                                                            @php
                                                                if($loan->payment_start){
                                                                    $currentDate = new DateTime($loan->payment_start);
                                                                }else{
                                                                    $currentDate = new DateTime($payment_start_date);
                                                                }

                                                                $grand_total_principal = 0;
                                                                $grand_total_interest = 0;
                                                                $grand_total_amount = 0;
                                                                $grand_saving_amount = 0;
                                                                $grand_total_amount_with_savings  = 0;
                                                                for($term = 1 ; $term <= $loan->term; $term++){


                                                                    $principal = $loan->amount / $loan->term;
                                                                    $interest = $loan->total_interest / $loan->term;
                                                                    $total_saving = $saving;

                                                                    $total_amount = $principal + $interest;
                                                                    $total_amount_with_saving = $principal + $interest + $saving;

                                                                    echo "<tr>";
                                                                    echo '<td align="center">'.$term.'</td>';
                                                                    echo '<td align="center">'.$currentDate->format('Y-m-d').'</td>';
                                                                    echo '<td align="center">'.number_format($principal, 2, '.', ',').'</td>';
                                                                    echo '<td align="center">'.number_format($interest, 2, '.', ',').'</td>';
                                                                    echo '<td align="center">'.number_format($total_amount, 2, '.', ',').'</td>';
                                                                    echo '<td align="center">'.number_format($saving, 2, '.', ',').'</td>';
                                                                    echo '<td align="center">'.number_format($total_amount_with_saving, 2, '.', ',').'</td>';
                                                                    echo "</tr>";

                                                                    $type = 'W';
                                                                    if($loan->type_info->name == "Weekly"){
                                                                        $currentDate->add(new DateInterval('P1W'));
                                                                    }elseif($loan->type_info->name == "Monthly"){
                                                                        $currentDate->add(new DateInterval('P1M'));
                                                                    }

                                                                    $grand_total_principal += $principal;
                                                                    $grand_total_interest += $interest;
                                                                    $grand_total_amount += $principal + $interest;
                                                                    $grand_saving_amount += $saving;
                                                                    $grand_total_amount_with_savings += $total_amount_with_saving;
                                                                    
                                                                }
                                                            @endphp

                                                            <tr>
                                                                <td align="center" colspan="2" style="background-color: rgb(17, 126, 214);color:white"><strong>Grand Total</strong></td>
                                                                <td align="center">{{number_format($grand_total_principal, 2, '.', ',')}}</td>
                                                                <td align="center">{{number_format($grand_total_interest, 2, '.', ',')}}</td>
                                                                <td align="center">{{number_format($grand_total_amount, 2, '.', ',')}}</td>
                                                                <td align="center">{{number_format($grand_saving_amount, 2, '.', ',')}}</t>
                                                                
                                                                <td align="center">{{number_format($grand_total_amount_with_savings, 2, '.', ',')}}</td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                              
                            </div>

                            <div class="col-md-6">
                                <br>
                                <h4>Borrower Details</h4>
                                <table class="table-bordered" style="width:100%">
                                    <tr>
                                        <td width="200px">Borrower Code</td>
                                        <td>{{$loan->borrower->borrower_code}}</td>
                                    </tr>
                                    <tr>
                                        <td>Borrower Name</td>
                                        <td>{{$loan->borrower->first_name . ' ' . $loan->borrower->last_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Borrower Type</td>
                                        <td>{{ $loan->borrower->borrowerType ? $loan->borrower->borrowerType->name : "" }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="/borrowers/view/{{$loan->borrower->id}}" target="_blank" class="btn btn-primary btn-sm mt-2 mb-2 ml-2">View Details</a>
                                        </td>
                                    </tr>
                                </table>
                                <br>
                                <h4>Actual Payments</h4>
                                <div class="col-md-12">
                                    <table class="table-bordered" width="100%">
                                        <thead>
                                            <th class="text-center">Actual Payment</th>
                                            <th class="text-center">Log Date</th>
                                        </thead>
                                        <tbody>
                                            @php
                                            
                                                $total_actual_payment = 0;
                                                foreach($loan->payments as $item)
                                                {
                                                    echo "<tr>";
                                                    echo '<td align="center">'. number_format($item['actual_payment'], 2, '.', ',') .'</td>';
                                                    echo '<td align="center">'.date('Y-m-d h:i A',strtotime($item['created_at'])).'</td>';
                                                    echo "</tr>";

                                                    $total_actual_payment += $item['actual_payment'];
                                                }
                                            @endphp
                                            <tr>
                                                <td align="center"> <strong>{{number_format($total_actual_payment, 2, '.', ',')}}</strong> </td>
                                                <td align="center" style="background-color: rgb(17, 126, 214);color:white"><strong>Grand Total</strong></td>
                                            </tr>   
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>

                        @if($loan->status == 'For Approval' && $payment_start_date)
                            <div class="col-md-12 mt-3">
                                <button type="button" class="btn btn-success btn-md" id="{{ $loan->id }}" data-target="#approve-{{ $loan->id }}" data-toggle="modal" title="Disapprove">
                                    <i class="ti-check btn-icon-prepend"></i> Approve</button>
                                <button type="button" class="btn btn-danger btn-md" id="{{ $loan->id }}" data-target="#disapprove-{{ $loan->id }}" data-toggle="modal" title="Disapprove">
                                    <i class="ti-close btn-icon-prepend"></i> Disapprove</button>
                            </div>
                        @elseif($loan->status == 'Approved')
                            <h4 class="badge badge-success mt-1">Approved</h4>
                        @elseif($loan->status == 'Disapproved')
                            <h4 class="badge badge-danger mt-1">Disapproved</h4>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('loans.approve')
@include('loans.disapprove')
@endsection