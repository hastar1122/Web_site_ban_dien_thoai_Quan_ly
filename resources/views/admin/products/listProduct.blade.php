@php
    $i = 1;
@endphp
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr class="text-center">
                <th width="1%">
                    STT
                </th>
                <th>
                    Mã sản phẩm
                </th>
                <th>
                    Tên sản phẩm
                </th>
                <th>
                    Loại sản phẩm
                </th>
                <th>
                    Thương hiệu
                </th>
                <th>
                    Giá bán
                </th>
                <th>
                    Hình ảnh
                </th>
                <th>
                    Tình trạng
                </th>
                <th width="90px">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
                <tr>
                    <td class="text-center">
                        {{ $i }}
                    </td>
                    <td>
                        {{ $item->ProductCode }}
                    </td>
                    <td>
                        {{ $item->ProductName }}
                    </td>
                    <td>
                        {{ $item->ProductCategoryName }}
                    </td>
                    <td>
                        {{ $item->BrandName }}
                    </td>
                    <td class="text-right">
                        {{ $item->Price }}
                    </td>
                    <td>
                        @if ($item->Image)
                            <img width="120" height="120" src="http://127.0.0.1:8000/imgProduct/{{$item->Image}}">
                        @endif            
                    </td>
                    <td>
                        @if ($item->Amount > 0)
                            <span class="badge badge-success">Còn hàng</span>
                        @else
                            <span class="badge badge-danger">Hết hàng</span>
                        @endif
                    </td>
                    <td>
                        @if ($item->Type == 1)
                            <a class="btn btn-sm btn-primary" href="/products/{{$item->ProductID}}/edit" data-toggle="tooltip" title="Sửa"> <i class="far fa-edit"></i></a>
                        @else
                            <a class="btn btn-sm btn-primary" href="/products2/{{$item->ProductID}}/edit" data-toggle="tooltip" title="Sửa"> <i class="far fa-edit"></i></a>
                        @endif
                        
                        <a class="btn btn-sm btn-info" data-toggle="tooltip" title="Thông tin"> <i class="fas fa-info-circle"></i></a>
                        <a class="delete btn btn-sm btn-danger" data-id="{{$item->ProductID}}" data-toggle="tooltip" title="Xóa"> <i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
</div>