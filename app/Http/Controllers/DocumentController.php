<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Storage;
use Illuminate\Http\Request;
use App\{
    Document
};

class DocumentController extends Controller
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
            'title' => 'required',
            'photo' => 'required'
        ],[
            'photo.required' => 'Attachment field is required'
        ]);

        DB::beginTransaction();
        try {
            $document = Document::create($request->all());
            //Saving of uploaded photo
            $document->update([
                'file_path' => Storage::disk('public')->put('Borrowers/'.'ID-'.$request->borrower_id.'/Documents', $request->photo),
                'file_name' => $request->photo->getClientOriginalName(),
            ]);

            DB::commit();
            return $document;
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
    public function destroy(Document $document)
    {
        return $document->delete();
    }

    /**
     * Display all resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists($id){
        return Document::where('borrower_id',$id)
            ->get();
    }
}
