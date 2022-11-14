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
                    Tên thuộc tính
                </th>
                <th width="90px">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attributes as $item)
                <tr>
                    <td class="text-center">
                        {{ $i }}
                    </td>
                    <td class="text-center">
                        {{ $item->AttributeName }}
                    </td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-primary information" data-id="{{$item->AttributeID}}" data-toggle="tooltip" title="Sửa"> <i class="far fa-edit"></i></a>
                        <a class="delete btn btn-sm btn-danger" data-id="{{$item->AttributeID}}" data-toggle="tooltip" title="Xóa"> <i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
</div>