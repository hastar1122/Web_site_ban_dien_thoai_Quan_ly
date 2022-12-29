@php
    $i = 1;
@endphp
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
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
                    Hình ảnh
                </th>
                <th width="1%">Thao tác</th>
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
                    <td>
                        @if ($item->Image)
                            <img width="120" height="120" src="http://127.0.0.1:8000/imgProduct/{{$item->Image}}">
                        @endif            
                    </td>
                    <td class="text-center">
                        <a class="addProduct btn btn-sm btn-success" data-id="{{$item->ProductID}}" data-toggle="tooltip" title="Chọn"> <i class="fas fa-check"></i> Chọn</a>
                    </td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
</div>