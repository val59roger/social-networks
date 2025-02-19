<x-app-layout>
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <x-slot name="header">
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __("Amis proches") }}
                </h2>
            </div>
        </x-slot>

        <!-- Conteneur Blanc -->
        <div class="mt-6 bg-white p-6 shadow-md rounded-lg">
            <!-- Info utilisateur -->
            <div class="text-sm text-gray-500">
                Nous n’envoyons pas de notification quand vous modifiez votre liste d’amis proches.
            </div>

            <!-- Barre de recherche avancée -->
            <div class="mt-4 relative">
                <input
                    type="text"
                    id="searchUsers"
                    placeholder="Rechercher un utilisateur..."
                    class="w-full border rounded-full px-4 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-300"
                />
                <!-- Conteneur pour les résultats -->
                <div id="searchResults" class="absolute w-full bg-white shadow-md mt-2 rounded-lg hidden"></div>
            </div>

            <!-- Liste d'amis -->
            <div class="mt-6 space-y-4">
                @forelse ($friends as $friend)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <img
                                src="{{ $friend->url_profile ? asset('storage/' . $friend->url_profile) : asset('storage/profile_photos/default-profile.jpg') }}"
                                alt="Photo de {{ $friend->pseudo }}"
                                class="w-12 h-12 rounded-full object-cover"
                            >
                            <div>
                                <a href="{{ route('profile.show', $friend->id) }}" class="font-medium text-gray-800 hover:underline">
                                    {{ $friend->pseudo }}
                                </a>
                                <p class="text-sm text-gray-500">{{ $friend->email }}</p>
                            </div>
                        </div>
                        <form action="{{ route('follow.toggle', $friend->id) }}" method="POST">
                            @csrf
                            <button class="bg-gray-300 px-4 py-1 rounded-full text-sm hover:bg-gray-400">
                                Retirer
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-600">Vous ne suivez encore personne.</p>
                @endforelse
            </div>

            <!-- Suggestions Section -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800">Suggestions</h3>
                <div class="mt-4 space-y-4">
                    @forelse ($suggestions as $suggestion)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img
                                    src="{{ $suggestion->url_profile ? asset('storage/' . $suggestion->url_profile) : asset('storage/profile_photos/default-profile.jpg') }}"
                                    alt="Photo de {{ $suggestion->pseudo }}"
                                    class="w-12 h-12 rounded-full object-cover"
                                >
                                <div>
                                    <a href="{{ route('profile.show', $suggestion->id) }}" class="font-medium text-gray-800 hover:underline">
                                        {{ $suggestion->pseudo }}
                                    </a>
                                    <p class="text-sm text-gray-500">{{ $suggestion->email }}</p>
                                </div>
                            </div>

                            <!-- Vérifie bien que c'est suggestion->id qui est envoyé -->
                            <form action="{{ route('follow.toggle', ['user' => $suggestion->id]) }}" method="POST">
                                @csrf
                                <button class="bg-blue-500 text-white px-4 py-1 rounded-full text-sm hover:bg-blue-600">
                                    Suivre
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-gray-600">Aucune suggestion pour le moment.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
