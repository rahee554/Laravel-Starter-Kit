<?php

namespace ArtflowStudio\StarterKit\Actions\Fortify;

use ArtflowStudio\StarterKit\Services\AuthService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUserWithHooks implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     * Extended to include custom hooks and logic
     *
     * @param  array  $input
     * @return mixed
     */
    public function create(array $input)
    {
        $userModel = config('auth.providers.users.model', 'App\\Models\\User');
        
        // TODO: Add pre-registration validation
        // Get custom validation rules
        $customRules = AuthService::getCustomRegistrationRules();

        // Merge with default rules
        $rules = array_merge([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique($userModel),
            ],
            'password' => $this->passwordRules(),
        ], $customRules);

        Validator::make($input, $rules)->validate();

        // TODO: Sanitize input data
        $data = AuthService::sanitizeRegistrationData($input);

        // TODO: Create user with custom logic
        $user = $userModel::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // TODO: Add additional fields here
            // 'role' => 'user',
            // 'status' => 'active',
        ]);

        // TODO: Post-creation hooks
        // These will also be called by event listener
        AuthService::afterRegister($user, request());

        return $user;
    }
}
