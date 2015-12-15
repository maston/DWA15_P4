<?php

namespace LMG\Http\Controllers;

use Illuminate\Http\Request;

use LMG\Http\Requests;
use LMG\Http\Controllers\Controller;

class Settings extends Controller
{

    public function getSettings()
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

        return View('Settings.edit')
            ->with('user_info', $user_info)
            ->with('user_total_save', $user_total_save)
            ->with('game_total_save', $game_total_save); 
    }

    public function postSettings(Request $request)
    {
         // Validation
        $this->validate(
            $request,
            [
                'bfast_spend' => 'required|numeric|between:.50,99.99',
                'lunch_spend' => 'required|numeric|between:.50,99.99',
                'dinner_spend' => 'required|numeric|between:.50,99.99',
                'coffee_spend' => 'required|numeric|between:.50,99.99',
                'zipcode' => 'required|digits:5'
            ]
        );

        $user_info = \Auth::user();
        $user_info->bfast_spend = $request->bfast_spend;
        $user_info->lunch_spend = $request->lunch_spend;
        $user_info->dinner_spend = $request->dinner_spend;
        $user_info->coffee_spend = $request->coffee_spend;
        $user_info->zipcode = $request->zipcode;
        $user_info->save();

        \Session::flash('flash_message','Your settings were updated.');
        return redirect('/settings');
    }
}
