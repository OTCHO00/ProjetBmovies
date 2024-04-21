$(document).ready(function () {

    // Gestionnaire d'événements pour le clic sur .movie-link
    $('.movie-link').on('click', function () {
        var filmId = $(this).data('film-id');
        var serieId = $(this).data('serie-id');

        if (typeof filmId !== 'undefined') {
            // C'est un film
            console.log('Film ID:', filmId);
            console.log('Film Name:', $(this).data('film-name'));

        } else if (typeof serieId !== 'undefined') {
            // C'est une série
            console.log('Serie ID:', serieId);
            console.log('Serie Name:', $(this).data('serie-name'));
        }

        var imageUrl = $(this).find('img').attr('src');
        var $clone = $(this).find('img').clone().addClass('enlarged-image');
        var $background = $('<div class="blurred-background"></div>');

        $('body').append($clone, $background);

        var $cross = $('<img src="../Images/cross.webp" alt="cross">').css({
            'position': 'fixed',
            'top': '5%',
            'right': '3%',
            'transform': 'translate(-50%, -50%)',
            'width': '45px',
            'height': 'auto',
            'z-index': '9999',
            'cursor': 'pointer'
        });

        var $poubelle = $('<img src="../Images/Poubelle.png" alt="Poubelle">').css({
            'position': 'fixed',
            'top': '86%',
            'right': '30%',
            'width': '70px',
            'height': 'auto',
            'z-index': '9999',
            'cursor': 'pointer'
        });

        // Gestionnaire d'événements pour le clic sur l'icône de croix
        $cross.on('click', function () {
            $poubelle.remove();
            $clone.remove();
            $background.remove();
            $(this).remove();
        });

        // Gestionnaire d'événements pour le clic sur l'icône de la poubelle
        $poubelle.on('click', function () {
            // Envoyer une requête AJAX pour supprimer l'image de film correspondante
            $.ajax({
                method: 'POST',
                url: '../Controler/delete-movie-image.php', // Endpoint pour supprimer l'image
                data: {
                    filmId: filmId // Envoyer l'ID du film à supprimer
                },
                success: function (response) {
                    console.log('Image de film supprimée avec succès.');
                    // Supprimer visuellement l'image de film de l'interface utilisateur
                    $clone.remove();
                    $background.remove();
                    $cross.remove();
                    $poubelle.remove();
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error('Erreur lors de la suppression de l\'image de film :', error);
                }
            });
        });

        $('body').append($cross);
        $('body').append($poubelle);

        $clone.on('click', function () {
            $poubelle.remove();
            $clone.remove();
            $background.remove();
            $cross.remove();
        });
    });
});
