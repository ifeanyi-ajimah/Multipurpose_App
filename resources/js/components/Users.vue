<template>
    <div class="container">

        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Table</h3>

                <div class="card-tools">
                    <button class="btn btn-success" data-toggle="modal" data-target="#userModal"> Add User <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Modify</th>
                  </tr>
                  <tr>
                    <td>183</td>
                    <td>John Doe</td>
                    <td>11-7-2014</td>
                    <td><span class="tag tag-success">Approved</span></td>
                    <td>
                        <a href="">
                            <i class="fa fa-edit"></i>
                        </a>/
                        <i class="fa fa-trash red"></i>

                    </td>
                  </tr>

                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

    <!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
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
      <has-error :form="form" field="email"></has-error>
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
      <input v-model="form.password" type="password" name="password_confirmation" placeholder="Confirm Password"
        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
      <has-error :form="form" field="password"></has-error>
    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"> Create </button>
      </div>
    </div>
  </div>
</div>


    </div>
</template>

<script>
    export default {

        data(){
            return{
                form: new Form({
                    name: '',
                    email:'',
                    password:'',
                    type:'',
                    bio:'',
                    photo:'',
                })
            }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
