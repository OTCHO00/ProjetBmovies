$(document).ready(function () {
    $('#search').on('input', function () {
        var searchTerm = $(this).val().toLowerCase();
        var imagesFound = false;

        $('.movie-link').each(function () {
            var altText = $(this).find('img').attr('alt').toLowerCase();
            if (!altText.includes(searchTerm)) {
                $(this).hide();
            } else {
                imagesFound = true;
                $(this).show();
            }
        });

        if (!imagesFound) {
            if ($('.image-row p').length === 0) {
                $('.image-row').append('<p>Aucun résultat trouvé pour cette recherche.</p>');
                $('#footer').css('position', 'fixed').css('bottom', '0'); 
            }
        } else if ($('.image-row p').length <= 3){
            $('.image-row p').remove();
            $('#footer').css('position', 'static');
        }
    });
});