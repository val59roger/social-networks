<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex space-x-4">
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
        <div class="max-w-4xl bg-white mx-auto p-8 rounded-lg">
            <!-- Section Profil en haut -->
            <div class="flex flex-col lg:flex-row items-center lg:items-start lg:space-x-8">
                <!-- Photo de profil -->
                <div class="relative w-24 h-24">
                    <img class="w-full h-full rounded-full object-cover" src="{{
                        $user->url_profile
                        ? asset('storage/' . $user->url_profile)
                        : asset('storage/profile_photos/default-profile.jpg') }}" alt="Photo de profil">
                </div>

                <!-- Informations du profil -->
                <div class="mt-6 lg:mt-0">
                    <div class="flex items-center space-x-4">
                        <h2 class="text-2xl font-bold">{{ $user->pseudo }}</h2>
                    </div>
                    <div class="mt-4 flex space-x-8">
                        <span><strong>{{ $postsCount }}</strong> publications</span>
                        <span><strong>{{ $followersCount }}</strong> followers</span>
                        <span><strong>{{ $followingCount }}</strong> suivi(e)s</span>
                        <span><strong>{{ $totalLikes }}</strong> Likes</span>
                        <span><strong>{{ $totalComments }}</strong> Commentaires</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
