<link rel="stylesheet" href="{{ asset('css/customer/footer.css') }}">

<div class="footer pt-5">
    <div class="info">
        <div class="container">
            <div class="col-md-3 col-sm-6 col-xs-12 float-left">
                <div class="footer-logo">
                    <a href="#">
                        <img src="{{ asset('storage/images/footer-logo.png') }}" width="165">
                    </a>
                </div>
                <div class="address">
                    {{ $spCompany->address }}
                </div>
                <div class="phone mt-2">{{ $spCompany->phone }}</div>
                <div class="email mt-2">{{ $spCompany->email }}</div>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-12 float-left">
                <h3 class="text-white footer-info-title">Về chúng tôi</h3>
                <di>
                    <div class="info-item"><a href="#">Trang chủ</a></div>
                    <div class="info-item"><a href="#">Giới thiệu</a></div>
                    <div class="info-item"><a href="#">Sản phẩm</a></div>
                    <div class="info-item"><a href="#">Liên hệ</a></div>

                </di>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-12 float-left">
                <h3 class="text-white footer-info-title">Điều khoản</h3>
                <di>
                    <div class="info-item"><a href="#">Tìm kiếm</a></div>
                    <div class="info-item"><a href="#">Qui định chung</a></div>
                    <div class="info-item"><a href="#">Tin tức mới nhất</a></div>
                    <div class="info-item"><a href="#">Tư vấn mua hàng</a></div>

                </di>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-12 float-left">
                <h3 class="text-white footer-info-title">Hướng dẫn</h3>
                <di>
                    <div class="info-item"><a href="#">Hướng dẫn đặt hàng</a></div>
                    <div class="info-item"><a href="#">Hướng dẫn thanh toán</a></div>
                    <div class="info-item"><a href="#">Quy định thanh toán</a></div>
                    <div class="info-item"><a href="#">Điều khoản sử dụng</a></div>
                </di>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 float-left">
                <h3 class="text-white footer-info-title">Thống kê truy cập</h3>
                <div class="thong-ke">
                    <div class="mt-2"><i class="fa fa-user-circle-o mr-2" aria-hidden="true"></i>Đang truy cập: 12345</div>
                    <div class="mt-2"><i class="fa fa-clock-o mr-2" aria-hidden="true"></i>Hôm nay: 12345</div>
                    <div class="mt-2"><i class="fa fa-globe mr-2" aria-hidden="true"></i>Tổng số: 12345</div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="copyright text-center mt-4">© Bản quyền thuộc về TCT Hà Nội, Thuốc bảo vệ thực vật.</div>
</div>
