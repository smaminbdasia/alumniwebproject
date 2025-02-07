<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],

        ])->validateWithBag('updateProfileInformation');

        // if (isset($input['photo'])) {
        //     $user->updateProfilePhoto($input['photo']);
        // }

        if (isset($input['photo'])) {
            $this->updateProfilePhoto($user, $input['photo']); // Call custom function
        }

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }
    }

    protected function updateProfilePhoto(User $user, $photo)
    {
        // Get the original file extension
        $extension = $photo->getClientOriginalExtension();

        // Fetch all files matching the user's profile photo naming convention
        $files = collect(Storage::disk('public')->files('profile-photos'))
            ->filter(fn($file) => Str::startsWith(basename($file), "Profile_Photo_{$user->dakhilBatch}_{$user->reg_id}_("));

        // Extract and determine the highest increment value
        $increment = $files->map(function ($file) {
            return (int) Str::between(basename($file), '_(', ')');
        })->sort()->last() + 1;

        // Default increment to 1 if no files found
        $increment = $increment ?: 1;

        // Construct the new filename
        $filename = "Profile_Photo_{$user->dakhilBatch}_{$user->reg_id}_({$increment}).{$extension}";

        // Store the file with the new name
        $path = $photo->storeAs('profile-photos', $filename, 'public');

        // Update the user's profile photo path
        $user->forceFill([
            'profile_photo_path' => $path,
        ])->save();
    }




    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
