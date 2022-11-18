@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh Mục Khách Hàng</h1>
        <div class="d-flex justify-content-end">
            <div class="input-group" style="width:260px;">
                <form action="" class="form-inline">
                    <input type="search" class="form-control  rounded" name="customer_search" id="customer-search"
                        placeholder="Search by name.." aria-label="Search" aria-describedby="search-addon" required />
                    <button type="submit" class="btn btn-outline-primary btn-search"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <br>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-1 font-weight-bold text-primary">Danh sách khách hàng</h6>
               
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã khách</th>
                                <th>Tên tài khoản</th>
                                <th>Ảnh</th>
                                <th>Tên khách</th>
                                <th>Địa chỉ</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_customer_get as $customer)
                                <tr>
                                    <td>{{ $customer->UserID }}</td>
                                    <td>{{ $customer->UserAccount }}</td>
                                    @if (!empty($customer->Image))
                                        <td><img src="{{ asset('/admin/img/' . $customer->Image) }}" width="70px"
                                                height="70px" alt=""></td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>{{ $customer->UserName }}</td>
                                    <td>{{ $customer->Address }}</td>
                                    <td>{{ $customer->Email }}</td>
                                    <td>{{ $customer->PhoneNumber }}</td>
                                    <td>
                                        <a data-url="{{ URL::to('/delete-customer/' . $customer->UserID) }}" type="button"
                                            class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="margin-left:17px;">
                {{ $all_customer_get->appends(request()->all())->links() }}
            </div>
        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $(".nav-1").addClass("show");

            $('.nav-link-1').removeClass('collapsed');
            
            $(".btn-delete").click(function() {
                var url = $(this).attr("data-url");
                if (confirm("Bạn có chắc muốn xóa không?")) {
                    $.ajax({
                        type: "get",
                        dataType: "json",
                        url: url,
                        success: function() {
                            toastr.success("Xóa khách hàng này thành công!");
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            toastr.error("Xóa khách hàng này thất bại!");
                        },
                    });
                }
            });
          
        });
    </script>
@endsection
