@extends("layouts.app")

@section("content")
  <!-- Main row -->
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="alert alert-danger">
        <h1>401</h1>
        <h4>{{$exception->getMessage()}}</h4>
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row (main row) -->
@endsection
