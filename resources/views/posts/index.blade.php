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
                    <p class="text-sm font-semibold text-gray-900">
                        <a href="{{ route('profile.show', $post->user->id) }}" class="text-blue-500 hover:underline">
                            {{ $post->user->pseudo }}
                        </a>
                    </p>
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
                    <button class="like-button flex items-center hover:text-red-500 {{ $post->userLiked ? 'text-red-500' : '' }}" data-post-id="{{ $post->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                        </svg>
                        <span>J’aime</span>
                    </button>
                    <!-- Bouton Commenter -->
                    <button class="flex items-center text-gray-500 hover:text-blue-500 comment-toggle" data-post-id="{{ $post->id }}">
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
                <!-- Zone de commentaire cachée -->
                <div class="hidden comment-section mt-3" id="comment-section-{{ $post->id }}">
                    <textarea class="w-full border rounded p-2" placeholder="Ajouter un commentaire..."></textarea>
                    <button class="mt-2 bg-blue-500 text-white px-3 py-1 rounded post-comment" data-post-id="{{ $post->id }}">Publier</button>
                </div>
                <!-- Conteneur des commentaires existants -->
                <div class="comments-container mt-3" data-post-id="{{ $post->id }}">
                    @foreach($post->comments as $comment)
                        <div class="flex items-start space-x-2 mt-3 relative">
                            <!-- Photo de profil -->
                            <img src="{{ asset('storage/' . $comment->user->url_profile) }}"
                                alt="Photo de {{ $comment->user->pseudo }}"
                                class="w-10 h-10 rounded-full border border-gray-300">

                            <!-- Détails du commentaire -->
                            <div>
                                <a href="{{ route('profile.show', $post->user->id) }}" class="font-semibold text-sm text-blue-500 hover:underline">
                                    {{ $comment->user->pseudo }}
                                </a>
                                <p class="comment-text text-gray-700 text-sm" data-comment-id="{{ $comment->id }}">{{ $comment->content }}</p>
                            </div>


                            <!-- Bouton Options aligné à droite -->
                            <button class="comment-options-btn text-gray-500 absolute right-0 top-1/2 transform -translate-y-1/2" data-comment-id="{{ $comment->id }}">
                                ⋮
                            </button>

                            <!-- Menu contextuel -->
                            <div class="flex comment-menu hidden absolute bg-white shadow-md rounded right-0 z-10 border-2 border-black" data-comment-id="{{ $comment->id }}">
                                <button class="edit-comment text-white bg-blue-500 p-2" data-comment-id="{{ $comment->id}}">Modifier</button>
                                <button class="delete-comment text-white bg-red-500 p-2" data-comment-id="{{ $comment->id}}">Supprimer</button>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
