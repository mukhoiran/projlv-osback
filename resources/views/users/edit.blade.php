@extends("layouts.app")

@section("title") Edit User @endsection

@section("content-title") Edit User @endsection

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
          <h3 class="card-title">Form Edit</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" enctype="multipart/form-data" action="{{route('users.update', ['id'=>$user->id])}}" method="POST">
          @csrf
          <input type="hidden" value="PUT" name="_method">
          <div class="card-body">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Full name" value="{{$user->name}}">
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{$user->username}}">
            </div>
            <div class="form-group">
              <label for="">Status</label><br />
              <input {{$user->status == "ACTIVE" ? "checked" : ""}} value="ACTIVE" type="radio" id="active" name="status"><label for="active"> Active</label><br />
              <input {{$user->status == "INACTIVE" ? "checked" : ""}} value="INACTIVE" type="radio" id="inactive" name="status"><label for="inactive"> Inactive</label>
            </div>
            <div class="form-group">
              <label for="">Roles</label><br />
              <input {{in_array("ADMIN", json_decode($user->roles)) ? "checked" : ""}} type="checkbox" name="roles[]" id="ADMIN" value="ADMIN"> <label for="ADMIN">Administrator</label><br />
              <input {{in_array("STAFF", json_decode($user->roles)) ? "checked" : ""}} type="checkbox" name="roles[]" id="STAFF" value="STAFF"> <label for="STAFF">Staff</label><br />
              <input {{in_array("CUSTOMER", json_decode($user->roles)) ? "checked" : ""}} type="checkbox" name="roles[]" id="CUSTOMER" value="CUSTOMER"> <label for="CUSTOMER">Customer</label>
            </div>
            <div class="form-group">
              <label for="phone">Phone number</label>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number" value="{{$user->phone}}">
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <textarea class="form-control" id="address" name="address" placeholder="Address">{{$user->address}}</textarea>
            </div>
            <div class="form-group">
              <label for="avatar">Avatar image</label>
              <br />
              Current avatar: <br>
              @if($user->avatar)
                <img src="{{asset('storage/'.$user->avatar)}}" width="120px" />
                <br>
              @else
                No avatar
              @endif
              <input type="file" class="form-control" id="avatar" name="avatar">
              <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="user@mail.com" value="{{$user->email}}">
            </div>
            {{-- <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
              <label for="password_confirmation">Password Confirmation</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password Confirmation">
            </div> --}}
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
