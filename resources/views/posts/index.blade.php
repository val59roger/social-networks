<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Fil d'actualité : ") }}
            </h2>
        </x-slot>

        @foreach($posts as $post)
        <div class="my-6 bg-white shadow rounded-lg overflow-hidden">
            <!-- Header du post -->
            <div class="flex items-center p-4">
                <!-- Photo de profil -->
                <div class="flex-shrink-0">
                    @if ($post->user->url_profile)
                        <img src="{{ asset('storage/' . $post->user->url_profile) }}" alt="Photo de profil de {{ $post->user->pseudo }}" class="w-14 h-14 rounded-full border border-black">
                    @else
                        <img src="{{ asset('storage/profile_photos/default-profile.jpg') }}" alt="Photo de profil par défaut" class="w-14 h-14 rounded-full border border-black">
                    @endif
                </div>
                <!-- Nom de l'utilisateur et date -->
                <div class="ml-4">
                    <p class="text-sm font-semibold text-gray-900">{{ $post->user->pseudo }}</p>
                    <p class="text-xs text-gray-500">Publié le {{ $post->date_published->format('d/m/Y à H:i') }}</p>
                </div>
            </div>

            <!-- Image du post -->
            @if ($post->image)
            <div class="bg-white">
                <img src="{{ asset('storage/' . $post->image) }}" alt="Image du post" class="w-full object-cover">
            </div>
            @endif

            <!-- Contenu du post -->
            <div class="p-4">
                <!-- Titre et description -->
                <h3 class="text-base font-semibold text-gray-900">{{ $post->title }}</h3>
                <p class="text-sm text-gray-700 mt-2">{{ $post->description }}</p>

                <!-- Interactions -->
                <div class="mt-4 flex items-center space-x-6">
                    <!-- Bouton J'aime -->
                    <button class="flex items-center text-gray-500 hover:text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                        </svg>
                        <span>J’aime</span>
                    </button>
                    <!-- Bouton Commenter -->
                    <button class="flex items-center text-gray-500 hover:text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                        </svg>
                        <span>Commenter</span>
                    </button>
                    <!-- Bouton Partager -->
                    <button class="flex items-center text-gray-500 hover:text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                        </svg>
                        <span>Partager</span>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
