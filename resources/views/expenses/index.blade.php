@extends('layouts.app2')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Expenses</h4>
                <p class="card-description">
                    
                    <button type="button" class="btn btn-outline-success btn-icon-text" data-toggle="modal" data-target="#newExpense">
                      <i class="ti-plus btn-icon-prepend"></i>                                                    
                      New
                    </button>
          
                  </p>
             
                <div class="table-responsive">
                  <table class="table table-hover table-bordered tablewithSearch">
                    <thead>
                        <tr>
                            <th>Expense Date</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expenses as $item)
                        <tr>
                            <td> <a href="/edit-expense/{{$item->id}}" class="ml-3 mr-3">
                                <i class="ti-pencil"></i>
                            </a> {{$item->expense_date}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->amount}}</td>
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
@include('expenses.create')
@endsection
