@extends('layouts.app')
@section('title', 'Lịch sử tham gia')
@section('css')
    <style>
        .main {
            margin-bottom: 100px !important;
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
    <div class="container position-relative">
        <h1 class="text-white text-center">Lịch sử nạp tiền</h1>
    </div>

    <div class="main my-5">
        <div class="container">
            @foreach ($transactions as $transaction)
            <div class="row border-bottom py-3">
                <div class="col-6">
                    <p class="mb-0 text-muted">
                        <span>Nạp tiền</span>
                        <span class="bage bg-{{ $transaction->status == 'pending' ? 'warning' : ($transaction->status == 'success' ? 'success' : 'danger') }} text-white p-1 rounded-pill" style="font-size: 12px;">{{ $transaction->status == 'pending' ? 'Chờ xác nhận' : ($transaction->status == 'success' ? 'Thành công' : 'Thất bại') }}</span>
                    </p>
                    <p class="mb-0 text-muted" style="font-size: 12px;">
                        <span>Nội dung: Nạp tiền</span>
                    </p>
                </div>
                <div class="col-6 text-end">
                    <p class="mb-0 text-muted" style="font-size: 12px;">
                        <span>{{ number_format($transaction->amount, 0, ',', '.') }}$</span>
                    </p>
                    <p class="mb-0 text-muted ">
                        <span style="font-size: 12px;">{{ now()->format('d/m/Y H:i:s') }}</span>
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    
</div>

@include('includes.footer')

@endsection
