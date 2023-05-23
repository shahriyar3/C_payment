<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class CompareChecksum implements ValidationRule, DataAwareRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $checksum = hash_hmac('sha256', $this->data['payment_id'], config('payment.ps_secret'));
        if ($checksum != $value)
            $fail('checksum invalid');
    }


    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }
}
