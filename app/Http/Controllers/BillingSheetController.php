<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
    public function store(Request $request)
    {
        //
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
