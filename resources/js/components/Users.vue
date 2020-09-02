<template>
    <div class="container">
      <!-- //copy responsive table here -->
        <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color: #D6EAF8;">
                <h3 class="card-title"><i class="fas fa-users indigo"></i> <span class="font-weight-bold"> Users Table</span></h3>

                <div class="card-tools">
                  <button class="btn btn-success" data-toggle="modal" data-target="#AddNew">Add New <i class="fas fa-user-plus fa-fw"></i></button>
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
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.type}}</td>
                      <td>{{user.created_at}}</td>
                      <td>
                          <a href="#">
                              <i class="fa fa-edit blue"></i>
                          </a>
                         |
                          <a href="#">
                              <i class="fa fa-trash red"></i>
                          </a>
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
        <div class="modal fade" id="AddNew" tabindex="-1" aria-labelledby="addNewLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header" style="background-color: #D6EAF8;">
                <h5 class="modal-title" id="AddNew">Add New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

          <form @submit.prevent="createUser">
            <div class="modal-body">

              <div class="card-body">
                <div class="form-group row">
                        <label for="Name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10"><!-- <label for="password" class="col-md-4 col-form-label text-md-right">Username</label> -->
                        <input v-model="form.name" type="text" name="name"
                            placeholder="Name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                        </div>
                    </div>

                     <div class="form-group row">
                        <label for="Email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input v-model="form.email" type="email" name="email"
                              placeholder="Email Address"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                          <has-error :form="form" field="email"></has-error>
                        </div>
                    </div>

                     <div class="form-group row">
                       <label for="Bio" class="col-sm-2 col-form-label">Bio</label>
                        <div class="col-sm-10">
                          <textarea v-model="form.bio" name="bio" id="bio"
                          placeholder="Short bio for user (Optional)"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                          <has-error :form="form" field="bio"></has-error>
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="Role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                          <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                              <option value="">Select User Role</option>
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
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Close</button>
            </div>
          </form>
            
            </div>
        

        </div>
        </div>
    </div>
</template>

<script>
    export default {
      data () {
          return {
            // Create a new form instance
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

      createUser(){

                this.form.post('api/user')

            }

      },
        created() {
            this.loadUsers();
        }
    }
</script>
