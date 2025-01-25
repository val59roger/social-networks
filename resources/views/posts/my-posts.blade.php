<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

        @if (session('success'))
            <div class="mb-4 text-green-600 bg-green-100 p-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @foreach ($posts as $post)
        <div class="mb-6 bg-white shadow rounded-lg overflow-hidden my-6">
            <!-- Header du post -->
            <div class="flex items-center p-4">
                <!-- Titre -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $post->title }}</h3>
                    <p class="text-xs text-gray-500">Publié le {{ $post->created_at->format('d/m/Y à H:i') }}</p>
                </div>
            </div>

            <!-- Image du post -->
            @if ($post->image)
            <div class="bg-gray-100">
                <img src="{{ asset('storage/' . $post->image) }}" alt="Image du post" class="w-full object-cover">
            </div>
            @endif

            <!-- Contenu du post -->
            <div class="p-4">
                <p class="text-sm text-gray-700">{{ $post->description }}</p>

                <!-- Actions : Modifier / Supprimer -->
                <div class="mt-4 flex items-center justify-between">
                    <!-- Bouton Modifier -->
                    <a href="{{ route('posts.edit', $post->id) }}"
                        class="flex items-center px-4 py-2 bg-yellow-500 text-black rounded-lg hover:bg-yellow-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        Modifier
                    </a>

                    <!-- Bouton Supprimer -->
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-500"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce post ?')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
