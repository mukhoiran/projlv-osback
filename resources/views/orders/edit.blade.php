@extends("layouts.app")

@section("title") Edit Order @endsection

@section("content-title") Edit Order @endsection

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
        <form role="form" enctype="multipart/form-data" action="{{route('orders.update', ['id' => $order->id])}}" method="POST">
          @csrf
          <input type="hidden" value="PUT" name="_method">
          <div class="card-body">
            <div class="form-group">
              <label for="invoice_number">Invoice number</label>
              <input type="text" class="form-control" value="{{$order->invoice_number}}" disabled>
            </div>
            <div class="form-group">
              <label for="">Buyer</label>
              <input type="text" class="form-control" value="{{$order->user->name}}" disabled>
            </div>
            <div class="form-group">
              <label for="created_at">Order date</label>
              <input type="text" class="form-control" value="{{$order->created_at}}" disabled>
            </div>
            <div class="form-group">
              <label for="">Books ({{$order->totalQuantity}}) </label>
              <ul>
                @foreach($order->books as $book)
                  <li>{{$book->title}} <b>({{$book->pivot->quantity}})</b></li>
                @endforeach
              </ul>
            </div>
            <div class="form-group">
              <label for="">Total price</label>
              <input class="form-control" type="text" value="{{$order->total_price}}" disabled>
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control" name="status" id="status">
                <option {{$order->status == "SUBMIT" ? "selected" : ""}} value="SUBMIT">SUBMIT</option>
                <option {{$order->status == "PROCESS" ? "selected" : ""}} value="PROCESS">PROCESS</option>
                <option {{$order->status == "FINISH" ? "selected" : ""}} value="FINISH">FINISH</option>
                <option {{$order->status == "CANCEL" ? "selected" : ""}} value="CANCEL">CANCEL</option>
              </select>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row (main row) -->
@endsection
