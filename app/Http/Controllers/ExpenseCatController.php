<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ExpenseCat;

class ExpenseCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $user_id = auth()->user()->id;

        $user = User::find($user_id);

        if($user->is_admin == 0) {

            return redirect('home')->with('error', 'Unauthorized Page');

        }

        return view('expensecat.index' , ['user' => $user]);


    }


    public function storeExpenseCat(Request $req) {
 

        $data = new ExpenseCat();
       
        $data->display_name = $req->display_name;
        
        $data->description = $req->description;


        $data->save();

		return $data;
    } 


    public function getExpenseCat(Request $req) {

        $expensecat = ExpenseCat::all();
        return $expensecat;

    }

    public function deleteExpenseCat (Request $request) {

        $expensecat = ExpenseCat::find ( $request->id )->delete ();

     
    }


    public function editExpenseCat(Request $request , $id) {

      
        $Expensecat = ExpenseCat::where ('id', $id)->first();


        $Expensecat->display_name = $request->get('val_1');
        
        $Expensecat->description = $request->get('val_2');


        $Expensecat->save();

        return $Expensecat;
     
	}

   
}
