<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Storage;
use Illuminate\Http\Request;
use App\{
    CoBorrower
};

class CoBorrowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'photo' => 'required',
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
            'monthly_profit' => 'required'
        ],[
            'country_id.required' => 'Country field is required',
            'region_id.required' => 'Region field is required',
            'county_id.required' => 'County field is required',
            'township_id.required' => 'Township field is required',
            'valid_id_type_id.required' => 'Valid ID Type field is required',
            'nature_of_business_id.required' => 'Nature of Business field is required',
        ]);

        DB::beginTransaction();
        try {
            $co_borrower = CoBorrower::create($request->all() + ['relationship_id' => 1]);
            //Saving of uploaded photo
            $co_borrower->update([
                'file_path' => Storage::disk('public')->put('Borrowers/'.'ID-6/CoBorrowers', $request->photo),
                'file_name' => $request->photo->getClientOriginalName(),
            ]);

            DB::commit();
            return $co_borrower;
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
    public function destroy($id)
    {
        //
    }
}
