<x-guest-layout>
    <!-- Titre et Description -->
    <h2 class="text-center text-2xl font-bold text-gray-800 mb-2">Mot de passe oublié</h2>
    <p class="text-center text-sm text-gray-500 mb-6">
        Pas de souci ! Indiquez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-sm text-green-600" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Adresse Email -->
        <div>
            <x-input-label for="email" :value="__('Adresse Email')" class="text-gray-700" />
            <x-text-input id="email" class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                          type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Bouton d'Envoi -->
        <div class="flex items-center justify-center">
            <x-primary-button class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                {{ __('Envoyer le lien de réinitialisation') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
