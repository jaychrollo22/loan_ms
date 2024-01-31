<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Alert;
use Storage;
use Illuminate\Http\Request;
use App\{
    Company
};

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = $this->lists();
        return view('settings.companies.index',compact('companies'));
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
            'name' => 'required',
            'logo' => 'required',
            'address' => 'required',
            'status' => 'required'
        ]);

        DB::beginTransaction();
        try {
            if($request->id){
                $company =  Company::findOrFail($request->id);
                $company->update($request->all());    
                // Update photo
                if(!$request->has('file_name')){
                    $company->update([
                            'file_path' => Storage::disk('public')->put('Companies/'.'ID-'.$company->id, $request->logo),
                            'file_name' => $request->logo->getClientOriginalName()
                        ]);
                }
            }else{
                $company = Company::create($request->all());
                $company->update([
                        'file_path' => Storage::disk('public')->put('Companies/'.'ID-'.$company->id, $request->logo),
                        'file_name' => $request->logo->getClientOriginalName()
                    ]);
            }

            DB::commit();
            Alert::success('Successfully Store')->persistent('Dismiss');
            return $company;
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
        return Company::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        return view('settings.companies.form',compact('id'));
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

    /**
     * Display all resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists(){
        return Company::get();
    }

    /**
     * Get active company
     *
     * @return \Illuminate\Http\Response
     */
    public static function active(){
        $company = Company::where('status','Active')
            ->first();

        return $company ? $company->file_path : '';
    }
}
