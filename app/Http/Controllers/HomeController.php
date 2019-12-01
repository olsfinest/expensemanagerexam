<?php

namespace App\Http\Controllers;

use App\User;
use App\Expense;
use DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      //   return view('home');

       $user_id = auth()->user()->id;

       $user = User::find($user_id);

       
       
        $expense = DB::select('SELECT expense_category, SUM(amount) as SUMAMOUNT FROM expenses WHERE user_id = '.$user->id.' GROUP BY expense_category');
       

        if($user->is_admin != 1) {

            return redirect('home')->with('error', 'Unauthorized Page');

        }

        return view('home' , ['user' => $user , 'expenses' => $expense]);

    }
}
