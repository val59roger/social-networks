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
                <a href="#" class="text-blue-500 hover:underline">Comment ça marche</a>
            </div>

            <!-- Barre de recherche -->
            <div class="mt-4">
                <input
                    type="text"
                    placeholder="Rechercher"
                    class="w-full border rounded-full px-4 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-300"
                />
            </div>

            <!-- Liste d'amis -->
            <div class="mt-6 space-y-4">
                <!-- Ami 1 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <img
                            src="https://via.placeholder.com/150"
                            alt="Photo de profil"
                            class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-medium text-gray-800">lajojovio</p>
                            <p class="text-sm text-gray-500">lajojovio</p>
                        </div>
                    </div>
                    <button class="bg-gray-300 px-4 py-1 rounded-full text-sm hover:bg-gray-400">
                        Retirer
                    </button>
                </div>

                <!-- Ami 2 -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <img
                            src="https://via.placeholder.com/150"
                            alt="Photo de profil"
                            class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-medium text-gray-800">fred_et_rock</p>
                            <p class="text-sm text-gray-500">Fred B. 🤘🎸</p>
                        </div>
                    </div>
                    <button class="bg-gray-300 px-4 py-1 rounded-full text-sm hover:bg-gray-400">
                        Retirer
                    </button>
                </div>
            </div>

            <!-- Suggestions Section -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800">Suggestions</h3>
                <div class="mt-4 space-y-4">
                    <!-- Suggestion 1 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <img
                                src="https://via.placeholder.com/150"
                                alt="Photo de profil"
                                class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <p class="font-medium text-gray-800">capsuledartiste</p>
                                <p class="text-sm text-gray-500">Capsule d’Artiste</p>
                            </div>
                        </div>
                        <button class="bg-blue-500 text-white px-4 py-1 rounded-full text-sm hover:bg-blue-600">
                            Ajouter
                        </button>
                    </div>

                    <!-- Suggestion 2 -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <img
                                src="https://via.placeholder.com/150"
                                alt="Photo de profil"
                                class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <p class="font-medium text-gray-800">nadouphotocom</p>
                                <p class="text-sm text-gray-500">Nadou 📸 Lyon, France</p>
                            </div>
                        </div>
                        <button class="bg-blue-500 text-white px-4 py-1 rounded-full text-sm hover:bg-blue-600">
                            Ajouter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
