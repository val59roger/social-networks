<x-guest-layout>
    <!-- Titre et Description -->
    <h2 class="text-center text-2xl font-bold text-gray-800 mb-2">Réinitialiser votre mot de passe</h2>
    <p class="text-center text-sm text-gray-500 mb-6">
        Entrez votre email et choisissez un nouveau mot de passe pour accéder à votre compte.
    </p>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Jeton pour la Réinitialisation -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Adresse Email -->
        <div>
            <x-input-label for="email" :value="__('Adresse Email')" class="text-gray-700" />
            <x-text-input id="email"
                          class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                          type="email"
                          name="email"
                          :value="old('email', $request->email)"
                          required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Nouveau Mot de Passe -->
        <div>
            <x-input-label for="password" :value="__('Nouveau mot de passe')" class="text-gray-700" />
            <x-text-input id="password"
                          class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                          type="password"
                          name="password"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Confirmation du Mot de Passe -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="text-gray-700" />
            <x-text-input id="password_confirmation"
                          class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                          type="password"
                          name="password_confirmation"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Bouton de Réinitialisation -->
        <div class="flex justify-center">
            <x-primary-button class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                {{ __('Réinitialiser le mot de passe') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
