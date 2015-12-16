<?php

namespace LMG\Http\Controllers;

use Illuminate\Http\Request;

use LMG\Http\Requests;
use LMG\Http\Controllers\Controller;

class GroceryRuns extends Controller
{

// ****************************
// function: getGroceryRun
// type: GET
// param: $id - grocery run id
// summary: If $id is set the selected grocery run loads to view for editing.
//          If not, view is ready for a new grocery run to be added.
// ****************************

    public function getGroceryRun($id = null)
    {
        $user_info = \Auth::user();
        $user_grocery_runs = \LMG\GroceryRun::orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get(); 
        $grocery_run_selected = isset($id);

        $selected_grocery_run = $user_grocery_runs->find($id);
 
        return view('GroceryRuns.show')
            ->with('user_grocery_runs', $user_grocery_runs)
            ->with('selected_grocery_run', $selected_grocery_run)
            ->with('user_info', $user_info)
            ->with('grocery_run_selected', $grocery_run_selected);
    }

// ****************************
// function: postGroceryRun
// type: POST
// param: $id - grocery run id
// summary: Updates the grocery run.  Evals the request to either 
//          update or add a Grocery run as appropriate.
// ****************************

    public function postGroceryRun(Request $request)
    {
        $this->validate(
            $request,
            [
                'dt_grocery_run' => 'required|unique:grocery_runs,dt_grocery_run|date',
                'total_amt' => 'required|numeric|between:.50,599.99',
                'non_food_amt' => 'required|numeric|between:0,99.99',
                'food_amt' => 'required|numeric|between:.50,99.99'
              ]
        );

        $user = \Auth::user();
        
        if(isset($request->grocery_run_id)) {
            $grocery_run = \LMG\GroceryRun::find($request->grocery_run_id);  
        }
        else {
            $grocery_run = new \LMG\GroceryRun;   
        }

        $grocery_run->dt_grocery_run = $request->dt_grocery_run;
        $grocery_run->total_amt = $request->total_amt;
        $grocery_run->non_food_amt = $request->non_food_amt;
        $grocery_run->food_amt = $request->food_amt;
        $grocery_run->user()->associate($user);
        $grocery_run->save();

        \Session::flash('flash_message','Your grocery run was saved.');

        if(isset($request->grocery_run_id)) {
            return redirect('/grocery-runs/'.$request->grocery_run_id);  
        }
        else {
            return redirect('/game-board'); 
        }
    }

// ****************************
// function: getDeleteGroceryRun
// type: get
// param: $id - grocery run id
// summary: Delete grocery run and all the meal count days associated to it
// ****************************
    
    public function getDeleteGroceryRun($id) {

        $grocery_run = \LMG\GroceryRun::find($id);   

        if(is_null($grocery_run)) {
            \Session::flash('flash_message','Grocery run not found.');
            return redirect('/grocery-runs');
        }
        if($grocery_run->meal_count_day()) {
            $grocery_run->meal_count_day()->delete();
        }
        $grocery_run->delete();
        \Session::flash('flash_message','Grocery run and all meal counts for '.$grocery_run->dt_grocery_run.' was deleted.');
        return redirect('/grocery-runs');
    }
}
