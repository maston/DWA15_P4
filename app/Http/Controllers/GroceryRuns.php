<?php

namespace LMG\Http\Controllers;

use Illuminate\Http\Request;

use LMG\Http\Requests;
use LMG\Http\Controllers\Controller;

class GroceryRuns extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     // $nav_gameboard = '';
    //     // $nav_settings = '';
    //     // $nav_grocery_run = 'active';
    //     // $nav_metrics = '';
    //     $user_info = \Auth::user();
    //     $user_grocery_runs = \LMG\GroceryRun::orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get(); 
    //     $grocery_run_selected = false;

    //      // dump($user_info);   
    //     return view('GroceryRuns.index')
    //         ->with('user_grocery_runs', $user_grocery_runs)
    //         ->with('user_info', $user_info)
    //         ->with('grocery_run_selected', $grocery_run_selected);
    // }

    public function getGroceryRun($id = null)
    {
        // $nav_gameboard = '';
        // $nav_settings = '';
        // $nav_grocery_run = 'active';
        // $nav_metrics = '';
        $user_info = \Auth::user();
        $user_grocery_runs = \LMG\GroceryRun::orderBy('dt_grocery_run','DESC')->where('user_id', '=', $user_info->id)->get(); 
        $grocery_run_selected = isset($id);

        $selected_grocery_run = $user_grocery_runs->find($id);

                //kpi totals
        $user_total_saved = \DB::select("select sum(bfast_ct*bfast_spend + lunch_ct*lunch_spend + dinner_ct*dinner_spend + coffee_ct*coffee_spend) as tot from meal_count_days m, users u where (m.user_id = u.id) and u.id = ".$user_info->id);
        foreach($user_total_saved as $user_tot) {
            $user_total_save = $user_tot->tot;
        }
        $game_total_saved = \DB::select("select sum(bfast_ct*bfast_spend + lunch_ct*lunch_spend + dinner_ct*dinner_spend + coffee_ct*coffee_spend) as tot from meal_count_days m, users u where (m.user_id = u.id)");
        foreach($game_total_saved as $game_tot) {
            $game_total_save = $game_tot->tot;
        } 

         // dump($user_info);   
        return view('GroceryRuns.show')
            ->with('user_grocery_runs', $user_grocery_runs)
            ->with('selected_grocery_run', $selected_grocery_run)
            ->with('user_info', $user_info)
            ->with('grocery_run_selected', $grocery_run_selected)
            ->with('user_total_save', $user_total_save)
            ->with('game_total_save', $game_total_save); 
    }

    public function postGroceryRun(Request $request)
    {

        $user = \Auth::user();
        
        if(isset($request->grocery_run_id)) {
            $grocery_run = \LMG\GroceryRun::find($request->grocery_run_id);  
        }
        else {
            $grocery_run = new \LMG\GroceryRun;   
        }

        $grocery_run->dt_grocery_run = $request->dt_grocery_run;
        $grocery_run->total_amt = $request->total_amt;
        $grocery_run->non_food_amt = $request->non_food_amt;
        $grocery_run->food_amt = $request->food_amt;
        $grocery_run->user()->associate($user);
        $grocery_run->save();

        \Session::flash('flash_message','Your grocery run was saved.');

        if(isset($request->grocery_run_id)) {
            return redirect('/grocery-runs/'.$request->grocery_run_id);  
        }
        else {
            return redirect('/game-board'); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate($id)
    {
        $nav_gameboard = '';
        $nav_settings = '';
        $nav_grocery_run = 'active';
        $nav_metrics = '';
        $user_info = \LMG\User::find($id);
            
        return view('GroceryRuns.create')
            ->with('user_info', $user_info)
            ->with('nav_gameboard', $nav_gameboard)
            ->with('nav_settings', $nav_settings)
            ->with('nav_grocery_run', $nav_grocery_run)
            ->with('nav_metrics', $nav_metrics);
    }

    // public function postCreate(Request $request)
    // {
    //     // dump($request);
    //     $nav_gameboard = '';
    //     $nav_settings = '';
    //     $nav_grocery_run = 'active';
    //     $nav_metrics = '';
    //     $user = \LMG\User::find($request['user_id']);

    //     $grocery_run = new \LMG\GroceryRun;    
    //     $grocery_run->dt_grocery_run = $request->dt_grocery_run;
    //     $grocery_run->total_amt = $request->total_amt;
    //     $grocery_run->non_food_amt = $request->non_food_amt;
    //     $grocery_run->food_amt = $request->food_amt;
    //     $grocery_run->user()->associate($user);
    //     $grocery_run->save();

    //     \Session::flash('flash_message','Your grocery run was saved.');
    //     return redirect('/grocery-runs/'.$grocery_run->user_id);
    // }



        //     $book = new \App\Book;
        // $book->title = "Harry Potter and the Philosopher's Stone";
        // $book->published = 1997;
        // $book->cover = 'http://prodimage.images-bn.com/pimages/9781582348254_p0_v1_s118x184.jpg';
        // $book->purchase_link = 'http://www.barnesandnoble.com/w/harrius-potter-et-philosophi-lapis-j-k-rowling/1102662272?ean=9781582348254';
        // $book->author()->associate($author); # <--- Associate the author with this book
        // //$book->author_id = $author->id;
        // $book->save();
        // dump($book->toArray());
        // return 'Added new book.';

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $nav_gameboard = '';
        $nav_settings = '';
        $nav_grocery_run = 'active';
        $nav_metrics = '';
        
        $grocery_run = \LMG\GroceryRun::find($id); 
        $user_info = \LMG\User::find($grocery_run['user_id']);    
        
        return view('GroceryRuns.edit')
            ->with('grocery_run', $grocery_run)
            ->with('user_info', $user_info)
            ->with('nav_gameboard', $nav_gameboard)
            ->with('nav_settings', $nav_settings)
            ->with('nav_grocery_run', $nav_grocery_run)
            ->with('nav_metrics', $nav_metrics);
    }

    public function postEdit(Request $request)
    {
        $nav_gameboard = '';
        $nav_settings = '';
        $nav_grocery_run = 'active';
        $nav_metrics = '';
        
        $grocery_run = \LMG\GroceryRun::find($request['grocery_run_id']);    
        $grocery_run->dt_grocery_run = $request->dt_grocery_run;
        $grocery_run->total_amt = $request->total_amt;
        $grocery_run->non_food_amt = $request->non_food_amt;
        $grocery_run->food_amt = $request->food_amt;
        $grocery_run->save();

        \Session::flash('flash_message','Your grocery run was updated.');
        return redirect('/grocery-runs/'.$grocery_run->user_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
