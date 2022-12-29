<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th style="width: 1%;">STT</th>
                <th>Mã phiếu nhập</th>
                <th>Nhà cung cấp</th>
                <th>Ngày nhập</th>
                <th>Tổng tiền</th>
                <th style="width: 10%;" class="text-center">Thao tác</th>
            </tr>
        </thead>

        <tbody>
            @php
            $i = 0;
            @endphp
            @foreach($importBills as $importBill)
            @php
            $i++;   
            @endphp
            <tr>
                <td class="text-center">{{ $i }}</td>
                <td>{{ $importBill->ImportBillCode}}</td>
                <td>{{ $importBill->UserName }}</td>
                <td>{{ $importBill->ImportDate}}</td>
                <td>{{ number_format($importBill->TotalPrice, 0, ',', '.') }}</td>
                <td>
                    <a class="btn btn-sm btn-primary" href="/importBill/{{$importBill->ImportBillID}}/edit" data-toggle="tooltip" title="Sửa"> <i class="far fa-edit"></i></a>
                    <a class="delete btn btn-sm btn-danger" data-id="{{$importBill->ImportBillID}}" data-toggle="tooltip" title="Xóa"> <i class="far fa-trash-alt"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>