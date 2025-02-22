@extends('layouts.app')

@section('title', 'Đăng ký')

@section('css')
<style>
    .wrapper {
        background: linear-gradient(hsla(0, 0%, 100%, 0), #b16a6a), url(/assets/images/login-bg.png);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
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
    input.form-control{
        height: 50px;
    }
    input.form-control:focus{
        border: 1px solid #fff;
        outline: none !important;
        box-shadow: none !important;
    }
    #register{
        height: 50px;
        font-size: 18px;
        font-weight: 600;
    }
</style>
@endsection
@section('content')
<div class="wrapper">


    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-10">
            <h3 class="text-center text-white">ĐĂNG NHẬP</h3>
            <form action="{{ route('loginPost') }}" method="POST" id="login-form">
                @csrf
                <div class="form-group mb-3">

                    <input type="text" class="form-control" id="username" name="username" placeholder="Tên tài khoản">
                </div>

                <div class="form-group mb-3">
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
                        <button class="btn border-0 bg-white" type="button" id="togglePassword">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger w-100" id="login">ĐĂNG NHẬP</button>

                <p class="text-center text-white mt-2" style="font-size: 20px;">Bạn chưa có tài khoản? <a class="text-danger text-decoration-none" href="{{ route('register') }}">Đăng ký</a></p>
            </form>
        </div>


    </div>
</div>

@endsection

@section('scripts')
<script>
    $('#login-form').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        // add loading
        $('#login').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang đăng nhập...');
        $('#login').prop('disabled', true);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            dataType: 'json',
            data: formData,
            success: function(response) {
                Swal.fire({
                    title: 'Thành công',
                    text: response.message,
                    icon: 'success'
                }).then(function() {
                    window.location.href = "{{ route('home') }}";
                });
            },

            error: function(response) {
                console.log(response);

                Swal.fire({
                    title: 'Lỗi',
                    text: response.responseJSON.error,
                    icon: 'error'
                });
            },

            complete: function() {
                $('#login').html('ĐĂNG NHẬP');
                $('#login').prop('disabled', false);
            }

        });


    });

    $('#togglePassword').click(function() {
        var password = $('#password');
        var icon = $(this).find('i');
        if (password.attr('type') === 'password') {

            password.attr('type', 'text');
            icon.removeClass('bi-eye').addClass('bi-eye-slash');
        } else {
            password.attr('type', 'password');
            icon.removeClass('bi-eye-slash').addClass('bi-eye');
        }
    });
    $('#togglePasswordConfirmation').click(function() {
        var password = $('#password_confirmation');
        var icon = $(this).find('i');
        if (password.attr('type') === 'password') {
            password.attr('type', 'text');
            icon.removeClass('bi-eye').addClass('bi-eye-slash');
        } else {
            password.attr('type', 'password');
            icon.removeClass('bi-eye-slash').addClass('bi-eye');
        }
    });


</script>
@endsection
