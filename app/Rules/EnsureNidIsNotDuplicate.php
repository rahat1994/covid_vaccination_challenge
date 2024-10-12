<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class EnsureNidIsNotDuplicate implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // $encryptedNid = Crypt::encryptString($value);
        // DB::selectOne('SELECT * FROM users WHERE nid = ?', [$encryptedNid]) === null ?: $fail("The $attribute is already taken.");
    }
}
