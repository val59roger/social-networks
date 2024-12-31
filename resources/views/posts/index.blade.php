<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Fil d'actualité : ") }}
            </h2>
        </x-slot>

        @foreach($posts as $post)
        <div class="mb-4 p-4 bg-white shadow rounded-lg flex items-start space-x-4">
            <!-- Photo de profil -->
            <div>
                @if ($post->user->url_profile)
                    <img src="{{ asset('storage/' . $post->user->url_profile) }}" alt="Photo de profil de {{ $post->user->pseudo }}" class="w-12 h-12 rounded-full">
                @else
                    <img src="{{ asset('storage/profile_photos/default-profile.jpg') }}" alt="Photo de profil par défaut" class="w-12 h-12 rounded-full">
                @endif
            </div>

            <!-- Contenu du post -->
            <div>
                <h3 class="text-lg font-semibold">
                    Publication de {{ $post->user->pseudo }}
                </h3>
                <h2 class="text-lg font-semibold">{{ $post->title }}</h2>
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Image du post" class="mt-2 w-64">
                @endif
                <p class="mt-2 text-gray-700">{{ $post->description }}</p>
                <p class="mt-1 text-sm text-gray-500">Publié le {{ $post->date_published->format('d/m/Y') }}</p>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
