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
}
