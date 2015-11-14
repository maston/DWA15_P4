<?php

namespace LMG;

use Illuminate\Database\Eloquent\Model;

class MealCountDay extends Model
{
   public function user() {
       # Meal Count Day belongs to User
       # Define an inverse one-to-many relationship.
       return $this->belongsTo('\LMG\User');
   }

   public function grocery_run() {
       # Meal Count Day belongs to Grocery Run 
       # Define an inverse one-to-many relationship.
       return $this->belongsTo('\LMG\GroceryRun');
   }
}
