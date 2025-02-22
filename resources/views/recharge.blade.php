@extends('layouts.app')
@section('title', 'Nạp tiền')
@section('css')
    <style>
        .main {
            margin-bottom: 100px !important;
            border: none !important;
        }

        button:hover {
            border: 1px solid #fff;
            outline: none;
            box-shadow: none;
        }

        button:focus {
            border: 1px solid #fff;
            outline: none !important;
            box-shadow: none !important;
        }

        input.form-control {
            height: 50px;
            border: none !important;
        }

        input.form-control:focus {
            border: 1px solid #fff;
            outline: none !important;
            box-shadow: none !important;
        }

        .bank_config {
            border-radius: 10px;
            padding: 10px;
            border: 1px solid red;

        }
        .title{
            font-size: 16px;
            font-weight: 600;
        }

        .title:before {
            background: red;
            content: "";
            display: block;
            height: 20px;
            width: 3px;
        }
        .recharge-content{
            padding: 10px 10px;
            border-radius: 15px;
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
        }
        .recharge-content ul{
            padding-left: 10px;
        }

        .recharge-content ul li:before {
            background: red;
            content: "";
            height: 10px;
            left: -10px;
            position: absolute;
            top: 5px;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            width: 10px;
        }

        .recharge-content ul li {
            color: #777;
            font-size: 14px;
            list-style: none;
            margin-bottom: 10px;
            padding-left: 10px;
            position: relative;
            text-align: left;
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
            <h1 class="text-white text-center">Nạp tiền</h1>
        </div>

        <div class="main my-5">
            <div class="container">
                <div class="bank_config mb-3">
                    <div class="row">
                        <div class="col-10">
                            <div class="bank_config_item">
                                <span style="font-size: 12px;">STK: </span>
                                <strong>{{ $bank->bank_number }}</strong>
                            </div>
                            <div class="bank_config_item">
                                <span style="font-size: 12px;">Chủ tài khoản: </span>
                                <strong>{{ $bank->bank_owner }}</strong>
                            </div>
                            <div class="bank_config_item">
                                <span style="font-size: 12px;">Ngân hàng: </span>
                                <strong>{{ $bank->bank_name }}</strong>
                            </div>

                        </div>
                        <div class="col-2" style="padding-left: 0px;">
                            <button class="btn btn-danger btn-sm" id="copy-btn" data-clipboard-text="{{ $bank->bank_number }}">
                                copy
                            </button>
                        </div>
                    </div>
                </div>
                <form action="{{ route('rechargePost') }}" method="POST" id="recharge">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <input type="number" class="form-control" id="amount" name="amount"
                                    placeholder="Nhập số tiền">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <button type="submit" class="btn btn-danger w-100" id="recharge-btn">Xác nhận</button>
                        </div>
                    </div>
                    <input type="hidden" name="bank_id" value="{{ $bank->id }}">
                </form>
            </div>

            <div class="recharge-content">
                <div class="row">
                    <div class="col-12">
                        <div class="title" style="margin: 0.2rem 0px 0.4rem;">Hướng dẫn nạp tiền</div>
                        <div class="">
                            <ul>
                                <li>Chuyển khoản đến thông tin ngân hàng ở trên.</li>
                                <li>Sau khi chuyển khoản thành công quý khách điền số tiền đã chuyển khoản vào ô "Nhập số tiền" và bấm xác nhận, số điểm sẽ được cộng trong vòng 3 phút.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.footer')
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#recharge').submit(function (e) {
                e.preventDefault();
                $('#recharge-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xác nhận...');
                $('#recharge-btn').prop('disabled', true);
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        Swal.fire({
                            title: 'Thành công',
                            text: response.message,
                            icon: 'success'
                        }).then(function () {
                            window.location.href = "{{ route('historyadd') }}";
                        });
                    },
                    error: function (response) {
                        Swal.fire({
                            title: 'Lỗi',
                            text: response.responseJSON.error,
                            icon: 'error'
                        });
                    },
                    complete: function () {
                        $('#recharge-btn').html('Xác nhận');
                        $('#recharge-btn').prop('disabled', false);
                    }
                });
            });
            $('#copy-btn').click(function () {
                var text = $(this).data('clipboard-text');
                var tempInput = document.createElement('input');
                document.body.appendChild(tempInput);
                tempInput.value = text;
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
                Toastify({
                    text: "Đã copy vào bộ nhớ",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    }
                }).showToast();
            });
        });
    </script>
@endsection