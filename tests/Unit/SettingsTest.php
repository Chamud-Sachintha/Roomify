<?php

use App\Models\Settings;
use Illuminate\Support\Facades\Schema;

it('can store and retrieve a setting value', function () {
    if (!Schema::hasTable('settings')) {
        Schema::create('settings', function ($table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('value');
            $table->timestamps();
        });
    }

    Settings::query()->where('key', 'ad_posting_fee')->delete();

    $setting = Settings::setValue('ad_posting_fee', 1500);

    expect($setting->key)->toBe('ad_posting_fee')
        ->and($setting->value)->toBe('1500');

    expect(Settings::getValue('ad_posting_fee', 1000))->toBe('1500');
});
