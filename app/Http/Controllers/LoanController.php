<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Borrower;
use App\Loan;
use App\LoanType;
use App\LoanTerm;
use App\LoanInterest;

use Alert;

class LoanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::with('borrower','type_info')->get();

        return view(
            'loans.index',
            array(
                'header' => 'loans',
                'loans' => $loans

            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $borrowers = Borrower::select('id','first_name','middle_name','last_name')->get();
        $loan_types = LoanType::all();
        $loan_terms = LoanTerm::all();
        $loan_interests = LoanInterest::all();

        return view(
            'loans.create',
            array(
                'header' => 'loans',
                'borrowers' => $borrowers,
                'loan_types' => $loan_types,
                'loan_terms' => $loan_terms,
                'loan_interests' => $loan_interests
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $loan_count = Loan::where('borrower_id', $request->borrower_id)->count();
        $loan_series_number = str_pad($loan_count + 1, 5, '0', STR_PAD_LEFT);

        $new = new Loan;
        $new->loan_number = $request->borrower_id . $loan_series_number;
        $new->borrower_id = $request->borrower_id;
        $new->type = $request->type;
        $new->term = $request->term;
        $new->amount = $request->amount;
        $new->interest = $request->interest;

        $total_interest = $request->amount * ($request->interest / 100);
        $total_amount =  $request->amount + $total_interest;

        $new->total_interest = $total_interest;
        $new->total_amount = $total_amount;

        $new->status = 'For Approval';
        $new->save();

        Alert::success('Successfully Store')->persistent('Dismiss');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loan = Loan::where('id',$id)->first();

        $borrowers = Borrower::select('id','first_name','middle_name','last_name')->get();
        $loan_types = LoanType::all();
        $loan_terms = LoanTerm::all();
        $loan_interests = LoanInterest::all();


        return view('loans.edit',
        array(
            'header' => 'loans',
            'loan' => $loan,
            'borrowers' => $borrowers,
            'loan_types' => $loan_types,
            'loan_terms' => $loan_terms,
            'loan_interests' => $loan_interests

        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $edit = Loan::findOrfail($id);
        $edit->borrower_id = $request->borrower_id;
        $edit->type = $request->type;
        $edit->term = $request->term;
        $edit->amount = $request->amount;
        $edit->interest = $request->interest;
        
        $total_interest = $request->amount * ($request->interest / 100);
        $total_amount =  $request->amount + $total_interest;

        $edit->total_interest = $total_interest;
        $edit->total_amount = $total_amount;

        $edit->save();
        
        Alert::success('Successfully updated')->persistent('Dismiss');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}