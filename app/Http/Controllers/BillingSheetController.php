<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Borrower;
use App\Loan;
use App\Grouping;


use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;

use PDF;

class BillingSheetController extends Controller
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
        $loans = [];
        
        $search = $request->search;
        $grouping = $request->grouping;

        if($search || $grouping){
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
        }
        
        $groupings = Grouping::with('loanOfficer')->where('status','Active')->get();

        return view(
            'billing_sheets.index',
            array(
                'header' => 'billing_sheets',
                'loans' => $loans,
                'search' => $search,
                'grouping' => $grouping,
                'groupings' => $groupings,

            )
        );
    }

    public function print(Request $request)
    {

        $search = $request->search;
        $grouping = $request->grouping;

        if($search || $grouping){
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
        }

        $pdf = PDF::loadView('billing_sheets.print',array(
            'loans' => $loans,
        ));
        $pdf->setPaper('legal', 'landscape');
        return $pdf->stream('memorandum_receipts.pdf');

    }
}
