
//*************************************************************************//
//*************************************************************************//
//Dans ces deux variables on stock le nom de notre cache + l'assets qui contient les fichiers à garder en cache.
const NomDuCache= 'ma_sauvegarde';
const assets = [
    '/',
    '/index.php',
    '../ressources/views/index.blade.php',
    '../ressources/views/offres.blade.php',
    '../ressources/views/entreprise.blade.php',
    '../ressources/views/accounts.blade.php',
    '/manifest.json',
    '/static/base.js',
    '/static/index.js',
    '../ressources/css/base.css',
    '../ressources/css/index.css',
    '/static/images/Y.png'
];

//*************************************************************************//
//*************************************************************************//
//Installation du service worker
self.addEventListener('install', evt => {

     evt.waitUntil(  caches.open(NomDuCache).then(cache => {
        console.log('caching shell assets');
        cache.addAll(assets);
        })
    )

});

//*************************************************************************//
//*************************************************************************//
//Activation du Service Worker
self.addEventListener('activate', evt => {
    console.log('service Worker has been activated');
});

//*************************************************************************//
//*************************************************************************//
//fetch event afin de répondre quand on est en mode hors ligne.
self.addEventListener('fetch', function(event) {
    event.respondWith(
      caches.open('ma_sauvegarde').then(function(cache) {
        return cache.match(event.request).then(function (response) {
          return response || fetch(event.request).then(function(response) {
            cache.put(event.request, response.clone());
            return response;
          });
        });
      })
    );
  });
