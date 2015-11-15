<?php

namespace LMG\Http\Controllers;

use Illuminate\Http\Request;

use LMG\Http\Requests;
use LMG\Http\Controllers\Controller;

class Settings extends Controller
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
        return view('Settings.show');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $nav_gameboard = '';
        $nav_settings = 'active';
        $nav_grocery_run = '';
        $nav_metrics = '';

        $user_info = \LMG\User::find($id);

        return View('Settings.edit')
            ->with('user_info', $user_info)
            ->with('nav_gameboard', $nav_gameboard)
            ->with('nav_settings', $nav_settings)
            ->with('nav_grocery_run', $nav_grocery_run)
            ->with('nav_metrics', $nav_metrics);
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
        // var_dump($request);
         // Validation
        $user_info = \LMG\User::find($request['user_id']);
        $user_info->bfast_spend = $request->bfast_spend;
        $user_info->lunch_spend = $request->lunch_spend;
        $user_info->dinner_spend = $request->dinner_spend;
        $user_info->coffee_spend = $request->coffee_spend;
        $user_info->zipcode = $request->zipcode;
        $user_info->save();
        // return $user_info;
        \Session::flash('flash_message','Your settings were updated.');
        return redirect('/settings/'.$user_info->id);
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
