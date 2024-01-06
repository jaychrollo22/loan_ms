<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $users = User::when($search,function($q) use($search){
                        $q->where('name', 'like' , '%' .  $search . '%');
                    })
                    ->get();


        return view('users.index',array(
            'users'=>$users,
            'search'=>$search,
        ));
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
        //
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

    public function changePassword(User $user){

        
        $user = User::where('id',$user->id)->first();

        return view('users.change_password',
        array(
            'header' => 'users',
            'user' => $user
        ));

    }

    public function updateUserPassword(Request $request,User $user){

        $validator = $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
    
        $user = User::findOrFail($user->id);
        $user->password = bcrypt($request->input('password'));
        $user->save();

        Alert::success('Successfully Updated')->persistent('Dismiss');
        return redirect('/users');

    }
}
