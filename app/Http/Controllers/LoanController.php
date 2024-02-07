<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Borrower;
use App\Loan;
use App\LoanBilling;
use App\LoanType;
use App\LoanTerm;
use App\LoanInterest;
use App\Grouping;
use App\Saving;


use Alert;
use DateTime;
use DateInterval;

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
    public function index(Request $request)
    {

        $search = $request->search;
        $grouping = $request->grouping;

        $borrowers = Borrower::when($search,function($q) use($search){
                                $q->where(function($w) use($search){
                                    $w->where('first_name', 'like' , '%' .  $search . '%')->orWhere('last_name', 'like' , '%' .  $search . '%')
                                    ->orWhere('borrower_code', 'like' , '%' .  $search . '%')
                                    ->orWhereRaw("CONCAT(`first_name`, ' ', `last_name`) LIKE ?", ["%{$search}%"])
                                    ->orWhereRaw("CONCAT(`last_name`, ' ', `first_name`) LIKE ?", ["%{$search}%"]);
                                });
                            })
                            ->when($grouping,function($q) use($grouping){
                                $q->where('grouping_id',$grouping);
                            })
                            ->pluck('id')
                            ->toArray();

        $loans = Loan::with('borrower.borrowerType','borrower.grouping','borrower.borrowerType','type_info','payments','billings','amount_to_pay')
                        ->where('loan_number','=',$search)
                        ->orWhereIn('borrower_id',$borrowers)
                        ->get();
        
        $groupings = Grouping::with('loanOfficer')->where('status','Active')->get();

        return view(
            'loans.index',
            array(
                'header' => 'loans',
                'loans' => $loans,
                'search' => $search,
                'grouping' => $grouping,
                'groupings' => $groupings,

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
    public function show($id,Request $request)
    {
        $payment_start_date = isset($request->payment_start_date) ?  $request->payment_start_date : "";
        $saving = isset($request->saving) ?  $request->saving : "0";
        $loan = Loan::with('borrower.borrowerType','type_info','payments','billings','amount_to_pay')
                        ->where('id',$id)
                        ->first();
        $savings = Saving::where('status','Active')->get();

        $release_date = '';
        return view(
            'loans.view',
            array(
                'header' => 'loans',
                'loan' => $loan,
                'payment_start_date' => $payment_start_date,
                'saving' => $saving,
                'release_date' => $release_date,
                'savings' => $savings

            )
        );
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
    public function approve(Request $request,$id)
    {

        // return $request->all();
        $loan = Loan::where('id',$id)->first();

        if($loan){
            $loan->status = 'Approved';
            $loan->release_date = $request->release_date;
            $loan->payment_start = $request->payment_start;
            $loan->approval_remarks = $request->approval_remarks;
            $loan->save();

            $currentDate = new DateTime($loan->payment_start);

            for($term = 1 ; $term <= $loan->term; $term++){
                
                $week_number = $term;
                $schedule_date = $currentDate->format('Y-m-d');
                $principal = $loan->amount / $loan->term;
                $interest = $loan->total_interest / $loan->term;
                $total_amount = $principal + $interest;
                $saving = $request->saving;
                $total_amount_with_saving = $principal + $interest + $saving;

                $new_loan_billing = new LoanBilling;
                $new_loan_billing->borrower_id = $loan->borrower_id;
                $new_loan_billing->loan_id = $loan->id;
                $new_loan_billing->week_number = $week_number;
                $new_loan_billing->schedule_date = date('Y-m-d',strtotime($schedule_date));
                $new_loan_billing->principal = $principal;
                $new_loan_billing->interest = $interest;
                $new_loan_billing->total_amount = $total_amount;
                $new_loan_billing->savings = $saving;
                $new_loan_billing->total_amount_with_savings = $total_amount_with_saving;
                $new_loan_billing->save();

                $type = 'W';
                if($loan->type_info->name == "Weekly"){
                    $currentDate->add(new DateInterval('P1W'));
                }elseif($loan->type_info->name == "Monthly"){
                    $currentDate->add(new DateInterval('P1M'));
                }
                
            }
            

            Alert::success('Loan has been Approved')->persistent('Dismiss');
            return back();
        }
    }
    public function disapprove(Request $request,$id)
    {
        $loan = Loan::where('id',$id)->first();
        if($loan){
            $loan->status = 'Disapproved';
            $loan->approval_remarks = $request->approval_remarks;
            $loan->save();

            Alert::success('Loan has been Approved')->persistent('Dismiss');
            return back();
        }
    }
}
