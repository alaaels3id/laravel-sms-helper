<?php

namespace Alaaelsaid\LaravelSmsHelper\Implements;

use Alaaelsaid\LaravelSmsHelper\Contracts\SmsInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Hisms implements SmsInterface
{
    private function messages($code): string
    {
        return match ($code) {
            1       => 'إسم المستخدم غير صحيح',
            2       => 'كلمة المرور غير صحيحة',
            404     => 'لم يتم إدخال جميع البرامترات المطلوبة',
            403     => 'تم تجاوز عدد المحاولات المطلوبة',
            504     => 'الحساب معطل',
            4       => 'لا يوجد أرقام',
            5       => 'لا يوجد رسالة',
            6       => 'سيندر خطئ',
            7       => 'سيندر غير مفعل',
            8       => 'الرسالة تحتوي كلمة ممنوعة',
            9       => 'لا يوجد رصيد',
            10      => 'صيغة التاريخ خاطئة',
            11      => 'صيغة الوقت خاطئة',
            default => 'تم الإرسال',
        };
    }

    private function errors(): array
    {
        return [1, 2, 404, 403, 504, 4, 5, 6, 7, 8, 9, 10, 11];
    }

    public function data($number, $message): array
    {
        return [
            'send_sms' => '',
            'username' => config('sms.sms_number'),
            'password' => config('sms.sms_password'),
            'numbers'  => $number,
            'sender'   => config('sms.sms_sender_name'),
            'message'  => $message,
        ];
    }

    public function send($number, $message): array
    {
        $code = Http::post('https://hisms.ws/api.php', $this->data($number, $message))->body();

        $result = ['message' => $this->messages($code), 'code' => $code];

        if (in_array((int)$code, $this->errors()))
        {
            $result['status'] = false;
            Log::warning('Hisms : ' . $result['message']);
        }
        else
        {
            $result['status'] = true;
        }

        return $result;
    }
}
