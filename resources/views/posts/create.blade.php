<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Crée un nouveau post : ") }}
            </h2>
        </x-slot>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="title" class="block font-medium text-sm text-gray-700 ">Titre</label>
                <input type="text" name="title" id="title" class="block mt-1 w-full" value="{{ old('title') }}" required>
                @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="block mt-1 w-full" required>{{ old('description') }}</textarea>
                @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="image" class="block font-medium text-sm text-gray-700">Image</label>
                <input type="file" name="image" id="image" class="block mt-1">
                @error('image') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-blue-600 px-4 py-2 rounded">Publier</button>
        </form>
    </div>
</x-app-layout>
