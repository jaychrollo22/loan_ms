<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoanTerm;


use Alert;

class LoanTermController extends Controller
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
        $loan_terms = LoanTerm::all();

        return view(
            'settings.loan_terms.index',
            array(
                'header' => 'settings',
                'loan_terms' => $loan_terms

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
        $new = new LoanTerm;
        $new->name = $request->name;
        $new->description = $request->description;
        $new->status = 'Active';
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
        $loan_term = LoanTerm::where('id',$id)->first();

        return view('settings.loan_terms.edit',
        array(
            'header' => 'settings',
            'loan_term' => $loan_term

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
        $edit = LoanTerm::findOrfail($id);
        $edit->name = $request->name;
        $edit->description = $request->description;
        $edit->status = $request->status;
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
