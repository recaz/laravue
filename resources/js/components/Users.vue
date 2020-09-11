<template>
   <div> 
      <!-- //copy responsive table here -->
      <!-- test v-show -->
      <div v-show="!edit">
        <div class="container-fluid content-layout mt--6">
        <!-- <div class="row mt-5"> -->
         
          <div class="header-body">
                <div class="row py-4 align-items-center">
                    <div class="col-xs-12 col-sm-4 col-md-5 align-items-center">
                        <h4 class="d-inline-flex mb-0 long-texts">User Table</h4>
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-7">
                        <div class="text-right">
                
                            <span><a href="#" class="btn btn-success btn-sm header-button-top"  @click="newModal"><span class="fa fa-user-plus"></span> &nbsp;Add New</a></span>
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
          
          <!-- search -->
        <div class="card">
          <div class="card-header border-bottom-0 bg-white py-3">
              <form >
                  <div class="align-items-center ">
                    <input type="text" autocomplete="off" @keyup="searchit" v-model="searchuser"  placeholder="Type Name/Email to search..." 
                      class="form-control font-italic input-lg">
                  </div> 
              </form>
          </div>
          
          <div class="card-body table-responsive p-0">
            <table class="table table-flush table-hover text-nowrap" >
              
              <thead class="thead-light">
                
                <tr>
                  <th>ID</th>
                  <th>NAME</th>
                  <th>EMAIL</th>
                  <th>TYPE</th>
                  <th>REGISTRATION DATE</th>
                  <th class="text-center">ACTIONS</th>
                </tr>
              </thead>
              
              <tbody>
                <tr v-for="user in users.data" :key="user.id">

                  <td>{{user.id}}</td>
                  <!-- <td><router-link to="/profile">{{user.name}}</router-link></td> -->
                  <!-- <td><router-link :to="{ name: 'bio', params: {id:user.id} }">{{user.name}}</router-link></td> -->
                  <td><a :href="`/bio/${user.id}`">{{user.name}}</a></td>
                  <!-- <td><a :href="`/bio`">{{user.name}}</a></td> -->
                  <td>{{user.email}}</td>
                  <td>{{user.type | upText}}</td>
                  <td>{{user.created_at | myDate}}</td>
                  <td>
                    <!-- <div class="dropdown">
                        <a href="#" role="button" data-toggle="dropdown" 
                        aria-haspopup="true" aria-expanded="false" 
                        class="btn btn-neutral btn-sm text-light items-align-center">
                        <i class="fa fa-ellipsis-h text-muted"></i>
                        </a> 
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" 
                          x-placement="bottom-end" 
                          style="position: absolute; transform: translate3d(-164px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                          <a href="#" class="dropdown-item" @click="viewUser(user)" >View</a> 
                          <a href="#" class="dropdown-item" @click="editModal(user)" >Edit</a> 
                          <div class="dropdown-divider"></div> 
                          
                          <button type="button" title="Delete" @click="deleteUser(user.id)" class="dropdown-item action-delete">
                              Delete
                          </button>
                      </div>
                    </div> -->
                    <div class="d-flex align-items-center justify-content-around">
                      <div>
                        <a href="#" @click="viewUser(user)">
                              <i class="fa fa-binoculars green"></i>
                        </a>
                        <!-- <router-link to="/profile">
                          <i class="nav-icon fas fa-eye orange"></i>
                        </router-link> -->
                      </div>
                      <div>
                        <a href="#" @click="editModal(user)">
                              <i class="fa fa-edit blue"></i>
                        </a>
                      </div>
                      <div>
                        <a href="#" @click="deleteUser(user.id)">
                            <i class="fa fa-trash red" ></i>
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
                
              </tbody>
            </table>
          </div>
              <!-- /.card-body -->
          <div class="card-footer">
            <pagination :data="users" @pagination-change-page="getResults"></pagination>
          </div>
        </div>
          
        </div>
      </div>
        <!-- test v show -->

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true" >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-success">
                 
                 <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New </h5>
                 <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User </h5>
                 
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>

          <form @submit.prevent="editmode ? updateUser() : createUser()">
            <div class="modal-body">

              <div class="card-body py-0">
                    <!-- <div class="form-group row">
                        <label for="Name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input v-model="form.name" type="text" name="name"
                              placeholder="name"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                          <has-error :form="form" field="name"></has-error>
                        </div>
                    </div> -->

                    
                                  <div class="form-group">
                                      <label for="inputName" class="form-control-label">Name</label>
                                      <div class="input-group input-group-merge ">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div> 
                                          <input type="" autocomplete="off" v-model="form.name" class="form-control" id="inputName" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
                                      <has-error :form="form" field="name"></has-error>
                                      </div>
                                  </div>
                   
                     <!-- <div class="form-group row">
                        <label for="Email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input v-model="form.email" type="email" name="email"
                              placeholder="email address"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                          <has-error :form="form" field="email"></has-error>
                        </div>
                    </div> -->

                    <div class="form-group">
                          <label for="inputEmail" class="form-control-label">Email</label>
                          <div class="input-group input-group-merge ">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                          <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email"  :class="{ 'is-invalid': form.errors.has('email') }">
                          <has-error :form="form" field="email"></has-error>
                          </div>
                    </div>

                     <!-- <div class="form-group row">
                       <label for="Bio" class="col-sm-2 col-form-label">Bio</label>
                        <div class="col-sm-10">
                          <textarea v-model="form.bio" name="bio" id="bio"
                          placeholder="short bio for user (Optional)"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                          <has-error :form="form" field="bio"></has-error>
                        </div>
                    </div> -->
                    
                        <div class="form-group">
                            <label for="inputExperience" class="form-control-label">Experience</label>
                            <textarea  v-model="form.bio" class="form-control"   id="inputExperience" placeholder="Experience" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                            <has-error :form="form" field="bio"></has-error>
                        </div>
                      


                    <!-- <div class="form-group row">
                      <label for="Role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                          <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                              <option value="">select user role</option>
                              <option value="admin">Admin</option>
                              <option value="user">Standard User</option>
                              <option value="author">Author</option>
                          </select>
                          <has-error :form="form" field="type"></has-error>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label for="Role" class="form-control-label">Role</label>
                          <div class="input-group input-group-merge ">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                            </div>
                            <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                <option value="">select user role</option>
                                <option value="admin">Admin</option>
                                <option value="user">Standard User</option>
                                <option value="author">Author</option>
                            </select>
                            <has-error :form="form" field="type"></has-error>
                      </div>
                    </div>

                    <!-- <div class="form-group row">
                      <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input v-model="form.password" type="password" name="password" id="password"
                          placeholder="password"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                          <has-error :form="form" field="password"></has-error>
                        </div>
                    </div> -->
                      <div class="form-group">
                          <label for="password" class="form-control-label">Password</label>
                          <div class="input-group input-group-merge ">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                          <input type="password"
                              v-model="form.password"
                              class="form-control"
                              id="password"
                              placeholder="Password"
                              :class="{ 'is-invalid': form.errors.has('password') }"
                          >
                          <has-error :form="form" field="password"></has-error>
                          </div>
                      </div>


                  <!-- /.card-body -->
              </div>       
            </div>
            <div class="card-footer">
              <div class="d-flex justify-content-end">
                 <a href="#" class="btn btn-icon btn-outline-secondary header-button-top mr-2" data-dismiss="modal">
                    <span class="btn-inner--icon"><i class="fas fa-times"></i></span> 
                    <span class="btn-inner--text">Cancel</span>
                </a>
                <button v-show ="editmode" type="submit" class="btn btn-success">
                  <span class="btn-inner--icon"><i class="fas fa-save"></i></span>
                  <span class="btn-inner--text">Update</span>
                </button>
                <button v-show ="!editmode" type="submit" class="btn btn-success">
                  <span class="btn-inner--icon"><i class="fas fa-save"></i></span>
                  <span class="btn-inner--text">Create</span>
                </button>
              </div>             
            </div>
          </form>
            
            </div>
        

        </div>
        </div>
        <!-- end modal -->

        <!-- view data -->
        <div v-show="edit">
          <!-- <div class="container-fluid content-layout">
                <div class="header-body">
                    <div class="row py-4 align-items-center">
                        <div class="col-xs-12 col-sm-4 col-md-5 align-items-center">
                            <h4 class="d-inline-flex mb-0 long-texts">Edit User</h4>
                        </div>
                    </div>
                </div>
          </div> -->
          <div class="container-fluid content-layout">
            <div class="header-body">
                  <div class="row py-4 align-items-center">
                      <div class="col-xs-12 col-sm-4 col-md-5 align-items-center">
                          <h4 class="d-inline-flex mb-0 long-texts">Edit User</h4>
                      </div>

                      <div class="col-xs-12 col-sm-8 col-md-7">
                          <div class="text-right">
                  
                              <span><a href="#" class="btn btn-success btn-sm header-button-top"  @click="newModal"><span class="fa fa-user-plus"></span> &nbsp;Add New</a></span>
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
          </div>


          <div class="container-fluid content-layout mt--6">
            <!-- <div class="col-12"> -->
            <div class="card">
              <div class="card-body">
                <!-- <div class="row"> -->
                      <form >
                                <div class="row mt-2">
                                  <div class="form-group col-md-6">
                                      <label for="inputName" class="form-control-label">Name</label>
                                      <div class="input-group input-group-merge ">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div> 
                                          <input type="" v-model="form.name" class="form-control" id="inputName" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
                                      <has-error :form="form" field="name"></has-error>
                                      </div>
                                  </div>
                                  <div class="form-group col-md-6">
                                      <label for="inputEmail" class="form-control-label">Email</label>
                                      <div class="input-group input-group-merge ">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                      <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email"  :class="{ 'is-invalid': form.errors.has('email') }">
                                      <has-error :form="form" field="email"></has-error>
                                      </div>
                                  </div>
                                </div>
                                <div class="row mt-2">
                                  <div class="form-group col-md-6">
                                    <label for="Role" class="form-control-label">Role</label>
                                      <div class="input-group input-group-merge ">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                        </div>
                                        <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                            <option value="">select user role</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">Standard User</option>
                                            <option value="author">Author</option>
                                        </select>
                                        <has-error :form="form" field="type"></has-error>
                                      </div>
                                  </div>
                                                                   
                                  <div class="form-group col-md-6">
                                      <label for="password" class="form-control-label">Password (leave empty if not changing)</label>
                                      <div class="input-group input-group-merge ">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                      <input type="password"
                                          v-model="form.password"
                                          class="form-control"
                                          id="password"
                                          placeholder="Password"
                                          :class="{ 'is-invalid': form.errors.has('password') }"
                                      >
                                      <has-error :form="form" field="password"></has-error>
                                      </div>
                                  </div>
                                </div>
                                <div class="row mt-2">
                                  <div class="form-group col-md-6">
                                      <label for="photo" class="form-control-label">Profile Photo</label>
                                      <div class="input-group input-group-merge ">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-portrait"></i></span>
                                        </div >
                                          <input type="file" @change="updateProfile" name="photo" class="form-input ml-1">
                                      </div>
                                  </div>
                                </div>
                                <div class="row mt-2">
                                  <div class="form-group col-md-12">
                                      <label for="inputExperience" class="form-control-label">Experience</label>
                                      <textarea  v-model="form.bio" class="form-control"   id="inputExperience" placeholder="Experience" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                      <has-error :form="form" field="bio"></has-error>
                                  </div>
                                </div>  

                                  <!-- <div class="form-group col-md-6"> -->
                                      <!-- <div class="col-sm-offset-2 col-sm-10"> -->
                                      <!-- <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Update</button> -->
                                      <!-- <button class="btn btn-warning" v-on:click="editmode = !editmode">Edit</button> -->
                                      <!-- </div> -->
                                  <!-- </div> -->
                                  <div class="card-footer">
                                    <div class="row save-buttons">
                                      <div class="col-md-12">
                                        <div class="d-flex justify-content-end">
                                          <a href="#" class="btn btn-icon btn-outline-secondary header-button-top" v-on:click="edit = !edit">
                                              <span class="btn-inner--icon"><i class="fas fa-times"></i></span> 
                                              <span class="btn-inner--text">Cancel</span></a>
                                              <button type="submit" data-loading-text="Loading..." 
                                                class="btn btn-icon btn-success button-submit header-button-top ml-2"><!----> 
                                                <span class="btn-inner--icon"><i class="fas fa-save"></i></span>
                                                <span class="btn-inner--text">Save</span>
                                              </button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                      </form>
                <!-- </div> -->
              </div>
            </div>
            <!-- </div> -->
          </div>
        </div>
        <!-- end view data -->
    </div>
    
    
