<?php

namespace App\Services;
use Carbon\Carbon;

class CodeGeneratorService
{
    public function generateCode($model, $prefix = null)
    {
        $currentDate = Carbon::now();
        $dayMonthYear = $currentDate->format('ymd');

        $latestId = str_pad(($model->latest('id')->pluck('id')->first() + 1), 6, '0', STR_PAD_LEFT);
        $code = $prefix . '-' . $dayMonthYear . '-' . $latestId;

        $codeExists = $model->where('code', $code)->exists();

        if ($codeExists) {
            return $this->generateCode($model, $prefix);
        }

        return $code;
    }
}
