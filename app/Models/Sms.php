<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $guarded = ['id'];

    public static function createSms($phone, $text) {
        $sms = new Sms();
        $sms->phone = $phone;
        $sms->message = $text;
        $sms->plan_time = Carbon::now('Asia/Almaty')->toDateTimeString();

        return $sms->save();
    }
}
