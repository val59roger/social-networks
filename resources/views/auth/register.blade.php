<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-2">
        @csrf

        <!-- Titre principal -->
        <h2 class="text-center text-2xl font-bold text-gray-800">Créer un compte</h2>
        <p class="text-center text-sm text-gray-500">
            Rejoignez notre communauté en quelques étapes !
        </p>

        <!-- Nom -->
        <div>
            <x-input-label for="name" :value="__('Nom')" class="text-gray-700" />
            <x-text-input id="name" class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Prénom -->
        <div>
            <x-input-label for="first_name" :value="__('Prénom')" class="text-gray-700" />
            <x-text-input id="first_name" class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" name="first_name" :value="old('first_name')" required autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Pseudo -->
        <div>
            <x-input-label for="pseudo" :value="__('Pseudo')" class="text-gray-700" />
            <x-text-input id="pseudo" class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" name="pseudo" :value="old('pseudo')" required autocomplete="pseudo" />
            <x-input-error :messages="$errors->get('pseudo')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Âge -->
        <div>
            <x-input-label for="age" :value="__('Âge')" class="text-gray-700" />
            <x-text-input id="age" class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="number" name="age" :value="old('age')" required autocomplete="age" />
            <x-input-error :messages="$errors->get('age')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
            <x-text-input id="email" class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Téléphone -->
        <div>
            <x-input-label for="phone" :value="__('Téléphone')" class="text-gray-700" />
            <x-text-input id="phone" class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="tel" name="phone" :value="old('phone')" required autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Mot de passe -->
        <div>
            <x-input-label for="password" :value="__('Mot de passe')" class="text-gray-700" />
            <x-text-input id="password" class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Confirmation du mot de passe -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="text-gray-700" />
            <x-text-input id="password_confirmation" class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between">
            <a class="text-sm text-indigo-600 hover:underline" href="{{ route('login') }}">
                {{ __('Déjà inscrit ? Connectez-vous') }}
            </a>

            <x-primary-button class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                {{ __('Inscription') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
