<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informations sur les données personnelles') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Mettez à jour les informations personnels et l'adresse électronique de votre compte.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="first_name" :value="__('Prénom')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <div>
            <x-input-label for="age" :value="__('Age')" />
            <x-text-input id="age" name="age" type="text" class="mt-1 block w-full" :value="old('age', $user->age)" required autofocus autocomplete="age" />
            <x-input-error class="mt-2" :messages="$errors->get('age')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Votre adresse électronique n est pas vérifiée.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Cliquez ici pour renvoyer l e-mail de vérification.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse électronique.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="phone" :value="__('Téléphone')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" required autofocus autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Sauvegarder') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Sauvegardé.') }}</p>
            @endif
        </div>
    </form>
</section>
