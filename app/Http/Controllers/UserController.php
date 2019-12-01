<?php

namespace App\Http\Controllers;

use App\User;
use App\UserRole;
use Hash;

use Illuminate\Http\Request;

class UserController extends Controller
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

        $userrole = UserRole::all();

        if($user->is_admin == 0) {

            return redirect('home')->with('error', 'Unauthorized Page');

        }

        return view('user.index' , ['user' => $user , 'userrole' => $userrole]);

    }


    public function storeUser(Request $req) {
 

        $data = new User();
        
        $data->name = $req->name;
            
        $data->email = $req->email;

        $role = (explode(":",$req->role));

        $data->is_admin = $role[0];

        $data->role_name = $role[1];

        $data->password = Hash::make("password123");

        $data->save();

        return $data;
    
    } 


    public function getUser(Request $req) {

        $user = User::all();

        return $user;

    }


    public function deleteUser(Request $request) {

        $user = User::find ( $request->id )->delete ();
  
    }



    public function editUser(Request $request , $id) {

      
        $user = User::where ('id', $id)->first();


        $user->name = $request->get('val_1');
        
        $user->email = $request->get('val_2');

        $role = (explode(":",$request->get('val_3')));

        $user->is_admin = $role[0];

        $user->role_name = $role[1];


        $user->save();

        return $user;
     
	}


}
