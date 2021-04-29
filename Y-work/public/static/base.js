$(document).ready(function () {

    if ($('.brands_slider').length) {
        var brandsSlider = $('.brands_slider');

        brandsSlider.owlCarousel(
            {
                loop: true,
                autoplay: true,
                autoplayTimeout: 5000,
                nav: false,
                dots: false,
                autoWidth: true,
                items: 8,
                margin: 42
            });

        if ($('.brands_prev').length) {
            var prev = $('.brands_prev');
            prev.on('click', function () {
                brandsSlider.trigger('prev.owl.carousel');
            });
        }

        if ($('.brands_next').length) {
            var next = $('.brands_next');
            next.on('click', function () {
                brandsSlider.trigger('next.owl.carousel');
            });
        }
    }


});

if('serviceWorker' in navigator){
    navigator.serviceWorker.register('../ServiceWorker.js') //Appelle du serviceWorker.js
    .then( (sw) => console.log('Le Service Worker a été pris en charge', sw)) // si le SW s'est bien exécuté cela affichera ceci.
    .catch((err) => console.log('Le Service Worker est introuvable', err)); // sinon il affichera ceci.
}
