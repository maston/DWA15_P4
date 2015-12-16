<?php

namespace LMG\Http\Controllers;

use Illuminate\Http\Request;

use LMG\Http\Requests;
use LMG\Http\Controllers\Controller;

class GameBoard extends Controller
{

// ****************************
// function: getGameBoard
// type: GET
// param: $gr_id - grocery run id
// summary: gets a gameboard for a selected grocery run.
//          if no gameboard is selected --> defaults to the most current grocery run.
//          Meal Counts --> default to add unless there are meal counts for today's date already then update mode.
// ****************************

     public function getGameBoard($gr_id = null)
    {
        $bfast_ct_tot = 0;
        $lunch_ct_tot = 0;
        $dinner_ct_tot = 0;
        $coffee_ct_tot = 0;
        $bfast_save_tot = 0;
        $lunch_save_tot = 0;
        $dinner_save_tot = 0;
        $coffee_save_tot = 0;
        $user_info = \Auth::user();
        $user_grocery_runs = \LMG\GroceryRun::with('meal_count_day')->orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get();
        $selected_meal_count_day = [];
        $meal_count_selected= false;

        $GroceryRunModel = new \LMG\GroceryRun();
        $grocery_run_for_dropdown = $GroceryRunModel->getGroceryRunsForDropdown();

        if(isset($gr_id)) {
            $selected_grocery_run = $user_grocery_runs->find($gr_id);
        }
        else {
            $selected_grocery_run = $user_grocery_runs->first();
        }

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

        //determine if there are meal counts for default current day
        $now = \Carbon\Carbon::now()->format('Y-m-d');
        $selected_meal_count_day = \LMG\MealCountDay::where('grocery_run_id', '=', $selected_grocery_run['id'])->where('dt_meal_count', '=', $now)->first();
        
        if(isset($selected_meal_count_day)) {
            $meal_count_selected= true;
        }     

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
            ->with('grocery_run_grand_tot', $grocery_run_grand_tot)
            ->with('meal_count_selected', $meal_count_selected);
    }

// ****************************
// function: getMealCount
// type: GET
// param: $mc_id - meal count id
// summary: gets a gameboard for a selected grocery run on a selected meal count day.
//          the meal count section will be in update mode.
// ****************************

    public function getMealCount($mc_id = null)
    {
        $user_info = \Auth::user();
        $user_grocery_runs = \LMG\GroceryRun::with('meal_count_day')->orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get();
        $selected_meal_count_day = \LMG\MealCountDay::where('id', '=', $mc_id)->first();
        $meal_count_selected= true;

        $GroceryRunModel = new \LMG\GroceryRun();
        $grocery_run_for_dropdown = $GroceryRunModel->getGroceryRunsForDropdown();

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
            ->with('grocery_run_grand_tot', $grocery_run_grand_tot)
            ->with('meal_count_selected', $meal_count_selected);
            // ->with('user_total_save', $user_total_save)
            // ->with('game_total_save', $game_total_save);           
    }

// ****************************
// function: getNewMealCount
// type: GET
// param: $mc_id - meal count id
// summary: gets a gameboard for a selected grocery run for a new meal count day.
//          
// ****************************

    public function getNewMealCount($gr_id = null)
    {
        $user_info = \Auth::user();
        $user_grocery_runs = \LMG\GroceryRun::with('meal_count_day')->orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get();
        $selected_meal_count_day = [];
        $meal_count_selected= false;

        $GroceryRunModel = new \LMG\GroceryRun();
        $grocery_run_for_dropdown = $GroceryRunModel->getGroceryRunsForDropdown();

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


        return view('GameBoard.show')
            ->with('user_grocery_runs', $user_grocery_runs)
            ->with('grocery_run_for_dropdown', $grocery_run_for_dropdown)
            ->with('selected_grocery_run', $selected_grocery_run)
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

// ****************************
// function: postMealCount
// type: POST
// param: Request $request
// summary: Updates meal count record.
// ****************************

    public function postMealCount(Request $request) {
        $this->validate(
            $request,
            [
                'one_meal_count_entered' => 'required|numeric|min:1',                
                'dt_meal_count' => 'required|date',
                'bfast_ct' => 'required|numeric|min:0',
                'lunch_ct' => 'required|numeric|min:0',
                'dinner_ct' => 'required|numeric|min:0',
                'coffee_ct' => 'required|numeric|min:0'
              ]
        );

        $user = \Auth::user();
        $grocery_run = \LMG\GroceryRun::find($request['grocery_run_id']);

        $meal_count_day = \LMG\MealCountDay::find($request->meal_count_day_id);   

        if ($meal_count_day->dt_meal_count != $request->dt_meal_count) {
            $meal_count_day = new \LMG\MealCountDay;
        }
        $meal_count_day->dt_meal_count = $request->dt_meal_count;
        $meal_count_day->bfast_ct = $request->bfast_ct;
        $meal_count_day->lunch_ct = $request->lunch_ct;
        $meal_count_day->dinner_ct = $request->dinner_ct;
        $meal_count_day->coffee_ct = $request->coffee_ct;
        $meal_count_day->user()->associate($user);
        $meal_count_day->grocery_run()->associate($grocery_run);
        $meal_count_day->save();

        \Session::flash('flash_message','Your meal counts were saved.');
        return redirect('/game-board/show/'.$request->grocery_run_id);
    }

// ****************************
// function: postCreateMealCount
// type: POST
// param: Request $request
// summary: Adds meal count record.
// ****************************

    public function postCreateMealCount(Request $request) {

        $this->validate(
            $request,
            [   
                'one_meal_count_entered' => 'required|numeric|min:1',
                'dt_meal_count' => 'required|unique:meal_count_days,dt_meal_count|date',
                'bfast_ct' => 'required|numeric|min:0',
                'lunch_ct' => 'required|numeric|min:0',
                'dinner_ct' => 'required|numeric|min:0',
                'coffee_ct' => 'required|numeric|min:0'
              ]
        );

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

        \Session::flash('flash_message','Your meal count was added.');
        return redirect('/game-board/show/'.$request->grocery_run_id);
    }

// ****************************
// function: getDeleteMealCount
// type: GET
// param: $id
// summary: Deletes Meal Count record
// ****************************

    public function getDeleteMealCount($id) {

        $meal_count_day = \LMG\MealCountDay::find($id);   
        if(is_null($meal_count_day)) {
            \Session::flash('flash_message','Meal count not found.');
            return redirect('/game-board');
        }
        $meal_count_day->delete();
        \Session::flash('flash_message','Meal count for '.$meal_count_day->dt_meal_count.' was deleted.');
        return redirect('/game-board');
    }
}
