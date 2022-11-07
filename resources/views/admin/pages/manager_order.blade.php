@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800" style="color: #0099FF;">Quản lí đơn hàng</h1>
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Ngày</th>
                            <th>Trạng thái</th>
                            <th>Tổng tiền</th>
                            <th>Tác vụ</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($order as $key => $ord)
                        @php
                        $i++;   
                        @endphp
                        <tr>
                            <td><i>{{ $i }}</i></td>
                            <td>{{ $ord -> OrderCode}}</td>
                            <td>{{ $ord -> OrderDate}}</td>
                            <td>
                                @if($ord -> OrderStatusID==1)
                                <p class="text-warning">Đang xử lí</p>
                                @else   
                                    @if($ord -> OrderStatusID==2)
                                    <p class="text-success">Thành công</p>
                                    @else
                                    <p class="text-danger">Đã hủy</p>
                                    @endif
                                @endif                         
                               {{-- {{ $status -> OrderStatus }} --}}
                            </td>
                            <td>{{ $ord -> TotalPrice }}</td>
                            <td>
                                <a class="information btn btn-sm btn-primary" href="{{ URL::to('/view-order/'.$ord->OrderID)}}" title="Xem chi tiết"><i class="far fa-edit"></i></a>
                                <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này không?')" class="information btn btn-sm btn-danger" href="{{ URL::to('/manager-order')}}" title="Xóa đơn hàng"><i class="fas fa-trash"></i></a>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<!-- /.container-fluid -->
@endsection




