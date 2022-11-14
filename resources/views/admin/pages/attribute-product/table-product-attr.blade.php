<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" id="" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Mã đặc trưng</th>
                <th>Tên đặc trưng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_attr_product as $product_attr)
            <tr>
                <td>{{ $product_attr -> AttributeID }}</td>
                <td>{{ $product_attr -> AttributeName }}</td>
                <td>
                    <a delete-attr-url="{{ URL::to('/delete-attribute-product/'. $product_attr -> AttributeID)}}" type="button"
                        class="btn-delete-attr btn btn-danger btn-delete"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('admin.pages.attribute-product.add')

