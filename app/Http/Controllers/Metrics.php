<?php

namespace LMG\Http\Controllers;

use Illuminate\Http\Request;

use LMG\Http\Requests;
use LMG\Http\Controllers\Controller;

class Metrics extends Controller
{

    public function index()
    {
        $user_info = \Auth::user();

        //kpi bar totals
        $user_total_saved = \DB::select("select sum(bfast_ct*bfast_spend + lunch_ct*lunch_spend + dinner_ct*dinner_spend + coffee_ct*coffee_spend) as tot from meal_count_days m, users u where (m.user_id = u.id) and u.id = ".\Auth::id());
        foreach($user_total_saved as $user_tot) {
            $user_total_save = $user_tot->tot;
        }
        $game_total_saved = \DB::select("select sum(bfast_ct*bfast_spend + lunch_ct*lunch_spend + dinner_ct*dinner_spend + coffee_ct*coffee_spend) tot from meal_count_days m, users u where (m.user_id = u.id)");
        foreach($game_total_saved as $game_tot) {
            $game_total_save = $game_tot->tot;
        }        

        // metrics - kpi - player data
        // money saved
        $kpi_player_total_saved = \DB::select("select sum(bfast_ct*bfast_spend + lunch_ct*lunch_spend + dinner_ct*dinner_spend + coffee_ct*coffee_spend) tot_save from meal_count_days m, users u where (m.user_id = u.id) and u.id = ".\Auth::id());
        foreach($kpi_player_total_saved as $kpi_player_tot) {
            $kpi_player_total_save = $kpi_player_tot->tot_save;
        }
        // food spend from grocery runs
        $kpi_player_total_food_spent = \DB::select("select sum(food_amt) as tot_food_spend from grocery_runs where user_id = ".\Auth::id());
        foreach($kpi_player_total_food_spent as $kpi_player_tot_food) {
            $kpi_player_total_food_spend = $kpi_player_tot_food->tot_food_spend;
        }

        $kpi_player_total_back_in_pocket = $kpi_player_total_save - $kpi_player_total_food_spend;

        // metrics - kpi - LMG data
        // money saved
        $kpi_lmg_total_saved = \DB::select("select sum(bfast_ct*bfast_spend + lunch_ct*lunch_spend + dinner_ct*dinner_spend + coffee_ct*coffee_spend) tot_save from meal_count_days m, users u where (m.user_id = u.id)");
        foreach($kpi_lmg_total_saved as $kpi_lmg_tot) {
            $kpi_lmg_total_save = $kpi_lmg_tot->tot_save;
        }
        // food spend from grocery runs
        $kpi_lmg_total_food_spent = \DB::select("select sum(food_amt) as tot_food_spend from grocery_runs");
        foreach($kpi_lmg_total_food_spent as $kpi_lmg_tot_food) {
            $kpi_lmg_total_food_spend = $kpi_lmg_tot_food->tot_food_spend;
        }

        $kpi_lmg_total_back_in_pocket = $kpi_lmg_total_save - $kpi_lmg_total_food_spend;

        // Metrics Detail 
        // Player Meal Counts by Type, MM-YYYY
        $kpi_player_meal_count_detail = \DB::select("select date_format(dt_meal_count, '%M %Y') dt, sum(bfast_ct) tot_bfast_ct, sum(lunch_ct) tot_lunch_ct, sum(dinner_ct) tot_dinner_ct, sum(coffee_ct) tot_coffee_ct,sum(bfast_ct + lunch_ct + dinner_ct + coffee_ct) tot_month_ct from meal_count_days m, users u where (m.user_id = u.id) and u.id = ".\Auth::id()." group by date_format(dt_meal_count, '%M %Y')");
        // Player Save by Type, MM-YYYY
        $kpi_player_save_detail = \DB::select("select date_format(dt_meal_count, '%M %Y') dt, sum(bfast_ct*bfast_spend) tot_bfast_save, sum(lunch_ct*lunch_spend) tot_lunch_save, sum(dinner_ct*dinner_spend) tot_dinner_save, sum(coffee_ct*coffee_spend) tot_coffee_save,sum(bfast_ct*bfast_spend + lunch_ct*lunch_spend + dinner_ct*dinner_spend + coffee_ct*coffee_spend) tot_month_save from meal_count_days m, users u where (m.user_id = u.id) and u.id = ".\Auth::id()." group by date_format(dt_meal_count, '%M %Y')");
       // Player grand totals
        $kpi_player_grand_totals = \DB::select("select sum(bfast_ct*bfast_spend) grand_tot_bfast_save, sum(lunch_ct*lunch_spend) grand_tot_lunch_save, sum(dinner_ct*dinner_spend) grand_tot_dinner_save, sum(coffee_ct*coffee_spend) grand_tot_coffee_save, sum(bfast_ct) grand_tot_bfast_ct, sum(lunch_ct) grand_tot_lunch_ct, sum(dinner_ct) grand_tot_dinner_ct, sum(coffee_ct) grand_tot_coffee_ct, sum(bfast_ct + lunch_ct + dinner_ct + coffee_ct) as grand_tot_ct, sum(bfast_ct*bfast_spend + lunch_ct*lunch_spend + dinner_ct*dinner_spend + coffee_ct*coffee_spend) as grand_tot_save from meal_count_days m, users u where (m.user_id = u.id) and u.id = ".\Auth::id().";");

        // LMG Meal Counts detail by Type, MM-YYYY
        $kpi_lmg_meal_count_detail = \DB::select("select date_format(dt_meal_count, '%M %Y') dt, sum(bfast_ct) tot_bfast_ct, sum(lunch_ct) tot_lunch_ct, sum(dinner_ct) tot_dinner_ct, sum(coffee_ct) tot_coffee_ct,sum(bfast_ct + lunch_ct + dinner_ct + coffee_ct) tot_month_ct from meal_count_days m, users u where (m.user_id = u.id) group by date_format(dt_meal_count, '%M %Y')");
        // LMG Save by Type, MM-YYYY
        $kpi_lmg_save_detail = \DB::select("select date_format(dt_meal_count, '%M %Y') dt, sum(bfast_ct*bfast_spend) tot_bfast_save, sum(lunch_ct*lunch_spend) tot_lunch_save, sum(dinner_ct*dinner_spend) tot_dinner_save, sum(coffee_ct*coffee_spend) tot_coffee_save,sum(bfast_ct*bfast_spend + lunch_ct*lunch_spend + dinner_ct*dinner_spend + coffee_ct*coffee_spend) tot_month_save from meal_count_days m, users u where (m.user_id = u.id) group by date_format(dt_meal_count, '%M %Y')");
        // LMG grand totals
        $kpi_lmg_grand_totals = \DB::select("select sum(bfast_ct*bfast_spend) grand_tot_bfast_save, sum(lunch_ct*lunch_spend) grand_tot_lunch_save, sum(dinner_ct*dinner_spend) grand_tot_dinner_save, sum(coffee_ct*coffee_spend) grand_tot_coffee_save, sum(bfast_ct) grand_tot_bfast_ct, sum(lunch_ct) grand_tot_lunch_ct, sum(dinner_ct) grand_tot_dinner_ct, sum(coffee_ct) grand_tot_coffee_ct, sum(bfast_ct + lunch_ct + dinner_ct + coffee_ct) as grand_tot_ct, sum(bfast_ct*bfast_spend + lunch_ct*lunch_spend + dinner_ct*dinner_spend + coffee_ct*coffee_spend) as grand_tot_save from meal_count_days m, users u where (m.user_id = u.id);");

        return view('Metrics.show')
            ->with('kpi_player_total_save', $kpi_player_total_save)
            ->with('kpi_player_total_food_spend', $kpi_player_total_food_spend)
            ->with('kpi_player_total_back_in_pocket', $kpi_player_total_back_in_pocket)
            ->with('kpi_lmg_total_save', $kpi_lmg_total_save)
            ->with('kpi_lmg_total_food_spend', $kpi_lmg_total_food_spend)
            ->with('kpi_lmg_total_back_in_pocket', $kpi_lmg_total_back_in_pocket)
            ->with('kpi_player_meal_count_detail', $kpi_player_meal_count_detail)
            ->with('kpi_player_save_detail', $kpi_player_save_detail)
            ->with('kpi_player_grand_totals', $kpi_player_grand_totals)
            ->with('kpi_lmg_meal_count_detail', $kpi_lmg_meal_count_detail)
            ->with('kpi_lmg_save_detail', $kpi_lmg_save_detail)
            ->with('kpi_lmg_grand_totals', $kpi_lmg_grand_totals)
            ->with('user_info', $user_info)
            ->with('user_total_save', $user_total_save)
            ->with('game_total_save', $game_total_save); 
    }
}
