<?php

namespace App\Http\Controllers;
use App\User;
use App\Expense;
use App\ExpenseCat;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $user_id = auth()->user()->id;

        $user = User::find($user_id);

        $expense = Expense::orderBy('created_at' , 'desc')->paginate(10);

        $expensecat = ExpenseCat::all();
       

        return view('expense.index' , ['user' => $user , 'expense' => $expense , 'expensecat' => $expensecat]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function storeExpense(Request $req) {

        $user_id = auth()->user()->id;

        $user = User::find($user_id);

        $data = new Expense();
       
        $data->entry_date = $req->entry_date;
        
        $data->amount = $req->amount;

        $data->expense_category = $req->expense_category;

        $data->user_id = $user->id;


        $data->save();

		return $data;
    } 


    public function getExpense(Request $req) {

        $expense = Expense::all();
        return $expense;

    }


    public function deleteExpense(Request $request) {

        $expense = Expense::find ( $request->id )->delete ();

     
    }


    public function editExpense(Request $request , $id) {

      
        $Expense = Expense::where ('id', $id)->first();

        
        $user_id = auth()->user()->id;

        $user = User::find($user_id);



        $Expense->expense_category = $request->get('val_1');
        
        $Expense->amount = $request->get('val_2');

        $Expense->entry_date =  $request->get('val_3');

        $Expense->user_id = $user->id;

        $Expense->save();

        return $Expense;
     
	}

   
}
