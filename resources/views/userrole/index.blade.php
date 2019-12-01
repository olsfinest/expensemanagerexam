@extends('layouts.adminapp')

@section('content')


<div class="container">

    <div class="row">
        
        <div class="col-md-6">  
          <div class="card-header">User Role</div>
        </div>

        <div class="col-md-6">  
           <h5 class="breadcrumps">User Management > Role</h5>
        </div>

        </div>
  
    
  

    <div class="">
        @if (session('status'))
            <div class="alert alert-success" role="alert">

                {{ session('status') }}
            </div>
        @endif


        <table class="table" id="table">
                <thead>
                    <tr> 
                        <th>Display Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                    </tr>
                </thead>
    
                <tr v-for="userrole in userroles">
    
                    <td @click="showModal = true; setVal(userrole.id, userrole.user_role, userrole.description, userrole.created_at)">@{{userrole.user_role}}</td>
                    <td @click="showModal = true; setVal(userrole.id, userrole.user_role, userrole.description, userrole.created_at)">@{{userrole.description}}</td>
                    <td @click="showModal = true; setVal(userrole.id, userrole.user_role, userrole.description, userrole.created_at)">@{{userrole.created_at}}</td>
    
                </tr>
            </table>

  
        <button type="button" class="btn btn-info btn-md create_button" data-toggle="modal" data-target="#additems">User Role</button>


        <!-- Modal -->
      <div id="additems" class="modal fade" role="dialog">
        <div class="modal-dialog">
      
          <!-- Modal content-->
          <div class="modal-content">
              
           
            <div class="modal-body">
                <h3 slot="header">Add User Role</h3>

                  <div class="form-group">
      
                      <label for="display_name">Display Name:</label>
      
                      <input type="text" class="form-control" id="display_name" name="display_name" v-model="newUserRole.user_role"  required   placeholder="Enter Role">

                  </div>
      
                  <div class="form-group">
      
                      <label for="description ">Description:</label>
      
                      <textarea style="min-height:200px;" class="form-control" id="description" name="description" v-model="newUserRole.description"  required   placeholder="Enter Description">
                        
                      </textarea>
      
                  </div>
      
                 
                 
                  <p class="text-center alert alert-danger" v-bind:class="{ hidden: hasError }">Please Fill All Fields!</p>
      
      
      
                  <p style="display:none;" id="user_id">{{$user->id}}</p>
      
                  <button class="btn btn-primary" @click.prevent="createUserRole()" id="name" name="name">
                  <span class="glyphicon glyphicon-plus"></span> ADD USER ROLE CATEGORY</button>
                 
      
            </div>
      
            
            
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" ref="close">Close</button>
            </div>
      
          </div>  
          </div>
      
        </div>



        <modal v-if="showModal" @close="showModal=false">
 
                <h3 slot="header">Update User Role</h3>
          
                <div slot="body">
                  
                   
                      <input type="hidden" disabled class="form-control" id="e_id" name="id" required  :value="this.e_id">
                      
                      Display Name: <input type="text" class="form-control" id="e_name" name="name"  required  :value="this.e_name">
                      <br/>
                      Description: <input type="text" class="form-control" id="e_age" name="age"  required  :value="this.e_age">
                     
                    
                  </div>
          
                  <div slot="footer">
          
                    <button @click.prevent="deleteDeleteRole()" class="btn btn-info delete">Delete</button>
                    
                    <button class="btn btn-info update" @click="editUserRole()">
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