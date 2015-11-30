<?php

namespace LMG\Http\Controllers;

use Illuminate\Http\Request;

use LMG\Http\Requests;
use LMG\Http\Controllers\Controller;

class GameBoard extends Controller
{
    public function index()
    {


        $user_info = \Auth::user();
        // $user_grocery_run = \LMG\GroceryRun::orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->first(); 
        // $user_grocery_run = \LMG\GroceryRun::orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get();
        // $user_meal_counts = \LMG\MealCountDay::with('GroceryRuns')->orderBy('dt_meal_count','DESC')->where('grocery_run_id', '=', $user_grocery_run->id)->get(); 
        $user_grocery_run = \LMG\GroceryRun::with('meal_count_day')->orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get();

        //check if there is a grocery run, if not --> go to grocery run screen?

        //get dropdown list of grocery run dates
        $grocery_run_for_dropdown = [];
        foreach($user_grocery_run as $grocery_run) {
            $grocery_run_for_dropdown[$grocery_run->id] = $grocery_run->dt_grocery_run;
        }
      
        //get most recent grocery run (if we are doing show() then we get the selected grocery run)
        $most_recent_grocery_run = $user_grocery_run->first();

        // dump($most_recent_grocery_run_dt);

        // $user_meal_counts = \LMG\MealCountDay::orderBy('dt_meal_count','DESC')->where('grocery_run_id', '=', $user_grocery_run->id)->get(); 
        $new_board = empty($user_grocery_run);

        return view('GameBoard.index')
            ->with('user_grocery_run', $user_grocery_run)
            ->with('grocery_run_for_dropdown', $grocery_run_for_dropdown)
            ->with('most_recent_grocery_run', $most_recent_grocery_run)
            ->with('user_info', $user_info)
            ->with('new_board', $new_board); 

        // if($new_board) {
        //     dump($user_grocery_run->toArray());
        //     return view('GameBoard.new')
        //     ->with('user_grocery_run', $user_grocery_run)
        //     ->with('user_info', $user_info);
        // }
        // else {
        //     return view('GameBoard.index')
        //     ->with('user_grocery_run', $user_grocery_run)
        //     ->with('user_info', $user_info)
        //     ->with('new_board', $new_board);            // ->with('user_meal_counts', $user_meal_counts)
        // }

    }

    public function postCreate(Request $request)
    {
        // dump($request);
        // $nav_gameboard = 'active';
        // $nav_settings = '';
        // $nav_grocery_run = '';
        // $nav_metrics = '';
        $user = \Auth::user();
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
        return redirect('/game-board');
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
    public function postShow(Request $request)
    {
        $user_info = \Auth::user();
        // $user_grocery_run = \LMG\GroceryRun::orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->first(); 
        // $user_grocery_run = \LMG\GroceryRun::orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get();
        // $user_meal_counts = \LMG\MealCountDay::with('GroceryRuns')->orderBy('dt_meal_count','DESC')->where('grocery_run_id', '=', $user_grocery_run->id)->get(); 
        $user_grocery_runs = \LMG\GroceryRun::with('meal_count_day')->orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get();

        //check if there is a grocery run, if not --> go to grocery run screen?

        //get dropdown list of grocery run dates
        $grocery_run_for_dropdown = [];
        foreach($user_grocery_runs as $grocery_run) {
            $grocery_run_for_dropdown[$grocery_run->id] = $grocery_run->dt_grocery_run;
        }
      
        //get most recent grocery run (if we are doing show() then we get the selected grocery run)
        $selected_grocery_run = $user_grocery_runs->find($request->grocery_run_id);
        
        $selected_meal_count_day = [];
        // if(isset($request->meal_count_day_dt)) {
            //need to figure out if the current day has an existing meal count
        // }
        // else {
            //set the selected meal count to the date selected.
            // $selected_meal_count_day = 

            // \DB::select("SELECT * FROM meal_count_days WHERE grocery_run_id = " & $request->grocery_run_id);
                    // $selected_meal_count_day = \DB::table('meal_count_days')
        //              ->select(\DB::raw('*'))
        //              ->where('grocery_run_id', '=', $request->grocery_run_id)
        //              ->get();
        // }
        // dump($selected_meal_count_day);

        // $selected_meal_count_day = 
        // $books = DB::select("SELECT * FROM books WHERE author LIKE '%Scott%'");
        // if (isset($request->meal_count_day_id)) {
        //     $selected_meal_count_day = $user_grocery_runs->meal_count_day->find($request->meal_count_day_id);
        //     dump ($selected_meal_count_day);
        // }
        // $user_meal_counts = $user_grocery_runs->meal_count_day->find($request->grocery_run_id);
        // dump($most_recent_grocery_run_dt);
        // orderBy('dt_meal_count','DESC')->where

        // $user_meal_counts = $user_grocery_run->filter('grocery_run_id', $user_grocery_run->id); 
        // $user_meal_counts = [];
        // foreach ($user_grocery_runs as $user_grocery_run) {
        //     foreach ($user_grocery_run->meal_count_day as $meal_count_day) {

        //         echo 'Bfast count: '.$meal_count_day->bfast_ct.' ,';
        //         echo 'Lunch count: '.$meal_count_day->lunch_ct.' ,';
        //     }
        // });
        // dump($user_grocery_runs);

        // foreach ($user_grocery_runs as $user_grocery_run) {
        //     // echo '<br>'.$user_grocery_run->dt_grocery_run.' grocery run has following meal counts: ';
        //     foreach ($user_grocery_run->meal_count_day as $meal_count_day) {
        //         echo 'Bfast count: '.$meal_count_day->bfast_ct.' ,';
        //         echo 'Lunch count: '.$meal_count_day->lunch_ct.' ,';
        //     }
        // }
        // $new_board = empty($user_grocery_run);
        // echo $request;
        // dump($selected_grocery_run->toArray());

        return view('GameBoard.show')
            ->with('user_grocery_runs', $user_grocery_runs)
            ->with('grocery_run_for_dropdown', $grocery_run_for_dropdown)
            ->with('selected_grocery_run', $selected_grocery_run)
            ->with('selected_meal_count_day', $selected_meal_count_day)
            ->with('user_info', $user_info); 
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
