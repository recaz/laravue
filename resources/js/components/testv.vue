<template>
<div id="app">
    <div class="card">
        <div class="card-body">
            <div class="row"> 

                <div class="form-group col-md-6">
                    <label for="email" class="form-control-label">Email</label> 
                    <div class="input-group input-group-merge ">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        </div> 
                        <input data-name="email" placeholder="Enter Email" name="email" type="text" id="email" class="form-control">
                    </div> <!---->
                </div> 
                <div class="form-group col-md-6">
                    <label for="tax_number" class="form-control-label">Tax Number</label> 
                    <div class="input-group input-group-merge ">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-percent"></i></span>
                        </div> 
                        <input data-name="tax_number" placeholder="Enter Tax Number" name="tax_number" type="text" value="P09834232V" id="tax_number" class="form-control">
                    </div> <!---->
                </div>
                <div class="form-group col-md-12">
                    <label for="address" class="form-control-label">Address</label> 
                    <textarea data-name="address" placeholder="Enter Address" 
                    rows="3" name="address" cols="50" id="address" 
                    class="form-control">
                    </textarea> <!---->
                </div>
                <div class="card-footer">
                    <div class="row save-buttons">
                        <div class="col-md-12">
                            <a href="#" class="btn btn-icon btn-outline-secondary header-button-top">
                                <span class="btn-inner--icon"><i class="fas fa-times"></i></span> 
                                <span class="btn-inner--text">Cancel</span></a> 
                                <button type="submit" data-loading-text="Loading..." 
                                class="btn btn-icon btn-success button-submit header-button-top"><!----> 
                                <span class="btn-inner--icon"><i class="fas fa-save"></i></span>
                                <span class="btn-inner--text">Save</span>
                                </button>
                        </div>
                    </div>
                </div> 
            </div>

            <div class="header-body">
                <div class="row py-4 align-items-center">
                    <div class="col-xs-12 col-sm-4 col-md-5 align-items-center">
                        <h2 class="d-inline-flex mb-0 long-texts">Payments</h2>
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-7">
                        <div class="text-right">
                
                            <span><a href="#" class="btn btn-success btn-sm header-button-top"><span class="fa fa-plus"></span> &nbsp;Add New</a></span>
                            <span><a href="#" class="btn btn-white btn-sm header-button-top"><span class="fa fa-upload"></span> &nbsp;Import</a></span>
                            <span><a href="#" class="btn btn-white btn-sm header-button-top"><span class="fa fa-download"></span> &nbsp;Export</a></span>

                            <span><a href="#"><span class="fa fa-rocket"></span> &nbsp;Payroll</a></span>
                            <span><a href="#" class="btn btn-white btn-sm header-button-bottom" target="_self">
                            <span class="fa fa-rocket"></span> &nbsp;Receipts</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>


<div class="card-header border-bottom-0">
    <form >
        <div class="align-items-center">
            <div class="el-select pl-20 mr-40">
               <div class="el-input el-input--suffix is-focus">
                   <input type="text" autocomplete="off" placeholder="Type to search.." 
                    class="el-input__inner">
                    <span class="el-input__suffix">
                        <span class="el-input__suffix-inner">
                            <i class="el-select__caret el-input__icon el-icon-"></i>
                        </span>
                    </span>
                </div>
            </div>
        </div> 
    </form>
</div>

<ul class="navbar-nav align-items-center ml-auto ml-md-0">
    <li class="nav-item dropdown">
        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
                <img src="https://app.akaunting.com/public/img/user.svg" class="user-img" alt="Admin">
                    <div class="media-body ml-2 d-none d-lg-block">
                        <span class="mb-0 text-sm font-weight-bold">Admin</span>
                    </div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome</h6>
            </div>
                 <a href="https://app.akaunting.com/auth/users/16871/edit" class="dropdown-item">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            <div class="dropdown-divider"></div>
                <a href="https://app.akaunting.com/auth/users" class="dropdown-item">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
                <a href="https://app.akaunting.com/auth/roles" class="dropdown-item">
                    <i class="fas fa-list"></i>
                    <span>Roles</span>
                </a>
            <div class="dropdown-divider"></div>
                <a href="https://app.akaunting.com/auth/logout" class="dropdown-item">
                    <i class="fas fa-power-off"></i>
                    <span>Logout</span>
                </a>
        </div>
    </li>
</ul>

        </div>
    </div>
</div>
</template>
                