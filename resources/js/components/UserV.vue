<template>
    <div class="container">
      <!-- //copy responsive table here -->
      <!-- test v-show -->
      
        <div class="row mt-5">
          <div class="col-12">
            
             <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">style="background-color: #D6EAF8;"<i class="fas fa-users green"></i> <span class="font-weight-bold"> Users Table</span></h3> -->
                <!-- <div>
                  <button class="btn btn-success float-right"  @click="newModal">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
                <div class="card-tools float-left" >
                      <div class="input-group input-group-sm mt-1">
                        <input type="text"  name="table_search" style="width: 200px; height: 30px;" class="form-control float-left" placeholder="Search">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default" style="background-color: #D6EAF8;"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                </div> -->
                <div class="d-flex justify-content-between">
                
                <div class="mt-2">
                  <h5>
                      <i class="fas fa-users green"></i><span class="font-weight-bold"> Users Table</span>
                  </h5>
                </div>
                <!-- <div class="card-tools" >
                      <div class="input-group input-group-sm mt-1">
                        <input type="text"  name="table_search" style="width: 250px; height: 30px;" class="form-control" placeholder="Search">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default" style="background-color: #D6EAF8;"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                </div> -->
                
                <div>
                  <button class="btn btn-success "  @click="newModal">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
                
                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap" >
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Type</th>
                      <th>Registered At</th>
                      <th>Modify</th>
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
                        <div class="d-flex align-items-center justify-content-around">
                          <div>
                            <router-link to="/profile">
                              <i class="nav-icon fas fa-eye orange"></i>
                            </router-link>
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
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true" >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #97db98;">
                 
                 <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New </h5>
                 <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User </h5>
                 
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>

          <form @submit.prevent="editmode ? updateUser() : createUser()">
            <div class="modal-body">

              <div class="card-body">
                    <div class="form-group row">
                        <label for="Name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10"><!-- <label for="password" class="col-md-4 col-form-label text-md-right">Username</label> -->
                          <input v-model="form.name" type="text" name="name"
                              placeholder="name"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                          <has-error :form="form" field="name"></has-error>
                        </div>
                    </div>

                     <div class="form-group row">
                        <label for="Email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input v-model="form.email" type="email" name="email"
                              placeholder="email address"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                          <has-error :form="form" field="email"></has-error>
                        </div>
                    </div>

                     <div class="form-group row">
                       <label for="Bio" class="col-sm-2 col-form-label">Bio</label>
                        <div class="col-sm-10">
                          <textarea v-model="form.bio" name="bio" id="bio"
                          placeholder="short bio for user (Optional)"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                          <has-error :form="form" field="bio"></has-error>
                        </div>
                    </div>

                    <div class="form-group row">
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
                    </div>

                    <div class="form-group row">
                      <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input v-model="form.password" type="password" name="password" id="password"
                          placeholder="password"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                          <has-error :form="form" field="password"></has-error>
                        </div>
                    </div>
                  <!-- /.card-body -->
              </div>       
            </div>
            <div class="card-footer">
                <button v-show ="editmode" type="submit" class="btn btn-success">Update</button>
                <button v-show ="!editmode" type="submit" class="btn btn-primary">Create</button>
                <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Close</button>
            </div>
          </form>
            
            </div>
        

        </div>
        </div>
      
        <!-- test v show -->
    </div>
</template>

<script>
    export default {
      data () {
          return {
            // Create a new form instance
            editmode: false,
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
                this.form.clear();
                $('#addNew').modal('show');
                this.form.fill(user);
        },

      newModal(){
                this.editmode = false;
                this.form.clear();
                this.form.reset();
                $('#addNew').modal('show');
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
            this.loadUsers();
             Fire.$on('AfterCreate',() => {
               this.loadUsers();
           });
        }

        
    }
</script>
