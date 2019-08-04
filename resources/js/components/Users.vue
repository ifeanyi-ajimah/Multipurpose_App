<template>
    <div class="container">

        <div class="row mt-5" v-show="$gate.isAdmin()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Tables</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="openNewModal"> Add User <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>

                  <tr>
                    <th>ID</th>
                    <th>Name </th>
                    <th>Email</th>
                    <th>Type</th>
                    <th> Registered At </th>
                    <th>Modify</th>
                  </tr>

                  <tr v-for="user in users.data" :key="user.id" >
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td><span class="tag tag-success">{{ user.type | to-uppercase }}</span></td>
                    <td>{{ user.created_at | my-date }}</td>
                    <td>
                        <a href="#" @click="openEditModal(user)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                            /
                        <a href="#" @click="deleteUser(user.id)">
                           <i class="fa fa-trash red"></i>
                        </a>

                    </td>
                  </tr>

                </tbody></table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                    <pagination :data="users" @pagination-change-page="getResults">
                        <span slot="prev-nav">&lt; Previous</span>
	                    <span slot="next-nav">Next &gt;</span>
                    </pagination>
              </div>
              <!-- .card-footer -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div v-if="!$gate.isAdminOrAuthor()">
            <not-found></not-found>
        </div>

    <!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> {{ title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form @submit.prevent=" editmode ? updateUser() : createUser()" >

      <div class="modal-body">

    <div class="form-group">
      <input v-model="form.name" type="text" name="name" placeholder="Name"
        class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
      <has-error :form="form" field="name"></has-error>
    </div>

    <div class="form-group">
      <input v-model="form.email" type="email" name="email" placeholder="Email"
        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
      <has-error :form="form" field="email"></has-error>
    </div>

    <div class="form-group">
      <textarea v-model="form.bio"  name="bio"  id="bio" placeholder="Short Bio fro user (optional)"
        class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"> </textarea>
      <has-error :form="form" field="bio"></has-error>
    </div>

    <div class="form-group">
      <select name="type" v-model="form.type" id="type"  class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
          <option disabled value=""> Select User Role</option>
          <option value="admin"> Admin </option>
          <option value="user">Standard User</option>
          <option value="author"> Author</option>
      </select>
      <has-error :form="form" field="type"></has-error>
    </div>

    <div class="form-group">
      <input v-model="form.password" type="password" name="password" placeholder="Password"
        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
      <has-error :form="form" field="password"></has-error>
    </div>

    <div class="form-group">
      <input v-model="form.password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password"
        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
      <has-error :form="form" field="password"></has-error>
    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> {{ action }} </button>

<!--     alternatively we use v-show
        <button v-show="editmode" type="submit" class="btn btn-danger" data-dismiss="modal"> Update</button>
        <button v-show="!editmode" type="submit" class="btn btn-danger" data-dismiss="modal"> Create </button> -->
      </div>
      </form>

    </div>
  </div>
</div>

    </div>
</template>

<script>
import { setInterval } from 'timers';
//import { constants } from 'crypto';
//import { log } from 'util';
    export default {

        data(){
            return{
                action: '',
                title: '',
                editmode : false,
                users:{},
                geterrors:{},
                form: new Form({
                    id: '',
                    name: '',
                    email:'',
                    password:'',
                    type:'',
                    bio:'',
                    photo:'',
                    password_confirmation:'',
                })
            }
        },

        methods:{
            searchfxn(){
                let query = this.$parent.search;
                axios.get('api/findUser?q=' + query)
                .then((response) => {
                    this.users = response.data
                })
                .catch((error)=> {
                    console.log(error.response.data.error)
                })
            },

           getResults(page = 1) {
			axios.get('api/user?page=' + page)
				.then(response => {
					this.users = response.data;
				});
		},

            updateUser(id){
                    this.form.put(`api/user/${this.form.id}`, {
                     name:  this.form.name,
                     email:  this.form.email,
                     password:  this.form.password,
                     type:  this.form.type,
                     bio:  this.form.bio,
                     photo:  this.form.photo,
                     password_confirmation:  this.form.password_confirmation,
                    })

                    .then( (response) =>{
                        console.log(response.data);
                        // this.$Progress.finish();//complete progress bar.
                         $('#userModal').modal('hide');

                        toast.fire({
                        type: 'success',
                        title: 'Updated successfully'
                        });

                        Fire.$emit('ReloadGetUsers'); //emmit the ReloadGetUsers event

                    })
                    .catch( (error) => {
                        // this.$Progress.fail(); //if action fails
                        //  console.log(error.response.data.errors);
                        //  console.log(error.response.status);
                         //console.log(error.response.headers);
                         //read about asyn and await new in es6 and javascript
                    });
            },

            openEditModal(user){
            this.editmode = true;
            this.title = 'Edit User';
            this.action = 'Update';
            this.form.reset();
              $('#userModal').modal('show');
              this.form.fill(user);
          },

          openNewModal(){
            this.editmode = false;
            this.title = 'Add User';
            this.action = 'Create';
            this.form.reset();
            $('#userModal').modal('show');
          },

            deleteUser(id){
                swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                }).then((result) => {

                if (result.value) {
                        swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )

                       //sene request to the server
                 this.form.delete(`/api/user/${id}`).then( (response) => {

                Fire.$emit('ReloadGetUsers');

                }).catch(() => {
                  swal.fire("Failed!", "Something went wrong.", "warning");
                  console.log('bad ');
                 });

                  }


                })
            },

            createUser(){
                //this.form.post('api/user');
               this.$Progress.start();  //start progress bar
              // axios.post('api/user', {
                this.form.post('api/user', {
                     name:  this.form.name,
                     email:  this.form.email,
                     password:  this.form.password,
                     type:  this.form.type,
                     bio:  this.form.bio,
                     photo:  this.form.photo,
                     password_confirmation:  this.form.password_confirmation,
                    })

                    .then( (response) =>{
                        //console.log(response.data);
                        //this.$Progress.finish();//complete progress bar.
                        $('#userModal').modal('hide');

                        toast.fire({
                        type: 'success',
                        title: 'User Created successfully'
                        });

                        Fire.$emit('ReloadGetUsers'); //emmit the ReloadGetUsers event

                        //redirect to a new component route on success
                        //this.$router.replace({ path: 'profile' })
                       // this.users.unshift(response.data); //update users object with latest data
                    })
                    .catch( (error) => {
                        this.$Progress.fail(); //if action fails
                        //console.log(error);
                        this.geterrors = error.response.data.errors;
                         console.log(error.response.data.errors);
                         console.log(error.response.data);
                         console.log('failded');
                         //console.log(error.response.headers);
                         //read about asyn and await new in es6 and javascript
                    });

            },

            loadUsers(){
                if(this.$gate.isAdminOrAuthor){
                axios.get('api/user')
                .then(({data}) => (this.users = data))
                //.catch( ({error}) => console.log(error.data) )
                .catch(({error}) => (error.data.data.errors = this.geterrors))
                .finally();

                }
            },

        },

        mounted() {
            console.log('Component mounted. GET STARTED');

            this.loadUsers();

            Fire.$on('ReloadGetUsers',() => {
                this.loadUsers();
            });
           // setInterval(() => this.loadUsers(), 3000); // to reload data from db every 3 seconds for realtime update.

           Fire.$on('searching',() =>{
               this.searchfxn();
           });

        },

    //     filters:{
    //     'to-uppercase':function(value){
    //         return value.toUpperCase();
    //     }
    //    },

    }
</script>


<style scoped >



</style>