</template>

<script>
    export default {
      data () {
          return {
            // Create a new form instance
            searchuser: '',
            editmode: false,
            edit: false,
            users:{},

                form: new Form({
                    id:'',
                    name : '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                })
              }
      },

      methods:{
       
      searchit: _.debounce(() => {
          Fire.$emit('searchingUser');
      },1000) ,
      
      // Our method to GET results from a Laravel endpoint
      getResults(page = 1) {
                axios.get('api/user?page=' + page)
                  .then(response => {
                    this.users = response.data;
                  });
            }, 

      loadUsers(){
                
                    axios.get("api/user").then(({ data }) => (this.users = data));
                    
            },
      
      updateUser(){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/user/'+this.form.id)
                .then(() => {
                    // success
                    $('#addNew').modal('hide');
                     swal.fire(
                        'Updated!',
                        'Information has been updated.',
                        'success'
                        )
                        this.$Progress.finish();
                         Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },

      editModal(user){  
                this.editmode = true;
                this.edit = false;
                this.form.clear();
                $('#addNew').modal('show');
                this.form.fill(user);
        },
        
        viewUser(user){  
                this.edit = true;
                this.form.clear();
                // $('#addNew').modal('show');
                this.form.fill(user);
        },

      newModal(){
                this.editmode = false;
                this.form.clear();
                this.form.reset();
                $('#addNew').modal('show');
        },
      updateProfile(){
               
        },

      deleteUser(id){
                swal.fire({
                      title: 'Are you sure?',
                      text: "You won't be able to revert this!",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        // Send request to the server
                         if (result.value) {
                                this.form.delete('api/user/'+id).then(()=>{
                                        swal.fire(
                                        'Deleted!',
                                        'User has been Deleted.',
                                        'success'
                                        )
                                    Fire.$emit('AfterCreate');
                                }).catch(()=> {
                                    swal.fire("Failed!", "Not Authorized.", "warning");
                                });
                         }
                    })
            },

      createUser(){
                this.$Progress.start();
                this.form.post('api/user')
                .then(()=>{
                    
                    Fire.$emit('AfterCreate');
                   $('#addNew').modal('hide');
                    
                    toast.fire({
                        icon: 'success',
                        title: 'User Created Successfully'
                        })
                    this.$Progress.finish();
                })
                .catch(()=>{
                })
            }
        },
      
      created() {
            
            Fire.$on('searching',() => {
                let query = this.$parent.search;
                axios.get('api/findUser?q=' + query)
                .then((data) => {
                    this.users = data.data
                })
                .catch(() => {
                })

                
            })
            
            Fire.$on('searchingUser',() => {
                
                let query1 = this.searchuser;
                axios.get('api/findUser1?q=' + query1)
                .then((data) => {
                    this.users = data.data
                })
                .catch(() => {
                })
            })

            this.loadUsers();
             Fire.$on('AfterCreate',() => {
               this.loadUsers();
              
           });
        }

        
    }
</script>
