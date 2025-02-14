<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->pseudo }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl bg-white mx-auto p-8 rounded-lg">
            <!-- Section Profil en haut -->
            <div class="flex items-center mb-8">
                <!-- Photo de profil -->
                <div class="flex-shrink-0">
                    @if ($user->url_profile)
                        <img src="{{ asset('storage/' . $user->url_profile) }}" alt="Photo de {{ $user->pseudo }}" class="w-24 h-24 rounded-full object-cover border border-gray-300">
                    @else
                        <img src="{{ asset('storage/profile_photos/default-profile.jpg') }}" alt="Photo par défaut" class="w-24 h-24 rounded-full object-cover border border-gray-300">
                    @endif
                </div>

                <!-- Informations sur l'utilisateur -->
                <div class="ml-6">
                    <div class="flex items-center space-x-6 mt-4">
                        <h1 class="text-2xl font-semibold text-gray-800">{{ $user->pseudo }}</h1>
                    </div>
                    <div class="flex items-center space-x-6 mt-4">
                        <p><strong>{{ $user->posts->count() }}</strong> posts</p>
                        <p><strong>{{ $user->posts->sum('likes_count') }}</strong> likes</p>
                        <p><strong>{{ $user->comments->count() }}</strong> commentaires</p>
                    </div>
                    <div class="flex items-center space-x-6 mt-4">
                        <p><strong>{{ $user->follows()->count() }}</strong> abonnements</p>
                        <p><strong>{{ $user->followers()->count() }}</strong> abonnés</p>
                        @if (Auth::user()->id !== $user->id)
                            @if (Auth::user()->follows()->where('followed_id', $user->id)->exists())
                                <form action="{{ route('follow.toggle', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Unfollow</button>
                                </form>
                            @else
                                <form action="{{ route('follow.toggle', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded">Follow</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <!-- Liste des posts de l'utilisateur -->
            <div class="space-y-6">
            @foreach ($posts as $post)
                <div class="border border-black shadow rounded-lg overflow-hidden">
                    <!-- Image du post -->
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Image du post" class="w-full object-cover">
                    @endif

                    <!-- Contenu du post -->
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $post->title }}</h3>
                        <p class="text-gray-600 mt-2">{{ $post->description }}</p>

                        <!-- Statistiques du post -->
                        <div class="mt-4 flex items-center space-x-4 text-gray-500">
                            <span><strong>{{ $post->likes()->count() }}</strong> likes</span>
                            <span><strong>{{ $post->comments->count() }}</strong> commentaires</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
    </div>
</x-app-layout>
