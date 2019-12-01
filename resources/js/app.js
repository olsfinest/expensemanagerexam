/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('chart', require('./components/chart.vue').default);

Vue.component('modal', {
    template: '#modal-template'
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    
    el: '#app',

    data :  {

        showModal: false,

        newItem : { 'Name' : '', 'age' : '', 'profession' : '' },

        newExpense : { 'expense_category' : '' , 'amount' : '' ,'entry_date' : '' },

        newExpenseCat : { 'display_name' : '' ,  'description' : ''  },

        newUserRole : { 'user_role' : '' , 'description' : ''  },

        newUser : { 'name' : '' , 'email' : ''  , 'role' : '' },

        hasError: true,

        items: [] ,

        expenses: [] ,
        
        expensescat: [] ,

        userroles: [] ,

        users: [] ,

        e_name: '',

        e_age: '',

        e_id: '',

        e_profession: '',

    }, 

    mounted: function mounted() {

        this.getItems();

        this.getExpense();

        this.getExpenseCat();

        this.getUserRole();

        this.getUser();

    } ,

    methods : {

        // show items create items

        getItems: function getItems() {

            var _this = this;
      
            axios.get('/getItems').then(function (response) {

              _this.items = response.data;

            });
        },


        // end show items create items

        // set values on button edit

        setVal(val_id, val_name, val_age, val_profession) {


            this.e_id = val_id;
            this.e_name = val_name;
            this.e_age = val_age;
            this.e_profession = val_profession;
          
        },


        //

        // start create items

        createItem : function createItem() {

          

            var input = this.newItem;
            var _this = this;
           

            if (input['name'] == '' || input['age'] == '' || input['profession'] == '' ) {

                this.hasError = false;
              }
              
            else {

                this.hasError = true;

                
                
                axios.post('/storeItem', input).then(function (response) {

                    _this.newItem = { 'Name' : '', 'age' : '', 'profession' : '' }

                    _this.getItems();

                    alert("Added Items");

                
                });

            }


        } ,


         // End create items.


         // start delete items

        
         deleteItem : function deleteItem(item) {

            var _this = this;

        
            axios.post('/deleteItem/' + item.id).then(function (response) {
           
                _this.getItems();

               alert('Item Deleted');

            });


         } ,

        // End delete items.


        // start edit items

         editItem : function editItem() {

            var _this = this;


            var i_val = document.getElementById('e_id');
            var n_val = document.getElementById('e_name');
            var a_val = document.getElementById('e_age');
            var p_val = document.getElementById('e_profession');



            axios.post('/editItem/' + i_val.value , { val_1: n_val.value , val_2: a_val.value , val_3: p_val.value }).then(function (response) {
         
                _this.getItems(); 
                
                _this.showModal = false;

            });

            
        

            // after creating go to route

         } ,

        // end edit items


         // start create items

         createExpense : function createExpense() {

            var input = this.newExpense;
            var _this = this;

            if (input['expense_category'] == '' || input['amount'] == '' || input['entry_date'] == '' ) {

                this.hasError = false;

            }

         
 
         
            axios.post('/storeExpense', input).then(function (response) {
                

                _this.newExpense = { 'expense_category' : '', 'amount' : '', 'entry_date' : '' }

                _this.getExpense();

                alert("Added Expense");

            
            });
            
    

        } ,


         // show items create items

         getExpense: function getExpense() {

            var _this = this;
      
            axios.get('/getExpense').then(function (response) {

               _this.expenses = response.data;

              

            });
        },


        deleteExpense : function deleteExpense() {

            var _this = this;

            var id = document.getElementById('e_id');

        

            if(confirm("Do you really want to delete?")){

                axios.post('/deleteExpense/' + id.value).then(function (response) {
            
                _this.getExpenseCat(); 

                _this.showModal = false;

                });
           }


         } ,



         editExpense : function editExpense() {

            var _this = this;

            var id = document.getElementById('e_id');
            var expense_category = document.getElementById('e_name');
            var amount = document.getElementById('e_age');
            var entry_date = document.getElementById('e_profession');

            axios.post('/editExpense/' + id.value , { val_1: expense_category.value , val_2: amount.value , val_3: entry_date.value }).then(function (response) {
         
                _this.getExpenseCat(); 
                
                _this.showModal = false;

                alert("Update all fields");

            });
       

         } ,



         createExpenseCat : function createExpenseCat() {
           
            var input = this.newExpenseCat;
            var _this = this;

         
            if (input['display_name'] == '' || input['description'] == '') {

                alert("Please Add All Fields");

                
            } else {

    
           
         
            axios.post('/storeExpenseCat', input).then(function (response) {
                

                _this.newExpenseCat = { 'display_name' : '', 'description' : ''}

            
                alert("Added Expense Category");
               
                _this.getExpenseCat();

            });
            
            }
    

        } ,


         // show items create items

        getExpenseCat: function getExpenseCat() {

            var _this = this;
      
            axios.get('/getExpenseCat').then(function (response) {

               _this.expensescat = response.data;

            });

        },

        deleteExpenseCat : function deleteExpenseCat() {

            var _this = this;

            var id = document.getElementById('e_id');

        
            if(confirm("Do you really want to delete?")){

                axios.post('/deleteExpenseCat/' + id.value).then(function (response) {

                    _this.getExpenseCat(); 
            
            
                _this.showModal = false;

                });
           }


         } ,


         editExpenseCat : function editExpenseCat() {

            var _this = this;

            var id = document.getElementById('e_id');
            var display_name = document.getElementById('e_name');
            var description = document.getElementById('e_age');
           

           

            axios.post('/editExpenseCat/' + id.value , { val_1: display_name.value , val_2: description.value }).then(function (response) {
         
               _this.getExpenseCat(); 
              
               _this.showModal = false;

            });

       

         } ,





         createUserRole : function createUserRole() {
           
            var input = this.newUserRole;
            var _this = this;

       

            if (input['name'] == '' || input['description'] == '') {

                alert("Please Add All Fields");

                
            } else {


            axios.post('/storeUserRole', input).then(function (response) {
                
                _this.getUserRole();
              
            });
            
            }
    

        } ,


        getUserRole: function getUserRole() {

            var _this = this;

            axios.get('/getUserRole').then(function (response) {

                _this.userroles = response.data;
 
             });


        } ,
    

        deleteDeleteRole : function deleteDeleteRole() {

            var _this = this;

            var id = document.getElementById('e_id');

        
            if(confirm("Do you really want to delete?")){

                axios.post('/deleteDeleteRole/' + id.value).then(function (response) {

                    _this.getUserRole(); 
            
            
                _this.showModal = false;

                });
           }


         } ,



         editUserRole : function editUserRole() {

            var _this = this;

            var id = document.getElementById('e_id');
            var display_name = document.getElementById('e_name');
            var description = document.getElementById('e_age');
           

            axios.post('/editUserRole/' + id.value , { val_1: display_name.value , val_2: description.value }).then(function (response) {
         
               _this.getUserRole(); 
              
               _this.showModal = false;

            });

       

         } ,



        storeUser : function storeUser() {
           
            var input = this.newUser;

            var _this = this;

       
            if (input['user_role'] == '' || input['email'] == '' || input['role'] == '') {


                alert("Please Add All Fields");

                
            } else {


            axios.post('/storeUser', input).then(function (response) {
                
             _this.getUser();
              
            });
            
            }
    

        } ,


        getUser: function getUser() {

            var _this = this;

            axios.get('/getUser').then(function (response) {

                _this.users = response.data;
 
             });

        } ,


        deleteUser : function deleteUser() {

            var _this = this;

            var id = document.getElementById('e_id');

          

         if(confirm("Do you really want to delete?")){

                axios.post('/deleteUser/' + id.value).then(function (response) {

                    _this.getUser(); 
            
                _this.showModal = false;

                });
         }


         } ,
    


         editUser : function editUser() {

            var _this = this;

            var id = document.getElementById('e_id');

            var name = document.getElementById('e_name');

            var email = document.getElementById('e_age');

            var role = document.getElementById('e_profession');

         
            axios.post('/editUser/' + id.value , { val_1: name.value , val_2: email.value , val_3: role.value }).then(function (response) {
         
               _this.getUser(); 
              
               _this.showModal = false;

            });


         } ,
     


    }
});
