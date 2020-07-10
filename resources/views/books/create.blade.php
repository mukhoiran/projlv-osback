@extends("layouts.app")

@section("title") Create Book @endsection

@section("content-title") Create Book @endsection

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
        <form role="form" enctype="multipart/form-data" action="{{route('books.store')}}" method="POST">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Book title">
            </div>
            <div class="form-group">
              <label for="cover">Cover</label>
              <input type="file" class="form-control" id="cover" name="cover">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description" placeholder="Give a description about this book"></textarea>
            </div>
            <div class="form-group">
              <label for="categories">Categories</label>
              <select class="form-control" id="categories" name="categories[]" multiple>

              </select>
            </div>
            <div class="form-group">
              <label for="stock">Stock</label>
              <input type="number" class="form-control" id="stock" name="stock" min=0 value=0>
            </div>
            <div class="form-group">
              <label for="author">Author</label>
              <input type="text" class="form-control" id="author" name="author" placeholder="Book author">
            </div>
            <div class="form-group">
              <label for="publisher">Publisher</label>
              <input type="text" class="form-control" id="publisher" name="publisher" placeholder="Book publisher">
            </div>
            <div class="form-group">
              <label for="price">Price</label>
              <input type="number" class="form-control" id="price" name="price" placeholder="Book price">
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>
            <button class="btn btn-secondary" name="save_action" value="DRAFT">Save as draft</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row (main row) -->
@endsection
