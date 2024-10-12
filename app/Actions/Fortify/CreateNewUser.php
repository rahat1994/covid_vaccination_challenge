<?php

namespace App\Actions\Fortify;

use App\Jobs\ProcessUserRegistration;
use App\Models\User;
use App\Rules\EnsureNidIsNotDuplicate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nid' =>  ['required', 'regex:/^\d{13}$|^\d{17}$/', 'unique:users'],
            'vaccine_center_id' => ['required', 'string', 'exists:vaccination_centers,id'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'nid' => $input['nid'],
            'vaccination_center_id' => $input['vaccine_center_id'],
            'password' => Hash::make($input['password']),
        ]);

        return $user;
    }
}
