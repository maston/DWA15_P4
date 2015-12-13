<?php

namespace LMG\Http\Controllers;

use Illuminate\Http\Request;

use LMG\Http\Requests;
use LMG\Http\Controllers\Controller;

class GameBoard extends Controller
{
    public function index()
    {


        // $user_info = \Auth::user();
        // $user_grocery_run = \LMG\GroceryRun::orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->first(); 
        // $user_grocery_run = \LMG\GroceryRun::orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get();
        // $user_meal_counts = \LMG\MealCountDay::with('GroceryRuns')->orderBy('dt_meal_count','DESC')->where('grocery_run_id', '=', $user_grocery_run->id)->get(); 
        // $user_grocery_run = \LMG\GroceryRun::with('meal_count_day')->orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get();

        //check if there is a grocery run, if not --> go to grocery run screen?

        //get dropdown list of grocery run dates
        // $grocery_run_for_dropdown = [];
        // foreach($user_grocery_run as $grocery_run) {
        //     $grocery_run_for_dropdown[$grocery_run->id] = $grocery_run->dt_grocery_run;
        // }
      
        //get most recent grocery run (if we are doing show() then we get the selected grocery run)
        // $most_recent_grocery_run = $user_grocery_run->first();

        // dump($most_recent_grocery_run_dt);

        // $user_meal_counts = \LMG\MealCountDay::orderBy('dt_meal_count','DESC')->where('grocery_run_id', '=', $user_grocery_run->id)->get(); 
        // $new_board = empty($user_grocery_run);

        // return view('GameBoard.index')
        //     ->with('user_grocery_run', $user_grocery_run)
        //     ->with('grocery_run_for_dropdown', $grocery_run_for_dropdown)
        //     ->with('most_recent_grocery_run', $most_recent_grocery_run)
        //     ->with('user_info', $user_info)
        //     ->with('new_board', $new_board); 

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

    public function getTest($default_meal_count_id=null)
    {
        $user_info = \Auth::user();
        $user_grocery_runs = \LMG\GroceryRun::with('meal_count_day')->orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get();
        $default_meal_count_day = \LMG\MealCountDay::where('id', '=', $default_meal_count_id)->get();
        dump($default_meal_count_day);
        //get dropdown list of grocery run dates
        $grocery_run_for_dropdown = [];
        foreach($user_grocery_runs as $grocery_run) {
            $grocery_run_for_dropdown[$grocery_run->id] = $grocery_run->dt_grocery_run;
        }
        // $default_meal_count_day->grocery_run_id
        $selected_grocery_run = $user_grocery_runs->find(2);
        dump($selected_grocery_run);
        $selected_meal_count_day = $default_meal_count_day;
// ->where('dt_meal_count', '=', $meal_count_date)
        // $meal_count_date = '2015-01-02';
        // $test_id = 1;
        
        // if(isset($request->meal_count_day_id)) {
        //     $selected_meal_count_day = $user_grocery_run->meal_count_day->find($request->meal_count_day_id);
        // }
        // else {
        //     // $selected_meal_count_day = $selected_grocery_run->meal_count_day->where();
        // }
        // dump($default_meal_count_day );

        $bfast_ct_tot = 0;
        $lunch_ct_tot = 0;
        $dinner_ct_tot = 0;
        $coffee_ct_tot = 0;

        $bfast_save_tot = 0;
        $lunch_save_tot = 0;
        $dinner_save_tot = 0;
        $coffee_save_tot = 0;

        foreach ($user_grocery_runs as $user_grocery_run) {
          if ($user_grocery_run['id']==$selected_grocery_run['id']) {
            foreach($user_grocery_run->meal_count_day as $meal_count_day) {
                $bfast_ct_tot = $bfast_ct_tot + $meal_count_day['bfast_ct'];
                $lunch_ct_tot = $lunch_ct_tot + $meal_count_day['lunch_ct'];
                $dinner_ct_tot = $dinner_ct_tot + $meal_count_day['dinner_ct'];
                $coffee_ct_tot = $coffee_ct_tot + $meal_count_day['coffee_ct'];

                $bfast_save_tot = $bfast_save_tot + ($meal_count_day['bfast_ct'] * $user_info['bfast_spend']);
                $lunch_save_tot = $lunch_save_tot + ($meal_count_day['lunch_ct'] * $user_info['lunch_spend']);
                $dinner_save_tot = $dinner_save_tot + ($meal_count_day['dinner_ct'] * $user_info['dinner_spend']);
                $coffee_save_tot = $coffee_save_tot + ($meal_count_day['coffee_ct'] * $user_info['coffee_spend']);

            }
          }
        }

        $grocery_run_grand_tot = $bfast_save_tot + $lunch_save_tot + $dinner_save_tot + $coffee_save_tot;

        return view('GameBoard.show')
            ->with('user_grocery_runs', $user_grocery_runs)
            ->with('grocery_run_for_dropdown', $grocery_run_for_dropdown)
            ->with('selected_grocery_run', $selected_grocery_run)
            ->with('selected_meal_count_day', $selected_meal_count_day)
            ->with('user_info', $user_info)
            ->with('bfast_ct_tot', $bfast_ct_tot)
            ->with('lunch_ct_tot', $lunch_ct_tot)
            ->with('dinner_ct_tot', $dinner_ct_tot)
            ->with('coffee_ct_tot', $coffee_ct_tot)
            ->with('bfast_save_tot', $bfast_save_tot)
            ->with('lunch_save_tot', $lunch_save_tot)
            ->with('dinner_save_tot', $dinner_save_tot)
            ->with('coffee_save_tot', $coffee_save_tot)
            ->with('grocery_run_grand_tot', $grocery_run_grand_tot); 
    }


   public function postShow(Request $request)
    {
        $user_info = \Auth::user();
        $user_grocery_runs = \LMG\GroceryRun::with('meal_count_day')->orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get();

        //get dropdown list of grocery run dates
        $grocery_run_for_dropdown = [];
        foreach($user_grocery_runs as $grocery_run) {
            $grocery_run_for_dropdown[$grocery_run->id] = $grocery_run->dt_grocery_run;
        }
        
        $most_recent_grocery_run = $user_grocery_runs->first();
        //get most recent grocery run (if we are doing show() then we get the selected grocery run)
        if(isset($request->grocery_run_id)) {
            $selected_grocery_run = $user_grocery_runs->find($request->grocery_run_id);
        }
        else {
            $selected_grocery_run = $most_recent_grocery_run;
        }
        
        $selected_meal_count_day = [];
// ->where('dt_meal_count', '=', $meal_count_date)
        $meal_count_date = '2015-01-02';
        $test_id = 1;
        $default_meal_count_day = \LMG\MealCountDay::where('grocery_run_id', '=', $request->grocery_run_id)->where('dt_meal_count', '=', $meal_count_date)->get();

        if(isset($request->meal_count_day_id)) {
            $selected_meal_count_day = $user_grocery_run->meal_count_day->find($request->meal_count_day_id);
        }
        else {
            // $selected_meal_count_day = $selected_grocery_run->meal_count_day->where();
        }
        dump($default_meal_count_day );

        $bfast_ct_tot = 0;
        $lunch_ct_tot = 0;
        $dinner_ct_tot = 0;
        $coffee_ct_tot = 0;

        $bfast_save_tot = 0;
        $lunch_save_tot = 0;
        $dinner_save_tot = 0;
        $coffee_save_tot = 0;

        foreach ($user_grocery_runs as $user_grocery_run) {
          if ($user_grocery_run['id']==$selected_grocery_run['id']) {
            foreach($user_grocery_run->meal_count_day as $meal_count_day) {
                $bfast_ct_tot = $bfast_ct_tot + $meal_count_day['bfast_ct'];
                $lunch_ct_tot = $lunch_ct_tot + $meal_count_day['lunch_ct'];
                $dinner_ct_tot = $dinner_ct_tot + $meal_count_day['dinner_ct'];
                $coffee_ct_tot = $coffee_ct_tot + $meal_count_day['coffee_ct'];

                $bfast_save_tot = $bfast_save_tot + ($meal_count_day['bfast_ct'] * $user_info['bfast_spend']);
                $lunch_save_tot = $lunch_save_tot + ($meal_count_day['lunch_ct'] * $user_info['lunch_spend']);
                $dinner_save_tot = $dinner_save_tot + ($meal_count_day['dinner_ct'] * $user_info['dinner_spend']);
                $coffee_save_tot = $coffee_save_tot + ($meal_count_day['coffee_ct'] * $user_info['coffee_spend']);

            }
          }
        }

        $grocery_run_grand_tot = $bfast_save_tot + $lunch_save_tot + $dinner_save_tot + $coffee_save_tot;

        return view('GameBoard.show')
            ->with('user_grocery_runs', $user_grocery_runs)
            ->with('grocery_run_for_dropdown', $grocery_run_for_dropdown)
            ->with('selected_grocery_run', $selected_grocery_run)
            ->with('selected_meal_count_day', $selected_meal_count_day)
            ->with('user_info', $user_info)
            ->with('bfast_ct_tot', $bfast_ct_tot)
            ->with('lunch_ct_tot', $lunch_ct_tot)
            ->with('dinner_ct_tot', $dinner_ct_tot)
            ->with('coffee_ct_tot', $coffee_ct_tot)
            ->with('bfast_save_tot', $bfast_save_tot)
            ->with('lunch_save_tot', $lunch_save_tot)
            ->with('dinner_save_tot', $dinner_save_tot)
            ->with('coffee_save_tot', $coffee_save_tot)
            ->with('grocery_run_grand_tot', $grocery_run_grand_tot); 
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
        return redirect('/game-board/show/3');
        
    }

   public function getShow($gr_id)
    {
        $user_info = \Auth::user();
        $user_grocery_runs = \LMG\GroceryRun::with('meal_count_day')->orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get();

        //get dropdown list of grocery run dates
        $grocery_run_for_dropdown = [];
        foreach($user_grocery_runs as $grocery_run) {
            $grocery_run_for_dropdown[$grocery_run->id] = $grocery_run->dt_grocery_run;
        }
        
        $most_recent_grocery_run = $user_grocery_runs->first();
        //get most recent grocery run (if we are doing show() then we get the selected grocery run)
        if(isset($gr_id)) {
            $selected_grocery_run = $user_grocery_runs->find($gr_id);
        }
        else {
            $selected_grocery_run = $most_recent_grocery_run;
        }
        
        $selected_meal_count_day = [];
// ->where('dt_meal_count', '=', $meal_count_date)
        $now = \Carbon\Carbon::now();
        $meal_count_date = $now;
        $test_id = 1;
        $default_meal_count_day = \LMG\MealCountDay::where('grocery_run_id', '=', $gr_id)->where('dt_meal_count', '=', $meal_count_date)->get();

        if(isset($request->meal_count_day_id)) {
            $selected_meal_count_day = $user_grocery_run->meal_count_day->find($request->meal_count_day_id);
        }
        else {
            // $selected_meal_count_day = $selected_grocery_run->meal_count_day->where();
        }
        dump($default_meal_count_day );

        $bfast_ct_tot = 0;
        $lunch_ct_tot = 0;
        $dinner_ct_tot = 0;
        $coffee_ct_tot = 0;

        $bfast_save_tot = 0;
        $lunch_save_tot = 0;
        $dinner_save_tot = 0;
        $coffee_save_tot = 0;

        foreach ($user_grocery_runs as $user_grocery_run) {
          if ($user_grocery_run['id']==$selected_grocery_run['id']) {
            foreach($user_grocery_run->meal_count_day as $meal_count_day) {
                $bfast_ct_tot = $bfast_ct_tot + $meal_count_day['bfast_ct'];
                $lunch_ct_tot = $lunch_ct_tot + $meal_count_day['lunch_ct'];
                $dinner_ct_tot = $dinner_ct_tot + $meal_count_day['dinner_ct'];
                $coffee_ct_tot = $coffee_ct_tot + $meal_count_day['coffee_ct'];

                $bfast_save_tot = $bfast_save_tot + ($meal_count_day['bfast_ct'] * $user_info['bfast_spend']);
                $lunch_save_tot = $lunch_save_tot + ($meal_count_day['lunch_ct'] * $user_info['lunch_spend']);
                $dinner_save_tot = $dinner_save_tot + ($meal_count_day['dinner_ct'] * $user_info['dinner_spend']);
                $coffee_save_tot = $coffee_save_tot + ($meal_count_day['coffee_ct'] * $user_info['coffee_spend']);

            }
          }
        }

        $grocery_run_grand_tot = $bfast_save_tot + $lunch_save_tot + $dinner_save_tot + $coffee_save_tot;

        return view('GameBoard.show')
            ->with('user_grocery_runs', $user_grocery_runs)
            ->with('grocery_run_for_dropdown', $grocery_run_for_dropdown)
            ->with('selected_grocery_run', $selected_grocery_run)
            ->with('selected_meal_count_day', $selected_meal_count_day)
            ->with('user_info', $user_info)
            ->with('bfast_ct_tot', $bfast_ct_tot)
            ->with('lunch_ct_tot', $lunch_ct_tot)
            ->with('dinner_ct_tot', $dinner_ct_tot)
            ->with('coffee_ct_tot', $coffee_ct_tot)
            ->with('bfast_save_tot', $bfast_save_tot)
            ->with('lunch_save_tot', $lunch_save_tot)
            ->with('dinner_save_tot', $dinner_save_tot)
            ->with('coffee_save_tot', $coffee_save_tot)
            ->with('grocery_run_grand_tot', $grocery_run_grand_tot); 
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
