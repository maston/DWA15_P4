<?php

namespace LMG\Http\Controllers;

use Illuminate\Http\Request;

use LMG\Http\Requests;
use LMG\Http\Controllers\Controller;

class TestBoard extends Controller
{
    public function index()
    {
        $user_info = \Auth::user();
        $user_grocery_runs = \LMG\GroceryRun::with('meal_count_day')->orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get();
        $selected_meal_count_day = [];
        $meal_count_selected= false;
        //get dropdown list of grocery run dates
        $grocery_run_for_dropdown = [];
        foreach($user_grocery_runs as $grocery_run) {
            $grocery_run_for_dropdown[$grocery_run->id] = $grocery_run->dt_grocery_run;
        }
        
        // get most recent Grocery Run
        $most_recent_grocery_run = $user_grocery_runs->first();

        $bfast_ct_tot = 0;
        $lunch_ct_tot = 0;
        $dinner_ct_tot = 0;
        $coffee_ct_tot = 0;

        $bfast_save_tot = 0;
        $lunch_save_tot = 0;
        $dinner_save_tot = 0;
        $coffee_save_tot = 0;

        $selected_grocery_run = $most_recent_grocery_run;
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

        return view('TestBoard.index')
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

    public function getGroceryRun($gr_id = null)
    {
        $user_info = \Auth::user();
        $user_grocery_runs = \LMG\GroceryRun::with('meal_count_day')->orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get();
        $selected_meal_count_day = [];
        $meal_count_selected= false;
        //get dropdown list of grocery run dates
        $grocery_run_for_dropdown = [];
        foreach($user_grocery_runs as $grocery_run) {
            $grocery_run_for_dropdown[$grocery_run->id] = $grocery_run->dt_grocery_run;
        }
        // get most recent Grocery Run
        // $most_recent_grocery_run = $user_grocery_runs->first();

        $bfast_ct_tot = 0;
        $lunch_ct_tot = 0;
        $dinner_ct_tot = 0;
        $coffee_ct_tot = 0;

        $bfast_save_tot = 0;
        $lunch_save_tot = 0;
        $dinner_save_tot = 0;
        $coffee_save_tot = 0;

        $selected_grocery_run = $user_grocery_runs->find($gr_id);
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

        return view('TestBoard.show')
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
            ->with('grocery_run_grand_tot', $grocery_run_grand_tot)
            ->with('meal_count_selected', $meal_count_selected); 
    }

    public function getMealCount($mc_id = null)
    {
        $user_info = \Auth::user();
        $user_grocery_runs = \LMG\GroceryRun::with('meal_count_day')->orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get();
        $selected_meal_count_day = \LMG\MealCountDay::where('id', '=', $mc_id)->first();
        $meal_count_selected= true;
        //get dropdown list of grocery run dates
        $grocery_run_for_dropdown = [];
        foreach($user_grocery_runs as $grocery_run) {
            $grocery_run_for_dropdown[$grocery_run->id] = $grocery_run->dt_grocery_run;
        }
        
        // get most recent Grocery Run
        // $most_recent_grocery_run = $user_grocery_runs->first();

        $bfast_ct_tot = 0;
        $lunch_ct_tot = 0;
        $dinner_ct_tot = 0;
        $coffee_ct_tot = 0;

        $bfast_save_tot = 0;
        $lunch_save_tot = 0;
        $dinner_save_tot = 0;
        $coffee_save_tot = 0;

        $selected_grocery_run = $user_grocery_runs->find($selected_meal_count_day->grocery_run_id);

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

        return view('TestBoard.mc')
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
            ->with('grocery_run_grand_tot', $grocery_run_grand_tot)
            ->with('meal_count_selected', $meal_count_selected);          
    }

    public function postMealCount(Request $request) {
        $user = \Auth::user();
        $grocery_run = \LMG\GroceryRun::find($request['grocery_run_id']);


        $meal_count_day = \LMG\MealCountDay::find($request->meal_count_day_id);   
        $meal_count_day->dt_meal_count = $request->dt_meal_count;
        $meal_count_day->bfast_ct = $request->bfast_ct;
        $meal_count_day->lunch_ct = $request->lunch_ct;
        $meal_count_day->dinner_ct = $request->dinner_ct;
        $meal_count_day->coffee_ct = $request->coffee_ct;
        $meal_count_day->user()->associate($user);
        $meal_count_day->grocery_run()->associate($grocery_run);
        $meal_count_day->save();

        \Session::flash('flash_message','Your meal counts were saved.');
        return redirect('/test-board/show/'.$request->grocery_run_id);
    }
}

