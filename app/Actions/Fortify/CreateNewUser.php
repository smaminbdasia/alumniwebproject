<?php

namespace App\Actions\Fortify;

// use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     * @return \App\Models\User
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'nameBangla' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'unique:users,phone'],
            'phone_2' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'image' => ['nullable', 'file', 'image', 'max:2048'],  // max:2048 means 2 MB

            'father' => ['nullable', 'string', 'max:255'],
            'mother' => ['nullable', 'string', 'max:255'],
            'birthday' => ['nullable', 'date'],
            'bloodgroup' => ['nullable', 'string'],
            'dakhilBatch' => ['required', 'integer'],
            'alimBatch' => ['nullable', 'integer'],

            'address' => ['nullable', 'string'],
            'district' => ['nullable', 'string', 'max:255'],

            'verification' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],

            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Generate reg_id
        $reg_id = $this->generateRegId($input['dakhilBatch']);

        return User::create([
            'reg_id' => $reg_id,
            'name' => $input['name'],
            'nameBangla' => $input['nameBangla'],
            'phone' => $input['phone'],
            'phone_2' => $input['phone_2'],
            'email' => $input['email'],
            'father' => $input['father'],
            'mother' => $input['mother'],
            'birthday' => $input['birthday'],
            'bloodgroup' => $input['bloodgroup'],
            'tshirt_size' => $input['tshirt_size'],
            'dakhilBatch' => $input['dakhilBatch'],
            'alimBatch' => $input['alimBatch'],
            'address' => $input['address'],
            'district' => $input['district'],
            'verification' => 'unverified', // Set default
            'status' => 'valid', // Set default
            'role' => 'user', // Set default role to 'user'
                    'password' => Hash::make($input['password']),
        ]);
    }

    /**
     * Generate the reg_id based on dakhilBatch.
     *
     * @param  int  $dakhilBatch
     * @return string
     */
    protected function generateRegId(int $dakhilBatch): string
    {
        $batchYearSuffix = substr($dakhilBatch, -2); // Last 2 digits of the year
        $lastUser = User::where('dakhilBatch', $dakhilBatch)->orderBy('id', 'desc')->first();

        $incrementValue = $lastUser ? ((int) substr($lastUser->reg_id, -4) + 1) : 1;
        $incrementValuePadded = str_pad($incrementValue, 4, '0', STR_PAD_LEFT);

        return $batchYearSuffix . '-' . $incrementValuePadded;
    }


}
