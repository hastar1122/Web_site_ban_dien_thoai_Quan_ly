<dl class="row dl-horizontal mb-0">
    <dt class="col-md-4">
        Mã hóa đơn:
    </dt>

    <dd class="col-md-8">
        {{ $order->OrderCode }}
    </dd>

    <dt class="col-md-4">
        Thời gian đặt:
    </dt>

    <dd class="col-md-8">
        {{ $order->OrderDate }}
    </dd>

    <dt class="col-md-4">
        Tổng tiền:
    </dt>

    <dd class="col-md-8">
        {{ number_format($order->TotalPrice, 0, ',', '.') }} VND
    </dd>

    <dt class="col-md-4">
        Nhân viên xác nhận:
    </dt>

    <dd class="col-md-8">
        @if ($employee)
            {{ $employee->UserName }}
        @endif
    </dd>

    <dt class="col-md-4">
        Trạng thái:
    </dt>

    <dd class="col-md-8">
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
    </dd>
</dl>