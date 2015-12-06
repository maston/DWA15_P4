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
    // $user_info = \Auth::user();
    // return view('GameBoard.index')
    //     ->with('user_info', $user_info);
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
    //Settings Routes
    Route::get('/settings', 'Settings@getEdit');
    Route::post('/settings', 'Settings@postEdit');

    // Game Board Routes - manages meal counts
    Route::get('/game-board', 'GameBoard@index'); //load user GB to current GR with MCs
    Route::post('/game-board', 'GameBoard@postShow');

    Route::post('/game-board/create', 'GameBoard@postCreate'); //Add a new MC
    Route::get('/game-board/edit', 'GameBoard@getEdit');  //Edit a MC from Grid
    Route::post('/game-board/edit', 'GameBoard@postEdit');  //Update a MC from Grid

    // Grocery Run Routes
    Route::get('/grocery-runs', 'GroceryRuns@index');

    // Metrics Routes
    Route::get('/metrics', 'Metrics@show');

});
// Route::delete('/settings/{user_id}', 'Settings@destroy');

// Route::get('/grocery-runs', 'GroceryRuns@index');
Route::get('/grocery-runs/create/{id}', 'GroceryRuns@getCreate');
Route::post('/grocery-runs/create', 'GroceryRuns@postCreate');
Route::get('/grocery-runs/edit/{id}', 'GroceryRuns@getEdit');
Route::post('/grocery-runs/edit', 'GroceryRuns@postEdit');

// Route::post('/grocery-runs', 'GroceryRuns@store');
// Route::get('/grocery-runs/{gr_id}', 'GroceryRuns@show');

// Route::put('/grocery-runs/{gr_id}', 'GroceryRuns@update');
// Route::delete('/grocery-runs/{gr_id}', 'GroceryRuns@destroy');

// Route::post('/game-board', 'GameBoard@store');
// Route::get('/game-board/{mc_id}', 'GameBoard@show');
// Route::put('/game-board/{mc_id}', 'GameBoard@update');
// Route::delete('/game-board/{mc_id}', 'GameBoard@destroy');



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



// Route::get('/practice', function() {
// $id=1;
// $user_meal_counts = \LMG\MealCountDay::with('grocery_run')->orderBy('dt_meal_count','DESC')->where('user_id', '=', $id)->get(); 
// dump($user_meal_counts->toArray());
// $user_grocery_run = \LMG\GroceryRun::with('meal_count_day')->orderBy('dt_grocery_run','DESC')->where('user_id', '=', $id)->get();
// dump($user_grocery_run->toArray());
//         $grocery_run_for_dropdown = [];
//         foreach($user_grocery_run as $grocery_run) {
//             $grocery_run_for_dropdown[$grocery_run->id] = $grocery_run->dt_grocery_run;
//         }
// dump($grocery_run_for_dropdown);
// });


Route::get('/practice', function() {
    $user_grocery_runs = \LMG\GroceryRun::with('meal_count_day')->orderBy('dt_grocery_run','DESC')->where('user_id', '=', 1)->get();

    foreach ($user_grocery_runs as $user_grocery_run) {
        echo '<br>'.$user_grocery_run->dt_grocery_run.' grocery run has following meal counts: ';
        foreach ($user_grocery_run->meal_count_day as $meal_count_day) {
            echo 'Bfast count: '.$meal_count_day->bfast_ct.' ,';
            echo 'Lunch count: '.$meal_count_day->lunch_ct.' ,';
        }
    }
 });

Route::get('/testing', function() {
    return view('testing');
 });









