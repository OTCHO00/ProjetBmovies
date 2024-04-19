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
        var filmName = $(this).data('film-name');

        console.log('Film ID:', filmId);
        console.log('Film Name:', filmName);

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
            $clone.remove();
            $background.remove();
            $(this).remove();
            $downloadLink.remove();
            $like.remove();
            $dislike.remove();
        });

        $('body').append($cross);
        $('body').append($downloadLink);


        $clone.on('click', function () {
            $clone.remove();
            $background.remove();
            $cross.remove();
            $downloadLink.remove();
            $like.remove();
            $dislike.remove();
        });

        $downloadLink.on('click', function () {
            downloadImage(imageUrl);
        });

        
        

    });
});
