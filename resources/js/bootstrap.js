import _ from 'lodash';
window._ = _;

// import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

 import Echo from 'laravel-echo';

 import Pusher from 'pusher-js';
// console
 window.Pusher = Pusher;
 
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    authEndpoint: '/api/pusher/auth',

    auth: {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }
 
});
//  window.Pusher = Pusher;
 
//  window.Echo = new Echo({
//      broadcaster: 'pusher',
//      key: import.meta.env.VITE_PUSHER_APP_KEY,
//      wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//      wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//      wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//      forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//      enabledTransports: ['ws', 'wss'],
//      auth: {
//                 headers: {
                    // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 }
//             }
 
//  });
 
//  PUSHER_APP_ID=1462763
// PUSHER_APP_KEY=337a574efe26825afd27
// PUSHER_APP_SECRET=5b6a7e34feb382769583