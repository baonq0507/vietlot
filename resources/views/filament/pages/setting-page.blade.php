<x-filament-panels::page>
    <style>
        .border {
            border: 1px solid #e5e7eb;
        }

        #btn_save_setting_kenno_1p {
            margin-top: 10px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    <x-filament::section>
        <div style="margin-bottom: 20px;" class="space-y-6">
            <h3>Cài đặt trả thưởng kèo Kenno 1 phút</h3>
            <form wire:submit.prevent="saveSettingKenno1p" id="form_save_setting_kenno_1p">
                <div>
                    <label for="reward_win" style="display: block;">Đôi bên</label>
                    <input type="number"
                        name="reward_win"
                        wire:model="dataFormSaveSettingKenno1p.reward_win"
                        min="0"

                        step="0.01"
                        style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    <button type="submit" style="width: 100px; height: 30px; background-color: #ccc; color: #000; border: none; border-radius: 5px; cursor: pointer;">Cập nhật</button>
                </div>
            </form>
        </div>
        <div style="margin-bottom: 20px;" class="space-y-6">
            <h3>Cài đặt trả thưởng kèo Kenno 3 phút</h3>
            <form wire:submit.prevent="saveSettingKenno3p" id="form_save_setting_kenno_3p">
                <div>
                    <label for="reward_win" style="display: block;">Đôi bên</label>
                    <input type="number"
                        name="reward_win"
                        wire:model="dataFormSaveSettingKenno3p.reward_win"
                        min="0"

                        step="0.01"
                        style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    <button type="submit" style="width: 100px; height: 30px; background-color: #ccc; color: #000; border: none; border-radius: 5px; cursor: pointer;">Cập nhật</button>
                </div>
            </form>
        </div>
        <div style="margin-bottom: 20px;" class="space-y-6">
            <h3>Cài đặt trả thưởng kèo Kenno 5 phút</h3>
            <form wire:submit.prevent="saveSettingKenno5p" id="form_save_setting_kenno_5p">
                <div>
                    <label for="reward_win" style="display: block;">Đôi bên</label>
                    <input type="number"
                        name="reward_win"
                        wire:model="dataFormSaveSettingKenno5p.reward_win"
                        min="0"

                        step="0.01"
                        style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    <button type="submit" style="width: 100px; height: 30px; background-color: #ccc; color: #000; border: none; border-radius: 5px; cursor: pointer;">Cập nhật</button>
                </div>
            </form>
        </div>

        <div style="margin-bottom: 20px;" class="space-y-6">
            <h3>Cài đặt trả thưởng kèo Xổ số 3 phút</h3>
            <form wire:submit.prevent="saveSettingXoso3p" id="form_save_setting_xoso_3p">
                <div style="display: flex; gap: 20px; align-items: flex-end;">
                    <div>
                        <label for="lo_thuong" style="display: block;">Lô thường</label>
                        <input type="number"
                            name="lo_thuong"
                            wire:model="dataFormSaveSettingXoso3p.lo_thuong"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="ba_cang" style="display: block;">Ba càng</label>
                        <input type="number"
                            name="ba_cang"
                            wire:model="dataFormSaveSettingXoso3p.ba_cang"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="db" style="display: block;">Đặc biệt</label>
                        <input type="number"
                            name="db"
                            wire:model="dataFormSaveSettingXoso3p.db"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="lo_xien_2" style="display: block;">Lô xiên 2</label>
                        <input type="number"
                            name="lo_xien_2"
                            wire:model="dataFormSaveSettingXoso3p.lo_xien_2"
                            min="0"

                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="lo_xien_3" style="display: block;">Lô xiên 3</label>
                        <input type="number"
                            name="lo_xien_3"
                            wire:model="dataFormSaveSettingXoso3p.lo_xien_3"
                            min="0"

                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="lo_xien_4" style="display: block;">Lô xiên 4</label>
                        <input type="number"
                            name="lo_xien_4"
                            wire:model="dataFormSaveSettingXoso3p.lo_xien_4"
                            min="0"

                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <button type="submit" style="width: 100px; height: 30px; background-color: #ccc; color: #000; border: none; border-radius: 5px; cursor: pointer;">Cập nhật</button>

                </div>
            </form>
        </div>

        <div style="margin-bottom: 20px;" class="space-y-6">
            <h3>Cài đặt trả thưởng kèo Xổ số 5 phút</h3>
            <form wire:submit.prevent="saveSettingXoso5p" id="form_save_setting_xoso_5p">
                <div style="display: flex; gap: 20px; align-items: flex-end;">
                    <div>
                        <label for="lo_thuong" style="display: block;">Lô thường</label>
                        <input type="number"
                            name="lo_thuong"
                            wire:model="dataFormSaveSettingXoso5p.lo_thuong"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="ba_cang" style="display: block;">Ba càng</label>
                        <input type="number"
                            name="ba_cang"
                            wire:model="dataFormSaveSettingXoso5p.ba_cang"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="db" style="display: block;">Đặc biệt</label>
                        <input type="number"
                            name="db"
                            wire:model="dataFormSaveSettingXoso5p.db"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="lo_xien_2" style="display: block;">Lô xiên 2</label>
                        <input type="number"
                            name="lo_xien_2"
                            wire:model="dataFormSaveSettingXoso5p.lo_xien_2"
                            min="0"

                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="lo_xien_3" style="display: block;">Lô xiên 3</label>
                        <input type="number"
                            name="lo_xien_3"
                            wire:model="dataFormSaveSettingXoso5p.lo_xien_3"
                            min="0"

                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="lo_xien_4" style="display: block;">Lô xiên 4</label>
                        <input type="number"
                            name="lo_xien_4"
                            wire:model="dataFormSaveSettingXoso5p.lo_xien_4"
                            min="0"

                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <button type="submit" style="width: 100px; height: 30px; background-color: #ccc; color: #000; border: none; border-radius: 5px; cursor: pointer;">Cập nhật</button>

                </div>
            </form>
        </div>

        <div style="margin-bottom: 20px;" class="space-y-6">
            <h3>Cài đặt trả thưởng kèo Xổ số miền Bắc</h3>
            <form wire:submit.prevent="saveSettingXosoMienBac" id="form_save_setting_xoso_mien_bac">
                <div style="display: flex; gap: 20px; align-items: flex-end;">
                    <div>
                        <label for="lo_thuong" style="display: block;">Lô thường</label>
                        <input type="number"
                            name="lo_thuong"
                            wire:model="dataFormSaveSettingXosoMienBac.lo_thuong"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="ba_cang" style="display: block;">Ba càng</label>
                        <input type="number"
                            name="ba_cang"
                            wire:model="dataFormSaveSettingXosoMienBac.ba_cang"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="db" style="display: block;">Đặc biệt</label>
                        <input type="number"
                            name="db"
                            wire:model="dataFormSaveSettingXosoMienBac.db"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="lo_xien_2" style="display: block;">Lô xiên 2</label>
                        <input type="number"
                            name="lo_xien_2"
                            wire:model="dataFormSaveSettingXosoMienBac.lo_xien_2"
                            min="0"

                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="lo_xien_3" style="display: block;">Lô xiên 3</label>
                        <input type="number"
                            name="lo_xien_3"
                            wire:model="dataFormSaveSettingXosoMienBac.lo_xien_3"
                            min="0"

                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="lo_xien_4" style="display: block;">Lô xiên 4</label>
                        <input type="number"
                            name="lo_xien_4"
                            wire:model="dataFormSaveSettingXosoMienBac.lo_xien_4"
                            min="0"

                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <button type="submit" style="width: 100px; height: 30px; background-color: #ccc; color: #000; border: none; border-radius: 5px; cursor: pointer;">Cập nhật</button>

                </div>
            </form>
        </div>

        <div style="margin-bottom: 20px;" class="space-y-6">
            <h3>Cài đặt trả thưởng kèo Xổ số miền Trung</h3>
            <form wire:submit.prevent="saveSettingXosoMienTrung" id="form_save_setting_xoso_mien_trung">
                <div style="display: flex; gap: 20px; align-items: flex-end;">
                    <div>
                        <label for="lo_thuong" style="display: block;">Lô thường</label>
                        <input type="number"
                            name="lo_thuong"
                            wire:model="dataFormSaveSettingXosoMienTrung.lo_thuong"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="ba_cang" style="display: block;">Ba càng</label>
                        <input type="number"
                            name="ba_cang"
                            wire:model="dataFormSaveSettingXosoMienTrung.ba_cang"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="db" style="display: block;">Đặc biệt</label>
                        <input type="number"
                            name="db"
                            wire:model="dataFormSaveSettingXosoMienTrung.db"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="lo_xien_2" style="display: block;">Lô xiên 2</label>
                        <input type="number"
                            name="lo_xien_2"
                            wire:model="dataFormSaveSettingXosoMienTrung.lo_xien_2"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="lo_xien_3" style="display: block;">Lô xiên 3</label>
                        <input type="number"
                            name="lo_xien_3"
                            wire:model="dataFormSaveSettingXosoMienTrung.lo_xien_3"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="lo_xien_4" style="display: block;">Lô xiên 4</label>
                        <input type="number"
                            name="lo_xien_4"
                            wire:model="dataFormSaveSettingXosoMienTrung.lo_xien_4"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <button type="submit" style="width: 100px; height: 30px; background-color: #ccc; color: #000; border: none; border-radius: 5px; cursor: pointer;">Cập nhật</button>

                </div>
            </form>
        </div>

        <div style="margin-bottom: 20px;" class="space-y-6">
            <h3>Cài đặt trả thưởng kèo Xổ số miền Nam</h3>
            <form wire:submit.prevent="saveSettingXosoMienNam" id="form_save_setting_xoso_mien_nam">
                <div style="display: flex; gap: 20px; align-items: flex-end;">
                    <div>
                        <label for="lo_thuong" style="display: block;">Lô thường</label>
                        <input type="number"
                            name="lo_thuong"
                            wire:model="dataFormSaveSettingXosoMienNam.lo_thuong"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="ba_cang" style="display: block;">Ba càng</label>
                        <input type="number"
                            name="ba_cang"
                            wire:model="dataFormSaveSettingXosoMienNam.ba_cang"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="db" style="display: block;">Đặc biệt</label>
                        <input type="number"
                            name="db"
                            wire:model="dataFormSaveSettingXosoMienNam.db"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="lo_xien_2" style="display: block;">Lô xiên 2</label>
                        <input type="number"
                            name="lo_xien_2"
                            wire:model="dataFormSaveSettingXosoMienNam.lo_xien_2"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="lo_xien_3" style="display: block;">Lô xiên 3</label>
                        <input type="number"
                            name="lo_xien_3"
                            wire:model="dataFormSaveSettingXosoMienNam.lo_xien_3"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <div>
                        <label for="lo_xien_4" style="display: block;">Lô xiên 4</label>
                        <input type="number"
                            name="lo_xien_4"
                            wire:model="dataFormSaveSettingXosoMienNam.lo_xien_4"
                            min="0"
                            step="0.01"
                            style="width: 100px; height: 30px; border: 1px solid #e5e7eb; border-radius: 5px; padding: 5px; color: #000;" />
                    </div>
                    <button type="submit" style="width: 100px; height: 30px; background-color: #ccc; color: #000; border: none; border-radius: 5px; cursor: pointer;">Cập nhật</button>
                </div>
            </form>
        </div>
        
    </x-filament::section>
</x-filament-panels::page>