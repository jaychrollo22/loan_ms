@extends('layouts.app2')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class='row'>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create Loan</h4>
                        <div class="col-md-12">
                            <form method='POST' action='{{url('new-loan')}}' onsubmit='show()' enctype="multipart/form-data">
                                @csrf
                               
                                <div class="row">
                          
                                    <div class="col-lg-12 form-group">
                                      <label for="borrower">Borrower</label>
                                      <select data-placeholder="Select Borrower" class="form-control form-control-sm required js-example-basic-single "
                                        style='width:100%;' name='borrower_id' required>
                                        <option value="">--Select Borrower--</option>
                                        @foreach ($borrowers as $borrower)
                                          <option value="{{ $borrower->id }}">
                                            {{ $borrower->last_name . ', ' . $borrower->first_name . ' ' . $borrower->middle_name }}</option>
                                        @endforeach
                                      </select>
                                    </div>

                                    <div class="col-lg-4 form-group">
                                      <label for="type">Loan Type</label>
                                      <select data-placeholder="Select Loan Type" class="form-control form-control-sm required js-example-basic-single "
                                        style='width:100%;' name='type' required>
                                        <option value="">--Select Loan Type--</option>
                                        @foreach ($loan_types as $loan_type)
                                          <option value="{{ $loan_type->id }}">
                                            {{ $loan_type->name }}</option>
                                        @endforeach
                                      </select>
                                    </div>

                                    <div class="col-lg-4 form-group">
                                      <label for="term">Loan Term</label>
                                      <select data-placeholder="Select Loan Term" class="form-control form-control-sm required js-example-basic-single "
                                        style='width:100%;' name='term' required>
                                        <option value="">--Select Loan Term--</option>
                                        @foreach ($loan_terms as $loan_term)
                                          <option value="{{ $loan_term->name }}">
                                            {{ $loan_term->name }}</option>
                                        @endforeach
                                      </select>
                                    </div>

                                    <div class="col-lg-4 form-group">
                                      <label for="interest">Loan Interest</label>
                                      <select data-placeholder="Select Loan Interest" class="form-control form-control-sm required js-example-basic-single "
                                        style='width:100%;' name='interest' required>
                                        <option value="">--Select Loan Interest--</option>
                                        @foreach ($loan_interests as $loan_interest)
                                          <option value="{{ $loan_interest->name }}">
                                            {{ $loan_interest->name }}</option>
                                        @endforeach
                                      </select>
                                    </div>

                                    <div class="col-lg-4 form-group">
                                      <label for="amount">Loan Amount</label>
                                      <input type="number" name="amount" step="any" class="form-control" placeholder="0.00">
                                    </div>

                                </div>

                                <a href='/loans' type="button" class="btn btn-secondary">Close</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                         
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection