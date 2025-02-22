@extends('layouts.app')
@section('title', 'Rút tiền')
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
        }

        input.form-control:focus {
            border: 1px solid #ccc;
            outline: none !important;
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

        .box-banking {
            background: url("{{ asset('assets/images/box-banking2.png') }}") no-repeat 50%;
            background-size: 100% 100%;
            min-height: 200px;
            padding: .26667rem .34667rem;
            position: relative;
            text-align: center;
        }

        .box-banking .money_banking {
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            left: 25px;
            position: absolute;
            text-align: left;
            top: 25px;
        }

        .box-banking .ctk {
            bottom: 35px;
            color: #f2f2f2;
            font-size: 14px;
            position: absolute;
            right: 25px;
        }

        .box-banking .icon_credit {
            bottom: 35px;
            left: 25px;
            position: absolute;
            max-width: 35px;
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
        }

        input.form-control:focus {
            border: 1px solid #ccc;
            outline: none !important;
            box-shadow: none !important;
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
            <h1 class="text-white text-center">Rút tiền</h1>
        </div>

        <div class="main my-5">
            <div class="container">

                <div class="bank-user">
                    <div class="box-banking">
                        <div class="money_banking">
                            <h6>Số dư khả dụng</h6>
                            <h6>{{ number_format(auth()->user()->balance, 2, ',', '.') }}$</h6>
                        </div>
                        <div class="ctk">{{ auth()->user()->username }}</div>
                        <div class="icon_credit">
                            <img src="{{ asset('assets/images/bank.png') }}" alt="viettinbank" class="img-fluid"/>
                        </div>
                    </div>
                </div>
                <form action="{{ route('withdrawPost') }}" method="POST" id="withdraw">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <input type="number" class="form-control" id="amount" name="amount"
                                    placeholder="Nhập số tiền">
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <select class="form-control" id="bank_id" name="bank_id">
                                    <option value="" disabled selected>Chọn ngân hàng</option>
                                    @foreach($userBanks as $userBank)
                                        <option value="{{ $userBank->id }}">{{ $userBank->bank_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <button type="submit" class="btn btn-danger w-100" id="withdraw-btn">Xác nhận</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @include('includes.footer')
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#withdraw').submit(function (e) {
                e.preventDefault();
                $('#withdraw-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xác nhận...');
                $('#withdraw-btn').prop('disabled', true);
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
                            window.location.href = "{{ route('historyget') }}";
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
                        $('#withdraw-btn').html('Xác nhận');
                        $('#withdraw-btn').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endsection