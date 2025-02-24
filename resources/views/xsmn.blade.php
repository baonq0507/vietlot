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
        font-size: 14px;
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
        padding: 10px;
    }

    .popup-bet {
        background: #fff;
        box-shadow: 0 .05333rem .10667rem #c5c5da40;
        max-width: 540px;
        padding: 10px;
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

    .table>:not(caption)>*>* {
        padding: 1rem !important;
    }

    .table-result td {
        align-items: center;
        display: flex;
        flex-flow: row wrap;
        justify-content: center;
    }


    .prize1,
    .special-prize {
        float: left;
        font-weight: 700;
        width: 100%;
    }

    .prize2,
    .prize3 {
        float: left;
        font-weight: 700;
    }

    .prize2 {
        width: 50%;
    }

    .prize3 {
        width: 33.3%;
    }

    .prize4 {
        float: left;
        font-weight: 700;
        width: 25%;
    }

    .prize5,
    .prize6,
    .prize7,
    .prize8 {
        float: left;
        font-weight: 700;
    }

    .prize5,
    .prize6,
    .prize8 {
        width: 33.3%;
    }

    .prize7 {
        width: 25%;
    }

    .prize1,
    .prize2,
    .prize3,
    .prize4,
    .prize5,
    .prize6,
    .prize7,
    .prize8 {
        font-size: 16px;
        padding: 10px;
    }

    .result_item {
        background: red;
        padding: 5px 7px;
        color: #fff;
        border-radius: 50%;
        font-size: 14px;
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

    .nav-pills {
        border-radius: 15px;
        justify-content: space-around;
        padding: 8px;
        color: #000;

    }

    .nav-pills .nav-link {
        color: #eee;
        background-color: #e8e7e8;
        color: #333;
        padding: 5px !important;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        background-color: red;
        color: #fff;
    }

    .bacang {
        border-bottom: 1px solid #b7b7b7;
        margin-bottom: .3rem;
        padding-bottom: .3rem;
    }

    .tab-bacang>li {
        background: none;
        border: 1px solid #ffc107;
        font-size: 12px;
        line-height: 12px;
        margin: 0 .05rem;
        padding: 10px;
    }

    .redball {
        background: red;
        border-radius: 100%;
        color: #fff;
        font-size: 14px;
        height: 30px;
        line-height: 30px;
        margin: 0 1px;
        text-align: center;
        width: 30px;
    }

    .ball_xs {
        display: flex;
    }
</style>
@endsection
@section('title', 'Xổ số Miền Nam')
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
                    document.getElementById('toggle-balance').addEventListener('click', function() {
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
                    <p class="card-title" style="font-size: 14px; color: #8b8b8b;">
                        XSMN ngày {{ $data ? $data['turnNum'] : '' }}
                    </p>
                    <div class="count">
                        <h5 style="font-size: 14px; color: #477bff;">Trả kết quả lúc: 19:00</h5>
                    </div>
                    <div class="mt-2">
                        <button class="btn-mini btn" style="border: 1px solid #ffc107;" data-bs-toggle="modal" data-bs-target="#modal-history">
                            Lịch sử của bạn
                        </button>
                    </div>
                </div>
                <div class="col-6 text-center" id="last-game">
                    <p class="card-title">Kết quả ngày {{ $data ? $data['issueList'][0]['turnNum'] : '' }}</p>
                    <div class="ball_xs" style="margin: 0.3rem auto; justify-content: center;">
                        @foreach(explode(',', $data['issueList'][0]['openNum']) as $number)
                        <div class="redball">{{ $number }}</div>
                        @endforeach
                    </div>
                    <button class="btn-mini btn" data-bs-toggle="modal" data-bs-target="#modal-last-game">
                        chi tiết kết quả
                    </button>
                </div>
            </div>
        </div>
    </div>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active btn-sm" id="pills-lo-tab" data-bs-toggle="pill" data-bs-target="#pills-lo" type="button" role="tab" aria-controls="pills-lo" aria-selected="true">Lô</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link btn-sm" id="pills-ba_cang-tab" data-bs-toggle="pill" data-bs-target="#pills-ba_cang" type="button" role="tab" aria-controls="pills-ba_cang" aria-selected="false">Ba càng</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link btn-sm" id="pills-de-tab" data-bs-toggle="pill" data-bs-target="#pills-de" type="button" role="tab" aria-controls="pills-de" aria-selected="false">Đề</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link btn-sm" id="pills-lo_xien2-tab" data-bs-toggle="pill" data-bs-target="#pills-lo_xien2" type="button" role="tab" aria-controls="pills-lo_xien2" aria-selected="false">Lô xiên 2</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link btn-sm" id="pills-lo_xien3-tab" data-bs-toggle="pill" data-bs-target="#pills-lo_xien3" type="button" role="tab" aria-controls="pills-lo_xien3" aria-selected="false">Lô xiên 3</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link btn-sm" id="pills-lo_xien4-tab" data-bs-toggle="pill" data-bs-target="#pills-lo_xien4" type="button" role="tab" aria-controls="pills-lo_xien4" aria-selected="false">Lô xiên 4</button>
        </li>
    </ul>
    <div class="popup-bet">
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
                                <span style="color: red;" id="choose-item">0</span> ,
                            </span>
                            <span>Tổng tiền cược
                                <span style="color: red;" id="total-money">0 đ</span>
                            </span>

                        </div>
                      
                    </div>
                    <div>
                        <p>Tỉ lệ cược 1: <span id="rate-bet"> {{ $settingXoso->lo_thuong }}</span></p>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-danger w-100">Đặt lệnh</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div style="margin-bottom: 100px; min-height: 60vh;">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-lo" role="tabpanel" aria-labelledby="pills-lo-tab">
                <div class="text_choose_center">
                    <div class="bet_state">Chọn Số</div>
                    <div class="state_choose">
                        @for($i = 0; $i <= 99; $i++)
                            <div class="choose_xs" data-bet="{{ 'lothuong_' . ($i < 10 ? '0'.$i : ($i < 100 ? $i : $i)) }}">{{ $i < 10 ? '0'.$i : ($i < 100 ? $i : $i) }}</div>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-ba_cang" role="tabpanel" aria-labelledby="pills-ba_cang-tab">
                <ul class="nav nav-pills mb-3 tab-bacang" id="pills-ba_cang-tab" role="tablist">
                    @foreach ([0, 100, 200, 300, 400, 500, 600, 700, 800, 900] as $start)
                    <li class="nav-item" role="presentation" style="padding: 5px 2px; border-radius: 7px;" data-bs-toggle="pill" data-bs-target="#pills-{{ $start }}" aria-controls="pills-{{ $start }}" aria-selected="{{ $start == 0 ? 'true' : 'false' }}">
                        <div class="line-bacang" type="button" role="tab">
                            {{ $start < 10 ? '00'.$start : ($start < 100 ? '0'.$start : $start) }}
                            <br>
                            <span class="line-bacang">-----</span>
                            <br>
                            {{ $start + 99 < 10 ? '00'.($start + 99) : ($start + 99 < 100 ? '0'.($start + 99) : ($start + 99)) }}
                        </div>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="pills-ba_cang-tab">
                    @foreach ([0, 100, 200, 300, 400, 500, 600, 700, 800, 900] as $start)
                    <div class="tab-pane fade {{ $start == 0 ? 'show active' : '' }}" id="pills-{{ $start }}" role="tabpanel" aria-labelledby="pills-{{ $start }}-tab">
                        <div class="text_choose_center">
                            <div class="bet_state">Chọn Số</div>
                            <div class="state_choose">
                                @for ($i = $start; $i <= $start + 99; $i++)
                                    <div id="{{ $i }}" class="choose_xs" data-bet="{{ 'bacang_' . ($i < 10 ? '00'.$i : ($i < 100 ? '0'.$i : $i)) }}">{{ $i < 10 ? '00'.$i : ($i < 100 ? '0'.$i : $i) }}</div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="pills-de" role="tabpanel" aria-labelledby="pills-de-tab">
                <div class="text_choose_center">
                    <div class="bet_state">Chọn Số</div>
                    <div class="state_choose">
                        @for($i = 0; $i <= 99; $i++)
                            <div class="choose_xs" data-bet="{{ 'de_' . ($i < 10 ? '0'.$i : ($i < 100 ? '0'.$i : $i)) }}">{{ $i < 10 ? '0'.$i : ($i < 100 ? $i : $i) }}</div>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-lo_xien2" role="tabpanel" aria-labelledby="pills-lo_xien2-tab">
                <div class="text_choose_center">
                    <div class="bet_state">Chọn Số</div>
                    <div class="state_choose">
                        @for($i = 0; $i <= 99; $i++)
                        <div class="choose_xs" data-bet="{{ 'loxien2_' . ($i < 10 ? '0'.$i : ($i < 100 ? $i : $i)) }}">{{ $i < 10 ? '0'.$i : ($i < 100 ? $i : $i) }}</div>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-lo_xien3" role="tabpanel" aria-labelledby="pills-lo_xien3-tab">
                <div class="text_choose_center">
                    <div class="bet_state">Chọn Số</div>
                    <div class="state_choose">
                        @for($i = 0; $i <= 99; $i++)
                            <div class="choose_xs" data-bet="{{ 'loxien3_' . ($i < 10 ? '0'.$i : ($i < 100 ? $i : $i)) }}">{{ $i < 10 ? '0'.$i : ($i < 100 ? $i : $i) }}</div>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-lo_xien4" role="tabpanel" aria-labelledby="pills-lo_xien4-tab">
                <div class="text_choose_center">
                    <div class="bet_state">Chọn Số</div>
                    <div class="state_choose">
                        @for($i = 0; $i <= 99; $i++)
                            <div class="choose_xs" data-bet="{{ 'loxien4_' . ($i < 10 ? '0'.$i : ($i < 100 ? $i : $i)) }}">{{ $i < 10 ? '0'.$i : ($i < 100 ? $i : $i) }}</div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
</div>



<div class="modal fade" id="modal-history" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center" style="background-color: #00b977; text-align: center;">
                <h6 class="modal-title text-white text-center" id="modal-play-title">Lịch sử tham gia</h6>
            </div>
            <div class="modal-body">
                <div class="popup-content">
                    <div id="my_history">
                        @foreach ($myHistory as $item)
                        <div class="row border-bottom py-3">
                            <div class="col-6">
                                <p class="mb-0 text-muted">
                                    <span>Xúc xắc 5 phút</span>
                                    <span
                                        class="bage {{ $item->result == 'win' ? 'bg-success' : 'bg-danger' }} text-white p-1 rounded-pill"
                                        style="font-size: 12px;">{{ $item->result == null ? 'Chờ kết quả' : ($item->result == 'win' ? 'Thắng' : 'Thua') }}</span>
                                </p>
                                <p class="mb-0 text-muted" style="font-size: 12px;">
                                    <span>Phiên cược: {{ $item->game->code }}</span>
                                </p>
                                <p class="mb-0 text-muted" style="font-size: 12px;">
                                    <span>Chọn
                                        @foreach ($item->choose as $itemChoose)
                                        @if(str_contains($itemChoose, 'de'))
                                        <span class="badge bg-primary text-uppercase">Đề {{ substr($itemChoose, -3) }}</span>
                                        @elseif(str_contains($itemChoose, 'lothuong'))
                                        <span class="badge bg-primary text-uppercase">Lô thường {{ substr($itemChoose, -3) }}</span>
                                        @elseif(str_contains($itemChoose, 'loxien2'))
                                        <span class="badge bg-primary text-uppercase">Lô xiên 2 {{ substr($itemChoose, -3) }}</span>
                                        @elseif(str_contains($itemChoose, 'loxien3'))
                                        <span class="badge bg-primary text-uppercase">Lô xiên 3 {{ substr($itemChoose, -3) }}</span>
                                        @elseif(str_contains($itemChoose, 'loxien4'))
                                        <span class="badge bg-primary text-uppercase">Lô xiên 4 {{ substr($itemChoose, -3) }}</span>
                                        @elseif(str_contains($itemChoose, 'db'))
                                        <span class="badge bg-primary text-uppercase">Đặc biệt {{ substr($itemChoose, -3) }}</span>
                                        @elseif(str_contains($itemChoose, 'bacang'))
                                        <span class="badge bg-primary text-uppercase">Ba càng {{ substr($itemChoose, -3) }}</span>
                                        @endif
                                        @endforeach
                                    </span>
                                </p>
                            </div>
                            <div class="col-6 text-end">
                                <p class="mb-0 text-muted" style="font-size: 12px;">
                                    <span>{{ number_format($item->money, 2, ',', '.') }} $</span>
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
            <div class="modal-footer justify-content-center">
                <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-danger w-25"
                    style="border-radius: 15px; background-color: #00b977;">Đóng</button>
            </div>
        </div>

    </div>
</div>
</div>
</div>



<div class="modal fade" id="modal-last-game" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- <div class="modal-header justify-content-center" style="background-color: #00b977; text-align: center;">
                <h6 class="modal-title text-white text-center" id="modal-play-title">Kết quả phiên {{ $lastGame ? $lastGame->code : '' }}</h6>
            </div> -->
            <div class="modal-body">
                <div class="popup-content" style="padding: 0px;">
                    <table id="table-xsmb" class="table-result table table-bordered table-striped table-xsmb text-center">
                        <tbody>
                            <tr>
                                <th style="width: 10%;">ĐB</th>
                                <td><span id="mb_prize_0" class="special-prize div-horizontal text-danger">{{ $result ? $result[0][0] : '' }}</span></td>
                            </tr>
                            <tr>
                                <th>1</th>
                                <td><span id="mb_prize_1" class="prize1 div-horizontal">{{ $result ? $result[1][0] : '' }}</span></td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <td><span id="mb_prize_2" class="prize2 div-horizontal">{{ $result ? $result[2][0] : '' }}</span></td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <td><span id="mb_prize_4" class="prize3 div-horizontal">{{ $result ? $result[3][0] : '' }}</span><span id="mb_prize_5" class="prize3 div-horizontal">{{ $result ? $result[3][1] : '' }}</span></td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <td><span id="mb_prize_10" class="prize4 div-horizontal">{{ $result ? $result[4][0] : '' }}</span>
                                <span id="mb_prize_11" class="prize4 div-horizontal">{{ $result ? $result[4][1] : '' }}</span>
                                <span id="mb_prize_12" class="prize4 div-horizontal">{{ $result ? $result[4][2] : '' }}</span>
                                <span id="mb_prize_13" class="prize4 div-horizontal">{{ $result ? $result[4][3] : '' }}</span>
                                <span id="mb_prize_14" class="prize4 div-horizontal">{{ $result ? $result[4][4] : '' }}</span>
                                <span id="mb_prize_15" class="prize4 div-horizontal">{{ $result ? $result[4][5] : '' }}</span>
                                <span id="mb_prize_16" class="prize4 div-horizontal">{{ $result ? $result[4][6] : '' }}</span>
                            </td>
                            </tr>
                            <tr>
                                <th>5</th>
                                <td><span id="mb_prize_14" class="prize5 div-horizontal">{{ $result ? $result[5][0] : '' }}</span></td>
                            </tr>
                            <tr>
                                <th>6</th>
                                <td><span id="mb_prize_20" class="prize6 div-horizontal">{{ $result ? $result[6][0] : '' }}</span><span id="mb_prize_21" class="prize6 div-horizontal">{{ $result ? $result[6][1] : '' }}</span><span id="mb_prize_22" class="prize6 div-horizontal">{{ $result ? $result[6][2] : '' }}</span></td>
                            </tr>
                            <tr>
                                <th>7</th>
                                <td><span id="mb_prize_23" class="prize7 div-horizontal">{{ $result ? $result[7][0] : '' }}</span></td>
                            </tr>
                            <tr>
                                <th>8</th>
                                <td><span id="mb_prize_23" class="prize7 div-horizontal">{{ $result ? $result[8][0] : '' }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-danger w-25"
                    style="border-radius: 15px; background-color: #00b977;">Đóng</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script src="https://cdn.socket.io/4.8.1/socket.io.min.js"
    integrity="sha384-mkQ3/7FUtcGyoppY6bz/PORYoGqOl7/aSUMn2ymDOJcapfS6PHqxhRTMh1RR0Q6+"
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        function reloadPage(element) {

            setTimeout(() => {
                $.get(window.location.href, function(data) {
                    if (typeof element === 'string') {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, 'text/html');
                        const newTable = doc.querySelector(element).innerHTML;
                        document.querySelector(element).innerHTML = newTable;
                    } else if (typeof element === 'array') {
                        element.forEach(item => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(data, 'text/html');
                            const newTable = doc.querySelector(item).innerHTML;
                            document.querySelector(item).innerHTML = newTable;
                        });
                    }
                });
            }, 1000);
        }
        const formatMoney = (money) => {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(money).replace('$', '$');
        }
        $('.choose_xs').click(function() {
            $(this).toggleClass('chooseItem');
            var chooseItem = $('.chooseItem').length;
            $('#choose-item').text(chooseItem);
            var result = $(this).data('result');

            const money = $('#money').val() ? parseInt($('#money').val()) : 0;
            $('#total-money').text(formatMoney(chooseItem * money));
        });

        $('#money').on('input', function() {
            const money = $(this).val() ? parseInt($(this).val()) : 0;
            $('#total-money').text(formatMoney($(".chooseItem").length * money));
        });

        const socket = io("{{ env('SOCKET_URL') }}", {
            withCredentials: true,
            transports: ['websocket', 'polling', 'flashsocket'],
        });
        let gameId = "{{ $game->id }}";
        let codeGame = "{{ $game->code }}";
        socket.on('connect', () => {
            let lastCode = '';
            // socket.on(`onGame-xoso3p`, (data) => {
            //     // Only update if code has changed
            //     if (data.code !== lastCode) {
            //         $('#code-game').text(data.code);
            //         codeGame = data.code;
            //         gameId = data.id;
            //         lastCode = data.code;
            //         reloadPage('#last-game');
            //     }

            //     const endTime = new Date(data.end_time);
            //     const now = new Date();
            //     const diff = endTime - now;

            //     // Đảm bảo không có số âm
            //     const diffInSeconds = Math.max(0, Math.floor(diff / 1000));

            //     const hour = Math.floor(diffInSeconds / 3600);
            //     const minute = Math.floor((diffInSeconds % 3600) / 60);
            //     const totalSeconds = diffInSeconds % 60;
            //     const second = Math.floor(totalSeconds / 10);
            //     const secondHidden = totalSeconds % 10;

            //     $('#hour').text(hour);
            //     $('#minute').text(minute);
            //     $('#second').text(second);
            //     $('#second-hidden').text(secondHidden);

            //     // Chỉ quay khi thực sự hết thời gian
            //     if (diffInSeconds <= 0) {
            //         const result = data.result.slice(-3);
            //         // startJackpot(result.join(''));
            //     }
            // });
        });
        let userId = "{{ auth()->user()->id }}";

        socket.on('disconnect', () => {
            console.log('disconnected from socket');
        });

        $('#pills-tab .nav-link').on('shown.bs.tab', function() {
            console.log($(this).attr('id'));
            var selectedTab = $(this).attr('id');
            switch(selectedTab) {
                case 'pills-lo-tab':
                    $('#rate-bet').text('{{ $settingXoso->lo_thuong }}');
                    break;
                case 'pills-ba_cang-tab':
                    $('#rate-bet').text('{{ $settingXoso->ba_cang }}');
                    break;
                case 'pills-de-tab':
                    $('#rate-bet').text('{{ $settingXoso->db }}');
                    break;
                case 'pills-lo_xien2-tab':
                    $('#rate-bet').text('{{ $settingXoso->lo_xien_2 }}');
                    break;
                case 'pills-lo_xien3-tab':
                    $('#rate-bet').text('{{ $settingXoso->lo_xien_3 }}');
                    break;
                case 'pills-lo_xien4-tab':
                    $('#rate-bet').text('{{ $settingXoso->lo_xien_4 }}');
                    break;
            }
        });
        

        $('#form-submit-bet').submit(function(e) {
            e.preventDefault();
            const money = $(this).find('input[name="money"]').val();
            const choose = $('.chooseItem').map(function() {
                return $(this).data('bet');
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
                success: function(response) {
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
                    reloadPage('#my_history');
                    reloadPage('#balance-container');
                },
                error: function(response) {
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
                complete: function() {

                }
            });
        });
    });
</script>
@endsection