import './bootstrap';
// alert(1);

// window.Echo.private(`Messenger.${userId}`)
// .listen('.new-message', (e) => {
//      alert(e);
//      console.log(12312312);
// });


//---------------------------------------------------------------
// @vite(['resources/js/app.js'])



$('.input-have-message').on('keydown', function(){
    let channel = Echo.private('chat')

     setTimeout( () => {
       channel.whisper('typing', {
         user: userId,
         conversation_id:response_conversation_id,
         typing: true
       })
     }, 300)
      if( $('.input-have-message').val().length == 0 ) 
            stopTyping(); 
        
});
     function stopTyping(){
        let channel = Echo.private('chat')

        setTimeout( () => {
          channel.whisper('typing', {
            user: userId,
            conversation_id:response_conversation_id,
            typing: false
          })
        }, 300)

     }
   
                      setTimeout( () => {
     
                      Echo.private('chat')
                    .listenForWhisper('typing', (e) => {
                        // console.log(e.conversation_id);
                        if(response_conversation_id==e.conversation_id)
                        {
                        if(e.typing)
                        $('#is-typing').removeClass('d-none')
                        else
                        $('#is-typing').addClass('d-none')        
                        }
                        
                    })
                }, 300)

 
