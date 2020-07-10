@extends("layouts.app")

@section("title") Trashed Category @endsection

@section("content-title") Trashed Category @endsection

@section("content")
  <div class="row">
    <div class="col-md-6">
      <form action="{{route('categories.index')}}">
        <div class="input-group">
          <input value="{{Request::get('name')}}" type="text" class="form-control" placeholder="Filter by category name" name="name">
          <div class="input-group-append">
            <input type="submit" value="Filter" class="btn btn-primary">
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-6">
      <ul class="nav nav-pills card-header-pills">
        <li class="nav-item">
          <a class="nav-link" href="{{route('categories.index')}}">Published</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{route('categories.trash')}}">Trash</a>
        </li>
      </ul>
    </div>
  </div><br />

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
                <a href="{{route('categories.create')}}" class="btn btn-primary">Create category</a>
              </div>
            </div>
          </div>
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($categories as $category)
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$category->name}}</td>
                  <td>{{$category->slug}}</td>
                  <td>
                    @if($category->image)
                      <img src="{{asset('storage/'.$category->image)}}" width="70px"/>
                    @else
                      N/A
                    @endif
                  </td>
                  <td>
                    <a href="{{route('categories.restore', ['id' => $category->id])}}" class="btn btn-success btn-sm">Restore</a>
                    <form class="d-inline" action="{{route('categories.delete-permanent', ['id' => $category->id])}}" method="POST" onsubmit="return confirm('Delete this category permanently?')">
                      @csrf
                      <input type="hidden" name="_method" value="DELETE"/>
                      <input type="submit" class="btn btn-danger btn-sm" value="Delete"/>
                    </form>
                  </td>
                </tr>
                @php $no++; @endphp
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan=10>
                  {{$categories->appends(Request::all())->links()}}
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
