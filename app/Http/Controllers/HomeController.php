<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserGame;
use App\Models\GameKenno;
use App\Models\SettingKenno;
use App\Models\SettingXx;
use App\Models\SettingXoso;
use Pusher\Pusher;
use App\Models\Notification;
use App\Models\Banks;
use App\Models\Transaction;
use App\Models\UserBank;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function notification()
    {
        $notifications = Notification::where('status', 'show')->get();
        return view('notification', compact('notifications'));
    }
    public function recharge()
    {
        $bank = Banks::where('status', 'show')->first();
        return view('recharge', compact('bank'));
    }
    public function rechargePost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'bank_id' => 'required',
        ], [
            'amount.required' => 'Số tiền không được để trống',
            'bank_id.required' => 'Ngân hàng không được để trống',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
        $setting = Setting::first();
        if ($request->amount < $setting->min_deposit || $request->amount > $setting->max_deposit) {
            return response()->json(['error' => 'Số tiền không hợp lệ'], 422);
        }

        Transaction::create([
            'user_id' => Auth::user()->id,
            'bank_id' => $request->bank_id,
            'amount' => $request->amount,
            'status' => 'pending',
            'type' => 'deposit',
            'description' => 'Nạp tiền',
        ]);
        return response()->json(['message' => 'Thành công']);
    }

    public function withdraw()
    {
        $userBanks = UserBank::where('user_id', Auth::user()->id)->get();
        return view('withdraw', compact('userBanks'));
    }

    public function withdrawPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'bank_id' => 'required',
        ], [
            'amount.required' => 'Số tiền không được để trống',
            'bank_id.required' => 'Ngân hàng không được để trống',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
        $user = User::find(Auth::user()->id);
        if ($user->balance < $request->amount) {
            return response()->json(['error' => 'Số tiền không đủ'], 422);
        }
        $setting = Setting::first();
        if ($request->amount < $setting->min_withdraw || $request->amount > $setting->max_withdraw) {
            return response()->json(['error' => 'Số tiền không hợp lệ'], 422);
        }

        $user->balance -= $request->amount;
        $user->save();
        Transaction::create([
            'user_id' => Auth::user()->id,
            'bank_id' => $request->bank_id,
            'amount' => $request->amount,
            'status' => 'pending',
            'type' => 'withdraw',
            'description' => 'Rút tiền',
        ]);
        return response()->json(['message' => 'Thành công']);
    }
    public function profile()
    {
        return view('profile');
    }

    public function historyplay()
    {
        $userGames = UserGame::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
        return view('historyplay', compact('userGames'));
    }

    public function historyadd()
    {
        $transactions = Transaction::where('user_id', Auth::user()->id)
            ->where('type', 'deposit')
            ->orderBy('id', 'desc')
            ->get();
        return view('historyadd', compact('transactions'));
    }

    public function historyget()
    {
        $transactions = Transaction::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->where('type', 'withdraw')
            ->get();
        return view('historyget', compact('transactions'));
    }

    public function addbank()
    {
        $userBanks = UserBank::where('user_id', Auth::user()->id)->get();
        return view('addbank', compact('userBanks'));
    }

    public function addbankPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required',
            'bank_number' => 'required',
            'bank_owner' => 'required',
        ], [
            'bank_name.required' => 'Tên ngân hàng không được để trống',
            'bank_number.required' => 'Số tài khoản không được để trống',
            'bank_owner.required' => 'Tên chủ tài khoản không được để trống',
        ]);
        $user = User::find(Auth::user()->id);

        $user->userBanks()->create([
            'bank_name' => $request->bank_name,
            'bank_number' => $request->bank_number,
            'bank_owner' => $request->bank_owner,
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
        return response()->json(['message' => 'Thành công']);
    }

    public function password()
    {
        return view('password');
    }

    public function passwordPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ], [
            'old_password.required' => 'Mật khẩu cũ không được để trống',
            'new_password.required' => 'Mật khẩu mới không được để trống',
            'confirm_password.required' => 'Nhập lại mật khẩu mới không được để trống',
            'confirm_password.same' => 'Nhập lại mật khẩu mới không khớp',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
        $user = User::find(Auth::user()->id);
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['error' => 'Mật khẩu cũ không chính xác'], 422);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        Auth::logout();

        return response()->json(['message' => 'Thành công']);
    }

    public function kenno5p()
    {
        $lastGame = GameKenno::where('type', 'kenno5p')
            ->where('status', 'completed')
            ->orderBy('id', 'desc')->first();

        $historyGame = GameKenno::orderBy('id', 'desc')
            ->where('type', 'kenno5p')
            ->where('status', 'completed')
            ->limit(10)
            ->get();
        $myHistory = UserGame::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->whereHas('game', function ($query) {
                $query->where('type', 'kenno5p');
            })
            ->limit(10)
            ->get();

        $settingKenno = SettingKenno::where('type', 'kenno5p')->first();
        return view('kenno5p', compact('lastGame', 'historyGame', 'myHistory', 'settingKenno'));
    }

    public function kenno3p()
    {
        $lastGame = GameKenno::where('type', 'kenno3p')
            ->where('status', 'completed')
            ->orderBy('id', 'desc')->first();

        $historyGame = GameKenno::orderBy('id', 'desc')
            ->where('type', 'kenno3p')
            ->where('status', 'completed')
            ->limit(10)
            ->get();
        $myHistory = UserGame::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->whereHas('game', function ($query) {
                $query->where('type', 'kenno3p');
            })
            ->limit(10)
            ->get();

        $settingKenno = SettingKenno::where('type', 'kenno3p')->first();
        return view('kenno3p', compact('lastGame', 'historyGame', 'myHistory', 'settingKenno'));
    }

    public function kenno1p()
    {
        // lấy phiên đã xong gần nhất
        $lastGame = GameKenno::where('type', 'kenno1p')
            ->where('status', 'completed')
            ->orderBy('id', 'desc')->first();

        $historyGame = GameKenno::orderBy('id', 'desc')
            ->where('type', 'kenno1p')
            ->where('status', 'completed')
            ->limit(10)
            ->get();
        $myHistory = UserGame::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->whereHas('game', function ($query) {
                $query->where('type', 'kenno1p');
            })
            ->limit(10)
            ->get();

        $settingKenno = SettingKenno::where('type', 'kenno1p')->first();
        return view('kenno1p', compact('lastGame', 'historyGame', 'myHistory', 'settingKenno'));
    }

    public function placebet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'money' => 'required',
            'choose' => 'required|array',
            'gameId' => 'required|exists:game_kenno,id',
        ], [
            'money.required' => 'Số tiền không được để trống',
            'choose.required' => 'Chọn không được để trống',
            'gameId.required' => 'Trò chơi không được để trống',
            'gameId.exists' => 'Trò chơi không tồn tại',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
        $game = GameKenno::find($request->gameId);
        if ($game->status != 'running') {
            return response()->json(['error' => 'Trò chơi đã kết thúc'], 422);
        }
        $totalMoney = $request->money * count($request->choose);
        $setting = Setting::first();
        if ($totalMoney < $setting->min_bet || $totalMoney > $setting->max_bet) {
            return response()->json(['error' => 'Số tiền không hợp lệ'], 422);
        }
        $user = User::find(Auth::user()->id);
        if ($user->balance < $totalMoney) {
            return response()->json(['error' => 'Số tiền không đủ'], 422);
        }

        $user->balance -= $totalMoney;
        $user->save();
        UserGame::create([
            'user_id' => $user->id,
            'game_id' => $request->gameId,
            'money' => $request->money,
            'choose' => $request->choose,
            'status' => 'pending',
            'total_money' => $totalMoney,
            'total_win' => 0,
        ]);
        $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
        ]);
        $pusher->trigger('bet-' . $game->type, 'onGame-' . $game->type, ['id' => $request->gameId]);
        return response()->json(['message' => 'Thành công', 'totalMoney' => $totalMoney, 'balance' => number_format($user->balance, 2, ',', '.')]);
    }

    public function xucxac3()
    {
        $lastGame = GameKenno::where('type', 'xucxac3p')
            ->where('status', 'completed')
            ->orderBy('id', 'desc')->first();

        $historyGame = GameKenno::orderBy('id', 'desc')
            ->where('type', 'xucxac3p')
            ->where('status', 'completed')
            ->limit(10)
            ->get();
        $myHistory = UserGame::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->whereHas('game', function ($query) {
                $query->where('type', 'xucxac3p');
            })
            ->limit(10)
            ->get();

        $settingXx = SettingXx::where('type', 'xucxac3p')->first();
        return view('xucxac3', compact('lastGame', 'historyGame', 'myHistory', 'settingXx'));
    }

    public function xucxac5()
    {
        $lastGame = GameKenno::where('type', 'xucxac5p')
            ->where('status', 'completed')
            ->orderBy('id', 'desc')->first();

        $historyGame = GameKenno::orderBy('id', 'desc')
            ->where('type', 'xucxac5p')
            ->where('status', 'completed')
            ->limit(10)
            ->get();
        $myHistory = UserGame::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->whereHas('game', function ($query) {
                $query->where('type', 'xucxac5p');
            })
            ->limit(10)
            ->get();

        $settingXx = SettingXx::where('type', 'xucxac5p')->first();
        return view('xucxac5', compact('lastGame', 'historyGame', 'myHistory', 'settingXx'));
    }


    public function xoso3p()
    {
        $lastGame = GameKenno::where('type', 'xoso3p')
            ->where('status', 'completed')
            ->orderBy('id', 'desc')->first();

        $historyGame = GameKenno::orderBy('id', 'desc')
            ->where('type', 'xoso3p')
            ->where('status', 'completed')
            ->limit(10)
            ->get();
        $myHistory = UserGame::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->whereHas('game', function ($query) {
                $query->where('type', 'xoso3p');
            })
            ->limit(10)
            ->get();

        $settingXoso = SettingXoso::where('type', 'xoso3p')->first();
        return view('xoso3p', compact('lastGame', 'historyGame', 'myHistory', 'settingXoso'));
    }

    public function xoso5p()
    {
        $lastGame = GameKenno::where('type', 'xoso5p')
            ->where('status', 'completed')
            ->orderBy('id', 'desc')->first();

        $historyGame = GameKenno::orderBy('id', 'desc')
            ->where('type', 'xoso5p')
            ->where('status', 'completed')
            ->limit(10)
            ->get();

        $myHistory = UserGame::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->whereHas('game', function ($query) {
                $query->where('type', 'xoso5p');
            })
            ->limit(10)
            ->get();

        $settingXoso = SettingXoso::where('type', 'xoso5p')->first();
        return view('xoso5', compact('lastGame', 'historyGame', 'myHistory', 'settingXoso'));
    }

    public function xsmb()
    {
        $url = 'https://mu88.live/api/front/open/lottery/history/list/5/miba';
        $response = Http::get($url);
        if ($response->status() != 200) {
            return response()->json(['error' => 'Lỗi khi lấy dữ liệu'], 422);
        }
        $data = $response->json();
        $detail = json_decode($data['t']['issueList'][0]['detail'], true);
        $result = [];
        foreach ($detail as $item) {
            $result[] = explode(',', $item);
        }
        $data = $data['t'];
        $timestamp = date('Y-m-d H:i:s', strtotime($data['openTime']));
        $game = GameKenno::where('type', 'xsmb')
            ->where('code', $timestamp)->first();
        $lastGame = GameKenno::where('type', 'xsmb')
            ->orderBy('id', 'desc')->first();

        $historyGame = GameKenno::orderBy('id', 'desc')
            ->where('type', 'xsmb')
            ->where('status', 'completed')
            ->limit(10)
            ->get();

        $myHistory = UserGame::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->whereHas('game', function ($query) {
                $query->where('type', 'xsmb');
            })
            ->limit(10)
            ->get();

        $settingXoso = SettingXoso::where('type', 'xsmb')->first();
        return view('xsmb', compact('lastGame', 'historyGame', 'myHistory', 'settingXoso', 'result', 'data', 'game'));
    }

    public function xsmt()
    {
        $url = 'https://mu88.live/api/front/open/lottery/history/list/5/dana';
        $response = Http::get($url);
        if ($response->status() != 200) {
            return response()->json(['error' => 'Lỗi khi lấy dữ liệu'], 422);
        }
        $data = $response->json();
        $detail = json_decode($data['t']['issueList'][0]['detail'], true);
        $result = [];
        foreach ($detail as $item) {
            $result[] = explode(',', $item);
        }
        $data = $data['t'];
        $timestamp = date('Y-m-d H:i:s', strtotime($data['openTime']));
        $game = GameKenno::where('type', 'xsmt')
            ->where('code', $timestamp)->first();
        $lastGame = GameKenno::where('type', 'xsmt')
            ->orderBy('id', 'desc')->first();

        $historyGame = GameKenno::orderBy('id', 'desc')
            ->where('type', 'xsmt')
            ->where('status', 'completed')
            ->limit(10)
            ->get();

        $myHistory = UserGame::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->whereHas('game', function ($query) {
                $query->where('type', 'xsmt');
            })
            ->limit(10)
            ->get();

        $settingXoso = SettingXoso::where('type', 'xsmt')->first();
        return view('xsmt', compact('lastGame', 'historyGame', 'myHistory', 'settingXoso', 'result', 'data', 'game'));
    }

    public function xsmn()
    {
        $url = 'https://mu88.live/api/front/open/lottery/history/list/5/biph';
        
        $response = Http::get($url);
        if ($response->status() != 200) {
            return response()->json(['error' => 'Lỗi khi lấy dữ liệu'], 422);
        }
        $data = $response->json();
        $detail = json_decode($data['t']['issueList'][0]['detail'], true);
        $result = [];
        foreach ($detail as $item) {
            $result[] = explode(',', $item);
        }
        $data = $data['t'];
        $timestamp = date('Y-m-d H:i:s', strtotime($data['openTime']));
        $game = GameKenno::where('type', 'xsmn')
            ->where('code', $timestamp)->first();
        $lastGame = GameKenno::where('type', 'xsmn')
            ->orderBy('id', 'desc')->first();

        $historyGame = GameKenno::orderBy('id', 'desc')
            ->where('type', 'xsmn')
            ->where('status', 'completed')
            ->limit(10)
            ->get();

        $myHistory = UserGame::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->whereHas('game', function ($query) {
                $query->where('type', 'xsmn');
            })
            ->limit(10)
            ->get();
            
        $settingXoso = SettingXoso::where('type', 'xsmn')->first();
        return view('xsmn', compact('lastGame', 'historyGame', 'myHistory', 'settingXoso', 'result', 'data', 'game'));
    }

    public function createGame()
    {
        Artisan::call('app:check-game-not-start');
    }
}
