
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

<!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
  
  <title>LaraVue Starter</title>

  <link rel="stylesheet" href="/css/app.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" @keyup="searchit" style="width: 200px; height: 40px;" v-model="search"   type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" @click="searchit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
    <div class="navbar-nav ml-auto">
      <ul class="navbar-nav align-items-center ml-auto ml-md-0">
        <li class="nav-item dropdown">
          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="d-flex justify-content-end mr-3">
                  <i class="fas fa-user-circle fa-2x"></i>
              <!-- <img src="./img/profile.png" class="img-circle" alt="Admin"> -->
                      <div class="media-body ml-2 d-none d-lg-block">
                          <span class="mb-0 text-md font-weight-bold">{{ Auth::user()->name }}</span>
                      </div>
              </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome</h6>
              </div>
                    <router-link to="/profile" class="dropdown-item">
                      <i class="fas fa-user mr-3"></i>
                      <span>Profile</span>
                    </router-link>  
                    
              <div class="dropdown-divider"></div>
                    <router-link to="/users" class="dropdown-item">
                      <i class="fas fa-users mr-3"></i>
                      <span>Users</span>
                    </router-link> 

                    <router-link to="/" class="dropdown-item">
                      <i class="fas fa-list mr-3"></i>
                      <span>Roles</span>
                    </router-link> 

              <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        <i class="fas fa-power-off mr-3"></i>
                          {{ __('Logout') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                      </form>
                </div>
        </li>
      </ul>
    </div>
    <!-- Right navbar links -->
 </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light bg-light elevation-1">
    <!-- Brand Logo -->
    <a href="#" class="brand-link navbar-success">
      <img src="./img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-bold">LaraVue</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./img/profile.png" class="img-circle elevation-2 mr-2" alt="User Image">
        </div>
        <div class="mt-2 text-capitalize">
          <a href="#">
         
          {{ Auth::user()->name }} - {{ Auth::user()->type}}
         
          </a>
          <!-- <p>
          {{ Auth::user()->type }}
          </p> -->
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2 ">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-th "></i>
              <p>
                Dashboard
              </p>
            </router-link>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-cog "></i>
              <p>
                Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ml-3">
              <li class="nav-item">
                <router-link to="/users" class="nav-link">
                  <!-- <i class=" fas fa-dot-circle fa-xs nav icon ml-3"></i> -->
                  <p class="ml-3">
                    Users
                  </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/" class="nav-link">
                  <!-- <i class=" fas fa-dot-circle fa-xs nav icon ml-3"></i> -->
                  <p class="ml-3">
                    Customers
                  </p>
                </router-link>
              </li>
            </ul>
          </li>
          @can('isAdmin')
          <li class="nav-item">
            <router-link to="/profile" class="nav-link">
              <i class="nav-icon fas fa-user "></i>
              <p>
                Profile
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/bio" class="nav-link">
              <i class="nav-icon fas fa-tag "></i>
              <p>
                Bio
              </p>
            </router-link>
          </li>
          @endcan
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-power-off "></i>
                <p>
                  {{ __('Logout') }}
                </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
       
        <router-view></router-view>

        <vue-progress-bar></vue-progress-bar>

        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Lets Code
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 <a href="#">LaraVue</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script src="/js/app.js"></script>

</body>
</html>
