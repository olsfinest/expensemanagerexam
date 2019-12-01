<?php

namespace App\Http\Controllers;


use App\User;
use App\Expense;

use Illuminate\Http\Request;

class MainController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

  
    public function index()
    {


        $user_id = auth()->user()->id;

        $user = User::find($user_id);

        

        $expense = Expense::where('id' , $user)->get();
       

        if($user->is_admin != 1) {

            return redirect('home')->with('error', 'Unauthorized Page');

        }

        return view('home' , ['user' => $user , 'expense' => $expense]);

    }
 
  
  
   

}
