<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Borrower;
use App\Loan;
use App\LoanPayment;

use Illuminate\Database\Eloquent\Builder;

use Alert;
use DB;
class PaymentController extends Controller
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
    public function index(Request $request)
    {

        $search = $request->search;
    
        $loans = Loan::with('borrower','type_info','payments','billings','amount_to_pay')
                                ->where('loan_number','=',$search)
                                ->orWhereHas('borrower',function($q) use($search){
                                    $q->where('first_name','LIKE','%'.$search.'%')
                                        ->where('last_name','LIKE','%'.$search.'%');
                                })
                                ->whereHas('billings')
                                ->get();

        return view(
            'payments.index',
            array(
                'header' => 'payments',
                'loans' => $loans,
                'search' => $search

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        $loan_details = Loan::where('id',$id)->first();

        if($loan_details){
            $loan_payment = new LoanPayment;
            $loan_payment->loan_id = $loan_details->id;
            $loan_payment->borrower_id = $loan_details->borrower_id;
            $loan_payment->actual_payment = $request->payment;
            $loan_payment->save();

            Alert::success('Payment has been successfully saved!')->persistent('Dismiss');
            return back();

        }

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
        //
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
        //
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
