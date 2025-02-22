@extends('layouts.app')
@section('title', 'Trang cá nhân')
@section('css')
    <style>
        .promotionRule__container-content__rules-item__titleLeft {
            background-color: #ff6464;
            height: 20px;
            position: absolute;
            top: -10px;
            -webkit-transform: translateX(-50%);
            transform: translate(-50%);
            clip-path: polygon(50% 0, 100% 0, 50% 50%, 100% 100%, 50% 100%, 0 50%);
            left: calc(50% - 55px);
            width: 15px;
            z-index: 5;
        }

        .promotionRule__container-content__rules-item__titleRight {
            background-color: #ff6464;
            -webkit-clip-path: polygon(50% 0, 100% 0, 50% 50%, 100% 100%, 50% 100%, 0 50%);
            clip-path: polygon(50% 0, 100% 0, 50% 50%, 100% 100%, 50% 100%, 0 50%);
            height: 20px;
            left: calc(50% + 55px);
            position: absolute;
            top: -10px;
            -webkit-transform: translateX(-50%) rotate(180deg);
            transform: translate(-50%) rotate(180deg);
            width: 15px;
            z-index: 5;
        }

        .promotionRule__container-content__rules-item__title {
            -webkit-clip-path: polygon(7% 0, 93% 0, 100% 50%, 93% 100%, 7% 100%, 0 50%);
            clip-path: polygon(7% 0, 93% 0, 100% 50%, 93% 100%, 7% 100%, 0 50%);
            color: #fff;
            font-size: 14px;
            left: 50%;
            line-height: 20px;
            text-align: center;
            width: 100px;
            background-color: #ff6464;
            height: 20px;
            position: absolute;
            top: -10px;
            -webkit-transform: translateX(-50%);
            transform: translate(-50%);
        }
        #action  {
            background-color: red;
            padding: 10px;
            position: absolute;
            bottom: -20px;
            left: 0;
            right: 0;
            border-radius: 10px;
            text-align: center;
        }
        #action a {
            color: #fff !important;
            text-decoration: none !important;
        }
        .card {
            border: 1px solid red;
        }
        .list-group {
            border:none !important;
            background-color: transparent !important;
        }
        .list-group-item {
            border:none !important;
            background-color: transparent !important;
            border-bottom: 1px solid #ccc !important;
            padding: 15px 0 !important;
        }
        .list-group i {
            font-size: 20px;
            color: red;
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row" id="header">
        <div class="col-6" id="header-top">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="img-fluid" style="width: 10rem;">
        </div>
        <div class="col-6 text-end mt-2" id="header-top">
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
        </div>
    </div>
    <div class="card">
        <div class="card-body position-relative" style="min-height: 200px;">
            <div class="promotionRule__container-content__rules-item__titleLeft"></div>
            <div class="promotionRule__container-content__rules-item__title">Thành Viên</div>
            <div class="promotionRule__container-content__rules-item__titleRight"></div>

            <div class="avatar text-center">
                <img src="{{ asset('assets/images/avt.jpg') }}" alt="avatar" class="rounded-circle" width="100px" height="100px">
                <p class="mt-1">{{ auth()->user()->username }}</p>
                <p class="mt-1"><h4>{{ number_format(auth()->user()->balance, 0, ',', '.') }} $</h4></p>
            </div>

            <div class="row justify-content-around w-75 mx-auto" id="action">
                <div class="col-6 border-end">
                    <a href="{{ route('recharge') }}">
                        <i class="bi bi-plus-lg font-weight-bold"></i> Nạp tiền
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ route('withdraw') }}">
                        <i class="bi bi-dash-lg font-weight-bold"></i> Rút tiền
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="main my-5">
        <div class="container">
            <div class="list-group">
                <a href="{{ route('historyplay') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div>
                        <i class="bi bi-clock-history font-weight-bold text-danger"></i>
                        Lịch sử tham gia
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </a>
                <a href="{{ route('historyadd') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div>
                        <i class="bi bi-wallet font-weight-bold text-danger"></i>
                        Lịch sử nạp
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </a>
                <a href="{{ route('historyget') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div>
                        <i class="bi bi-wallet font-weight-bold text-danger"></i>
                        Lịch sử rút
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </a>
                <a href="{{ route('addbank') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div>
                        <i class="bi bi-bank"></i>
                        Liên kết ngân hàng
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </a>
                <a href="{{ route('password') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div>
                        <i class="bi bi-shield-lock"></i>
                        Đổi mật khẩu
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-danger w-100 border-0">
                        <div>
                            <i class="bi bi-box-arrow-right"></i>
                            Đăng xuất
                        </div>
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @include('includes.footer')
</div>

@endsection