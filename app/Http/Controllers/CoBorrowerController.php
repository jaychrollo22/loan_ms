<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Alert;
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
            'birthday' => 'required',
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
            if($request->id){
                $co_borrower = CoBorrower::where('borrower_id',$request->borrower_id)
                    ->first();

                $co_borrower->update($request->except(['borrower_type','country','region','county','township','property_type',
                    'civil_status','valid_id_type','nature_of_business','business_property_type']));

                // Update photo
                if(!$request->has('file_name')){
                    $co_borrower->update([
                            'file_path' => Storage::disk('public')->put('Borrowers/'.'ID-'.$request->borrower_id.'/Photos', $request->photo),
                            'file_name' => $request->photo->getClientOriginalName()
                        ]);
                }
            }else{
                $co_borrower = CoBorrower::create($request->all() + ['relationship_id' => 1]);
                //Saving of uploaded photo
                $co_borrower->update([
                        'file_path' => Storage::disk('public')->put('Borrowers/'.'ID-'.$request->borrower_id.'/CoBorrowers', $request->photo),
                        'file_name' => $request->photo->getClientOriginalName(),
                    ]);
            }

            DB::commit();
            Alert::success('Successfully Store')->persistent('Dismiss');
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
        return CoBorrower::with('country','region','county','township','propertyType',
            'civilStatus','validIdType','natureOfBusiness','businessPropertyType')
            ->where('borrower_id',$id)
            ->first();
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
