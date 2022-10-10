//Pusher.logToConsole = true;

setTimeout(() => {
    
            var pusher = new Pusher('802b2b4536e206d4fd81', {
                cluster: 'eu',
                authEndpoint: 'http://127.0.0.1:8000/api/pusher/auth',
                auth: {  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}}
                });
    
                var channel = pusher.subscribe(`private-Messenger.${userId}`);
                let dataa = new FormData
                channel.bind('new-message', function(data) {
                    // $(document).ready(function(){});  
                 
    
                //---------------to replace last message in chat card------------------
                 var message_body_with_slice=data.message.body.slice(140, -129);
                 message_body_with_slice=message_body_with_slice.slice(0,10);  
                $(`.last-message[data-messages=${data.message.conversation_id}]`).empty()  ;
                $(`.last-message[data-messages=${data.message.conversation_id}]`).append(message_body_with_slice);  
                
                    // conversation id from pusher   conversation id from chat 
                    if(data.message.conversation_id==response_conversation_id)
                    {
    
                        if(data.message.conversation.type=='group'){
    
                            addMessage(data.message,'',true,true)
                        }
                        else{
                          
                            addMessage(data.message,'',true,false)
                        }
                        
                        dataa.append('message_id',data.message.id)
                        fetch('/api/readMessage', {
                        method: 'POST',
                        body:dataa,
                        headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                        
                        }
                    });
                }
                
                else{
                    
                    //-----------to replace number of message un readed-----------------
                    if($(`.unread-message-count[data-messages=${data.message.conversation_id}]`).text()=='')
                    {
               
                        $(`.unread-message-count[data-messages=${data.message.conversation_id}]`).css('visibility','');
                       
                    }
                    else{
    
                        $(`.unread-message-count[data-messages=${data.message.conversation_id}]`).html(parseInt($(`.unread-message-count[data-messages=${data.message.conversation_id}]`).text())+1);
                    }
    
                    //-----------------to reciave toast ---------------------
                    $('.goToChat').attr('chat-id',data.message.conversation_id)
                    $('.headarToast').empty();
                    $('.bodyToast').empty();
                    if(data.message.conversation.type=='group')
                    {
                        $('.headarToast').append(data.message.conversation.lable);
                        $('.bodyToast').append(data.message.user.name+' : '+message_body_with_slice);
                    }
                    else
                    {
                        $('.headarToast').append(data.message.user.name);
                        $('.bodyToast').append(message_body_with_slice);    
                    }
                    $(".toast").toast({ delay: 3000 });
                    $('.toast').toast({animation: true});
                    $('.toast').toast('show');
                    // console.log( data.message.user.name+' sent message');
                    } 
                });
            
                channel.bind('pusher:subscription_error', function(data) {
                    console.log(data);
                });
}, 1000);
