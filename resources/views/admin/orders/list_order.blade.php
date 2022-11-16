<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th style="width: 1%;">STT</th>
                <th>Mã đơn hàng</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Ngày</th>
                <th>Trạng thái</th>
                <th style="width: 10%;" class="text-center">Thao tác</th>
            </tr>
        </thead>

        <tbody>
            @php
            $i = 0;
            @endphp
            @foreach($orders as $order)
            @php
            $i++;   
            @endphp
            <tr>
                <td><i>{{ $i }}</i></td>
                <td>{{ $order->OrderCode}}</td>
                <td>{{ $order->UserName }}</td>
                <td>{{ number_format($order->TotalPrice, 0, ',', '.') }}</td>
                <td>{{ $order->OrderDate}}</td>
                <td>
                    @if ($order->OrderStatusID == 1)
                        <span class="badge badge-primary">Đang xử lý</span> 
                    @endif     
                    @if ($order->OrderStatusID == 2)
                        <span class="badge badge-info">Đang giao hàng</span> 
                    @endif 
                    @if ($order->OrderStatusID == 3)
                        <span class="badge badge-success">Giao hàng thành công</span> 
                    @endif 
                    @if ($order->OrderStatusID == 4)
                        <span class="badge badge-danger">Đã hủy</span> 
                    @endif              
                </td>
                <td>
                    <a class="information btn btn-sm btn-primary" href="{{ URL::to('/view-order/'.$order->OrderID)}}" title="Xem chi tiết"><i class="far fa-edit"></i></a>
                    <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này không?')" class="information btn btn-sm btn-danger" href="{{ URL::to('/manager-order')}}" title="Xóa đơn hàng"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>