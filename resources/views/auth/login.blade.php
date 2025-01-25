<x-guest-layout>
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Titre principal -->
        <h2 class="text-center text-2xl font-bold text-gray-800">Bienvenue !</h2>
        <p class="text-center text-sm text-gray-500">
            Connectez-vous pour continuer
        </p>

        <!-- Email Address or Pseudo -->
        <div>
            <x-input-label for="login" :value="__('Email ou Pseudo')" class="text-gray-700" />
            <x-text-input id="login" class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" name="login" :value="old('login')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('login')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Mot de Passe')" class="text-gray-700" />
            <x-text-input id="password" class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center text-sm text-gray-600">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" name="remember">
                <span class="ml-2">{{ __('Se souvenir de moi !') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">
                    {{ __('Mot de passe oublié ?') }}
                </a>
            @endif
        </div>

        <!-- Actions -->
        <div>
            <x-primary-button class="w-full bg-indigo-600 flex items-center justify-center text-white py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                {{ __('Se connecter') }}
            </x-primary-button>
        </div>

        <!-- Redirection vers la page register -->
        <p class="text-center text-sm text-gray-600 mt-4">
            {{ __("Vous n'avez pas de compte ?") }}
            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:underline">
                {{ __('Inscrivez-vous') }}
            </a>
        </p>
    </form>
</x-guest-layout>
