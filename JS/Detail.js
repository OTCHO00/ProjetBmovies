$(document).ready(function () {

    function downloadImage(imageUrl) {
        var link = document.createElement('a');
        link.href = imageUrl;
        link.download = 'image.jpg';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    $('.movie-link').on('click', function () {

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
        var $like = $('<img src="../Images/Like.png" alt="Like">').css({
            'position': 'fixed',
            'top': '72%',
            'right': '30%',
            'width': '70px',
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

        $('body').append($cross);
        $('body').append($like);
        $('body').append($dislike);
        $('body').append($downloadLink);

        $cross.on('click', function () {
            $clone.remove();
            $background.remove();
            $(this).remove();
            $downloadLink.remove();
            $like.remove();
            $dislike.remove();
        });

        $like.on('click', function () {
            var $likeImg = $(this);
            var filmId = $likeImg.closest('.movie-link').data('film-id');
            var filmName = $likeImg.closest('.movie-link').data('film-name');
            console.log("Clic sur l'icône de like pour le film :", filmName); 
        
            if ($likeImg.attr('src') === '../Images/LikeB.png') {
                $likeImg.attr('src', '../Images/Like.png');
                removeLike(filmId);
            } else {
                $likeImg.attr('src', '../Images/LikeB.png');
                addLike(filmId, filmName);
            }
        });
        
        $dislike.on('click', function () {
            var $dislikeImg = $(this);
            var filmId = $dislikeImg.closest('.movie-link').data('film-id');
            var filmName = $dislikeImg.closest('.movie-link').data('film-name'); 
        
            console.log("Clic sur l'icône de dislike pour le film :", filmName);    
        
            if ($dislikeImg.attr('src') === '../Images/DislikeB.png') {
                $dislikeImg.attr('src', '../Images/Dislike.png');
                removeDislike(filmId);
            } else {
                $dislikeImg.attr('src', '../Images/DislikeB.png');
                addDislike(filmId, filmName); 
            }
        });

        $clone.on('click', function () {
            $(this).remove();
            $background.remove();
            $cross.remove();
            $downloadLink.remove();
            $like.remove();
            $dislike.remove();
        });

        $downloadLink.on('click', function () {
            downloadImage(imageUrl);
        });

        function addLike(filmId, filmName) {
            $.ajax({
                method: 'POST',
                url: 'update-like.php',
                data: { filmId: filmId, action: 'like', filmName: filmName }, 
                success: function (response) {
                    console.log('Like ajouté avec succès !');
                },
                error: function (xhr, status, error) {
                    console.error('Erreur lors de l\'ajout du like :', error);
                }
            });
        }
        
        function addDislike(filmId, filmName) {
            $.ajax({
                method: 'POST',
                url: 'update-like.php',
                data: { filmId: filmId, action: 'dislike', filmName: filmName }, 
                success: function (response) {
                    console.log('Dislike ajouté avec succès !');
                },
                error: function (xhr, status, error) {
                    console.error('Erreur lors de l\'ajout du dislike :', error);
                }
            });
        } 
        function removeLike(filmId) {
            $.ajax({
                method: 'POST',
                url: 'remove-like.php',
                data: { filmId: filmId, action: 'removeLike' },
                success: function (response) {
                    console.log('Like supprimé avec succès !');
                },
                error: function (xhr, status, error) {
                    console.error('Erreur lors de la suppression du like :', error);
                }
            });
        }
        
        function removeDislike(filmId) {
            $.ajax({
                method: 'POST',
                url: 'remove-like.php',
                data: { filmId: filmId, action: 'removeDislike' },
                success: function (response) {
                    console.log('Dislike supprimé avec succès !');
                },
                error: function (xhr, status, error) {
                    console.error('Erreur lors de la suppression du dislike :', error);
                }
            });
        }
    });
});



