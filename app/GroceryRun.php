<?php

namespace LMG;

use Illuminate\Database\Eloquent\Model;

class GroceryRun extends Model
{
   public function user() {
       # Grocery Run belongs to User
       # Define an inverse one-to-many relationship.
       return $this->belongsTo('\LMG\User');
   }
   
   public function meal_count_day() {
      # User has many Meal Count Days
      # Define a one-to-many relationship.
      return $this->hasMany('\LMG\MealCountDay');
   }


// ****************************
// function: getGroceryRunsForDropdown
// param: none
// summary: creates a drop down of a user's grocery runs
// ****************************
public function getGroceryRunsForDropdown() {

    $user_grocery_runs = \LMG\GroceryRun::with('meal_count_day')->orderBy('dt_grocery_run','DESC')->where('user_id', '=', \Auth::id())->get();
    
    $grocery_run_for_dropdown = [];
    foreach($user_grocery_runs as $grocery_run) {
        $grocery_run_for_dropdown[$grocery_run->id] = $grocery_run->dt_grocery_run;
    }
    return $grocery_run_for_dropdown;

}

}