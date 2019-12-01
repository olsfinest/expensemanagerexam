@extends('layouts.adminapp')

@section('content')


<div class="container">

    <div class="card-header">Expenses</div>



    <div class="">
        @if (session('status'))
            <div class="alert alert-success" role="alert">

                {{ session('status') }}
            </div>
        @endif


    <table class="table" id="table">
        <thead>
            <tr>
               
                <th>Expense Category</th>
                <th>Amount</th>
                <th>Entry Date</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tr v-for="expense in expenses">

            <td @click="showModal = true; setVal(expense.id, expense.expense_category, expense.amount, expense.entry_date)">@{{expense.expense_category}}</td>
            <td @click="showModal = true; setVal(expense.id, expense.expense_category, expense.amount, expense.entry_date)">$@{{expense.amount}}</td>
            <td @click="showModal = true; setVal(expense.id, expense.expense_category, expense.amount, expense.entry_date)">@{{expense.entry_date}}</td>
            <td @click="showModal = true; setVal(expense.id, expense.expense_category, expense.amount, expense.entry_date)">@{{expense.created_at}}</td>
            <td>  
          </td>
           
        </tr>
    </table>


  
  <button type="button" class="btn btn-info btn-md create_button" data-toggle="modal" data-target="#additems">Add Expense</button>


  <!-- Modal -->
<div id="additems" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

   
      <div class="modal-body">
          <h3 slot="header">Add Expense</h3>
            <div class="form-group">
                    <label for="expense_category">Expense:</label>
  
                    <select class="form-control" v-model="newExpense.expense_category">
                        <option value="">Select Category</option>
                        @foreach ($expensecat as $expensecats) 
                         <option value="{{$expensecats->display_name}}">{{$expensecats->display_name}}</option>
                        @endforeach
                    </select>

            </div>

            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" class="form-control" id="amount" name="amount" v-model="newExpense.amount"  required   placeholder="Enter amount">
            </div>

            <div class="form-group">
                <label for="entry_date">Entry Date:</label>
                <input type="date" class="form-control" id="entry_date" name="entry_date" v-model="newExpense.entry_date"  required   placeholder="Enter Entry Date">
            </div>

           
            <p class="text-center alert alert-danger" v-bind:class="{ hidden: hasError }">Please Fill All Fields!</p>



            <p style="display:none;" id="user_id">{{$user->id}}</p>

            <button class="btn btn-primary" @click.prevent="createExpense()" id="name" name="name">
            <span class="glyphicon glyphicon-plus"></span> ADD EXPENSE</button>
           

      </div>

      
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" ref="close">Close</button>
      </div>

    </div>  
    </div>

  </div>



  <modal v-if="showModal" @close="showModal=false">
 
      <h3 slot="header">Update Expense</h3>

      <div slot="body">
        
         
          <input type="hidden" disabled class="form-control" id="e_id" name="id" required  :value="this.e_id">
            
            Expense Category: 
            <select class="form-control" id="e_name" name="name" >

                <option required  :value="this.e_name">Select Category</option>

                @foreach ($expensecat as $expensecats) 

                 <option value="{{$expensecats->display_name}}">{{$expensecats->display_name}}</option>

                @endforeach

            </select>
            <br/>
            Amount: <input type="number" class="form-control" id="e_age" name="age"  required  :value="this.e_age">
            <br/>
            Entry Date: <input type="text" class="form-control" id="e_profession" name="profession"  required  :value="this.e_profession">
            
          
        </div>

        <div slot="footer">

          <button @click.prevent="deleteExpense()" class="btn btn-info delete">Delete</button>
          
          <button class="btn btn-info update" @click="editExpense()">
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