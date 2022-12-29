<tr class="tr_{{$product->ProductID}}" data-id="{{$product->ProductID}}">
    <td>{{ $product->ProductCode}} <input value="{{$product->ProductID}}" name="ProductID[]" hidden></td>
    <td>{{ $product->ProductName }}</td>
    <td>
        @if ($product->Image)
            <img width="90" height="90" src="http://127.0.0.1:8000/imgProduct/{{$product->Image}}">
        @endif 
    </td>
    <td>
        <div class="">
            <input id="Amount_{{$product->ProductID}}" data-id="{{$product->ProductID}}" name="Amount[]" value=0 min="0" type="number" class="form-control text-right Amount">
        </div>
    </td>
    <td>
        <div class="">
            <input id="OutwardPrice_{{$product->ProductID}}" data-id="{{$product->ProductID}}" name="OutwardPrice[]" value="{{ $product->OutwardPrice }}" min="1" type="number" class="form-control text-right OutwardPrice">
        </div>
    </td>
    <td>
        <p class="TotalPrice text-right" id="TotalPrice_{{$product->ProductID}}">{{ number_format($product->OutwardPrice * 0, 0, ',', '.') }} </p>  
    </td>
    <td class="text-center">
        <a class="delete btn btn-sm btn-danger" data-id="{{$product->ProductID}}" data-toggle="tooltip" title="Xóa"> <i class="far fa-trash-alt"></i></a>
    </td>
</tr>
<tr class="tr_{{$product->ProductID}}" @if (1 == 2 )
    hidden
@endif>
    <td>Danh sách số EMEI mới</td>
    <td colspan="6">
        <div class="">
            <textarea data-id="{{$product->ProductID}}" id="Emei_{{$product->ProductID}}" name="Emei[]" class="form-control Emei"></textarea>
        </div>
    </td>
</tr>