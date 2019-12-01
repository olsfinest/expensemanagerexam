<?php

namespace App\Http\Controllers;

use App\User;
use App\UserRole;

use Illuminate\Http\Request;

class UserRoleController extends Controller
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
        //

        $user_id = auth()->user()->id;

        $user = User::find($user_id);

        if($user->is_admin == 0) {

            return redirect('home')->with('error', 'Unauthorized Page');

        }

        return view('userrole.index' , ['user' => $user]);

    }

    public function storeUserRole(Request $req) {

      
        $data = new UserRole();
       
        $data->user_role = $req->user_role;
        
        $data->description = $req->description;

        $data->save();

		return $data;
    } 



    public function getUserRole(Request $req) {

        $userrole = UserRole::all();
        return $userrole;

    }


    public function deleteDeleteRole(Request $request) {

        $userrole = UserRole::find ( $request->id )->delete ();

     
    }



    public function editUserRole(Request $request , $id) {

      
        $userrole = UserRole::where ('id', $id)->first();


        $userrole->user_role = $request->get('val_1');
        
        $userrole->description = $request->get('val_2');

        $userrole->save();

        return $userrole;
     
	}


    
}
