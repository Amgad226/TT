//Pusher.logToConsole = true;

setTimeout(() => {
            var pusher = new Pusher('802b2b4536e206d4fd81', {
                cluster: 'eu',
                authEndpoint: 'api/pusher/auth',
                auth: {
                    headers: {
                       'Authorization':`Bearer ${tokenn}`
                   }}
                });

                var channel = pusher.subscribe(`private-Messenger.${userId}`);
                channel.bind('new-message', function(data) {
                  
                //---------------to replace last message in chat card------------------
                var message_body_with_slice=data.message.type;

                if(data.message.type=='text'){
                     message_body_with_slice=data.message.body;
                    

                   $(`.last-message[data-messages=${data.message.conversation_id}]`).empty()  ;
                   $(`.last-message[data-messages=${data.message.conversation_id}]`).append(message_body_with_slice);
                }
                else {
                    $(`.last-message[data-messages=${data.message.conversation_id}]`).empty()  ;
                    $(`.last-message[data-messages=${data.message.conversation_id}]`).append(data.message.type);
                }

                    // conversation id from pusher   conversation id from chat
                    data.message.conversation_id=data.message.conversation.id
                    // console.log(data);
                    // console.log(data.message.conversation_id, 'from pusher');
                    // console.log(response_conversation_id, 'response_conversation_id');
                if(data.message.conversation_id==response_conversation_id)
                {
                    if(data.message.conversation.type=='group'){
                        addMessagesToGroup(data.message,'',true)
                    }
                    else{
                        addMessage(data.message,'',true)
                    }
                    fetch(`/api/readMessage/${data.message.id}`, { method: 'get', headers: {    'Authorization':`Bearer ${tokenn}`} });
                }

                else{
                        play() ;
                    
                        if($(`.unread-message-count[data-messages=${data.message.conversation_id}]`).text()>=1){
                            $(`.unread-message-count[data-messages=${data.message.conversation_id}]`).removeClass('d-none')
                            $(`.unread-message-count[data-messages=${data.message.conversation_id}]`).html(parseInt($(`.unread-message-count[data-messages=${data.message.conversation_id}]`).text())+1);
                        }
                    
                        else{
                            $(`.unread-message-count[data-messages=${data.message.conversation_id}]`).removeClass('d-none')
                            $(`.unread-message-count[data-messages=${data.message.conversation_id}]`).html(1)
                        }
                    
                    
                        $('.goToChat').attr('chat-id',data.message.conversation_id)
                        $('.headarToast').empty();
                        $('.bodyToast').empty();
                        if(data.message.conversation.type=='group'){
                            $('.headarToast').append(data.message.conversation.lable);
                            $('.bodyToast').append(data.message.user.name+' : '+message_body_with_slice);
                        }

                        else{
                            $('.headarToast').append(data.message.user.name);
                            $('.bodyToast').append(message_body_with_slice);
                        }
                    
                        $(".toast-recive").toast({ delay: 3000 });
                        $('.toast-recive').toast({animation: true});
                        $('.toast-recive').toast('show');
                }
                });

                channel.bind('pusher:subscription_error', function(data) {
                    console.log(data);
                });
}, 500);
