@extends("layouts.app")

@section("title") Edit Book @endsection

@section("content-title") Edit Book @endsection

@section('footer-scripts')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script>
    $('#categories').select2({
      ajax: {
          url: '{{route('categories.select2')}}',
          processResults: function(data){
          return {
            results: data.map(function(item){
              return {
                id: item.id,
                text:item.name}
            })
          }
        }
      }
    });
    var categories = {!! $book->categories !!}
    categories.forEach(function(category){
      var option = new Option(category.name, category.id, true, true);
      $('#categories').append(option).trigger('change');
    });
  </script>
@endsection

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
        <form role="form" enctype="multipart/form-data" action="{{route('books.update', ['id' => $book->id])}}" method="POST">
          @csrf
          <input type="hidden" name="_method" value="PUT">
          <div class="card-body">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Book title" value="{{$book->title}}">
            </div>
            <div class="form-group">
              <label for="cover">Cover</label>
              <br />
              Current cover: <br>
              @if($book->cover)
                <img src="{{asset('storage/'.$book->cover)}}" width="120px" />
                <br>
              @else
                No Image
              @endif
              <input type="file" class="form-control" id="cover" name="cover">
              <small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
            </div>
            <div class="form-group">
              <label for="slug">Slug</label>
              <input type="text" class="form-control" id="slug" name="slug" placeholder="enter-a-slug" value="{{$book->slug}}">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description" placeholder="Give a description about this book">{{$book->description}}</textarea>
            </div>
            <div class="form-group">
              <label for="categories">Categories</label>
              <select class="form-control" id="categories" name="categories[]" multiple>
              </select>
            </div>
            <div class="form-group">
              <label for="stock">Stock</label>
              <input type="number" class="form-control" id="stock" name="stock" min=0 value="{{$book->stock}}">
            </div>
            <div class="form-group">
              <label for="author">Author</label>
              <input type="text" class="form-control" id="author" name="author" placeholder="Book author" value="{{$book->author}}">
            </div>
            <div class="form-group">
              <label for="publisher">Publisher</label>
              <input type="text" class="form-control" id="publisher" name="publisher" placeholder="Book publisher" value="{{$book->publisher}}">
            </div>
            <div class="form-group">
              <label for="price">Price</label>
              <input type="number" class="form-control" id="price" name="price" placeholder="Book price" value="{{$book->price}}">
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control" id="status" name="status">
                <option {{$book->status == 'PUBLISH' ? 'selected' : ''}} value="PUBLISH">PUBLISH</option>
                <option {{$book->status == 'DRAFT' ? 'selected' : ''}} value="DRAFT">DRAFT</option>
              </select>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button class="btn btn-primary" value="PUBLISH">Update</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row (main row) -->
@endsection
