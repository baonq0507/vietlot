@extends('layouts.app')
@section('css')
    <style>
        .count {
            align-items: center;
            display: flex;
            height: 1.5rem;
            justify-content: center;
            line-height: 1.5rem;
            margin: .3rem 0 0;

        }

        .count>div {
            background: #efeff4;
            border: .00667rem solid #fff;
            border-radius: .05333rem;
            color: red;
            font-size: 1.5rem;
            font-weight: 700;

            padding: 0.13333rem;
            text-align: center;
        }

        .count>.notime {
            background: transparent;
        }

        .popup-content {
            font-size: 14px;
        }

        .box-quay {
            background: #00b977;
            border-radius: .18667rem;
            height: 100px;
            margin-top: .48rem;
            padding: .26667rem;
            position: relative;
        }

        .box-quay:before {
            background: #008b59;
            border-radius: .13333rem 0 0 .13333rem;
            left: -.13333rem;
            content: "";
            display: block;
            height: .69333rem;
            position: absolute;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            width: .13333rem;
            z-index: 0;
        }

        .box-quay .box {
            align-items: center;
            background: #003c26;
            border-radius: .13333rem;
            display: flex;
            height: 100%;
            justify-content: space-between;
            padding: .13333rem;
            position: relative;
            width: 100%;
        }

        .box-quay:after {
            background: #008b59;
            border-radius: 0 .13333rem .13333rem 0;
            right: -.13333rem;
        }

        .box-quay:after,
        .box-quay:before {
            content: "";
            display: block;
            height: .69333rem;
            position: absolute;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            width: .13333rem;
            z-index: 0;
        }

        .box-quay .box .slot-column {
            background: #333;
            border-radius: .10667rem;
            display: inline-block;
            height: 100%;
            overflow: hidden;
            position: relative;
            text-align: center;
            vertical-align: bottom;
            width: calc(20% - .10667rem);
        }

        .box-quay .box .slot-column .slot-transform {
            -webkit-transform: translateY(-245px);
            transform: translateY(-245px);
        }

        .box-quay .box .slot-column .slot-transform .slot-num {
            background: #e1e1ec;
            border-radius: 50%;
            color: #0006;
            font-size: 1.2rem;
            font-weight: 700;
            height: 50px;
            line-height: 50px;
            margin: 0 auto .10667rem;
            width: 50px;
        }

        .box-quay .box:after {
            border-left: .53333rem solid transparent;
            border-right: .53333rem solid #00b977;
            right: 0;
        }

        .box-quay .box:after,
        .box-quay .box:before {
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .box-quay .box:before {
            border-left: .53333rem solid #00b977;
            border-right: .53333rem solid transparent;
            left: 0;
        }

        .box-quay .box:after,
        .box-quay .box:before {
            border-bottom: .18667rem solid transparent;
            border-top: .18667rem solid transparent;
            content: "";
            height: 0;
            position: absolute;
            width: 0;
            z-index: 3;
        }

        .slot-num {
            transition: transform 3s all;
        }

        .slot-num.active {
            background: #00e065 !important;
            color: #fff !important;
        }

        .text_choose_center {
            background: #fff;
            border-radius: .26667rem;
            box-shadow: 0 .05333rem .10667rem #c5c5da40;
            font-size: 14px;
            margin-top: .33rem;
            padding: .26667rem .34667rem;
            text-align: center;
        }

        .state {
            display: block;
            font-size: 12px;
            font-weight: 700;
            font-style: normal;
            color: red;
        }

        .state_choose .chooseItem,
        .state_rowindex .chooseItem .state {
            background: red;
            border: 1px solid red;
            color: #fff;
        }


        .text_choose_center .bet_state {
            border-bottom: 3px solid red;
            display: inline-block;
            font-size: 1rem;
            font-weight: 700;
            margin: .1rem 0 .3rem;
        }

        .state_choose {
            align-items: center;
            display: flex;
            flex-flow: row wrap;
            justify-content: center;
        }

        .state_choose>div {
            border: 1px solid #e5e5e5;
            border-radius: .22rem;
            cursor: pointer;
            flex: 1 1;
            margin: .1rem;
            padding: 7px;
        }

        .popup-bet {
            background: #fff;
            bottom: 0;
            box-shadow: 0 .05333rem .10667rem #c5c5da40;
            left: 50%;
            max-width: 540px;
            padding: 10px;
            position: fixed;
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%);
            width: 100%;
            z-index: 101;
        }

        .item_choose_footer {
            display: flex;
            font-size: 14px;
            justify-content: space-between;
        }

        .item_choose_footer .btn-sbmit {
            align-items: center;
            background: linear-gradient(180deg, #ee8d8d, red);
            border: none;
            border-radius: 1.06667rem;
            box-shadow: 0 .05333rem #e53636;
            color: #fff;
            display: flex;
            font-size: 14px;
            font-weight: 700;
            justify-content: center;
            padding: 10px 30px;
            text-shadow: 0 .05333rem .02667rem red;
        }

        .item_choose_footer input {
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            box-shadow: 0 .05333rem .21333rem #d0d0ed5c;
            font-size: 14px;
            margin: 0 0 0 .2rem;
            padding: 10px 10px;
        }

        .chooseItem .state {
            color: #fff !important;
        }

        /* tab */
        .tab.active {
            background: red !important;
            color: #fff !important;
        }

        .tab {
            background: #ccc !important;
            color: #000 !important;
        }

        .nav-tabs {
            justify-content: space-around;
            border-bottom: none !important;
        }

        th {
            color: #fff !important;
            font-size: 14px !important;
        }

        td {
            font-size: 12px !important;
        }

        .result_item {
            background: red;
            padding: 5px 7px;
            color: #fff;
            border-radius: 50%;
            font-size: 12px;
        }

        #history_game,
        #my_history {
            max-height: 250px;
            overflow-y: auto;
            margin: 0 auto;
            -ms-overflow-style: none;
            /* Hide scrollbar for IE and Edge */
            scrollbar-width: none;
            /* Hide scrollbar for Firefox */
        }

        #my_history {
            background: #fff;
            padding: 10px;
            border-radius: 10px;
        }

        #history_game::-webkit-scrollbar {
            display: none;
            /* Hide scrollbar for Chrome, Safari and Opera */
        }

        #my_history::-webkit-scrollbar {
            display: none;
            /* Hide scrollbar for Chrome, Safari and Opera */
        }

        #myTabContent {
            margin-bottom: 5rem;
        }

        .main_game {
            margin-bottom: 100px;
        }
    </style>
