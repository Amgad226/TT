import './bootstrap';

window.Echo.private(`Messenger.${userId}`)
    .listen('.new-message', (e) => {
        console.log(e.message);
    });

