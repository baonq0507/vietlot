<x-filament-panels::page>
    <style>
        .text-center {
            text-align: center;
        }
        thead tr th span{
            justify-content: center !important;
        }
        #table-container{
            margin-top: 20px;
        }
        td {
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
                    Kết quả
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
                            @if (str_contains($itemChoose, 'total'))
                                <span class="badge bg-primary text-uppercase">Tổng 
                                    {{ substr($itemChoose, -1) === 't' ? 'Tài' : 
                                    (substr($itemChoose, -1) === 'x' ? 'Xỉu' : 
                                    (substr($itemChoose, -1) === 'c' ? 'Chẵn' : 
                                    (substr($itemChoose, -1) === 'l' ? 'Lẻ' : ''))) }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                </span>
                            @elseif (str_contains($itemChoose, 'bi'))
                                @php
                                    $bi = substr($itemChoose, 2, 1); // Get bi number
                                    $type = substr($itemChoose, -1); // Get type (l/x)
                                    $displayType = $type === 'l' ? 'Lẻ' : ($type === 'c' ? 'Chẵn' : ($type === 't' ? 'Tài' : 'Xỉu'));
                                @endphp
                                <span class="badge bg-primary text-uppercase">Bi {{ $bi }} {{ $displayType }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                </span>
                            @endif
                        @endforeach
                    </x-filament-tables::cell>
                    <x-filament-tables::cell class="text-center border" style="padding: 10px;">
                        {{ $userGame->result }}
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

    <div class="text-center">
        <p>Kết quả kèo hiện tại là: <span id="current-result"></span></p>
        <div id="action_change_result" style="margin-top: 20px;">
            <form action="" method="post" id="form_change_result" wire:submit.prevent="changeResult">
                <input type="text" name="result" id="result" style="width: 100px; height: 30px;" wire:model="result" placeholder="1,2,3,4,5">
                <button type="submit" style="width: 100px; height: 30px; background-color: #ccc; color: #000; border: none; border-radius: 5px; cursor: pointer;">Cập nhật</button>
                <button type="button" style="width: 100px; height: 30px; background-color: #ccc; color: #000; border: none; border-radius: 5px; cursor: pointer;">Làm mới</button>
            </form>
        </div>
    </div>

    {{-- table list game --}}
    <div id="table-container">
        <x-filament-tables::table class="border">
            <x-slot name="header">
                <x-filament-tables::header-cell style="text-align: center; border: 1px solid #e5e7eb;">
                    Kỳ
                </x-filament-tables::header-cell>
                <x-filament-tables::header-cell style="text-align: center; border: 1px solid #e5e7eb;">
                    Kết quả
                </x-filament-tables::header-cell>
                {{-- cập nhật kết quả --}}
                <x-filament-tables::header-cell style="text-align: center; border: 1px solid #e5e7eb;">
                    Cập nhật
                </x-filament-tables::header-cell>
                <x-filament-tables::header-cell style="text-align: center; border: 1px solid #e5e7eb;">
                    Thời gian
                </x-filament-tables::header-cell>
            </x-slot>

            @foreach ($listGame as $game)
                <x-filament-tables::row>
                    <x-filament-tables::cell class="text-center border" style="padding: 10px;">
                        {{ $game->code }}
                    </x-filament-tables::cell>
                    <x-filament-tables::cell class="text-center border" style="padding: 10px;">
                        {{ implode(',', $game->result) }}
                    </x-filament-tables::cell>
                    {{-- cập nhật kết quả --}}
                    <x-filament-tables::cell class="text-center border" style="padding: 10px;">
                        <form action="" method="post" id="form_change_result_{{ $game->id }}" wire:submit.prevent="changeResultGame({{ $game->id }})">
                            <input type="text" name="resultGame_{{ $game->id }}" id="resultGame_{{ $game->id }}" style="width: 100px; height: 30px;" wire:model="resultGame.{{ $game->id }}" placeholder="1,2,3,4,5">
                            <button type="submit" style="width: 100px; height: 30px; background-color: #ccc; color: #000; border: none; border-radius: 5px; cursor: pointer;">Cập nhật</button>
                        </form>
                    </x-filament-tables::cell>
                    <x-filament-tables::cell class="text-center border" style="padding: 10px;">
                        {{ $game->start_time }}
                    </x-filament-tables::cell>
                </x-filament-tables::row>
            @endforeach
        </x-filament-tables::table>
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
            socket.on('onGame-kenno3p', (data) => {
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
    

    var channel = pusher.subscribe('bet-kenno3p');
    channel.bind('onGame-kenno3p', function(data) {
        reloadTable();
    });
</script>
</x-filament-panels::page>
