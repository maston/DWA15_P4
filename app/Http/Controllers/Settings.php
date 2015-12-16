<?php

namespace LMG\Http\Controllers;

use Illuminate\Http\Request;

use LMG\Http\Requests;
use LMG\Http\Controllers\Controller;

class Settings extends Controller
{

// ****************************
// function: getSettings
// type: GET
// param: none
// summary: Displays user settings.
// ****************************

    public function getSettings()
    {

        return View('Settings.edit'); 
    }

// ****************************
// function: postSettings
// type: POST
// param: none
// summary: Updates user settings.
// ****************************

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
