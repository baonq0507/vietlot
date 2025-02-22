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
                    <span>
                        Số dư
                        <span id="balance"
                            style="display: none;">{{ number_format(auth()->user()->balance, 2, ',', '.') }}$</span>
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
            <h1 class="text-white text-center">Lịch sử tham gia</h1>
        </div>

        <div class="main my-5">
            <div class="container">
                @foreach ($userGames as $userGame)
                        <div class="row border-bottom py-3">
                            <div class="col-6">
                                <p class="mb-0 text-muted">
                                    <span>{{ $userGame->game->type ==
                    'kenno5p' ? 'Kenno 5 phút' : ($userGame->game->type == 'kenno3p' ? 'Kenno 3 phút' : ($userGame->game->type == 'kenno1p' ? 'Kenno 1 phút' : ($userGame->game->type == 'xucxac3' ? 'Xúc xắc 3 phút' : ($userGame->game->type == 'xucxac5' ? 'Xúc xắc 5 phút' : '')))) }}</span>
                                    <span
                                        class="bage bg-{{ $userGame->result == 'win' ? 'success' : 'danger' }} text-white p-1 rounded-pill"
                                        style="font-size: 12px;">{{ $userGame->result == 'win' ? 'Thắng' : 'Thua' }}</span>
                                </p>
                                <p class="mb-0 text-muted" style="font-size: 12px;">
                                    <span>Phiên cược: {{ $userGame->code }}</span>
                                </p>
                                <p class="mb-0 text-muted" style="font-size: 12px;">
                                    <span>
                                        @if(str_contains($userGame->game->type, 'kenno'))
                                                        @foreach ($userGame->choose as $itemChoose)
                                                                        @if (str_contains($itemChoose, 'total'))
                                                                                    <span class="badge bg-primary text-uppercase">Tổng
                                                                                        {{ substr($itemChoose, -1) === 't' ? 'Tài' :
                                                                            (substr($itemChoose, -1) === 'x' ? 'Xỉu' :
                                                                                (substr($itemChoose, -1) === 'c' ? 'Chẵn' :
                                                                                    (substr($itemChoose, -1) === 'l' ? 'Lẻ' : ''))) }}
                                                                                    </span>
                                                                        @elseif (str_contains($itemChoose, 'bi'))
                                                                                        @php
                                                                                            $bi = substr($itemChoose, 2, 1); // Get bi number
                                                                                            $type = substr($itemChoose, -1); // Get type (l/x)
                                                                                            $displayType = $type === 'l' ? 'Lẻ' : ($type === 'c' ? 'Chẵn' : ($type === 't' ? 'Tài' : 'Xỉu'));
                                                                                        @endphp
                                                                                        <span class="badge bg-primary text-uppercase">Bi {{ $bi }} {{ $displayType }}
                                                                                        </span>
                                                                        @endif

                                                        @endforeach
                                        @elseif(str_contains($userGame->game->type, 'xucxac'))
                                            @foreach ($userGame->choose as $choose)
                                                @if(str_contains($choose, 'cltx'))
                                                    <span class="badge bg-primary text-uppercase">{{ substr($choose, -1) }}</span>
                                                @elseif(str_contains($choose, '2st'))
                                                    <span
                                                        class="badge bg-primary text-uppercase">{{ substr($choose, -5) === 'every' ? '2 số trùng bất kì' : '2 số trùng ' . substr($choose, -2) }}</span>
                                                @elseif(str_contains($choose, '3st'))
                                                    <span
                                                        class="badge bg-primary text-uppercase">{{ substr($choose, -5) === 'every' ? '3 số trùng bất kì' : '3 số trùng ' . substr($choose, -3) }}</span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </span>
                                </p>
                            </div>
                            <div class="col-6 text-end">
                                <p class="mb-0 text-muted" style="font-size: 12px;">
                                    <span>{{ number_format($userGame->money, 2, ',', '.') }}$</span>
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