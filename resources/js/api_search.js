document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchUsers");
    const resultsContainer = document.getElementById("searchResults");

    searchInput.addEventListener("input", function () {
        let query = this.value.trim();

        if (query.length < 2) {
            resultsContainer.innerHTML = "";
            resultsContainer.classList.add("hidden");
            return;
        }

        fetch(`/api/search/users?q=${query}`)
            .then(response => response.json())
            .then(users => {
                resultsContainer.innerHTML = "";

                if (users.length === 0) {
                    resultsContainer.innerHTML = "<p class='p-2 text-gray-500'>Aucun résultat.</p>";
                } else {
                    users.forEach(user => {
                        resultsContainer.innerHTML += `
                            <div class="p-2 hover:bg-gray-100 flex items-center justify-between cursor-pointer">
                                <div class="flex items-center space-x-3">
                                    <img src="${user.url_profile ? '/storage/' + user.url_profile : '/storage/profile_photos/default-profile.jpg'}" class="w-10 h-10 rounded-full object-cover" alt="${user.pseudo}">
                                    <div>
                                        <p class="font-medium text-gray-800">${user.pseudo}</p>
                                        <p class="text-sm text-gray-500">${user.email}</p>
                                    </div>
                                </div>
                                <a href="/profile/${user.id}" class="bg-blue-500 text-white px-4 py-1 rounded-full text-sm hover:bg-blue-600">
                                    Profil
                                </a>
                            </div>
                        `;
                    });
                }
                resultsContainer.classList.remove("hidden");
            });
    });

    // Cacher les résultats si on clique ailleurs
    document.addEventListener("click", function (event) {
        if (!searchInput.contains(event.target) && !resultsContainer.contains(event.target)) {
            resultsContainer.classList.add("hidden");
        }
    });
});
