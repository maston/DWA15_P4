<?php

namespace LMG\Http\Controllers;

use Illuminate\Http\Request;

use LMG\Http\Requests;
use LMG\Http\Controllers\Controller;

class GameBoard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $nav_gameboard = 'active';
        $nav_settings = '';
        $nav_grocery_run = '';
        $nav_metrics = '';
        $user_info = \LMG\User::find($id);
        $user_grocery_run = \LMG\GroceryRun::orderBy('dt_grocery_run','DESC')->where('user_id', '=', $id)->first(); 
        $user_meal_counts = \LMG\MealCountDay::orderBy('dt_meal_count','DESC')->where('grocery_run_id', '=', $user_grocery_run->id)->get(); 
        $new_board = empty($user_meal_counts);
        // dump($user_info);
        // dump($user_grocery_run);
        // dump($user_meal_counts);
        // dump($new_board);
        if($new_board) {
            return view('GameBoard.new')
            ->with('user_grocery_run', $user_grocery_run)
            ->with('user_info', $user_info)
            ->with('nav_gameboard', $nav_gameboard)
            ->with('nav_settings', $nav_settings)
            ->with('nav_grocery_run', $nav_grocery_run)
            ->with('nav_metrics', $nav_metrics);
        }
        else {
            return view('GameBoard.index')
            ->with('user_grocery_run', $user_grocery_run)
            ->with('user_info', $user_info)
            ->with('user_meal_counts', $user_meal_counts)
            ->with('nav_gameboard', $nav_gameboard)
            ->with('nav_settings', $nav_settings)
            ->with('nav_grocery_run', $nav_grocery_run)
            ->with('nav_metrics', $nav_metrics)
            ->with('new_board', $new_board);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {
        // dump($request);
        $nav_gameboard = 'active';
        $nav_settings = '';
        $nav_grocery_run = '';
        $nav_metrics = '';
        $user = \LMG\User::find($request['user_id']);
        $grocery_run = \LMG\GroceryRun::find($request['grocery_run_id']);


        $meal_count_day = new \LMG\MealCountDay;    
        $meal_count_day->dt_meal_count = $request->dt_meal_count;
        $meal_count_day->bfast_ct = $request->bfast_ct;
        $meal_count_day->lunch_ct = $request->lunch_ct;
        $meal_count_day->dinner_ct = $request->dinner_ct;
        $meal_count_day->coffee_ct = $request->coffee_ct;
        $meal_count_day->user()->associate($user);
        $meal_count_day->grocery_run()->associate($grocery_run);
        $meal_count_day->save();

        \Session::flash('flash_message','Your meal counts were saved.');
        return redirect('/game-board/'.$grocery_run->user_id);
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
}
