<html>
    <head>
        <title>Billing Sheet</title>
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                height: 20px;
            }
            body{
                font-size: 13px;
            }
        </style>
    </head>
    <body>
        
        <img src="{{ URL::asset('/storage/'.session('logo.file_path')) }}" style="height:auto;max-height:60px" class="mr-2 ml-2" alt="logo" />
        <center>
            <span>{{session('logo.name')}}</span> <br><br>
        </center>

        <span>Date: {{date('Y-m-d')}}</span> <br><br>
        

        <table width="100%">
            <thead>
                <tr>
                    <th align="center">Group</th>
                    <th align="center">Name</th>
                    <th align="center">Weekly Payment</th>
                    <th align="center">Remaining Balance</th>
                    <th align="center">Release Date</th>
                    <th align="center">Maturity Date</th>
                    <th align="center">Savings</th>
                    <th align="center">Amount</th>
                    <th align="center">Recovery Date</th>
                    <th align="center">Contact Number</th>
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
                    <td align="right">
                      @php
                          $weekly_payment = $item->billings[0]['total_amount_with_savings'];

                      @endphp
                      {{ number_format($weekly_payment, 2, '.', ',')}}
                    </td>
                    <td align="right">
                      @php
                          $total_payment = $item->payments->sum('actual_payment');
                          $remaining_balance = $item->total_amount - $total_payment;
                          if($remaining_balance <= 0){
                            $remaining_balance = 'Fully Paid';
                          }
                      @endphp
                      {{ $remaining_balance == 'Fully Paid' ? $remaining_balance  :  number_format($remaining_balance, 2, '.', ',')}}
                    </td>
                    <td>
                      @php
                          $release_date = date('Y-m-d',strtotime($item->release_date));

                      @endphp
                      {{$release_date}}
                    </td>
                    <td>
                      @php
                          $maturity_date = date('Y-m-d',strtotime($item->billings[0]['schedule_date']));

                      @endphp
                      {{$maturity_date}}
                    </td>
                    <td align="right">
                      @php
                          $savings = $item->billings[0]['savings'];
                      @endphp
                      {{ number_format($savings, 2, '.', ',')}}
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </body>
</html>