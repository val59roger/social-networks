// Attendre que tout le contenu du DOM soit chargé avant d'exécuter le script
document.addEventListener('DOMContentLoaded', () => {

    // Sélectionner tous les boutons de like avec la classe `like-button`
    document.querySelectorAll('.like-button').forEach(button => {

        // Ajouter un écouteur d'événements `click` sur chaque bouton de like
        button.addEventListener('click', function () {

            // Récupérer l'ID du post associé au bouton sur lequel on a cliqué
            const postId = this.getAttribute('data-post-id');

            // Basculer la classe `text-red-500` pour changer la couleur du bouton (passer en rouge ou revenir à la couleur initiale)
            this.classList.toggle('text-red-500');

            // Envoyer une requête AJAX pour ajouter ou supprimer un like sur le post
            fetch(`/posts/${postId}/like`, {
                method: 'POST', // Méthode HTTP utilisée pour la requête
                headers: {
                    // Récupérer le token CSRF depuis la balise meta du document pour sécuriser la requête
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json', // Type de contenu JSON
                },
            })
            .then(response => response.json()) // Convertir la réponse en JSON
            .then(data => {
                // Afficher dans la console le nombre actuel de likes après l'ajout/retrait
                console.log(`Likes count: ${data.likes_count}`);
            })
            .catch(error => console.error('Erreur:', error)); // Gérer les erreurs éventuelles
        });
    });
});
