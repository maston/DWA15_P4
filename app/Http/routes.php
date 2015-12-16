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

Route::get('/', function(){
    if(Auth::check()) {
        return redirect('/game-board');
    }
    else {
        return view('home');
    }
});


// Authentication Routes
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

// Registration Routes
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');

// Route Group
Route::group(['middleware' => 'auth'], function() {
    //Instructions Route
    Route::get('/instructions', 'Instructions@index');

    //Settings Routes
    Route::get('/settings', 'Settings@getSettings');
    Route::post('/settings', 'Settings@postSettings');

    // Game Board Routes - manages meal counts
    Route::get('/game-board', 'GameBoard@getGameBoard'); //load user GB to current GR with MCs
    Route::get('/game-board/show/{id?}', 'GameBoard@getGameBoard'); //load specific GB with GR
    Route::get('/game-board/show/meal-count/{id}', 'GameBoard@getMealCount'); //load specific GB with GR
    Route::get('/game-board/show/meal-count/new/{id}', 'GameBoard@getNewMealCount');
    Route::post('/game-board/show/meal-count', 'GameBoard@postMealCount');
    Route::post('/game-board/show/meal-count/create', 'GameBoard@postCreateMealCount');
    Route::get('/game-board/show/meal-count/delete/{id}', 'GameBoard@getDeleteMealCount');


    // Grocery Run Routes
    Route::get('/grocery-runs/{id?}', 'GroceryRuns@getGroceryRun');
    Route::post('/grocery-runs', 'GroceryRuns@postGroceryRun');
    Route::get('/grocery-runs/delete/{id}', 'GroceryRuns@getDeleteGroceryRun');

    // Metrics Routes
    Route::get('/metrics', 'Metrics@index');


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
});









