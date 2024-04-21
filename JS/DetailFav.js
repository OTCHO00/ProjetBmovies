$(document).ready(function () {
    function downloadImage(imageUrl) {
        // Fonction pour télécharger une image
        var link = document.createElement('a');
        link.href = imageUrl;
        link.download = 'image.jpg';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

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


        var $dislike = $('<img src="../Images/Dislike.png" alt="Dislike">').css({
            'position': 'fixed',
            'top': '80%',
            'right': '30%',
            'width': '70px',
            'height': 'auto',
            'z-index': '9999',
            'cursor': 'pointer'
        });
        

        var $downloadLink = $('<img src="../Images/Download.png" alt="Download">').css({
            'position': 'fixed',
            'top': '88%',
            'right': '30%',
            'width': '70px',
            'height': 'auto',
            'z-index': '9999',
            'cursor': 'pointer'
        });

        // Gestionnaire d'événements pour le clic sur l'icône de croix
        $cross.on('click', function () {
            $dislike.remove(); 
            $clone.remove();
            $background.remove();
            $(this).remove();
            $downloadLink.remove();
        });

        $('body').append($cross);
        $('body').append($dislike);
        $('body').append($downloadLink);


        $clone.on('click', function () {
            $dislike.remove();  
            $clone.remove();
            $background.remove();
            $cross.remove();
            $downloadLink.remove();
        });

        $downloadLink.on('click', function () {
            downloadImage(imageUrl);
        });


        $dislike.on('click', function () {
            var $dislikeImg = $(this);
            var isDisliked = $dislikeImg.attr('src') === '../Images/DislikeB.png';
        
            var contentId = null;
        
            if (typeof filmId !== 'undefined') {
                // C'est un film
                contentId = filmId;
            } else if (typeof serieId !== 'undefined') {
                // C'est une série
                contentId = serieId;
            }
        
            if (isDisliked) {
                // L'icône est déjà désactivée, donc il faut réactiver le like
                $dislikeImg.attr('src', '../Images/Dislike.png');
            } else {
                // L'icône est activée, donc il faut retirer le like
                $dislikeImg.attr('src', '../Images/DislikeB.png');
                if (contentId !== null) {
                    removeLike(contentId);
                }
            }
        });

        function removeLike(contentId) {
            // Déterminez si c'est un film ou une série en fonction de la présence de filmId ou serieId
            var action = (typeof filmId !== 'undefined') ? 'remove-like-film' : 'remove-like-serie';
        
            $.ajax({
                method: 'POST',
                url: '../Controler/remove-like.php',
                data: {
                    contentId: contentId,
                    action: action
                },
                success: function (response) {
                    console.log('Like retiré avec succès pour le contenu ID : ' + contentId);
                    console.log(response); // Vérifiez la réponse du serveur
                    console.log("Content ID:", contentId);
                    console.log("Action:", action);
                },
                error: function (xhr, status, error) {
                    console.error('Erreur lors du retrait du like :', error);
                }
            });
        }



    });
});
