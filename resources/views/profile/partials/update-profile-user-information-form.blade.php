<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informations sur le profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Mettez à jour les informations le pseudo et la photo de profil de votre compte.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.updateUserDetails') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="pseudo" :value="__('Pseudo')" />
            <x-text-input id="pseudo" name="pseudo" type="text" class="mt-1 block w-full" :value="old('pseudo', $user->pseudo)" required autofocus autocomplete="pseudo" />
            <x-input-error class="mt-2" :messages="$errors->get('pseudo')" />
        </div>

        <div>
            <x-input-label for="url_profile" :value="__('Photo de Profil')" />
            <x-text-input id="url_profile" name="url_profile" type="file" class="mt-1 block w-full" accept="image/*" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('url_profile')" />
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
