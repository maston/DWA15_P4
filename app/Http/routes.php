<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

// Registration Routes
Route::get('/register/create', 'Register@getCreate');
Route::post('/register/create', 'Register@postCreate');
Route::get('/register/intro', 'Register@getIntro');
Route::get('/register/settings', 'Register@getSettings');
Route::post('/register/settings', 'Register@postSettings');

// Settings Routes
// Settings are created at registration these routes edit them.
// Route::get('/settings/{user_id}', 'Settings@show');
Route::get('/settings/{id}', 'Settings@getEdit');
Route::post('/settings', 'Settings@postEdit');
// Route::delete('/settings/{user_id}', 'Settings@destroy');

// Grocery Run Routes
Route::get('/grocery-runs/{id}', 'GroceryRuns@index');
Route::get('/grocery-runs/create/{id}', 'GroceryRuns@getCreate');
Route::post('/grocery-runs/create', 'GroceryRuns@postCreate');
Route::get('/grocery-runs/edit/{id}', 'GroceryRuns@getEdit');
Route::post('/grocery-runs/edit', 'GroceryRuns@postEdit');

// Route::post('/grocery-runs', 'GroceryRuns@store');
// Route::get('/grocery-runs/{gr_id}', 'GroceryRuns@show');

// Route::put('/grocery-runs/{gr_id}', 'GroceryRuns@update');
// Route::delete('/grocery-runs/{gr_id}', 'GroceryRuns@destroy');

// Game Board Routes - manages meal counts
Route::get('/game-board/{id}', 'GameBoard@index'); //load user GB to current GR with MCs
Route::post('/game-board/create', 'GameBoard@postCreate'); //Add a new MC
Route::get('/game-board/edit/{id}', 'GameBoard@getEdit');  //Edit a MC from Grid
Route::post('/game-board/edit', 'GameBoard@postEdit');  //Update a MC from Grid



Route::post('/game-board', 'GameBoard@store');
Route::get('/game-board/{mc_id}', 'GameBoard@show');
Route::put('/game-board/{mc_id}', 'GameBoard@update');
Route::delete('/game-board/{mc_id}', 'GameBoard@destroy');

// Metrics Routes
Route::get('/metrics/{user_id}', 'Metrics@show');

// FAQ Routes
Route::get('/faqs', 'FAQs@index');


Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(config('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    /*
    The following line will output your MySQL credentials.
    Uncomment it only if you're having a hard time connecting to the database and you
    need to confirm your credentials.
    When you're done debugging, comment it back out so you don't accidentally leave it
    running on your live server, making your credentials public.
    */
    //print_r(config('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    }
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});