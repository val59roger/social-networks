<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Il s agit d une zone sécurisée de l application. Veuillez confirmer votre mot de passe avant de continuer.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Mot De Passe')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirmation') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
