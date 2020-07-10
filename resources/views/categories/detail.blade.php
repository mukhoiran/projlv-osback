@extends("layouts.app")

@section("title") Detail Category @endsection

@section("content-title") Detail Category @endsection

@section("content")
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Detail Category</h3>
        </div>
        <div class="card-body">
          <b>Category Name:</b> <br/>
            {{$category->name}}
          <br><br>
          <b>Category Slug:</b> <br/>
            {{$category->slug}}
          <br><br>
          <b>Category Image:</b> <br/>
          @if($category->image)
            <img src="{{asset('storage/'. $category->image)}}" width="128px"/>
          @else
            No image
          @endif
          <br><br>
        </div>
      </div>
    </div>
  </div>
@endsection
