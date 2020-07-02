@extends("layouts.app")

@section("title") List User @endsection

@section("content-title") List User @endsection

@section("content")
  <div class="row">
    <div class="col-md-6">
      <form action="{{route('users.index')}}">
        <div class="row">
          <div class="col-md-6">
            <input value="{{Request::get('keyword')}}" name="keyword" class="form-control" type="text" placeholder="Masukan email untuk filter..."/>
          </div>
          <div class="col-md-6">
            <input {{Request::get('status') == 'ACTIVE' ? 'checked' : ''}} value="ACTIVE" name="status" type="radio" id="active">
            <label for="active">Active</label>
            <input {{Request::get('status') == 'INACTIVE' ? 'checked' : ''}} value="INACTIVE" name="status" type="radio" id="inactive">
            <label for="inactive">Inactive</label>
            <input type="submit" value="Filter" class="btn btn-primary"> <br/><br />
          </div>
        </div>
      </form>
    </div>
  </div>
  @if(session('status'))
    <div class="alert alert-success">
      {{session('status')}}
    </div>
  @endif
  <!-- /.row -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body table-responsive p-0">
          <div class="card-header">
            <div class="row">
              <div class="col-md-12 text-right">
                <a href="{{route('users.create')}}" class="btn btn-primary">Create user</a>
              </div>
            </div>
          </div>
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Avatar</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($users as $user)
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->username}}</td>
                  <td>{{$user->email}}</td>
                  <td>
                    @if($user->avatar)
                      <img src="{{asset('storage/'.$user->avatar)}}" width="70px"/>
                    @else
                      N/A
                    @endif
                  </td>
                  <td>
                    @if($user->status == "ACTIVE")
                      <span class="badge badge-success">
                        {{$user->status}}
                      </span>
                    @else
                      <span class="badge badge-danger">
                        {{$user->status}}
                      </span>
                    @endif
                  </td>
                  <td>
                    <a class="btn btn-info text-white btn-sm" href="{{route('users.edit',['id'=>$user->id])}}">Edit</a>
                    <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline" action="{{route('users.destroy', ['id' => $user->id ])}}" method="POST">
                      @csrf
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                    </form>
                    <a href="{{route('users.show', ['id' => $user->id])}}" class="btn btn-primary btn-sm">Detail</a>
                  </td>
                </tr>
                @php $no++; @endphp
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan=10>
                  {{$users->appends(Request::all())->links()}}
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row -->
@endsection
