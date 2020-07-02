@extends("layouts.app")

@section("title") Create User @endsection

@section("content-title") Create User @endsection

@section("content")
  @if(session('status'))
    <div class="alert alert-success">
      {{session('status')}}
    </div>
  @endif
  <!-- Main row -->
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Form input</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" enctype="multipart/form-data" action="{{route('users.store')}}" method="POST">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Full name">
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            </div>
            <div class="form-group">
              <label for="">Roles</label><br />
              <input type="checkbox" name="roles[]" id="ADMIN" value="ADMIN"> <label for="ADMIN" style="margin-right:15px;">Administrator</label><br />
              <input type="checkbox" name="roles[]" id="STAFF" value="STAFF"> <label for="STAFF" style="margin-right:15px;">Staff</label><br />
              <input type="checkbox" name="roles[]" id="CUSTOMER" value="CUSTOMER"> <label for="CUSTOMER" style="margin-right:15px;">Customer</label>
            </div>
            <div class="form-group">
              <label for="phone">Phone number</label>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number">
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <textarea class="form-control" id="address" name="address" placeholder="Address"></textarea>
            </div>
            <div class="form-group">
              <label for="avatar">Avatar image</label>
              <input type="file" class="form-control" id="avatar" name="avatar">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="user@mail.com">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
              <label for="password_confirmation">Password Confirmation</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password Confirmation">
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row (main row) -->
@endsection
