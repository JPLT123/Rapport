<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

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
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'verification_code' => mt_rand(100000, 999999),
                'slug' => Str::slug($input['email'])
            ]);
    
            Permission::create([
                'id_user' => $user->id,
                'id_role' => 3
            ]);
            // Envoyer l'email de vérification
            Mail::to($user->email)->send(new VerificationCodeMail($user->verification_code));
    
            return $user;
        });
    }

}
