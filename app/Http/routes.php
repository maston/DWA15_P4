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
    return view('welcome');
});

Route::get('/register', function () {
    return "Registration Form";
});

Route::post('/register', function () {
    return "Registration Form";
});


// these may be on same "getting started" screen
Route::get('/setup-instructions', function () {
    return "Intro Instructions on Setup";  // will bring in instructions view
});

Route::get('/setup-settings', function () {
    return "Intro Settings Form"; // will bring in settings view
});

Route::get('/settings', function () {
    return "Settings Form";
});

Route::post('/settings', function () {
    return "Settings Form";
});

Route::get('/grocery-runs', function () {
    return "Grocery Run Form";
});

Route::post('/grocery-runs', function () {
    return "Grocery Run Form";
});

Route::get('/game-board', function () {
    return "The Gameboard";
});

Route::post('/game-board', function () {
    return "Process The Gameboard";
});

Route::get('/metrics', function () {
    return "Metrics";
});

Route::get('/faq', function () {
    return "FAQ View";
});

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