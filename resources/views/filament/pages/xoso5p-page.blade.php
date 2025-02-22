<x-filament-panels::page>
    <style>
        .text-center {
            text-align: center;
        }

        thead tr th span {
            justify-content: center !important;
        }

        #table-container {
            margin-top: 20px;
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
    </style>
    <div>
        <h2 class="text-xl font-bold text-center">Set Kèo</h2>
        <h4 class="text-center">Kỳ : <span id="current-code">{{ $gameRunning->code }}</span></h4>
        <h4 class="text-center">Thời gian còn lại: <span id="diff-time">{{ $diffTime }}</span></h4>
    </div>

    <div id="table-container">
        <x-filament-tables::table class="border">
            <x-slot name="header">
                {{-- //id user --}}
                <x-filament-tables::header-cell style="text-align: center; border: 1px solid #e5e7eb;">
                    ID user
                </x-filament-tables::header-cell>
                <x-filament-tables::header-cell style="text-align: center; border: 1px solid #e5e7eb;">
                    Tên
                </x-filament-tables::header-cell>
                <x-filament-tables::header-cell style="text-align: center; border: 1px solid #e5e7eb;">
                    Số tiền
                </x-filament-tables::header-cell>
                <x-filament-tables::header-cell style="text-align: center; border: 1px solid #e5e7eb;">
                    Chọn
                </x-filament-tables::header-cell>
                <x-filament-tables::header-cell style="text-align: center; border: 1px solid #e5e7eb;">
                    Tổng tiền
                </x-filament-tables::header-cell>
                <x-filament-tables::header-cell style="text-align: center; border: 1px solid #e5e7eb;">
                    Thời gian
                </x-filament-tables::header-cell>
            </x-slot>

            @foreach ($userGames as $userGame)
            <x-filament-tables::row>
                <x-filament-tables::cell class="text-center border" style="padding: 10px;">
                    {{ $userGame->user->id }}
                </x-filament-tables::cell>
                <x-filament-tables::cell class="text-center border" style="padding: 10px;">
                    {{ $userGame->user->name }}
                </x-filament-tables::cell>
                <x-filament-tables::cell class="text-center border" style="padding: 10px;">
                    {{ $userGame->money }}
                </x-filament-tables::cell>
                <x-filament-tables::cell class="text-center border" style="padding: 10px;">
                    @foreach ($userGame->choose as $itemChoose)
                    @if (str_contains($itemChoose, 'de_'))
                    <span class="badge bg-primary text-uppercase">Đề:
                    </span>
                    @elseif (str_contains($itemChoose, 'lothuong_'))

                    <span class="badge bg-primary text-uppercase">Lô thường:
                    </span>
                    @elseif (str_contains($itemChoose, 'loxien2_'))
                    <span class="badge bg-primary text-uppercase">Lô xiên 2:
                    </span>
                    @elseif (str_contains($itemChoose, 'loxien3_'))
                    <span class="badge bg-primary text-uppercase">Lô xiên 3:
                    </span>
                    @elseif (str_contains($itemChoose, 'loxien4_'))
                    <span class="badge bg-primary text-uppercase">Lô xiên 4:
                    </span>
                    @endif
                    <span>
                        @php
                        $number = substr($itemChoose, strpos($itemChoose, '_') + 1);
                        @endphp
                        {{ $number }}
                    </span>
                    @if (!$loop->last)
                    ,
                    @endif
                    @endforeach
                </x-filament-tables::cell>
                <x-filament-tables::cell class="text-center border" style="padding: 10px;">
                    {{ $userGame->total_money }}
                </x-filament-tables::cell>
                <x-filament-tables::cell class="text-center border" style="padding: 10px;">
                    {{ $userGame->created_at }}
                </x-filament-tables::cell>
            </x-filament-tables::row>
            @endforeach
        </x-filament-tables::table>
    </div>


    <div id="table-container">
        <form wire:submit="changeResult">
            <table id="table-xsmb" class="table-result table table-bordered table-striped table-xsmb text-center" style="width: 100%;">
                <tbody>
                    <tr>
                        <th style="text-align: center; border: 1px solid #e5e7eb; width: 10%;">ĐB</th>
                        <td style="text-align: center; border: 1px solid #e5e7eb;">
                            <span id="mb_prize_0" class="special-prize div-horizontal text-danger">
                                <input type="text" wire:model="result.0.0" class="text-center" style="width: 15%;">
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: center; border: 1px solid #e5e7eb;">1</th>
                        <td style="text-align: center; border: 1px solid #e5e7eb;">
                            <span id="mb_prize_1" class="prize1 div-horizontal">
                                <input type="text" wire:model="result.1.0" class="text-center" style="width: 15%;">
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: center; border: 1px solid #e5e7eb;">2</th>
                        <td style="text-align: center; border: 1px solid #e5e7eb;">
                            <span id="mb_prize_2" class="prize2 div-horizontal">
                                <input type="text" wire:model="result.2.0" class="text-center" style="width: 25%;">
                            </span>
                            <span id="mb_prize_3" class="prize2 div-horizontal">
                                <input type="text" wire:model="result.2.1" class="text-center" style="width: 25%;">
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: center; border: 1px solid #e5e7eb;">3</th>
                        <td style="text-align: center; border: 1px solid #e5e7eb;">
                            <span id="mb_prize_4" class="prize3 div-horizontal">
                                <input type="text" wire:model="result.3.0" class="text-center" style="width: 40%;">
                            </span>
                            <span id="mb_prize_5" class="prize3 div-horizontal">
                                <input type="text" wire:model="result.3.1" class="text-center" style="width: 40%;">
                            </span>
                            <span id="mb_prize_6" class="prize3 div-horizontal">
                                <input type="text" wire:model="result.3.2" class="text-center" style="width: 40%;">
                            </span>
                            <span id="mb_prize_7" class="prize3 div-horizontal">
                                <input type="text" wire:model="result.3.3" class="text-center" style="width: 40%;">
                            </span>
                            <span id="mb_prize_8" class="prize3 div-horizontal">
                                <input type="text" wire:model="result.3.4" class="text-center" style="width: 40%;">
                            </span>
                            <span id="mb_prize_9" class="prize3 div-horizontal">
                                <input type="text" wire:model="result.3.5" class="text-center" style="width: 40%;">
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: center; border: 1px solid #e5e7eb;">4</th>
                        <td style="text-align: center; border: 1px solid #e5e7eb;">
                            <span id="mb_prize_10" class="prize4 div-horizontal">
                                <input type="text" wire:model="result.4.0" class="text-center" style="width: 50%;">
                            </span>
                            <span id="mb_prize_11" class="prize4 div-horizontal">
                                <input type="text" wire:model="result.4.1" class="text-center" style="width: 50%;">
                            </span>
                            <span id="mb_prize_12" class="prize4 div-horizontal">
                                <input type="text" wire:model="result.4.2" class="text-center" style="width: 50%;">
                            </span>
                            <span id="mb_prize_13" class="prize4 div-horizontal">
                                <input type="text" wire:model="result.4.3" class="text-center" style="width: 50%;">
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: center; border: 1px solid #e5e7eb;">5</th>
                        <td style="text-align: center; border: 1px solid #e5e7eb;">
                            <span id="mb_prize_14" class="prize5 div-horizontal">
                                <input type="text" wire:model="result.5.0" class="text-center" style="width: 40%;">
                            </span>
                            <span id="mb_prize_15" class="prize5 div-horizontal">
                                <input type="text" wire:model="result.5.1" class="text-center" style="width: 40%;">
                            </span>
                            <span id="mb_prize_16" class="prize5 div-horizontal">
                                <input type="text" wire:model="result.5.2" class="text-center" style="width: 40%;">
                            </span>
                            <span id="mb_prize_17" class="prize5 div-horizontal">
                                <input type="text" wire:model="result.5.3" class="text-center" style="width: 40%;">
                            </span>
                            <span id="mb_prize_18" class="prize5 div-horizontal">
                                <input type="text" wire:model="result.5.4" class="text-center" style="width: 40%;">
                            </span>
                            <span id="mb_prize_19" class="prize5 div-horizontal">
                                <input type="text" wire:model="result.5.5" class="text-center" style="width: 40%;">
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: center; border: 1px solid #e5e7eb;">6</th>
                        <td style="text-align: center; border: 1px solid #e5e7eb;">
                            <span id="mb_prize_20" class="prize6 div-horizontal">
                                <input type="text" wire:model="result.6.0" class="text-center" style="width: 40%;">
                            </span>
                            <span id="mb_prize_21" class="prize6 div-horizontal">
                                <input type="text" wire:model="result.6.1" class="text-center" style="width: 40%;">
                            </span>
                            <span id="mb_prize_22" class="prize6 div-horizontal">
                                <input type="text" wire:model="result.6.2" class="text-center" style="width: 40%;">
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: center; border: 1px solid #e5e7eb;">7</th>
                        <td style="text-align: center; border: 1px solid #e5e7eb;">
                            <span id="mb_prize_23" class="prize7 div-horizontal">
                                <input type="text" wire:model="result.7.0" class="text-center" style="width: 50%;">
                            </span>
                            <span id="mb_prize_24" class="prize7 div-horizontal">
                                <input type="text" wire:model="result.7.1" class="text-center" style="width: 50%;">
                            </span>
                            <span id="mb_prize_25" class="prize7 div-horizontal">
                                <input type="text" wire:model="result.7.2" class="text-center" style="width: 50%;">
                            </span>
                            <span id="mb_prize_26" class="prize7 div-horizontal">
                                <input type="text" wire:model="result.7.3" class="text-center" style="width: 50%;">
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary" style="
                margin-top: 10px; margin-bottom: 10px; background-color: #007bff; border-color: #007bff; padding: 10px 20px;
                color: white;
                ">Cập nhật kết quả</button>
                <button type="button" class="btn btn-primary" style="
                margin-top: 10px; margin-bottom: 10px; background-color: #007bff; border-color: #007bff; padding: 10px 20px;
                color: white;
                "
                    wire:click="randomResult">Ngẫu nhiên</button>
            </div>
        </form>
    </div>
    <select name="code" id="code" wire:change="changeGame($event.target.value)">
            @foreach ($listGame as $listGame)
            <option value="{{ $listGame->id }}" {{ $listGame->id == $game->id ? 'selected' : '' }}>Kỳ {{ $listGame->code }}</option>
            @endforeach
        </select>
    {{-- //select xem kết quả cũ --}}
    <div id="table-container">
       

        <table id="table-xsmb" class="table-result table table-bordered table-striped table-xsmb text-center" style="width: 100%;">
            <tbody>
                <tr>
                    <th style="text-align: center; border: 1px solid #e5e7eb; width: 10%; color: red;">ĐB</th>
                    <td style="text-align: center; border: 1px solid #e5e7eb; color: red;"><span id="mb_prize_0" class="special-prize div-horizontal text-danger">{{ $game ? $game->result[0][0] : '' }}</span></td>
                </tr>
                <tr>
                    <th style="text-align: center; border: 1px solid #e5e7eb;">1</th>
                    <td><span id="mb_prize_1" class="prize1 div-horizontal">{{ $game ? $game->result[1][0] : '' }}</span></td>
                </tr>
                <tr>
                    <th style="text-align: center; border: 1px solid #e5e7eb;">2</th>
                    <td style="text-align: center; border: 1px solid #e5e7eb;"><span id="mb_prize_2" class="prize2 div-horizontal">{{ $game ? $game->result[2][0] : '' }}</span><span id="mb_prize_3" class="prize2 div-horizontal">{{ $game ? $game->result[2][1] : '' }}</span></td>
                </tr>
                <tr>
                    <th style="text-align: center; border: 1px solid #e5e7eb;">3</th>
                    <td style="text-align: center; border: 1px solid #e5e7eb;"><span id="mb_prize_4" class="prize3 div-horizontal">{{ $game ? $game->result[3][0] : '' }}</span><span id="mb_prize_5" class="prize3 div-horizontal">{{ $game ? $game->result[3][1] : '' }}</span><span id="mb_prize_6" class="prize3 div-horizontal">{{ $game ? $game->result[3][2] : '' }}</span><span id="mb_prize_7" class="prize3 div-horizontal">{{ $game ? $game->result[3][3] : '' }}</span><span id="mb_prize_8" class="prize3 div-horizontal">{{ $game ? $game->result[3][4] : '' }}</span><span id="mb_prize_9" class="prize3 div-horizontal">{{ $game ? $game->result[3][5] : '' }}</span></td>
                </tr>
                <tr>
                    <th style="text-align: center; border: 1px solid #e5e7eb;">4</th>
                    <td style="text-align: center; border: 1px solid #e5e7eb;"><span id="mb_prize_10" class="prize4 div-horizontal">{{ $game ? $game->result[4][0] : '' }}</span><span id="mb_prize_11" class="prize4 div-horizontal">{{ $game ? $game->result[4][1] : '' }}</span><span id="mb_prize_12" class="prize4 div-horizontal">{{ $game ? $game->result[4][2] : '' }}</span><span id="mb_prize_13" class="prize4 div-horizontal">{{ $game ? $game->result[4][3] : '' }}</span></td>
                </tr>
                <tr>
                    <th style="text-align: center; border: 1px solid #e5e7eb;"  >5</th>
                    <td style="text-align: center; border: 1px solid #e5e7eb;"><span id="mb_prize_14" class="prize5 div-horizontal">{{ $game ? $game->result[5][0] : '' }}</span><span id="mb_prize_15" class="prize5 div-horizontal">{{ $game ? $game->result[5][1] : '' }}</span><span id="mb_prize_16" class="prize5 div-horizontal">{{ $game ? $game->result[5][2] : '' }}</span><span id="mb_prize_17" class="prize5 div-horizontal">{{ $game ? $game->result[5][3] : '' }}</span><span id="mb_prize_18" class="prize5 div-horizontal">{{ $game ? $game->result[5][4] : '' }}</span><span id="mb_prize_19" class="prize5 div-horizontal">{{ $game ? $game->result[5][5] : '' }}</span></td>
                </tr>
                <tr>
                    <th style="text-align: center; border: 1px solid #e5e7eb;">6</th>
                    <td style="text-align: center; border: 1px solid #e5e7eb;"><span id="mb_prize_20" class="prize6 div-horizontal">{{ $game ? $game->result[6][0] : '' }}</span><span id="mb_prize_21" class="prize6 div-horizontal">{{ $game ? $game->result[6][1] : '' }}</span><span id="mb_prize_22" class="prize6 div-horizontal">{{ $game ? $game->result[6][2] : '' }}</span></td>
                </tr>
                <tr>
                    <th style="text-align: center; border: 1px solid #e5e7eb;">7</th>
                    <td style="text-align: center; border: 1px solid #e5e7eb;"><span id="mb_prize_23" class="prize7 div-horizontal">{{ $game ? $game->result[7][0] : '' }}</span><span id="mb_prize_24" class="prize7 div-horizontal">{{ $game ? $game->result[7][1] : '' }}</span><span id="mb_prize_25" class="prize7 div-horizontal">{{ $game ? $game->result[7][2] : '' }}</span><span id="mb_prize_26" class="prize7 div-horizontal">{{ $game ? $game->result[7][3] : '' }}</span></td>
                </tr>
            </tbody>
        </table>
    </div>




    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.socket.io/4.8.1/socket.io.min.js"
        integrity="sha384-mkQ3/7FUtcGyoppY6bz/PORYoGqOl7/aSUMn2ymDOJcapfS6PHqxhRTMh1RR0Q6+"
        crossorigin="anonymous"></script>
    <script>
        let lastGameId = null;
        let lastCode = null;
        const socket = io("{{ env('SOCKET_URL') }}");
        socket.on('connect', () => {
            console.log('Connected to server');
            socket.on('onGame-xoso5p', (data) => {
                $('#current-code').text(data.code);
                $('#current-result').text(data.result.slice(1).join(','));

                // Chỉ cập nhật khi có game mới
                if (lastGameId !== data.id) {
                    lastGameId = data.id;
                    @this.changeGameId(data.id);
                    console.log(data.id);
                }

                const endTime = new Date(data.end_time);
                const now = new Date();
                const diff = endTime - now;

                // Đảm bảo không có số âm
                const diffInSeconds = Math.max(0, Math.floor(diff / 1000));

                const hour = Math.floor(diffInSeconds / 3600) < 10 ? '0' + Math.floor(diffInSeconds / 3600) : Math.floor(diffInSeconds / 3600);
                const minute = Math.floor((diffInSeconds % 3600) / 60) < 10 ? '0' + Math.floor((diffInSeconds % 3600) / 60) : Math.floor((diffInSeconds % 3600) / 60);
                const second = Math.floor(diffInSeconds % 60) < 10 ? '0' + Math.floor(diffInSeconds % 60) : Math.floor(diffInSeconds % 60);


                const diffTime = minute + ':' + second;
                $('#diff-time').text(diffTime);
            });
        });
    </script>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: 'ap1',
            encrypted: true
        });

        //reload table
        function reloadTable() {
            $.get(window.location.href, function(data) {
                const parser = new DOMParser();
                const doc = parser.parseFromString(data, 'text/html');
                const newTable = doc.querySelector('#table-container').innerHTML;
                document.querySelector('#table-container').innerHTML = newTable;
            });
        }


        var channel = pusher.subscribe('bet-xoso5p');
        channel.bind('onGame-xoso5p', function(data) {
            reloadTable();
        });
    </script>
</x-filament-panels::page>