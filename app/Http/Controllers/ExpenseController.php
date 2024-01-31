<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use Alert;

class ExpenseController extends Controller
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
       $expenses = Expense::all();

        return view(
            'expenses.index',
            array(
                'header' => 'expense',
                'expenses' => $expenses

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
        $new = new Expense;
        $new->name = $request->name;
        $new->description = $request->description;
        $new->amount = $request->amount;
        $new->expense_date = $request->expense_date;
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
        $expense = Expense::where('id',$id)->first();

        return view('expenses.edit',
        array(
            'header' => 'expenses',
            'expense' => $expense

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
        $edit = Expense::findOrfail($id);
        $edit->name = $request->name;
        $edit->description = $request->description;
        $edit->amount = $request->amount;
        $edit->expense_date = $request->expense_date;
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
