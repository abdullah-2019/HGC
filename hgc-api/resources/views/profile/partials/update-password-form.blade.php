<section>
    <header>
        <h2 class="text-lg font-medium text-white">{{ __('Update Password') }}</h2>
        <p class="mt-1 text-sm text-gray-400">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-300">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                autocomplete="current-password" />
            @if ($errors->updatePassword->has('current_password'))
                <p class="mt-2 text-sm text-red-400">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-300">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password"
                class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                autocomplete="new-password" />
            @if ($errors->updatePassword->has('password'))
                <p class="mt-2 text-sm text-red-400">{{ $errors->updatePassword->first('password') }}</p>
            @endif
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-300">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                autocomplete="new-password" />
            @if ($errors->updatePassword->has('password_confirmation'))
                <p class="mt-2 text-sm text-red-400">{{ $errors->updatePassword->first('password_confirmation') }}</p>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-400 focus:bg-primary-500 active:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-400">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>