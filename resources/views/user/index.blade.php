@extends('layouts.adminapp')

@section('content')


<div class="container">

    <div class="card-header">User</div>

    <div class="">
        @if (session('status'))
            <div class="alert alert-success" role="alert">

                {{ session('status') }}
            </div>
        @endif

        <table class="table" id="table">
                <thead>
                    <tr>
                       
                        <th>Name</th>
                        <th>Email Address</th>
                        <th>Role</th>
                        <th>Created at</th>
                    </tr>
                </thead>
                <tr v-for="user in users">
        
                    <td  @click="showModal = true; setVal(user.id, user.name, user.email, user.is_admin + ' :' + user.role_name)">@{{user.name}}</td>
                    <td  @click="showModal = true; setVal(user.id, user.name, user.email, user.is_admin + ' :' + user.role_name)">@{{user.email}}</td>
                    <td  @click="showModal = true; setVal(user.id, user.name, user.email, user.is_admin + ' :' + user.role_name)">@{{user.role_name }}</td>
                    <td  @click="showModal = true; setVal(user.id, user.name, user.email, user.is_admin + ' :' + user.role_name)">@{{user.created_at}}</td>
                    <td>  
                  </td>
                   
                </tr>
        </table>
        
       
<button type="button" class="btn btn-info btn-md create_button" data-toggle="modal" data-target="#additems">Add User</button>

  <!-- Modal -->
<div id="additems" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        
     
      <div class="modal-body">
          <h3 slot="header">Add User</h3>
            <div class="form-group">

                <label for="display_name">Name:</label>

                <input type="text" class="form-control" id="display_name" name="display_name" v-model="newUser.name"  required   placeholder="John Smithon">

            </div>

            <div class="form-group">

                <label for="description ">Email:</label>

                <input type="email" class="form-control" id="display_name" name="display_name" v-model="newUser.email"  required   placeholder="test@email.com">

            </div>

            <div class="form-group">

                    <label for="description ">Role:</label>
    

                    <select class="form-control" v-model="newUser.role" required>

                            
                            <option value="">Select Category</option>

                            @foreach ($userrole as $userroles) 

                            <option value="{{$userroles->id}} : {{$userroles->user_role}}">{{$userroles->user_role}}</option>

                            @endforeach

                    </select>
    

             </div>

            <button class="btn btn-primary" @click.prevent="storeUser()" id="name" name="name">
            <span class="glyphicon glyphicon-plus"></span> ADD EXPENSE CATEGORY</button>
           

      </div>

      
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" ref="close">Close</button>
      </div>

    </div>  
    </div>

  </div>



  <modal v-if="showModal" @close="showModal=false">
 
        <h3 slot="header">Update User</h3>
  
        <div slot="body">
          
              <input type="hidden" disabled class="form-control" id="e_id" name="id" required  :value="this.e_id">
              
              Name: <input type="text" class="form-control" id="e_name" name="name"  required  :value="this.e_name">
              <br/>
              Description: <input type="text" class="form-control" id="e_age" name="age"  required  :value="this.e_age">
              <br/>
              Role: 
              <select class="form-control" id="e_profession" name="profession" >
  
                <option required  :value="this.e_profession">Select Category</option>

                  @foreach ($userrole as $userroles) 

                    <option value="{{$userroles->id}} : {{$userroles->user_role}}">{{$userroles->user_role}}</option>
  
                  @endforeach
  
              </select>
          </div>
  
          <div slot="footer">
  
            <button @click.prevent="deleteUser()" class="btn btn-info delete">Delete</button>
            
            <button class="btn btn-info update" @click="editUser()">
              Update
            </button>
  
            <button class="btn btn-default cancel" @click="showModal = false">
                Cancel
            </button>
          </div>
  
      </modal>
  
  
      <script type="text/x-template" id="modal-template">
        <transition name="modal">
          <div class="modal-mask">
            <div class="modal-wrapper">
                    <div class="modal-container">
    
                    <div class="modal-header">
                    <slot name="header">
                     default header
                    </slot>
                    </div>
              
                    <div class="modal-body">
                    <slot name="body">
                                  
                    </slot>
                    </div>
              
                    <div class="modal-footer">
                    <slot name="footer">
                                      
                    </slot>
                 </div>
                </div>
            </div>
          </div>
        </transition>
    </script>



</div>

@endsection