<?php

namespace LMG\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        # Make the variable "user" available to all views
        \View::composer('*', function($view) {
            $view->with('user_info', \Auth::user());
        });
        # Make KPI variables available to all views.
        \View::composer('*', function($view) {
            $user_total_save = 0;
            //check to see that there is a user logged in - else you get error.
            if(\Auth::check()) {
                $user_total_saved = \DB::select("select sum(bfast_ct*bfast_spend + lunch_ct*lunch_spend + dinner_ct*dinner_spend + coffee_ct*coffee_spend) as tot from meal_count_days m, users u where (m.user_id = u.id) and u.id = ".\Auth::id());        
                foreach($user_total_saved as $user_tot) {
                    $user_total_save = $user_tot->tot;
                }
                if(!isset($user_total_save)) {
                    $user_total_save=0;
                }
            }
            $view->with('user_total_save', $user_total_save);
        });
        \View::composer('*', function($view) {
            $game_total_saved = \DB::select("select sum(bfast_ct*bfast_spend + lunch_ct*lunch_spend + dinner_ct*dinner_spend + coffee_ct*coffee_spend) as tot from meal_count_days m, users u where (m.user_id = u.id)");
            foreach($game_total_saved as $game_tot) {
                $game_total_save = $game_tot->tot;
            } 
            $view->with('game_total_save', $game_total_save);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
