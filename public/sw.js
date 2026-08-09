const CACHE_NAME = 'fitlife-hub-cache-v3';
const urlsToCache = [
  '/',
  '/images/icon-192.png',
  '/images/icon-512.png'
];

// Install Service Worker
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        return cache.addAll(urlsToCache);
      })
      .then(() => self.skipWaiting())
      .catch(err => console.log('SW cache install soft error handled:', err))
  );
});

// Activate Service Worker
self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cache => {
          if (cache !== CACHE_NAME) {
            return caches.delete(cache);
          }
        })
      );
    }).then(() => self.clients.claim())
  );
});

// Fetch Assets with Cache Fallback (Bypasses Admin Routes & Safely Catches Cache Errors)
self.addEventListener('fetch', event => {
  if (event.request.method !== 'GET') return;

  const url = new URL(event.request.url);

  // Bypass Service Worker Cache for Admin Routes & Non-HTTP Schemes
  if (url.pathname.startsWith('/admin') || !url.protocol.startsWith('http')) {
    return;
  }

  event.respondWith(
    fetch(event.request)
      .then(response => {
        if (response && response.status === 200 && response.type === 'basic') {
          const responseToCache = response.clone();
          caches.open(CACHE_NAME).then(cache => {
            cache.put(event.request, responseToCache).catch(() => {});
          }).catch(() => {});
        }
        return response;
      })
      .catch(() => {
        return caches.match(event.request);
      })
  );
});
