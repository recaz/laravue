<template>
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-4 mt-5">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white" style="background-image:url('./img/laptop1.jpg')">
                        <h3 class="widget-user-username text-right">{{this.form.name}}</h3>
                        <h5 class="widget-user-desc text-right">{{this.form.type}}</h5>
                    </div>
                    <div class="widget-user-image">
                        <!-- <img class="profile-user-img img-fluid img-circle" :src="getProfilePhoto()" alt="User profile picture"> -->
                        <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
                    </div>
                </div>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

         </div>
          <!-- /.col -->
          <div class="col-md-8 mt-5">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
                    <!-- Post -->
                <div class="card-body">
                    <div class="form-group row">
                        <label for="Name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10"><!-- <label for="password" class="col-md-4 col-form-label text-md-right">Username</label> -->
                          <input v-model="form.name" type="text" name="name"
                              placeholder="name"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"
                              :disabled='isDisabled'>
                          <has-error :form="form" field="name"></has-error>
                        </div>
                    </div>

                     <div class="form-group row">
                        <label for="Email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input v-model="form.email" type="email" name="email"
                              placeholder="email address"
                              class="form-control" :class="{ 'is-invalid': form.errors.has('email') }"
                              :disabled='isDisabled'>
                          <has-error :form="form" field="email"></has-error>
                        </div>
                    </div>

                     <div class="form-group row">
                       <label for="Bio" class="col-sm-2 col-form-label">Bio</label>
                        <div class="col-sm-10">
                          <textarea v-model="form.bio" name="bio" id="bio"
                          placeholder="short bio for user (Optional)"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"
                          :disabled='isDisabled'></textarea>
                          <has-error :form="form" field="bio"></has-error>
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="Role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                          <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }"
                          :disabled='isDisabled'>
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
                          class="form-control" :class="{ 'is-invalid': form.errors.has('password') }"
                          :disabled='isDisabled'>
                          <has-error :form="form" field="password"></has-error>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <label for='edit'>
                                    <input id='edit' type='checkbox' v-model='edit' /> Edit
                                    </label>
                                    
                                    </div>
                    </div> -->
                    <div class="card-footer">
                                    <!-- <div class="col-sm-offset-2 col-sm-10"> -->
                                        <button class="btn btn-warning" v-on:click="edit = !edit">Edit</button>
                                        <button id='edit' @click.prevent="updateInfo" type="submit" class="btn btn-success float-right" :disabled='isDisabled'>Update</button>
                                    <!-- </div> -->
                    </div>
                  <!-- /.card-body -->
                </div>      
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane active" id="settings">
                    <form class="form-horizontal">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                    <input type="" v-model="form.name" class="form-control" id="inputName" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
                                     <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                    <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email"  :class="{ 'is-invalid': form.errors.has('email') }">
                                     <has-error :form="form" field="email"></has-error>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                                    <div class="col-sm-10">
                                    <textarea  v-model="form.bio" class="form-control" id="inputExperience" placeholder="Experience" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                     <has-error :form="form" field="bio"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="photo" class="col-sm-2 control-label">Profile Photo</label>
                                    <div class="col-sm-10">
                                        <input type="file" @change="updateProfile" name="photo" class="form-input">
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 control-label">Password (leave empty if not changing)</label>

                                    <div class="col-sm-10">
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

                                <div class="form-group row">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
</template>

   <script>
    export default {
        data(){
    
           return {
                edit: false,

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
        mounted() {
            console.log('Component mounted.')
        },
      methods:{

            getProfilePhoto(){
                let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/"+ this.form.photo ;
                return photo;
            },
            
            updateInfo(){
               this.$Progress.start();
                if(this.form.password == ''){
                    this.form.password = undefined;
                }
                this.form.put('api/profile')
                .then(()=>{
                    
                    swal.fire(
                            'Updated',
                            'User Profile has been Updated!',
                            'success'
                    );
                    
                    Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                   
                })
                .catch(() => {
                    
                    this.$Progress.fail();
                    
                    // swal.fire({
                    //         icon: 'error',
                    //         title: 'Oops...',
                    //         text: 'Something went wrong!',
                    //         })
                    swal.fire(
                            'Oops...',
                            'Something went wrong! check error on form',
                            'error'
                    );
                   
                });
                
            },
            updateProfile(e){
                let file = e.target.files[0];
                let reader = new FileReader();
                let limit = 1024 * 1024 * 2;
                if(file['size'] > limit){
                    swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file',
                    })
                    return false;
                }
                reader.onloadend = (file) => {
                    this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
            },
            
        },
        
      computed: {
  	    isDisabled(){
    	return !this.edit;
            }
        },
        created() {
            axios.get("api/profile")
            // axios.get('api/profile/'+this.form.id)
            .then(({ data }) => (this.form.fill(data)));
        }
    }
</script>
