<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ConfirmPass implements Rule
{
    private $hashedPass;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($hashedPass)
    {
        //
        $this->hashedPass = $hashedPass;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        return Hash::check($value, $this->hashedPass);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The password does not match current password.';
    }
}
