@extends('layouts.adminapp')

@section('content')



<div class="container">
    <div class="row">
        
      
      <div class="col-md-12">

          <div class="row">
        
          <div class="col-md-6">  
            <div class="card-header">My Expense</div>
          </div>

          <div class="col-md-6">  
             <h5 class="breadcrumps">Dashboard</h5>
          </div>

          </div>
         
          

        <table class="expense-total" style="width: 100%;  border-bottom: 1px solid black;  margin-bottom: 50px;">
          <tr>
            <th><h4><strong>Expense Categories</strong></h4></th>
            <th><h4 style="text-align:right;"><strong>Total</strong></h4></th>
          </tr>
        
          
        @foreach ($expenses as $expense)

          <tr>
            <td><p style="text-align:left;"><i>{{$expense->expense_category}}</i></p></td>
            <td><p style="text-align:right;">${{$expense->SUMAMOUNT}}</p></td>
          </tr>

        @endforeach

        </table>

      </div>

      <?php
      
      $count = count($expenses);
  
      ?> 

      <div class="col-md-12">
          <chart width="1000" height="600"
          id="chart2"
          type="pie"
          title="# of previous Votes"

          :labels='[

            <?php
      
            for($i = 0; $i < $count; $i++) {
      
              echo '"';
              echo $expenses[$i]->expense_category;
              echo '",';
              
            }
            
            ?>
          
          ]'
          
          :data='[
            
            <?php
      
            for($i = 0; $i < $count; $i++) {
      
              echo '"';
              echo $expenses[$i]->SUMAMOUNT;
              echo '",';
            
      
            }
            
            ?>
          
          ]'
          
          :background-color="'#556080'"
          :border-color="'#000'"
          border-width="2"
          fill="false"></chart>
      <div>

  </div>  
</div>
@endsection