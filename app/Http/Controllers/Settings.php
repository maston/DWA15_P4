<?php

namespace LMG\Http\Controllers;

use Illuminate\Http\Request;

use LMG\Http\Requests;
use LMG\Http\Controllers\Controller;

class Settings extends Controller
{

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit()
    {
        $user_info = \Auth::user();

        return View('Settings.edit')
            ->with('user_info', $user_info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postEdit(Request $request)
    {

         // Validation
        $user_info = \Auth::user();
        $user_info->bfast_spend = $request->bfast_spend;
        $user_info->lunch_spend = $request->lunch_spend;
        $user_info->dinner_spend = $request->dinner_spend;
        $user_info->coffee_spend = $request->coffee_spend;
        $user_info->zipcode = $request->zipcode;
        $user_info->save();

        \Session::flash('flash_message','Your settings were updated.');
        return redirect('/settings');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     return view('Settings.show');

    // }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
}
