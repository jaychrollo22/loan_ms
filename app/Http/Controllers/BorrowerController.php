<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\{
    Borrower
};

class BorrowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('borrowers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('borrowers.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'borrower_type_id' => 'required',
            'grouping_id' => '',
            'loan_officer_id' => '',
            'business_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'suffix' => '',
            'country_id' => 'required',
            'region_id' => 'required',
            'county_id' => 'required',
            'township_id' => 'required',
            'address' => 'required',
            'property_type_id' => 'required',
            'age' => 'required',
            'civil_status_id' => 'required',
            'contact_number' => 'required',
            'email_address' => 'required',
            'valid_id_type_id' => 'required',
            'id_number' => 'required',
            'nature_of_business_id' => 'required',
            'business_address' => 'required',
            'business_property_type_id' => 'required',
            'monthly_sale' => 'required',
            'monthly_profit' => 'required',
            'file_name' => '',
            'file_path' => ''
        ],[
            'country_id.required' => 'Country field is required'
        ]);

        DB::beginTransaction();
        try {
            $borrower = Borrower::create($request->borrower + ['loan_officer_id' => Auth::user()->id]);
         
            DB::commit();
            return $borrower;
        } catch (Exception $e) {
            DB::rollBack();
            // return GlobalController::errorLogs($e->getMessage(),'App\DocumentRfp');
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
    public function destroy(Borrower $borrower)
    {
        return $borrower->delete();
    }

    /**
     * Display all resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists(){
        return Borrower::get();
    }
}
