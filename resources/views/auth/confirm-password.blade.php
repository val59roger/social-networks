<x-guest-layout>
    <!-- Titre et Description -->
    <h2 class="text-center text-2xl font-bold text-gray-800 mb-2">Confirmation du mot de passe</h2>
    <p class="text-center text-sm text-gray-500 mb-6">
        Cette section est sécurisée. Veuillez confirmer votre mot de passe pour continuer.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <!-- Mot de Passe -->
        <div>
            <x-input-label for="password" :value="__('Mot de Passe')" class="text-gray-700" />
            <x-text-input id="password"
                          class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Bouton de Confirmation -->
        <div class="flex justify-center">
            <x-primary-button class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                {{ __('Confirmer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
