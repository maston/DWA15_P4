<?php

namespace LMG\Http\Controllers;

use Illuminate\Http\Request;

use LMG\Http\Requests;
use LMG\Http\Controllers\Controller;

class Instructions extends Controller
{

// ****************************
// function: index
// type: GET
// param: none
// summary: Displays instructions.
// ****************************

    public function index()
    {

        return View('instructions');

    }
}
