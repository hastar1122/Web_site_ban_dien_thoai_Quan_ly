<div class="navbar-inner">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="agileits-navi_search">
                <form action="{{ URL::to('/list-products') }}" method="post">
                    <select id="agileinfo-nav_search" name="agileinfo_search" class="border" required="">
                        <option value="">Danh mục sản phẩm</option>
                        @foreach ($category as $key => $cate)
                            <option value="{{ $cate -> CategoryID }}">{{ $cate -> ProductCategoryName }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto text-center mr-xl-5">
                    <li class="nav-item active mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link" href="index.html">Trang chủ
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Thiết bị điện tử
                        </a>
                        <div class="dropdown-menu">
                            <div class="agile_inner_drop_nav_info p-4">
                                <h5 class="mb-3">Điện thoại, Laptop</h5>
                                <div class="row">
                                    <div class="col-sm-6 multi-gd-img">
                                        <ul class="multi-column-dropdown">
                                            
                                            <li>
                                                <a href="product.html">Iphone</a>
                                            </li>
                                            <li>
                                                <a href="product.html">Xiaomi</a>
                                            </li>
                                            <li>
                                                <a href="product.html">Nokia</a>
                                            </li>
                                            <li>
                                                <a href="product.html">Samsung</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 multi-gd-img">
                                        <ul class="multi-column-dropdown">
                                            <li>
                                                <a href="product.html">Máy tính bảng</a>
                                            </li>
                                            <li>
                                                <a href="product.html">Đồng hồ thông minh</a>
                                            </li>
                                            <li>
                                                <a href="product.html">Ốp điện thoại</a>
                                            </li>
                                            <li>
                                                <a href="product.html">Tai nghe</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::to('/list-products') }}">Danh sách sản phẩm</a>
                    </li>
                    <li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Giới thiệu
                        </a>
                        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Liên hệ với chúng tôi</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>