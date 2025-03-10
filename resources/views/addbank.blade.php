@extends('layouts.app')
@section('title', 'Liên kết ngân hàng')
@section('css')
    <style>
        .main {
            margin-bottom: 100px !important;
            border: none !important;
        }

        .box-banking {
            background: url("{{ asset('assets/images/box-banking.png') }}") no-repeat 50%;
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
            border: none !important;
        }

        input.form-control:focus {
            border: 1px solid #fff;
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
            <h1 class="text-white text-center">Liên kết ngân hàng</h1>
        </div>

        <div class="main my-5">
            <div class="container">
                @if(count($userBanks) < 1)
                    <form action="{{ route('addbankPost') }}" method="POST" id="addbank">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="bank_name" name ="bank_name"
                                        placeholder="Tên ngân hàng">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="bank_number" name="bank_number"
                                        placeholder="Số tài khoản">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="bank_owner" name="bank_owner"
                                        placeholder="Chủ tài khoản">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <button type="submit" class="btn btn-danger w-100" id="addbank-btn">Xác nhận</button>
                            </div>
                        </div>
                    </form>
                @endif
                @if(count($userBanks) > 0)
                <div class="list-bank">
                    @foreach($userBanks as $userBank)
                    <div class="bank-user">.
                        <div class="box-banking">
                            <div class="money_banking">
                                <h6>{{ $userBank->bank_owner }}</h6>
                                <h6>{{ substr($userBank->bank_number, 0, 4) . str_repeat('*', strlen($userBank->bank_number) - 4) }}</h6>
                            </div>
                            <div class="ctk">{{ $userBank->bank_name }}</div>
                            <div class="icon_credit">
                                <img src="{{ asset('assets/images/bank.png') }}" alt="viettinbank" class="img-fluid"/>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @include('includes.footer')
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#addbank').submit(function(e) {
                e.preventDefault();
                $('#addbank-btn').html('<spaln class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xác nhận...');
                $('#addbank-btn').prop('disabled', true);
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire({
                            title: 'Thành công',
                            text: response.message,
                            icon: 'success'
                        }).then(function() {
                            window.location.href = "{{ route('addbank') }}";
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            title: 'Lỗi',
                            text: response.responseJSON.error,
                            icon: 'error'
                        });
                    },
                    complete: function() {
                        $('#addbank-btn').html('Xác nhận');
                        $('#addbank-btn').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endsection


