@extends('admin.layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-info">Tổng quan</h1>
    </div>
    {{-- message here --}}
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 ">
            <div class="card-body mb-3">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Thương hiệu
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">@ViewBag.TongSoNganhHoc</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-university fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a href="@Url.Action("Index", "NganhHoc")" style="text-decoration: none">
                <div class="card-footer text-center no-gutters "> Xem chi tiết <i class="fas fa-arrow-alt-circle-right"></i></div>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 ">
            <div class="card-body mb-3">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Phân loại sản phẩm
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">@ViewBag.TongSoHocPhan</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-school fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a href="@Url.Action("Index", "HocPhan")" style="text-decoration: none">
                <div class="card-footer text-center no-gutters "> Xem chi tiết <i class="fas fa-arrow-alt-circle-right"></i></div>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 ">
            <div class="card-body mb-3">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Nhân viên
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">@ViewBag.TongSoGiangVien</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-tie fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a href="@Url.Action("Index", "GiangVien")" style="text-decoration: none">
                <div class="card-footer text-center no-gutters "> Xem chi tiết <i class="fas fa-arrow-alt-circle-right"></i></div>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 ">
            <div class="card-body mb-3">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Nhà cung cấp
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">@ViewBag.TongSoLopHocPhan</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a href="@Url.Action("Index", "LopHocPhan")" style="text-decoration: none">
                <div class="card-footer text-center no-gutters "> Xem chi tiết <i class="fas fa-arrow-alt-circle-right"></i></div>
            </a>
        </div>
    </div>


</div>

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 ">
            <div class="card-body mb-3">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Khách hàng
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">@ViewBag.TongSoNganhHoc</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-university fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a href="@Url.Action("Index", "NganhHoc")" style="text-decoration: none">
                <div class="card-footer text-center no-gutters "> Xem chi tiết <i class="fas fa-arrow-alt-circle-right"></i></div>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 ">
            <div class="card-body mb-3">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Thuộc tính sản phẩm
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">@ViewBag.TongSoHocPhan</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-school fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a href="@Url.Action("Index", "HocPhan")" style="text-decoration: none">
                <div class="card-footer text-center no-gutters "> Xem chi tiết <i class="fas fa-arrow-alt-circle-right"></i></div>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 ">
            <div class="card-body mb-3">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Sản phẩm
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">@ViewBag.TongSoGiangVien</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-tie fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a href="@Url.Action("Index", "GiangVien")" style="text-decoration: none">
                <div class="card-footer text-center no-gutters "> Xem chi tiết <i class="fas fa-arrow-alt-circle-right"></i></div>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 ">
            <div class="card-body mb-3">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Đơn hàng
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">@ViewBag.TongSoLopHocPhan</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard-teacher fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a href="@Url.Action("Index", "LopHocPhan")" style="text-decoration: none">
                <div class="card-footer text-center no-gutters "> Xem chi tiết <i class="fas fa-arrow-alt-circle-right"></i></div>
            </a>
        </div>
    </div>


</div>

<!-- /.container-fluid -->
@endsection
