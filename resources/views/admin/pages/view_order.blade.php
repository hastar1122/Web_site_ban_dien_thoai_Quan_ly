@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow border-left-info mb-4">
        <div class="card-header">
            <h4 class="text-info m-0">Thông tin chung</h4>       
        </div>    
        <div class="card-body pb-0">
            <dl class="row dl-horizontal mb-0">
                @foreach($order as $key => $ord)
                <dt class="col-md-3">
                    Mã hóa đơn: 
                </dt>

                <dd class="col-md-9">
                    {{$ord -> OrderCode}}
                </dd>
                
                <dt class="col-md-3">
                    Tên nhân viên:
                </dt>

                <dd class="col-md-9">
                    {{$employee -> UserName}}
                </dd>
                <dt class="col-md-3">
                    Trạng thái đơn hàng:
                </dt>

                <dd class="col-md-9">
                    {{$status2 -> OrderStatus}}
                </dd>
                @endforeach
            </dl>         
        </div>
        {{-- @foreach($order as $key => $ord)
        <form action="/update/{{ $ord-> OrderID  }}" style="text-align: right">
            {{ csrf_field() }}
            <label for="cars">Trạng thái đơn hàng:</label>
            <select name="cars" id="">
                @foreach($status as $key => $sts )
                    <option value="{{ $sts->    OrderStatus }}">{{ $sts->    OrderStatus }}</option>
                @endforeach
            </select>
            <button type="submit" value="Submit" class="btn btn-primary" style="width: 10%"> Update</button>
        </form>
        @endforeach --}}
       
         
    </div>
    <div class="card shadow border-left-info mb-4">
        <div class="card-header">
            <h4 class="text-info m-0">Thông tin khách hàng</h4>
        </div>

        <div class="card-body pb-0">
            <dl class="row dl-horizontal mb-0">
                <dt class="col-md-3">
                    Tên khách hàng: 
                </dt>

                <dd class="col-md-9">
                    {{$customer -> UserName}}
                </dd>

                <dt class="col-md-3">
                    Số điện thoại: 
                </dt>

                <dd class="col-md-9">
                    {{$customer -> PhoneNumber}}
                </dd>

                <dt class="col-md-3">
                    Địa chỉ nhận hàng: 
                </dt>

                <dd class="col-md-9">
                    {{$customer -> Address}}
                </dd>

                <dt class="col-md-3">
                    Email:
                </dt>

                <dd class="col-md-9">
                    {{$customer -> Email}}
                </dd>
              
            </dl>
        </div>
      

    </div>
    <div class="card shadow mb-4 border-left-info">
        <div class="card-header py-3">
            <div class="float-left mt-2">
                <h5 class="m-0 text-primary">Danh sách đơn hàng</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                            $total = 0;
                        @endphp
                        @foreach($order_detail as $key => $detail)
                      
                        @php
                            $i++;   
                            $subtotal =  $detail -> Amount*$product -> Price;
                            $total += $subtotal;
                        @endphp
                         <tr>
                            <td><i>{{ $i }}</i></td>
                            <td>{{ $product -> ProductName}}</td>
                            <td>{{ $product -> Image}}</td>
                            <td>{{ $detail -> Amount}}</td>
                            <td>{{ $product -> Price}}</td>
                            <td>{{ number_format($subtotal,0,',','.')}}đ</td>
                         </tr>
                        @endforeach
                        <tr>
                            <td style="text-align: right">Thanh toán: {{ number_format($total,0,',','.')}}đ </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @foreach($order as $key => $ord)
        <form action="/update/{{ $ord -> OrderID }}" method="post" tyle="text-align: right" >
            {{ csrf_field() }}
            <label for="">Cập nhật:</label>
            <select name="status" id="status">
                @foreach($status as $key => $sts )
                    <option value="{{ $sts->    OrderStatusID }}" name ="order_status" >{{ $sts->    OrderStatus }}</option>
                @endforeach
            </select>
                    <button type="submit" class="btn btn-primary" name="update">Cập nhật</button>
        </form>
        @endforeach
    </div>
</div>
@endsection