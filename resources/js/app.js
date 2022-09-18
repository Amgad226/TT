import './bootstrap';
// window.Echo.channel(`Messenger.${userId}`)
// .listen('new-message',(e)=>{
//     alert(e)
//     console.log(`${userId}`);
//     })

// window.Echo.private
//     window.Echo.private(`private-Messenger.${userId}`)
// .listen('new-message',(e)=>{
//     alert(e)
//     console.log(`${userId}`);
//     })


//     Echo.private(`private-Messenger.${userId}`)
//     .listen('new-message', (e) => {
//         console.log(e);
//     });

//---------------------------------------------------------------
// @vite(['resources/js/app.js'])



     Pusher.logToConsole = true;

     var pusher = new Pusher('802b2b4536e206d4fd81', {
         cluster: 'eu',
    //   authEndpoint: 'http://127.0.0.1:8000/broadcasting/auth',
    //   auth: { headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}}
    
});

     var channel = pusher.subscribe(`Messenger.${userId}`);
     channel.bind('new-message', function(data) {
         alert(data);
        });
        channel.bind('pusher:subscription_error', function(data) {
            console.log(data);
            // alert('ddddd')
        });
        // pusher.signin()