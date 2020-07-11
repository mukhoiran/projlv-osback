@extends("layouts.app")

@section("title") List Orders @endsection

@section("content-title") List Orders @endsection

@section("content")
  <form action="{{route('orders.index')}}">
    <div class="row">
        <div class="col-md-5">
          <div class="input-group">
            <input value="{{Request::get('buyer_email')}}" type="text" class="form-control" placeholder="Search by buyer email" name="keyword">
          </div>
        </div>
        <div class="col-md-2">
          <select name="status" class="form-control" id="status">
            <option value="">ANY</option>
            <option {{Request::get('status') == "SUBMIT" ? "selected" : ""}} value="SUBMIT">SUBMIT</option>
            <option {{Request::get('status') == "PROCESS" ? "selected" : ""}} value="PROCESS">PROCESS</option>
            <option {{Request::get('status') == "FINISH" ? "selected" : ""}} value="FINISH">FINISH</option>
            <option {{Request::get('status') == "CANCEL" ? "selected" : ""}} value="CANCEL">CANCEL</option>
          </select>
        </div>
        <div class="col-md-2">
          <input type="submit" value="Filter" class="btn btn-primary">
        </div>
    </div>
  </form><br />
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
                List Order
              </div>
            </div>
          </div>
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Invoice number</th>
                <th>Status</th>
                <th>Buyer</th>
                <th>Total quantity</th>
                <th>Order date</th>
                <th>Total price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($orders as $order)
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$order->invoice_number}}</td>
                  <td>
                    @if($order->status == "SUBMIT")
                      <span class="badge bg-warning text-light">{{$order->status}}</span>
                    @elseif($order->status == "PROCESS")
                      <span class="badge bg-info text-light">{{$order->status}}</span>
                    @elseif($order->status == "FINISH")
                      <span class="badge bg-success text-light">{{$order->status}}</span>
                    @elseif($order->status == "CANCEL")
                      <span class="badge bg-dark text-light">{{$order->status}}</span>
                    @endif
                  </td>
                  <td>
                    {{$order->user->name}} <br>
                    <small>{{$order->user->email}}</small>
                  </td>
                  <td>{{$order->totalQuantity}} pc (s)</td>
                  <td>{{$order->created_at}}</td>
                  <td>{{$order->total_price}}</td>
                  <td>
                    <a href="{{route('orders.edit', ['id' => $order->id])}}" class="btn btn-info btn-sm"> Edit</a>
                  </td>
                </tr>
                @php $no++; @endphp
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan=10>
                  {{$orders->appends(Request::all())->links()}}
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
