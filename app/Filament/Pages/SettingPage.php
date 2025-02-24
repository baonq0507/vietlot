<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\SettingKenno;
use App\Models\SettingXx;
use App\Models\SettingXoso;
use Filament\Notifications\Notification;
use App\Models\Setting;

class SettingPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.setting-page';

    protected static ?string $navigationLabel = 'Cài đặt trả thưởng';

    protected static ?string $label = 'Cài đặt trả thưởng';

    protected static ?string $pluralLabel = 'Cài đặt trả thưởng';

    public $settingKenno1p;
    public $settingKenno3p;
    public $settingKenno5p;

    public $settingXucXac3p;
    public $settingXucXac5p;

    public $settingXoso3p;
    public $settingXoso5p;
    public $settingXosoMienBac;
    public $settingXosoMienTrung;
    public $settingXosoMienNam;

    public $dataFormSaveSettingKenno1p;
    public $dataFormSaveSettingKenno3p;
    public $dataFormSaveSettingKenno5p;
    public $dataFormSaveSettingXoso3p;
    public $dataFormSaveSettingXoso5p;
    public $dataFormSaveSettingXosoMienBac;
    public $dataFormSaveSettingXosoMienTrung;
    public $dataFormSaveSettingXosoMienNam;

    public $dataFormSaveSetting;

    public $setting;

    //label
    public static function getLabel(): string
    {
        return 'Cài đặt trả thưởng';
    }

    public function mount()
    {
        $this->settingKenno1p = $this->getSettingKenno1p();
        $this->settingKenno3p = $this->getSettingKenno3p();
        $this->settingKenno5p = $this->getSettingKenno5p();

        $this->settingXucXac3p = $this->getSettingXucXac3p();
        $this->settingXucXac5p = $this->getSettingXucXac5p();

        $this->settingXoso3p = $this->getSettingXoso3p();
        $this->settingXoso5p = $this->getSettingXoso5p();
        $this->settingXosoMienBac = $this->getSettingXosoMienBac();
        $this->settingXosoMienTrung = $this->getSettingXosoMienTrung();
        $this->settingXosoMienNam = $this->getSettingXosoMienNam();

        $this->setting = $this->getSetting();

        $this->dataFormSaveSettingKenno1p = [
            'reward_win' => $this->settingKenno1p->reward_win,
        ];

        $this->dataFormSaveSettingKenno3p = [
            'reward_win' => $this->settingKenno3p->reward_win,
        ];

        $this->dataFormSaveSettingKenno5p = [
            'reward_win' => $this->settingKenno5p->reward_win,
        ];

        $this->dataFormSaveSettingXoso3p = [
            'lo_thuong' => $this->settingXoso3p->lo_thuong,
            'ba_cang' => $this->settingXoso3p->ba_cang,
            'db' => $this->settingXoso3p->db,
            'lo_xien_2' => $this->settingXoso3p->lo_xien_2,
            'lo_xien_3' => $this->settingXoso3p->lo_xien_3,
            'lo_xien_4' => $this->settingXoso3p->lo_xien_4,
        ];

        $this->dataFormSaveSettingXoso5p = [
            'lo_thuong' => $this->settingXoso5p->lo_thuong,
            'ba_cang' => $this->settingXoso5p->ba_cang,
            'db' => $this->settingXoso5p->db,
            'lo_xien_2' => $this->settingXoso5p->lo_xien_2,
            'lo_xien_3' => $this->settingXoso5p->lo_xien_3,
            'lo_xien_4' => $this->settingXoso5p->lo_xien_4,
        ];

        $this->dataFormSaveSettingXosoMienBac = [
            'lo_thuong' => $this->settingXosoMienBac->lo_thuong,
            'ba_cang' => $this->settingXosoMienBac->ba_cang,
            'db' => $this->settingXosoMienBac->db,
            'lo_xien_2' => $this->settingXosoMienBac->lo_xien_2,
            'lo_xien_3' => $this->settingXosoMienBac->lo_xien_3,
            'lo_xien_4' => $this->settingXosoMienBac->lo_xien_4,
        ];

        $this->dataFormSaveSettingXosoMienTrung = [
            'lo_thuong' => $this->settingXosoMienTrung->lo_thuong,
            'ba_cang' => $this->settingXosoMienTrung->ba_cang,
            'db' => $this->settingXosoMienTrung->db,
            'lo_xien_2' => $this->settingXosoMienTrung->lo_xien_2,
            'lo_xien_3' => $this->settingXosoMienTrung->lo_xien_3,
            'lo_xien_4' => $this->settingXosoMienTrung->lo_xien_4,
        ];

        $this->dataFormSaveSettingXosoMienNam = [
            'lo_thuong' => $this->settingXosoMienNam->lo_thuong,
            'ba_cang' => $this->settingXosoMienNam->ba_cang,
            'db' => $this->settingXosoMienNam->db,
            'lo_xien_2' => $this->settingXosoMienNam->lo_xien_2,
            'lo_xien_3' => $this->settingXosoMienNam->lo_xien_3,
            'lo_xien_4' => $this->settingXosoMienNam->lo_xien_4,
        ];

        $this->dataFormSaveSetting = [
            'min_bet' => $this->setting->min_bet,
            'max_bet' => $this->setting->max_bet,
            'min_withdraw' => $this->setting->min_withdraw,
            'max_withdraw' => $this->setting->max_withdraw,
            'min_deposit' => $this->setting->min_deposit,
            'max_deposit' => $this->setting->max_deposit,
            'cskh' => $this->setting->cskh,
        ];
    }

    //get setting
    public function getSettingKenno1p()
    {
        return SettingKenno::where('type', 'kenno1p')->first();
    }

    public function getSettingKenno3p()
    {
        return SettingKenno::where('type', 'kenno3p')->first();
    }

    public function getSettingKenno5p()
    {
        return SettingKenno::where('type', 'kenno5p')->first();
    }

    public function getSettingXucXac3p()
    {
        return SettingXx::where('type', 'xucxac3p')->first();
    }

    public function getSettingXucXac5p()
    {
        return SettingXx::where('type', 'xucxac5p')->first();
    }

    public function getSettingXoso3p()
    {
        return SettingXoso::where('type', 'xoso3p')->first();
    }

    public function getSettingXoso5p()
    {
        return SettingXoso::where('type', 'xoso5p')->first();
    }

    public function getSettingXosoMienBac()
    {
        return SettingXoso::where('type', 'xsmb')->first();
    }   

    public function getSettingXosoMienTrung()
    {
        return SettingXoso::where('type', 'xsmt')->first();
    }

    public function getSettingXosoMienNam()
    {
        return SettingXoso::where('type', 'xsmn')->first();
    }

    public function getSetting()
    {
        return Setting::first();
    }
    

    public function saveSettingKenno1p()
    {
        $this->settingKenno1p->update($this->dataFormSaveSettingKenno1p);
        Notification::make()
            ->title('Cập nhật thành công')
            ->success()
            ->send();
    }

    public function saveSettingKenno3p()
    {
        $this->settingKenno3p->update($this->dataFormSaveSettingKenno3p);
        Notification::make()
            ->title('Cập nhật thành công')
            ->success()
            ->send();
    }

    public function saveSettingKenno5p()
    {
        $this->settingKenno5p->update($this->dataFormSaveSettingKenno5p);
        Notification::make()
            ->title('Cập nhật thành công')
            ->success()
            ->send();
    }

    public function saveSettingXucXac3p()
    {
        $this->settingXucXac3p->update($this->dataFormSaveSettingXucXac3p);
        Notification::make()
            ->title('Cập nhật thành công')
            ->success()
            ->send();
    }

    public function saveSettingXucXac5p()
    {
        $this->settingXucXac5p->update($this->dataFormSaveSettingXucXac5p);
        Notification::make()
            ->title('Cập nhật thành công')
            ->success()
            ->send();
    }

    public function saveSettingXoso3p()
    {
        $this->settingXoso3p->update($this->dataFormSaveSettingXoso3p);
        Notification::make()
            ->title('Cập nhật thành công')
            ->success()
            ->send();
    }

    public function saveSettingXoso5p()
    {
        $this->settingXoso5p->update($this->dataFormSaveSettingXoso5p);
        Notification::make()
            ->title('Cập nhật thành công')
            ->success()
            ->send();
    }

    public function saveSettingXosoMienBac()
    {
        $this->settingXosoMienBac->update($this->dataFormSaveSettingXosoMienBac);
        Notification::make()
            ->title('Cập nhật thành công')
            ->success()
            ->send();
    }

    public function saveSettingXosoMienTrung()
    {
        $this->settingXosoMienTrung->update($this->dataFormSaveSettingXosoMienTrung);
        Notification::make()
            ->title('Cập nhật thành công')
            ->success()
            ->send();
    }

    public function saveSettingXosoMienNam()
    {
        $this->settingXosoMienNam->update($this->dataFormSaveSettingXosoMienNam);
        Notification::make()
            ->title('Cập nhật thành công')
            ->success()
            ->send();
    }

    public function saveSetting()
    {
        $this->setting->update($this->dataFormSaveSetting);
        Notification::make()
            ->title('Cập nhật thành công')
            ->success()
            ->send();
    }
    
    
    

}