@endsection
@section('title', 'Kenno 1P')
@section('content')
    <div class="container-fluid">
        <div class="row" id="header">
            <div class="col-6" id="header-top">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="img-fluid" style="width: 10rem;">
            </div>
            <div class="col-6 text-end mt-2" id="">
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
        <div class="card" style="position: sticky; top: 0; z-index: 100;">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 text-center" style="border-right: 1px solid #ccc;">
                        <p class="card-title">Phiên số</p>
                        <p class="card-text"><strong id="code-game">{{ $lastGame ? $lastGame->code : '' }}</strong></p>
                        <button class="btn-mini btn" data-bs-toggle="modal" data-bs-target="#modal-play">Hướng dẫn cách
                            chơi</button>
                    </div>
                    <div class="col-6 text-center">
                        <p class="card-title" style="font-size: 14px; color: #8b8b8b;">Thời gian còn lại</p>
                        <div class="count">
                            <div>0</div>
                            <div id="minute">0</div>
                            <div class="notime">:</div>
                            <div id="second">0</div>
                            <div id="second-hidden">0</div>
                        </div>
                    </div>

                </div>
                <div>
                    <div class="col-100">
                        <div class="box-quay">
                            <div class="box">
                                <div class="slot-column">
                                    <div class="slot-transform" data-col="0">
                                        <div class="slot-num">0</div>
                                        <div class="slot-num">1</div>
                                        <div class="slot-num">2</div>
                                        <div class="slot-num">3</div>
                                        <div class="slot-num">4</div>
                                        <div class="slot-num">5</div>
                                        <div class="slot-num">6</div>
                                        <div class="slot-num">7</div>
                                        <div class="slot-num">8</div>
                                        <div class="slot-num">9</div>
                                        <div class="slot-num">0</div>
                                        <div class="slot-num">1</div>
                                        <div class="slot-num">2</div>
                                        <div class="slot-num">3</div>
                                        <div class="slot-num">4</div>
                                        <div class="slot-num">5</div>
                                        <div class="slot-num">6</div>
                                        <div class="slot-num">7</div>
                                        <div class="slot-num">8</div>
                                        <div class="slot-num">9</div>
                                    </div>
                                </div>
                                <div class="slot-column">
                                    <div class="slot-transform" data-col="1">
                                        <div class="slot-num">0</div>
                                        <div class="slot-num">1</div>
                                        <div class="slot-num">2</div>
                                        <div class="slot-num">3</div>
                                        <div class="slot-num">4</div>
                                        <div class="slot-num">5</div>
                                        <div class="slot-num">6</div>
                                        <div class="slot-num">7</div>
                                        <div class="slot-num">8</div>
                                        <div class="slot-num">9</div>
                                        <div class="slot-num">0</div>
                                        <div class="slot-num">1</div>
                                        <div class="slot-num">2</div>
                                        <div class="slot-num">3</div>
                                        <div class="slot-num">4</div>
                                        <div class="slot-num">5</div>
                                        <div class="slot-num">6</div>
                                        <div class="slot-num">7</div>
                                        <div class="slot-num">8</div>
                                        <div class="slot-num">9</div>
                                    </div>
                                </div>
                                <div class="slot-column">
                                    <div class="slot-transform" data-col="2">
                                        <div class="slot-num">0</div>
                                        <div class="slot-num">1</div>
                                        <div class="slot-num">2</div>
                                        <div class="slot-num">3</div>
                                        <div class="slot-num">4</div>
                                        <div class="slot-num">5</div>
                                        <div class="slot-num">6</div>
                                        <div class="slot-num">7</div>
                                        <div class="slot-num">8</div>
                                        <div class="slot-num">9</div>
                                        <div class="slot-num">0</div>
                                        <div class="slot-num">1</div>
                                        <div class="slot-num">2</div>
                                        <div class="slot-num">3</div>
                                        <div class="slot-num">4</div>
                                        <div class="slot-num">5</div>
                                        <div class="slot-num">6</div>
                                        <div class="slot-num">7</div>
                                        <div class="slot-num">8</div>
                                        <div class="slot-num">9</div>
                                    </div>
                                </div>
                                <div class="slot-column">
                                    <div class="slot-transform" data-col="3">
                                        <div class="slot-num">0</div>
                                        <div class="slot-num">1</div>
                                        <div class="slot-num">2</div>
                                        <div class="slot-num">3</div>
                                        <div class="slot-num">4</div>
                                        <div class="slot-num">5</div>
                                        <div class="slot-num">6</div>
                                        <div class="slot-num">7</div>
                                        <div class="slot-num">8</div>
                                        <div class="slot-num">9</div>
                                        <div class="slot-num">0</div>
                                        <div class="slot-num">1</div>
                                        <div class="slot-num">2</div>
                                        <div class="slot-num">3</div>
                                        <div class="slot-num">4</div>
                                        <div class="slot-num">5</div>
                                        <div class="slot-num">6</div>
                                        <div class="slot-num">7</div>
                                        <div class="slot-num">8</div>
                                        <div class="slot-num">9</div>
                                    </div>
                                </div>
                                <div class="slot-column">
                                    <div class="slot-transform" data-col="4">
                                        <div class="slot-num">0</div>
                                        <div class="slot-num">1</div>
                                        <div class="slot-num">2</div>
                                        <div class="slot-num">3</div>
                                        <div class="slot-num">4</div>
                                        <div class="slot-num">5</div>
                                        <div class="slot-num">6</div>
                                        <div class="slot-num">7</div>
                                        <div class="slot-num">8</div>
                                        <div class="slot-num">9</div>
                                        <div class="slot-num">0</div>
                                        <div class="slot-num">1</div>
                                        <div class="slot-num">2</div>
                                        <div class="slot-num">3</div>
                                        <div class="slot-num">4</div>
                                        <div class="slot-num">5</div>
                                        <div class="slot-num">6</div>
                                        <div class="slot-num">7</div>
                                        <div class="slot-num">8</div>
                                        <div class="slot-num">9</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="main_game">
            <div class="route_game">
                <div class="text_choose_center">
                    <div class="bet_state">Tổng</div>
                    <div class="state_choose">
                        <div class="state_rowindex">
                            <i class="state" data-bet="total_t">Tổng lớn</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>
                        <div class="state_rowindex ">
                            <i class="state" data-bet="total_x">Tổng nhỏ</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>

                        <div class="state_rowindex ">
                            <i class="state" data-bet="total_l">Tổng lẻ</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>
                        <div class="state_rowindex ">
                            <i class="state" data-bet="total_c">Tổng chẵn</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>
                    </div>
                </div>
                <div class="text_choose_center">
                    <div class="bet_state">Bi thứ 1</div>
                    <div class="state_choose">
                        <div class="state_rowindex">
                            <i class="state" data-bet="bi1_t">Lớn</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>
                        <div class="state_rowindex">
                            <i class="state" data-bet="bi1_x">Nhỏ</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>

                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi1_l">Lẻ</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>
                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi1_c">Chẵn</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>

                    </div>
                </div>
                <div class="text_choose_center">
                    <div class="bet_state">Bi thứ 2</div>
                    <div class="state_choose">
                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi2_t">Lớn</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>
                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi2_x">Nhỏ</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>

                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi2_l">Lẻ</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>

                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi2_c">Chẵn</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>
                    </div>
                </div>

                <div class="text_choose_center">
                    <div class="bet_state">Bi thứ 3</div>
                    <div class="state_choose">
                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi3_t">Lớn</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>
                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi3_x">Nhỏ</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>

                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi3_l">Lẻ</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>

                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi3_c">Chẵn</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>
                    </div>
                </div>

                <div class="text_choose_center">
                    <div class="bet_state">Bi thứ 4</div>
                    <div class="state_choose">
                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi4_t">Lớn</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>
                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi4_x">Nhỏ</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>

                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi4_l">Lẻ</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>

                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi4_c">Chẵn</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>
                    </div>
                </div>

                <div class="text_choose_center">
                    <div class="bet_state">Bi thứ 5</div>
                    <div class="state_choose">
                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi5_t">Lớn</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>
                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi5_x">Nhỏ</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>

                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi5_l">Lẻ</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>
                        <div class="state_rowindex ">
                            <i class="state" data-bet="bi5_c">Chẵn</i>
                            <span class="setting_type">{{ $settingKenno->reward_win }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs my-3" id="myTab" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="nav-link active btn btn-danger tab" id="history_game-tab" data-bs-toggle="tab"
                        data-bs-target="#history_game" type="button" role="tab" aria-controls="history_game"
                        aria-selected="true">Lịch sử trò chơi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link tab btn btn-danger" id="my_history-tab" data-bs-toggle="tab"
                        data-bs-target="#my_history" type="button" role="tab" aria-controls="my_history"
                        aria-selected="false">Lịch sử của tôi</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="history_game" role="tabpanel" aria-labelledby="history_game-tab">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead style="background-color: red; color: #fff;">
                                <tr>
                                    <th>Phiên số</th>
                                    <th class="text-center">Kết quả</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historyGame as $item)
                                    <tr>
                                        <td>{{ $item->code }}</td>
                                        <td class="text-center">
                                            <span class="result_item">{{ $item->result[1] }}</span>
                                            <span class="result_item">{{ $item->result[2] }}</span>
                                            <span class="result_item">{{ $item->result[3] }}</span>
                                            <span class="result_item">{{ $item->result[4] }}</span>
                                            <span class="result_item">{{ $item->result[5] }}</span>
                                        </td>
                                        <td>{{ $item->start_time }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="my_history" role="tabpanel" aria-labelledby="my_history-tab">
                    <div>
                        @foreach ($myHistory as $item)
                            <div class="row border-bottom py-3">
                                <div class="col-6">
                                    <p class="mb-0 text-muted">
                                        <span>Kenno 1P</span>
                                        <span class="bage {{ $item->result == 'win' ? 'bg-success' : 'bg-danger' }} text-white p-1 rounded-pill"
                                            style="font-size: 12px;">{{ $item->result == null ? 'Chờ kết quả' : ($item->result == 'win' ? 'Thắng' : 'Thua') }}</span>
                                    </p>
                                    <p class="mb-0 text-muted" style="font-size: 12px;">
                                        <span>Phiên cược: {{ $item->game->code }}</span>
                                    </p>
                                    <p class="mb-0 text-muted" style="font-size: 12px;">
                                        <span>Chọn 
                                            @foreach ($item->choose as $itemChoose)
                                                <span class="badge bg-primary text-uppercase">{{ substr($itemChoose, -1) }}</span>
                                            @endforeach
                                        </span>
                                    </p>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="mb-0 text-muted" style="font-size: 12px;">
                                        <span>{{ $item->money }} Đ</span>
                                    </p>
                                    <p class="mb-0 text-muted ">
                                        <span style="font-size: 12px;">{{ $item->created_at->format('d/m/Y H:i:s') }}</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="popup-bet d-none">
            <form id="form-submit-bet">
                <div class="footer_choose">
                    <div class="title_choose_footer">
                        <div class="item_choose_footer">
                            <div style="display: flex; align-items: center;">
                                <b>Số tiền cược: </b>
                                <input required="" min="1" id="money" name="money" type="number"
                                    placeholder="Nhập số tiền cược">
                            </div>
                        </div>
                        <div class="item_choose_footer" style="margin: 0.3rem 0px 0px;">
                            <div style="display: flex; align-items: center;">
                                <span style="margin-right: 5px;">Đã chọn
                                    <span style="color: red;" id="choose-item">1</span> ,
                                </span>
                                <span>Tổng tiền cược
                                    <span style="color: red;" id="total-money">0 đ</span>
                                </span>
                            </div>
                            <button type="submit" class="btn-sbmit">Đặt lệnh</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal fade" id="modal-play" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header justify-content-center" style="background-color: red; text-align: center;">
                        <h6 class="modal-title text-white text-center" id="modal-play-title">Hướng dẫn cách chơi</h6>
                    </div>
                    <div class="modal-body">
                        <div class="popup-content">Chiến thắng khi đặt cược bi (tài/xỉu/lẻ/chẵn) khớp với kết quả xổ số. Tỉ
                            lệ ăn {{ $settingKenno->reward_win }} (đánh 100k ăn {{ $settingKenno->reward_win * 100 }}k).<br><br><b>Ví dụ 1</b><br>Bạn đặt bi thứ 2 là L (lẻ) và T (tài).
                            Kết quả xổ số là 71294, bi thứ 2 có kết quả là 1. Bạn chiến thắng L nhưng thua T.<br><br><b>Ví
                                dụ 2</b><br>Bạn đặt bi thứ 4 là C (chẵn). Kết quả xổ số là 71294, bi thứ 4 có kết quả là 9.
                            Bạn thua cuộc.</div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-danger w-25"
                            style="border-radius: 15px;">Đóng</button>
                    </div>
                </div>

            </div>
        </div>
        @include('includes.footer')
    </div>


@endsection
@section('scripts')
    <script src="https://cdn.socket.io/4.8.1/socket.io.min.js"
        integrity="sha384-mkQ3/7FUtcGyoppY6bz/PORYoGqOl7/aSUMn2ymDOJcapfS6PHqxhRTMh1RR0Q6+"
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            // const targetNumber = "56789"; // Số muốn dừng lại
            const columns = $(".slot-transform");

            function spinColumn($column, targetDigit, delay) {
                let position = 0;
                let speed = 100; // Tốc độ quay
                let interval = setInterval(() => {
                    position -= 30;
                    $column.css("transform", `translateY(${position}px)`);
                }, speed);
                $column.css("transform", "");
                const totalItems = 20; // Số lượng phần tử trong mỗi cột
                const itemHeight = parseInt($column.css("height")) / totalItems - 1;
                setTimeout(() => {
                    clearInterval(interval);


                    // Tìm vị trí chính xác của số cần dừng
                    const matchingElements = $column.find(".slot-num").toArray().filter(el =>
                        $(el).text().trim() === String(targetDigit)
                    );
                    const targetIndex = matchingElements.length > 0 ?
                        $column.find(".slot-num").index(matchingElements[matchingElements.length - 1]) : -1;

                    const finalPosition = -(targetIndex % totalItems) * itemHeight;
                    console.log("Column stop at index:", targetIndex, "Final position:", finalPosition);


                    // Đảm bảo dừng đúng vị trí
                    requestAnimationFrame(() => {
                        $column.css({
                            "transition": "transform 0.8s ease-out",
                            "transform": `translateY(${finalPosition}px)`
                        });

                        setTimeout(() => {
                            $column.find(".slot-num").removeClass("active");
                            $column.find(".slot-num").eq(targetIndex).addClass("active");
                        }, 800);
                    });
                }, delay);
            }


            function startJackpot(targetNumber) {
                columns.each(function (index) {
                    const targetDigit = targetNumber[index];
                    console.log("Column", index, "Target digit:", targetDigit);
                    spinColumn($(this), targetDigit, 2000 + index * 500);
                });
            }

            // startJackpot(lastGame.result.slice(-5).join(''));

            const formatMoney = (money) => {
                return money.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            $(".state_rowindex").click(function () {
                const state = $(this).find(".state").text();
                $(this).toggleClass("chooseItem");
                if ($(".chooseItem").length > 0) {
                    $(".popup-bet").removeClass("d-none");
                    $('#choose-item').text($(".chooseItem").length);
                    const money = $('#money').val() ? parseInt($('#money').val()) : 0;
                    $('#total-money').text(formatMoney($(".chooseItem").length * money));
                } else {
                    $(".popup-bet").addClass("d-none");
                    $('#choose-item').text(0);
                    $('#total-money').text(formatMoney(0));
                }
            });

            $('#money').on('input', function () {
                const money = $(this).val() ? parseInt($(this).val()) : 0;
                $('#total-money').text(formatMoney($(".chooseItem").length * money));
            });

            const lastGame = @json($lastGame);
            if(lastGame) {
                startJackpot(lastGame.result.slice(-5).join(''));
            }

            //reload page

            function reloadPage(element) {
                console.log(typeof element);
                
                $.get(window.location.href, function(data) {
                    if(typeof element == 'string') {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, 'text/html');
                        const newTable = doc.querySelector(element).innerHTML;
                        document.querySelector(element).innerHTML = newTable;
                    } else if(typeof element == 'object') {
                        element.forEach(item => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(data, 'text/html');
                            const newTable = doc.querySelector(item).innerHTML;
                            document.querySelector(item).innerHTML = newTable;
                        });
                    }
                });
            }

            const socket = io("{{ env('SOCKET_URL') }}", {
                transports: ['polling'],
            });
            let gameId = '';
            let codeGame = '';
            socket.on('connect', () => {
                let lastCode = '';
                socket.on(`onGame-kenno1p`, (data) => {
                    console.log(data.result);
                    
                    // Only update if code has changed
                    if (data.code !== lastCode) {
                        $('#code-game').text(data.code);
                        codeGame = data.code;
                        gameId = data.id;
                        lastCode = data.code;
                    }

                    const endTime = new Date(data.end_time);
                    const now = new Date();
                    const diff = endTime - now;
                    
                    // Đảm bảo không có số âm
                    const diffInSeconds = Math.max(0, Math.floor(diff / 1000));
                    
                    const hour = Math.floor(diffInSeconds / 3600);
                    const minute = Math.floor((diffInSeconds % 3600) / 60);
                    const totalSeconds = diffInSeconds % 60;
                    const second = Math.floor(totalSeconds / 10);
                    const secondHidden = totalSeconds % 10;

                    $('#hour').text(hour);
                    $('#minute').text(minute);
                    $('#second').text(second);
                    $('#second-hidden').text(secondHidden);

                    // Chỉ quay khi thực sự hết thời gian
                    if (diffInSeconds <= 0) {
                        const result = data.result.slice(-5);
                        startJackpot(result.join(''));
                        reloadPage(['#my_history', '#history_game']);
                    }
                });
            });
            let userId = "{{ auth()->user()->id }}";

            socket.on(`reward-win-kenno1p-${userId}`, (data) => {
                Toastify({
                    text: 'Bạn đã thắng ' + data.balance + ' $',
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    }
                }).showToast();
                reloadPage('#balance-container');
            });
            socket.on(`reward-lose-kenno1p-${userId}`, (data) => {
                Toastify({
                    text: 'Rất tiếc, bạn đã không may mắn trong lần cược này, hãy cố gắng lần sau nhé!',
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "linear-gradient(to right, #ff6b6b, #ff0000)",
                    }
                }).showToast();
                reloadPage('#balance-container');
            });
            socket.on('disconnect', () => {
                console.log('disconnected from socket');
            });

            $('#form-submit-bet').submit(function (e) {
                e.preventDefault();
                const money = $(this).find('input[name="money"]').val();
                const choose = $('.chooseItem').map(function () {
                    return $(this).find('.state').attr('data-bet');
                }).get();
                $.ajax({
                    url: "{{ route('placebet') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        money: money,
                        choose: choose,
                        gameId: gameId
                    },
                    success: function (response) {
                        Toastify({
                            text: 'Đặt cược thành công',
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            style: {
                                background: "linear-gradient(to right, #00b09b, #96c93d)",
                            }
                        }).showToast();
                        $('#form-submit-bet').find('input[name="money"]').val('');
                        $('.chooseItem').removeClass('chooseItem');
                        $('.popup-bet').addClass('d-none');
                        $('#balance').text(response.balance);
                        reloadPage('#my_history');
                        reloadPage('#history_game');
                        reloadPage('#balance-container');
                    },
                    error: function (response) {
                        Toastify({
                            text: response.responseJSON.error,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            style: {
                                background: "linear-gradient(to right, #ff6b6b, #ff0000)",
                            }
                        }).showToast();
                    },
                    complete: function () {

                    }
                });
            });
        });
    </script>

@endsection