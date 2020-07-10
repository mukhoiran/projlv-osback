@extends("layouts.app")

@section("title") Edit Category @endsection

@section("content-title") Edit Category @endsection

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
        <form role="form" enctype="multipart/form-data" action="{{route('categories.update', ['id' => $category->id])}}" method="POST">
          @csrf
          <input type="hidden" value="PUT" name="_method">
          <div class="card-body">
            <div class="form-group">
              <label for="name">Category Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}">
            </div>
            <div class="form-group">
              <label for="slug">Category Slug</label>
              <input type="text" class="form-control" id="slug" name="slug" value="{{$category->slug}}">
            </div>
            <div class="form-group">
              <label for="image">Category image</label>
              <br />
              Current image: <br>
              @if($category->image)
                <img src="{{asset('storage/'.$category->image)}}" width="120px" />
                <br>
              @else
                No Image
              @endif
              <input type="file" class="form-control" id="image" name="image">
              <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
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
