@extends('layouts.app')
@section('title', 'Khuyến mãi')
@section('css')
    <style>
        .main {
            margin-bottom: 100px !important;
            border: none !important;
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
            <h1 class="text-white text-center">Khuyến mãi</h1>
        </div>
        <div class="main my-5">
            <div class="container">
                <div class="row">
                    @foreach($notifications as $notification)
                    <div class="col-12 mb-3">
                        <div class="card">
                            <div class="card-body" data-bs-toggle="modal" data-bs-target="#notification-{{ $notification->id }}">
                                <img src="{{ $notification->image_url }}" alt="{{ $notification->title }}" class="img-fluid" >
                            </div>
                            <div class="card-footer" style="background-color: transparent;">
                                <p class="text-center mb-0">
                                    <span class="">{{ $notification->title }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="notification-{{ $notification->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="notification-{{ $notification->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header justify-content-center" style="border-bottom: none; background-color: red; color: white;">
                              <h5 class="modal-title text-center" id="notification-{{ $notification->id }}">{{ $notification->title }}</h5>
                            </div>
                            <div class="modal-body">
                              <div class="">
                                <p class="text-center mb-0">{!! $notification->content !!}</p>
                              </div>
                            </div>
                            <div class="modal-footer justify-content-center">
                              <button type="button" class="btn btn-danger btn-sm w-25" data-bs-dismiss="modal">Đóng</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include('includes.footer')
    </div>
@endsection
