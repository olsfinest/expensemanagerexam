<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

   
    <!-- Styles -->
    <style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: auto;
        margin: 0;
    }
    .full-height {
        min-height: 100vh;
    }
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }
    .position-ref {
        position: relative;
    }
    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }
    .content {
    /*  text-align: center; */
    }
    .title {
        font-size: 84px;
    }
    .m-b-md {
        margin-bottom: 30px;
    }
    .modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    display: table;
    transition: opacity .3s ease;
    }
    .modal-wrapper {
    display: table-cell;
    vertical-align: middle;
    }
    .modal-container {
    max-width: 500px;
    margin: 0px auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
    transition: all .3s ease;
    font-family: Helvetica, Arial, sans-serif;
    }
    .modal-header h3 {
    margin-top: 0;
    color: #42b983;
    }
    .modal-body {
    margin: 20px 0;
    }
    </style>
</head>
<body>

    

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light  shadow-sm">
            <div class="container">
               <p class="header-text-top">Welcome To Expense Manager</p>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">    
            <div class="row">
                <main class="flex-row col-md-3 sidebar pull-right">

                    <div class="profile">

                    <img src="/img/user.png" />
                    <br/><br/>

                    <p><strong>{{ Auth::user()->name }}</strong>
                   
                    ( <i>{{Auth::user()->role_name}}</i> )</p> </p>
                   
                    <br/>
                    <h4><a href="{{ url('home') }}">Dashboard</a></h4>
                    
                 <br/>

                    <h4>User Management</h4>

                    <ul class="sidebarlist">
                        <li><a href="{{ url('userrole') }}"><img src="/img/scrum.png" />Roles</a></li>
                        <li><a href="{{ url('user') }}"><img src="/img/user-mini.png" />User</a></li>
                    </ul>

                    <br/>

                    <h4>Expense Management</h4>

                    <ul class="sidebarlist">

                        <li><a href="{{ url('expensecat') }}"><img src="/img/list.png" />Expense Categories</a></li>
                        <li><a href="{{ url('expense') }}"><img src="/img/expenses.png" />Expense</a></li>

                    </ul>
                
                    </div>
                </main>

                <main class="flex-row-reverse col-md-9">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>


    
</body>
</html>
