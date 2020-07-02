@extends("layouts.app")

@section("title") Detail User @endsection

@section("content-title") Detail User @endsection

@section("content")
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Detail User</h3>
        </div>
        <div class="card-body">
          <b>Name:</b> <br/>
            {{$user->name}}
          <br><br>
          @if($user->avatar)
            <img src="{{asset('storage/'. $user->avatar)}}" width="128px"/>
          @else
            No avatar
          @endif
          <br><br>
          <b>Username:</b><br>
            {{$user->email}}
          <br><br>
          <b>Phone number</b> <br>
            {{$user->phone}}
          <br><br>
          <b>Address</b> <br>
            {{$user->address}}
          <br><br>
          <b>Roles:</b> <br>
          @foreach (json_decode($user->roles) as $role)
            &middot; {{$role}} <br>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
