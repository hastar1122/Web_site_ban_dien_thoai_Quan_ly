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
        <div class="card border-left-light shadow h-100 ">
            <div class="card-body mb-3">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Thương hiệu
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $brand }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-copyright fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a href="{{ URL::to('/all-brand') }}" style="text-decoration: none">
                <div class="card-footer text-center no-gutters "> Xem chi tiết <i class="fas fa-arrow-alt-circle-right"></i></div>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 ">
            <div class="card-body mb-3">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Phân loại sản phẩm
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $category }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-pie fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a href="{{ URL::to('/all-category') }}" style="text-decoration: none">
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $employee }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-tie fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a href="{{ URL::to('/all-employee') }}" style="text-decoration: none">
                <div class="card-footer text-center no-gutters "> Xem chi tiết <i class="fas fa-arrow-alt-circle-right"></i></div>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 ">
            <div class="card-body mb-3">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Nhà cung cấp
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $supplier }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-truck fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a href="{{ URL::to('/all-supplier') }}" style="text-decoration: none">
                <div class="card-footer text-center no-gutters "> Xem chi tiết <i class="fas fa-arrow-alt-circle-right"></i></div>
            </a>
        </div>
    </div>


</div>

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 ">
            <div class="card-body mb-3">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Khách hàng
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $customer }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a href="{{ URL::to('/all-customer') }}" style="text-decoration: none">
                <div class="card-footer text-center no-gutters "> Xem chi tiết <i class="fas fa-arrow-alt-circle-right"></i></div>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 ">
            <div class="card-body mb-3">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Thuộc tính sản phẩm
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $attribute }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-th fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a href="{{ URL::to('/attributes') }}" style="text-decoration: none">
                <div class="card-footer text-center no-gutters "> Xem chi tiết <i class="fas fa-arrow-alt-circle-right"></i></div>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 ">
            <div class="card-body mb-3">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Sản phẩm
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $product }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a href="{{ URL::to('/products') }}" style="text-decoration: none">
                <div class="card-footer text-center no-gutters "> Xem chi tiết <i class="fas fa-arrow-alt-circle-right"></i></div>
            </a>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-dark shadow h-100 ">
            <div class="card-body mb-3">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Đơn hàng
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $order }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-boxes fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a href="{{ URL::to('/manager-order') }}" style="text-decoration: none">
                <div class="card-footer text-center no-gutters "> Xem chi tiết <i class="fas fa-arrow-alt-circle-right"></i></div>
            </a>
        </div>
    </div>


</div>

<!-- /.container-fluid -->
@endsection
