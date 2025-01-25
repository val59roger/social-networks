<x-guest-layout>
    <!-- Titre et Description -->
    <h2 class="text-center text-2xl font-bold text-gray-800 mb-2">Vérification de votre adresse e-mail</h2>
    <p class="text-center text-sm text-gray-500 mb-6">
        Merci de vous être inscrit ! Avant de commencer, veuillez vérifier votre adresse électronique en cliquant sur le lien que nous venons de vous envoyer. Si vous n'avez pas reçu l'email, nous vous en enverrons un autre avec plaisir.
    </p>

    <!-- Message de Confirmation de Lien -->
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 text-center">
            {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse électronique que vous avez fournie lors de votre inscription.') }}
        </div>
    @endif

    <!-- Boutons : Renvoi de l'email et Déconnexion -->
    <div class="mt-6 flex items-center justify-center space-x-4">
        <!-- Renvoi de l'email -->
        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:max-w-md">
            @csrf
            <x-primary-button class="w-full py-2 px-4 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                {{ __('Renvoyer l\'email de vérification') }}
            </x-primary-button>
        </form>

        <!-- Déconnexion -->
        <form method="POST" action="{{ route('logout') }}" class="w-full sm:max-w-md">
            @csrf
            <button type="submit" class="w-full py-2 px-4 text-center text-sm text-gray-600 hover:text-gray-900 rounded-lg border-2 border-gray-300 hover:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                {{ __('Déconnexion') }}
            </button>
        </form>
    </div>
</x-guest-layout>
