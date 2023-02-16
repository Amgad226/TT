//Pusher.logToConsole = true;

setTimeout(() => {
    
            var pusher = new Pusher('802b2b4536e206d4fd81', {
                cluster: 'eu',
                authEndpoint: 'api/pusher/auth',
                auth: {  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}}
                });
    
                var channel = pusher.subscribe(`private-Messenger.${userId}`);
                let dataa = new FormData
                channel.bind('new-message', function(data) {
                    console.log(123)
                    // $(`.unread-message-count[data-messages=${data.message.conversation_id}]`).css('visibility','visiable');
                    // $(document).ready(function(){});  
                    // window.onload = function(){
                       
                    // }
                    // play();
                //---------------to replace last message in chat card------------------
                if(data.message.type=='text'){
                    var message_body_with_slice=data.message.body.slice(143, -129);
                    message_body_with_slice=message_body_with_slice.slice(0,10);  
                   $(`.last-message[data-messages=${data.message.conversation_id}]`).empty()  ;
                   $(`.last-message[data-messages=${data.message.conversation_id}]`).append(message_body_with_slice);
                }
                else {
                    $(`.last-message[data-messages=${data.message.conversation_id}]`).empty()  ;
                   $(`.last-message[data-messages=${data.message.conversation_id}]`).append(data.message.type);
                }
           
                
                    // conversation id from pusher   conversation id from chat 
                    if(data.message.conversation_id==response_conversation_id)
                    {
    
                        if(data.message.conversation.type=='group'){
    
                            addMessagesToGroup(data.message,'',true)
                        }
                        else{
                          
                            addMessage(data.message,'',true)
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
                   
                    // Push.create(data.message.user.name, {
                    //     body: message_body_with_slice,
                    //     icon: logo,
                    //     timeout: 8000,
                    //     onClick: function () {
                    //         window.focus();
                    //         this.close();
                    //         open_chat(data.message.conversation_id)
                    //     }
                    // });     
                    //-----------to replace number of message un readed-----------------
                    // $(`.unread-message-count[data-messages=${data.message.conversation_id}]`).css('visibility','visiable');
                    // alert($(`.unread-message-count[data-messages=${data.message.conversation_id}]`).text())
                    if($(`.unread-message-count[data-messages=${data.message.conversation_id}]`).text()>=1){

                        $(`.unread-message-count[data-messages=${data.message.conversation_id}]`).removeClass('d-none')   
                        $(`.unread-message-count[data-messages=${data.message.conversation_id}]`).html(parseInt($(`.unread-message-count[data-messages=${data.message.conversation_id}]`).text())+1);
                        
                    }

                    else{
                        $(`.unread-message-count[data-messages=${data.message.conversation_id}]`).removeClass('d-none')   
                        $(`.unread-message-count[data-messages=${data.message.conversation_id}]`).html(1)   
                    }
                  
                    // else{
    

                    // }
                    
                    //-----------------to reciave toast ---------------------

                    // Push.create(data.message.user.name, {
                    //     body: message_body_with_slice,
                    //     icon: logo,
                    //     timeout: 4000,
                    //     tag:"f",
                    //     onClick: function () {
                    //         window.focus();
                    //         this.close();
                    //         open_chat(data.message.conversation_id)   

                    //     }
                    // });  
                    //--------------------------------------------------------
                    // Notification.requestPermission().then(prem=>{
                    //     if(prem=="granted")
                    //     {
                    //          play();

                    //         const notificationn=   new Notification(data.message.user.name,{ 
                    //             body:message_body_with_slice,
                    //             icon:logo,
                    //             timestamp:500,
                    //             silent:true,
                    //          });
                    //             notificationn.onclick=(e)=>{
                    //                 window.focus();
                    //                 this.close();
                    //                 open_chat(data.message.conversation_id)   
                    //                                          }
                    //                 setTimeout(() => {
                    //                     notificationn.close(); 
                    //                 }, 1000);
                    //     }
                    //     else
                    //     {   
                            // play();

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
                             play();

                            $(".toast-recive").toast({ delay: 3000 });
                            $('.toast-recive').toast({animation: true});
                            $('.toast-recive').toast('show');                       
                    //      }
                    // });



                 
                    
                        // console.log( data.message.user.name+' sent message');
                    } 
                });
            
                channel.bind('pusher:subscription_error', function(data) {
                    console.log(data);
                });
}, 500);
