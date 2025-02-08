document.addEventListener('DOMContentLoaded', () => {
    console.log("Script comments.js chargé ✅");

    // 👉 Afficher/masquer la zone de commentaire au clic
    document.querySelectorAll('.comment-toggle').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');
            const commentSection = document.getElementById(`comment-section-${postId}`);
            commentSection.classList.toggle('hidden');
        });
    });

    // 👉 Gérer l'envoi d'un commentaire
    document.querySelectorAll('.post-comment').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');
            const commentSection = document.getElementById(`comment-section-${postId}`);
            const textarea = commentSection.querySelector('textarea');
            const content = textarea.value.trim();

            if (content === '') {
                alert("Le commentaire ne peut pas être vide.");
                return;
            }

            // Envoi AJAX pour ajouter le commentaire
            fetch(`/posts/${postId}/comment`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ content }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.comment) {
                    const commentContainer = document.querySelector(`.comments-container[data-post-id='${postId}']`);

                    // Création du nouvel élément de commentaire
                    const newComment = document.createElement('div');
                    newComment.classList.add('flex', 'items-start', 'space-x-2', 'mt-3', 'relative');
                    newComment.innerHTML = `
                        <img src="/storage/${data.comment.user_profile}"
                            alt="Photo de ${data.comment.user}"
                            class="w-10 h-10 rounded-full border border-gray-300">
                        <div>
                            <a href="/profile/${data.comment.user_id}" class="font-semibold text-sm text-blue-500 hover:underline">
                                ${data.comment.user}
                            </a>
                            <p class="comment-text text-gray-700 text-sm" data-comment-id="${data.comment.id}">
                                ${data.comment.content}
                            </p>
                        </div>

                        <!-- Bouton Options (⋮) -->
                        <button class="comment-options-btn text-gray-500 absolute right-0 top-1/2 transform -translate-y-1/2" data-comment-id="${data.comment.id}">
                            ⋮
                        </button>

                        <!-- Menu contextuel -->
                        <div class="flex comment-menu hidden absolute bg-white shadow-md rounded right-0 z-10 border-2 border-black" data-comment-id="${data.comment.id}">
                            <button class="edit-comment text-white bg-blue-500 p-2" data-comment-id="${data.comment.id}">Modifier</button>
                            <button class="delete-comment text-white bg-red-500 p-2" data-comment-id="${data.comment.id}">Supprimer</button>
                        </div>
                    `;

                    // Ajouter le commentaire dans la liste
                    commentContainer.appendChild(newComment);

                    // Vider le champ après ajout
                    textarea.value = '';
                }
            })
            .catch(error => console.error('Erreur:', error));
        });
    });

    // 👉 Afficher le menu contextuel au clic sur "⋮"
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('comment-options-btn')) {
            console.log("Bouton Options cliqué 🎯");

            const commentId = event.target.getAttribute('data-comment-id');

            // Cacher tous les autres menus ouverts
            document.querySelectorAll('.comment-menu').forEach(menu => menu.classList.add('hidden'));

            // Afficher le menu du bon commentaire
            const menu = document.querySelector(`.comment-menu[data-comment-id='${commentId}']`);
            if (menu) {
                menu.classList.toggle('hidden');
            }
        }
    });

    // 👉 Fermer le menu contextuel si on clique ailleurs
    document.addEventListener('click', function (event) {
        if (!event.target.classList.contains('comment-options-btn')) {
            document.querySelectorAll('.comment-menu').forEach(menu => menu.classList.add('hidden'));
        }
    });

    // 👉 Modifier un commentaire
    document.addEventListener('click', function (event) {
        const editBtn = event.target.closest('.edit-comment');
        if (editBtn) {
            console.log("Modification du commentaire 📝");

            const commentId = editBtn.getAttribute('data-comment-id');
            // On s'assure que le bouton possède bien l'ID
            if (!commentId) {
                console.error("ID de commentaire non défini !");
                return;
            }

            const commentText = document.querySelector(`.comment-text[data-comment-id='${commentId}']`);
            if (!commentText) {
                console.error("Le contenu du commentaire n'a pas été trouvé pour l'ID", commentId);
                return;
            }

            // Remplace le texte par un champ input pour l'édition
            const currentText = commentText.textContent;
            commentText.innerHTML = `<input type="text" class="border p-1 w-full edit-input" value="${currentText}">`;

            // Focus sur l'input
            const inputField = commentText.querySelector('.edit-input');
            inputField.focus();

            // Sauvegarder la modification lorsque l'utilisateur appuie sur "Enter"
            inputField.addEventListener('keydown', function (event) {
                if (event.key === 'Enter') {
                    const newText = this.value.trim();
                    if (newText !== '') {
                        fetch(`/comments/${commentId}/edit`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ content: newText }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.updatedContent) {
                                commentText.innerHTML = data.updatedContent; // Met à jour le contenu
                                console.log("Commentaire modifié ✅");
                            } else {
                                console.error("Erreur de modification :", data.error);
                            }
                        })
                        .catch(error => console.error('Erreur:', error));
                    }
                }
            });
        }
    });


    // 👉 Supprimer un commentaire
    document.addEventListener('click', function (event) {
        // Utiliser closest() pour s'assurer qu'on cible bien le bouton delete
        const deleteBtn = event.target.closest('.delete-comment');
        if (!deleteBtn) return; // Si le clic ne provient pas d'un bouton de suppression, on quitte

        // Affichage de debug
        console.log("Bouton de suppression cliqué :", deleteBtn);
        const commentId = deleteBtn.getAttribute('data-comment-id');
        console.log("ID récupéré :", commentId);

        if (!commentId) {
            console.error("L'attribut data-comment-id est introuvable sur le bouton de suppression.");
            return;
        }

        if (!confirm("Voulez-vous vraiment supprimer ce commentaire ?")) return;

        fetch(`/comments/${commentId}/delete`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remonter jusqu'au conteneur du commentaire.
                // Ici, nous supposons que le conteneur principal du commentaire possède les classes suivantes :
                // "flex items-start space-x-2 mt-3"
                const commentElement = deleteBtn.closest('.flex.items-start.space-x-2.mt-3');
                if (commentElement) {
                    commentElement.remove();
                    console.log("Commentaire supprimé ✅");
                } else {
                    console.warn("Le conteneur du commentaire n'a pas été trouvé.");
                }
            } else {
                console.error("Erreur de suppression :", data.error);
            }
        })
        .catch(error => console.error('Erreur:', error));
    });
});
