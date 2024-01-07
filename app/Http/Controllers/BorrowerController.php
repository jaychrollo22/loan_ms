<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Storage;
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
            'photo' => 'required',
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
                $borrower =  Borrower::where('id',$request->id)
                    ->update($request->all());
            }else{
                $borrower = Borrower::create($request->all() + ['loan_officer_id' => Auth::user()->id]);
            
                $borrower_type = $request->borrower_type_id == 1 ? 'BI' : 'BG';
                $borrower_code = $borrower_type.now()->year.$this->pad(now()->month,2).$this->pad($borrower->id,5);
                $borrower->update([
                        'borrower_code' => $borrower_code, 
                        'file_path' => Storage::disk('public')->put('Borrowers/'.'ID-'.$borrower->id.'/Photos', $request->photo),
                        'file_name' => $request->photo->getClientOriginalName(),
                    ]);
            }

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
        return  Borrower::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('borrowers.form',compact('id'));
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

    /**
     * Pad character
     *
     */
    public function pad ($data,$count){
        return str_pad($data, $count, '0', STR_PAD_LEFT);
    }

    /**
     * Show the form for viewing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        return view('borrowers.view',compact('id'));
    }
}
