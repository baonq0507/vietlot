@extends('layouts.app')

@section('title', 'Trang chủ')
@section('content')

<div class="container-fluid">
    <div class="row" id="header">
        <div class="col-6" id="header-top">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="img-fluid" style="width: 10rem;">
        </div>
        <div class="col-6 text-end mt-2" id="header-top">
            @if(auth()->check())
            <p class="text-white align-items-center text-end my-0">
                <span id="balance-container">
                    Số dư:
                    <span id="balance" style="display: none;">@if(auth()->user()->balance > 1000000000)<span
                    style="font-size: 12px;">{{ number_format(auth()->user()->balance, 2, ',', '.') }}$</span>@else{{ number_format(auth()->user()->balance, 2, ',', '.') }}$@endif</span>
                    <span id="balance-hidden">********</span>
                    <i class="bi bi-eye-slash" id="toggle-balance" style="cursor: pointer; margin-left: 5px;"></i>
                </span>
                <script>
                    document.getElementById('toggle-balance').addEventListener('click', function () {
                        const balance = document.getElementById('balance');
                        const balanceHidden = document.getElementById('balance-hidden');
                        const icon = this;

                        if (balance.style.display !== 'none') {
                            balance.style.display = 'none';
                            balanceHidden.style.display = 'inline';
                            icon.classList.remove('bi-eye');
                            icon.classList.add('bi-eye-slash');
                        } else {
                            balance.style.display = 'inline';
                            balanceHidden.style.display = 'none';
                            icon.classList.remove('bi-eye-slash');
                            icon.classList.add('bi-eye');
                        }
                    });
                </script>
            </p>
            @else
            <a href="{{ route('login') }}" class="btn btn-warning btn-sm" style="background: linear-gradient(124.32deg, #ffce1f 12.08%, #ccd26d 85.02%); color: #fff;">Đăng nhập</a>
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Đăng ký</a>
            @endif
        </div>
    </div>
    <div class="swiper mySwiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
                <img src="{{ asset('assets/images/banner1.jpg') }}" alt="banner" class="img-fluid">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('assets/images/banner2.jpg') }}" alt="banner" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="notify my-3">
        <div class="notify-item row p-1 align-items-center align-content-center" style="background-color: #f1f1f1;">
            <div class="col-1">
                <i class="bi bi-bell"></i>
            </div>
            <div class="col-11">
                <marquee class="text-dark d-flex align-self-center" style="font-size: 14px; height: 100%;">
                    Chào mừng đến với
                    <strong>{{ env('APP_URL') }}</strong>

                    trang xổ số truyền thống và xổ số tự chọn hàng đầu Việt Nam.
                </marquee>
            </div>
        </div>
    </div>
    <div class="main">
        <h2 class="title my-3">Games</h2>
        <div class="list-game">
            <div class="box-game">
                <a href="{{ route('kenno5p') }}">
                    <img src="{{ asset('assets/images/kenno5p.png') }}">
                    <h3>KENO 5P</h3>
                    <div class="box-game-text">
                        <div>Đoán số</div>
                        <div>Lớn/Nhỏ/Lẻ/Chẵn để giành chiến thắng</div>
                    </div>
                </a>
            </div>
            <div class="box-game">
                <a href="{{ route('kenno3p') }}">
                    <img src="{{ asset('assets/images/kenno3p.png') }}" style="margin: 0px 5px 0px 0px;">
                    <h3>KENO 3P</h3>
                    <div class="box-game-text">
                        <div>Đoán số</div>
                        <div>Lớn/Nhỏ/Lẻ/Chẵn để giành chiến thắng</div>
                    </div>
                </a>
            </div>
            <div class="box-game">
                <a href="{{ route('kenno1p') }}">
                    <img src="{{ asset('assets/images/kenno1p.png') }}">
                    <h3>KENO 1P</h3>
                    <div class="box-game-text">

                        <div>Đoán số</div>
                        <div>Lớn/Nhỏ/Lẻ/Chẵn để giành chiến thắng</div>
                    </div>
                </a>
            </div>
            <div class="box-game">
                <a href="{{ route('xucxac3') }}">
                    <img src="{{ asset('assets/images/xx3p.png') }}" style="margin: 0px 5px 0px 0px;">

                    <h3>ĐỔ XÚC SẮC 3P</h3>
                    <div class="box-game-text">
                        <div>Dự đoán</div>
                        <div>Dự đoán Xúc sắc để giành chiến thắng</div>
                    </div>
                </a>
            </div>
            <div class="box-game" >
                <a href="{{ route('xucxac5') }}">
                    <img src="{{ asset('assets/images/xx5p.png') }}" style="margin: 0px 5px 0px 0px;">
                    <h3>ĐỔ XÚC SẮC 5P</h3>
                    <div class="box-game-text">

                        <div>Dự đoán</div>
                        <div>Dự đoán Xúc sắc để giành chiến thắng</div>
                    </div>
                </a>
            </div>
            <div class="box-game op xsmb">
                <a href="">
                    {{-- <img src="{{ asset('assets/images/mb.png') }}" style="margin-left: -15px;"> --}}
                </a>
            </div>
            <div class="box-game op xsmt">
                <a href="">
                    {{-- <img src="{{ asset('assets/images/mt.png') }}" style="margin-left: -15px;">
                    <h3>XỔ SỐ TRUYỀN THỐNG</h3>
                    <div class="box-game-text">
                        <div>Xổ số miền Trung</div>
                        <div>Dự đoán kết quả xổ số miền Trung để giành chiến thắng</div>
                    </div> --}}
                </a>
            </div>
            <div class="box-game op xsmn">
                <a href="">
                    {{-- <img src="{{ asset('assets/images/mn.png') }}" style="margin-left: -15px;">
                    <h3>XỔ SỐ TRUYỀN THỐNG</h3>
                    <div class="box-game-text">
                        <div>Xổ số miền Nam</div>
                        <div>Dự đoán kết quả xổ số miền Nam để giành chiến thắng</div>
                    </div> --}}
                </a>
            </div>
            <div class="box-game">
                <a href="{{ route('xoso3p') }}">
                    <img src="{{ asset('assets/images/n3p.png') }}" style="margin: 8px 5px 0px 0px;">
                    <h3>XỔ SỐ NHANH 3P</h3>
                    <div class="box-game-text">
                        <div>Dự đoán</div>
                        <div>Dự đoán xổ số để giành chiến thắng</div>
                    </div>
                </a>
            </div>
            <div class="box-game" style="margin-bottom: 100px;">
                <a href="">
                    <img src="{{ asset('assets/images/n5p.png') }}" style="margin: 0px 5px 0px 0px;">
                    <h3>XỔ SỐ NHANH 5P</h3>
                    <div class="box-game-text">

                        <div>Dự đoán</div>
                        <div>Dự đoán xổ số để giành chiến thắng</div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    @include('includes.footer')
</div>

@endsection

@section('scripts')
<script>
    var swiper = new Swiper(".mySwiper", {
        autoplay: {
            delay: 1500,
            disableOnInteraction: false,
        },
    });
</script>
@endsection