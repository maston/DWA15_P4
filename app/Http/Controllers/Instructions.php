<?php

namespace LMG\Http\Controllers;

use Illuminate\Http\Request;

use LMG\Http\Requests;
use LMG\Http\Controllers\Controller;

class Instructions extends Controller
{

// ****************************
// function: getSettings
// type: GET
// param: none
// summary: Displays user settings.
// ****************************

    public function index()
    {
        $user_info = \Auth::user();

        //kpi totals
        $user_total_saved = \DB::select("select sum(bfast_ct*bfast_spend + lunch_ct*lunch_spend + dinner_ct*dinner_spend + coffee_ct*coffee_spend) as tot from meal_count_days m, users u where (m.user_id = u.id) and u.id = ".$user_info->id);
        foreach($user_total_saved as $user_tot) {
            $user_total_save = $user_tot->tot;
        }
        $game_total_saved = \DB::select("select sum(bfast_ct*bfast_spend + lunch_ct*lunch_spend + dinner_ct*dinner_spend + coffee_ct*coffee_spend) as tot from meal_count_days m, users u where (m.user_id = u.id)");
        foreach($game_total_saved as $game_tot) {
            $game_total_save = $game_tot->tot;
        } 

        return View('instructions')
            ->with('user_info', $user_info)
            ->with('user_total_save', $user_total_save)
            ->with('game_total_save', $game_total_save); 
    }
}
