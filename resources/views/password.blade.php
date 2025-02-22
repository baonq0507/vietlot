@extends('layouts.app')
@section('title', 'Đổi mật khẩu')
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
            <h1 class="text-white text-center">Đổi mật khẩu</h1>
        </div>

        <div class="main my-5">
            <div class="container">
                <form action="{{ route('passwordPost') }}" method="POST" id="password">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <input type="password" class="form-control" id="old_password" name="old_password"
                                    placeholder="Mật khẩu cũ">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    placeholder="Mật khẩu mới">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                    placeholder="Nhập lại mật khẩu mới">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <button type="submit" class="btn btn-danger w-100" id="password-btn">Xác nhận</button>
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
            $('#password').submit(function (e) {
                e.preventDefault();
                $('#password-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xác nhận...');
                $('#password-btn').prop('disabled', true);
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
                            window.location.href = "{{ route('password') }}";
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
                        $('#password-btn').html('Xác nhận');
                        $('#password-btn').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endsection