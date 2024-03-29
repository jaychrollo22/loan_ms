<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Alert;
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
        $borrowers = $this->lists();
        return view('borrowers.index',compact('borrowers'));
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
        //     'photo' => 'required',
        //     'borrower_type_id' => 'required',
        //     'grouping_id' => '',
        //     'loan_officer_id' => '',
        //     'business_name' => 'required',
        //     'first_name' => 'required',
        //     'middle_name' => 'required',
        //     'last_name' => 'required',
        //     'suffix' => '',
        //     'country_id' => 'required',
        //     'region_id' => 'required',
        //     'county_id' => 'required',
        //     'township_id' => 'required',
        //     'address' => 'required',
        //     'property_type_id' => 'required',
        //     'birthday' => 'required',
        //     'age' => 'required',
        //     'civil_status_id' => 'required',
        //     'contact_number' => 'required',
        //     'email_address' => 'required',
        //     'valid_id_type_id' => 'required',
        //     'id_number' => 'required',
        //     'nature_of_business_id' => 'required',
        //     'business_address' => 'required',
        //     'business_property_type_id' => 'required',
        //     'monthly_sale' => 'required',
        //     'monthly_profit' => 'required'
        // ],[
        //     'country_id.required' => 'Country field is required',
        //     'region_id.required' => 'Region field is required',
        //     'county_id.required' => 'County field is required',
        //     'township_id.required' => 'Township field is required',
        //     'valid_id_type_id.required' => 'Valid ID Type field is required',
        //     'nature_of_business_id.required' => 'Nature of Business field is required',
        // ]);

        DB::beginTransaction();
        try {
            $borrowers = Borrower::with('loans.payments')
                ->where('first_name',$request->first_name)
                ->where('last_name',$request->last_name)
                ->where('birthday',$request->birthday)
                ->get();

            $bad_accounts = [];
            foreach($borrowers as $borrower){
               foreach($borrower->loans as $loan){
                    $loan_amount = $loan->amount;
                    $total_payment = $loan->payments->sum('actual_payment');
                    if($loan_amount > $total_payment){
                        $balance = $loan_amount - $total_payment;
                        $bad_accounts[] = 'Bad Accounts! with total loan of '.$loan_amount.' and with total payment of '.$total_payment. '. Remaining balance is '.$balance;
                    }
               }
            }
    
            if($bad_accounts) return $this->commonError($bad_accounts);

            if($request->id){
                $borrower =  Borrower::findOrFail($request->id);
                $borrower->update($request->except(['borrower_type','country','region','county','township','property_type',
                        'civil_status','valid_id_type','nature_of_business','business_property_type','photo']));
                    
                    // Update photo
                    if(!$request->has('file_name')){
                        $borrower->update([
                                'file_path' => Storage::disk('public')->put('Borrowers/'.'ID-'.$borrower->id.'/Photos', $request->photo),
                                'file_name' => $request->photo->getClientOriginalName()
                            ]);
                    }
            }else{
                $borrower = Borrower::create($request->all());
            
                $borrower_type = $request->borrower_type_id == 1 ? 'BI' : 'BG';
                $borrower_code = $borrower_type.'-'.now()->year.$this->pad(now()->month,2).'-'.$this->pad($borrower->id,5);
                $borrower->update([
                        'borrower_code' => $borrower_code, 
                        'file_path' => Storage::disk('public')->put('Borrowers/'.'ID-'.$borrower->id.'/Photos', $request->photo),
                        'file_name' => $request->photo->getClientOriginalName()
                    ]);
            }

            DB::commit();
            Alert::success('Successfully Store')->persistent('Dismiss');
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
        return Borrower::with('borrowerType','loanOfficer','grouping','country','region','county','township',
            'propertyType','civilStatus','validIdType','natureOfBusiness','businessPropertyType')
            ->where('id',$id)
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

    /**
     * Display active resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function active(){
        return Borrower::where('status','Active')
            ->count();
    }

    /**
     * Common Error Message
     */
    public static function commonError($message){
        if(is_array($message)){// Loop error if array
            $errors = [];
            foreach($message as $m){
                $errors[] = [$m];
            }
        }else{
            $errors = [
                'item' => [$message]
            ];
        }
        return response()->json(['errors' => $errors], 422);
    }
}
