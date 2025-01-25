<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- Lien vers le dashboard -->
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Statistiques') }}
            </x-nav-link>

            <!-- Lien vers Mes posts -->
            <x-nav-link :href="route('posts.my-posts')" :active="request()->routeIs('posts.my-posts')">
                {{ __('Mes posts') }}
            </x-nav-link>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>{{ __("Nombre d'abonnés :") }}</p>
                    <p>{{ __("Nombre de personne suivie :") }}</p>
                    <p>{{ __("Nombre de posts :") }}</p>
                    <p>{{ __("Nombre de like total :") }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
