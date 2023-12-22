<?php

namespace App\Http\Controllers;

use DB;
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
        // $request->validate([

        // ]);

        DB::beginTransaction();
        try {
            $borrower_params = $request->borrower;
            $borrower = Borrower::create([
                'borrower_type_id' => 1,
                'grouping_id' => null,
                'loan_officer_id' => 1,
                'business_name' => $borrower_params['business_name'],
                'first_name' => $borrower_params['first_name'],
                'middle_name' => $borrower_params['middle_name'],
                'last_name' => $borrower_params['last_name'],
                'suffix' => null,
                'country_id' => 1,
                'region_id' => 1,
                'county_id' => 1,
                'township_id' => 1,
                'address' => $borrower_params['address'],
                'property_type_id' => 1,
                'age' => $borrower_params['age'],
                'civil_status_id' => 1,
                'contact_number' => $borrower_params['contact_number'],
                'email_address' => $borrower_params['email_address'],
                'valid_id_type_id' => 1,
                'id_number' => $borrower_params['id_number'],
                'nature_of_business_id' => 1,
                'business_address' => $borrower_params['address'],
                'business_property_type_id' => 1,
                'monthly_sale' => $borrower_params['monthly_sale'],
                'monthly_profit' => $borrower_params['monthly_profit'],
                'file_name' => 'file_name',
                'file_path' => 'file_path'
            ]);
         
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
