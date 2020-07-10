@extends("layouts.app")

@section("title") List Books @endsection

@section("content-title") List Books @endsection

@section("content")
  <div class="row">
    <div class="col-md-6">
      <form action="{{route('books.index')}}">
        <div class="input-group">
          <input value="{{Request::get('keyword')}}" type="text" class="form-control" placeholder="Filter by title" name="keyword">
          <div class="input-group-append">
            <input type="submit" value="Filter" class="btn btn-primary">
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-6">
      <ul class="nav nav-pills card-header-pills">
        <li class="nav-item">
          <a class="nav-link {{Request::get('status') == NULL && Request::path() == 'books' ? 'active' : ''}}" href="{{route('books.index')}}">All</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::get('status') == 'publish' ? 'active' : '' }}" href="{{route('books.index', ['status' => 'publish'])}}">Publish</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::get('status') == 'draft' ? 'active' : '' }}" href="{{route('books.index', ['status' => 'draft'])}}">Draft</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::path() == 'books/trash' ? 'active' : ''}}" href="{{route('books.trash')}}">Trash</a>
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
                <a href="{{route('books.create')}}" class="btn btn-primary">Create book</a>
              </div>
            </div>
          </div>
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Cover</th>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th>Categories</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($books as $book)
                <tr>
                  <td>{{$no}}</td>
                  <td>
                    @if($book->cover)
                      <img src="{{asset('storage/'.$book->cover)}}" width="70px"/>
                    @else
                      N/A
                    @endif
                  </td>
                  <td>{{$book->title}}</td>
                  <td>{{$book->author}}</td>
                  <td>
                    @if($book->status == "DRAFT")
                      <span class="badge bg-dark text-white">
                        {{$book->status}}
                      </span>
                    @else
                      <span class="badge badge-success">
                        {{$book->status}}
                      </span>
                    @endif
                  </td>
                  <td>
                    <ul>
                      @foreach($book->categories as $category)
                        <li>{{$category->name}}</li>
                      @endforeach
                    </ul>
                  </td>
                  <td>{{$book->stock}}</td>
                  <td>{{$book->price}}</td>
                  <td>
                    <a class="btn btn-info text-white btn-sm" href="{{route('books.edit',['id'=>$book->id])}}">Edit</a>
                    <form onsubmit="return confirm('Move category to trash?')" class="d-inline" action="{{route('books.destroy', ['id' => $book->id ])}}" method="POST">
                      @csrf
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="submit" value="Trash" class="btn btn-danger btn-sm">
                    </form>
                  </td>
                </tr>
                @php $no++; @endphp
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan=10>
                  {{$books->appends(Request::all())->links()}}
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
