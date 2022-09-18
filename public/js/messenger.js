// const a ='http://192.168.43.194:8000';
const a ='http://127.0.0.1:8000';
const tokenn =  $('meta[name="csrf-token"]').attr('content')

$("#targetttt").on('submit',function(e){
    // console.log('angadsasdoas');
    e.preventDefault();
    let msg=$(this).find('textarea').val()
    $.post($(this).attr('action') ,$(this).serialize() , function(response){
        // console.log(response[0].html);
        addMessage(response.obj_msg ,'message-out')
        
    }

    );

    
$(this).find('textarea').val('');

});

$("#change_pass").on('submit',function(e){
    e.preventDefault();
    $.post($(this).attr('action') ,$(this).serialize() , function(response){
        alert(response.message)
    });

});

$("#searchhh_chats").on('submit',function(e){
    e.preventDefault();
    $.post($(this).attr('action') ,$(this).serialize() , function(response){
        search_chats(response)  
    });
// $(this).find('#aso').val('');
});

$("#search_users").on('submit',function(e){
    e.preventDefault();
    $.post($(this).attr('action') ,$(this).serialize() , function(response){
        search_users(response)  
    });
// $(this).find('#aso').val('');
});

const search_users = function(res){
    // alert(res.name)
    
    $("#users_in_searsh").replaceWith(` 
    <div id="users_in_searsh" class="card-list">
    </div>
`);
for(let i = 0; i<
    res.length ;i++)
{
    // alert(2)
    $("#users_in_searsh").append(`
  
    <div id="users_in_searsh" class="card-list">
  
    <div class="card border-0">
        <div id="users-body" class="card-body">

            <div class="row align-items-center gx-5">
                <div class="col-auto">
                    <a href="#" class="avatar avatar-online">
                     
                        <img class="avatar-img" src="${res[i].img}" alt="">
                        
                        
                    </a>
                </div>

                <div class="col">
                    <h5>
                      <a href="#">${res[i].name}</a></h5>
                     <!-- <p>${res[i].last_seen_at}</p> -->
                </div>

                <div  class="col-auto">
         
                    <input class="onlL" onclick=myFunction()  type="submit" value="Hi"  style="text-decoration: none;border-radius: 9px;border:solid 1px #3e444f ;cursor : pointer;padding:0px 15px ;text-align: center;color:#fff;background-color: #16191c ;" >
                    <script>
                    function myFunction() {
                        alert('message [hi] sended , go to chat to complete conversation');
                        let data = new FormData
                                data.append('message','Hi');
                                data.append('user_id',1);
                        fetch(a+"/api/messages", {
                            method: "POST",
                            body:data,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        // alert(12)
                    }
                    </script>
                    
                    
            
                </div>

            </div>

        </div>
    </div>
    <!-- Card -->

</div>
<br>
`)
}
}

const search_chats = function(res){
    
    $("#chat-list").replaceWith(` 
    <div id="chat-list">
</div>
`);
for(let i = 0; i<
    res.length ;i++)
{
    // alert(2)
    $("#chat-list").append(`
    <div id="card_to_append_search" style="  margin-bottom: 13px  ">

    <a href="http://127.0.0.1:8000/a/${res[i].conversation_id}" class="card border-0 text-reset">
    
        <div  class="card-body">
            <div class="row gx-5">
                <div class="col-auto">
                    <div class="avatar avatar-online">

                    </div>
                </div>

                <div class="col">
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="me-auto mb-0">  ${res[i].name}</h5>

                        <span class="text-muted extra-small ms-2"> ${res[i].created_at}</span>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="line-clamp me-auto">
                        ${res[i].body}
                        </div>

                        <div class="badge badge-circle bg-primary ms-5">
                            <span>3</span>
                        </div>
                    </div>
                </div>
            </div>

        
            </div>
    </a>

</div>
`)
}
}

const addMessage = function(msg ,c = '' ,isAnimate = true){
    const $container = $('.form-ccontainer');
    if (isAnimate) {
        $container.animate({
          scrollTop: $container.prop('scrollHeight')
        });
      } else {
        $container.scrollTop($container.prop('scrollHeight'))
        // $container.scrollTop = 9c9;
      }
    // $container.animate({
    //     scrollTop: $container.prop('scrollHeight')
    //   }, 1000);
      
    $("#soso").append(`
    
    

<div class="message ${c} ">

    <div class="message-inner" >
        <div class="message-body">
            <div class="message-content">
                <div class="message-text ">
                    <p>${msg.body} 
                    <spam class="sended  fas fa-check" style="position:relative ;bottom:-12px;right:-10px;z-index:12;"></spam> 
                    </p>
                </div>
            </div> 
        </div>

        <div class="message-footer">
            <span class="extra-small text-muted">${moment(msg.created_at).fromNow()}</span>
        </div>
    </div>
</div>



`);
const sendMessage = (selector, isAnimate = true) => {
    const text = $(selector).val();
    const $container = $('.form-container');
    $container.append(`<p>${text}</p>`);
    if (isAnimate) {
      $container.animate({
        scrollTop: $container.prop('scrollHeight')
      }, 1000);
    } else {
      $container.scrollTop($container.prop('scrollHeight'));
    }
    $(selector).val('');
  };
  
  $('button:eq(0)').on('click', function() {
    sendMessage('input[type=text]');
  });
  
  $('button:eq(1)').on('click', function() {
    sendMessage('input[type=text]', false);
  });

}

const getConversations=function(){
    $.get(a+'/api/conversations',function(response){
  
        for(i in response)
        {
            // console.log(response[i].conversation.last_massege.body);
        conversation(response[i])
        }
    

    })
}

const conversation=function(chat){
    $('#chat-list').append(`

    <a href="#" id="roro" data-messages=${chat.conversation.id} class="card border-0 text-reset">
    <div  class="card-body">
        <div class="row gx-5">
            <div class="col-auto">
                <div class="avatar avatar-online">
                  
                    <img src="${chat.conversation.partiscipants[0].img}" alt="#" class="avatar-img">
                </div>
            </div>

            <div class="col">
                <div class="d-flex align-items-center mb-3">
                    <h5 class="me-auto mb-0">
                       
                    ${chat.conversation.partiscipants[0].name}</h5>
                    <span class="text-muted extra-small ms-2">${moment(chat.conversation.last_massege.created_at).fromNow()}</span>
                </div>

                <div class="d-flex align-items-center">
                    <div class="line-clamp me-auto">
                    ${chat.conversation.last_massege.body}
                    </div>

                    <div class="badge badge-circle bg-primary ms-5">
                        <span>3</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .card-body -->

    
</a>

    `)
}

$(`#chat-list`).on('click','[data-messages]',function(e){
    // alert(111);
    $(".footer-input-chat").css("display", "block");
    $(".app-bar-name-and-img").css("display", "block");
    $(".welcome-text").css("display", "none");
    $(".form-ccontainer").css("display", "block");
    
    e.preventDefault();
    let id =$(this).attr('data-messages');
    $(`#soso`).empty();
    $('input[name=conversation_id]').val(id)
    $.get(a+`/api/conversations/${id}/messages` , function(response){
        
        $('#chat-name').text(response.conversation.partiscipants[0].name);
        $('#chat-img').attr('src',response.conversation.partiscipants[0].img);
        for(i in response.messeges)
        {
            // alert(1)
            // console.log(userId);
        let msg = response.messeges[i];
        let c  = msg.user_id ==userId ? 'message-out' :'';
        addMessage(msg , c ,false)
        }    
    })
})

$(`#tab-chats`).on('click',function(e){
    $(`#chat-list`).empty();
    getConversations();

});
 
$(`#tab-friends`).on('click',function(e){
    $(`#users_in_searsh`).empty();
    getFriends();

});

$(`#tab-all-users`).on('click',function(e){
    $(`#all_users_in_app`).empty();
    getUsers();

});

$(`#tab-notifications`).on('click',function(e){
    $(`#cards-notification`).empty();
    getNotification();

});



const getNotification=function(){
    $.get(a+'/api/getNotification',function(response){
  
        for(i in response)
        {
            // alert(response[i].type);
        notification(response[i])
        }
    })
}

const notification=function(chat){
    if(chat.type=='request')
    {
    $('#cards-notification').append(`
    
    <div id="cardNoti"  class="card border-0 mb-5">
    <div class="card-body">

        <div class="row gx-5">
            <div class="col-auto">
                <!-- Avatar -->
                <a href="#" class="avatar">
                    <img class="avatar-img" src="${chat.img}" alt="">

                    <div class="badge badge-circle bg-primary border-outline position-absolute bottom-0 end-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </div>
                </a>
            </div>

            <div class="col">
                <div class="d-flex align-items-center mb-2">
                    <h5 class="me-auto mb-0">
                        <a href="#">${chat.title}</a>
                        <a href="#"> </a>
                      
                    </h5>
                    <span class="extra-small text-muted ms-2">${chat.created_at}</span>
                    
                </div>

                <div class="d-flex">
                    <div class="me-auto">${chat.body}</div>

                   
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row gx-4">
            <div id = 'button-notification'class="col button-notification">
                <input href="#2" type="submit" value="Hide" class="btn btn-sm btn-soft-primary w-100"
                onclick="{
                    let data = new FormData
                    data.append('_token','${tokenn}')
                    data.append('notification_id','${chat.id}')
                    fetch('/api/refusFriend/${chat.refernce}', {
                    method: 'POST',
                    body:data,
                    headers: {
                        'X-CSRF-TOKEN': '${tokenn}'
                        
                    }
                    })
            
                // this.parentNode.parentNode.style.display = 'none';
                this.parentNode.parentNode.replaceWith('deleted succesfuly')
                
                
                }">
            </div>
            <div id = 'button-notification' class="col button-notification">
                <input href="#" value="Confirm" class="btn btn-sm btn-primary w-100" onclick="{
                    let data = new FormData
                    data.append('_token','${tokenn}')
                    data.append('notification_id','${chat.id}')
                
                    fetch('/api/acceptFriend/${chat.refernce}', {
                    method: 'POST',
                    body:data,
                    headers: {
                        'X-CSRF-TOKEN': '${tokenn}'
                    }
                    })
                    this.parentNode.parentNode.replaceWith('added succesfuly')

                    }">
            </div>
        </div>
    </div>
</div>
    
    `)
    }

    else 
    {
    $('#cards-notification').append(` 
     <div class="card-list mt-8">


    <!-- Card -->
    <div class="card border-0 mb-5">
        <div class="card-body">

            <div class="row gx-5">
                <div class="col-auto">
                    <!-- Avatar -->
                    <div class="avatar">
                        <span class="avatar-text bg-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        </span>

                        <div class="badge badge-circle bg-success border-outline position-absolute bottom-0 end-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="d-flex align-items-center mb-2">
                        <h5 class="me-auto mb-0">Password Changed</h5>
                        <span class="extra-small text-muted ms-2">${chat.created_at}</span>
                    </div>

                    <div class="d-flex">
                        <div class="me-auto">Your password has been <br> updated successfully.</div>


                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Card -->
</div>`)
    }



}





styleHi=" text-decoration: none;border-radius: 9px;border:solid 1px #3e444f;cursor : pointer;padding:0px 15px ;text-align: center;color:#fff;background-color: #16191c ; display:block"
const getFriends=function(){
    // $.get(a+'/api/getUsers',function(response){
        $.get(a+'/api/getFriend',function(response){
        for(i in response) 
        {
    // alert(response[i].id)

            $('#users_in_searsh').append(`

            <div id="users_in_searsh" class="card-list">
          
            <div class="card border-0">
                <div id="users-body" class="card-body">
        
                    <div class="row align-items-center gx-5">
                        <div class="col-auto">
                            <a href="#" class="avatar avatar-online">
                             
                                <img class="avatar-img" src="${response[i].img}" alt="">
                                
                                
                            </a>
                        </div>
        
                        <div class="col">
                            <h5>
                              <a href="#">${response[i].name}</a></h5>
                             <!-- <p>${response[i].last_seen_at}</p> -->
                        </div>
        
                        <div  class="col-auto">
                        <input type="submit" value="Hi" user-id=${response[i].id}  style="${styleHi}" 
                        onclick="
                        {
                            alert('message sended')
                            let data = new FormData
                            data.append('_token','${tokenn}')
                            data.append('message','Hi')
                            data.append('user_id',$(this).attr('user-id'));
                            fetch('${a}'+'/api/messages', {
                                method: 'POST',
                                body:data,
                                headers: {
                                    'X-CSRF-TOKEN': +'${tokenn}'
                                }
                                })
                         }" >
                      
                            
                         
                        </div>
        
                    </div>
        
                </div>
            </div>
            <!-- Card -->
        
        </div>
        <br>
            `)
        }
        // user(response[i])
    });
}


$(".say_hi").on('submit',function(e){
    alert('angadsasdoas');
    e.preventDefault();
    // let msg=$(this).find('textarea').val()
    $.post($(this).attr('action') ,$(this).serialize() , function(response){
    });
    alert('Welcome message arrived , go to chat to complete coversation')

});

$(document).ready(function(){
    getConversations();
});


const getUsers=function(){
    $.get(a+'/api/getUsers',function(response){
        // $.get(a+'/api/friend',function(response){
// alert(2)


// response.each(function(index,value){
   

        for(i in response) 
        {
             // alert(response[i].id)

            $('#all_users_in_app').append(`

            
            <div id="user_in_all_user" class="card-list">
          
            <div class="card border-0">
                <div id="users-body" class="card-body">
        
                    <div class="row align-items-center gx-5">
                        <div class="col-auto">
                            <a href="#" class="avatar avatar-online">
                             
                                <img class="avatar-img" src="${response[i].img}" alt="">
                                
                                
                            </a>
                        </div>
        
                        <div class="col">
                            <h5>
                              <a href="#">${response[i].name}</a></h5>
                             <!-- <p>${response[i].last_seen_at}</p> -->
                        </div>
        
                        <div  class="col-auto">

                        <input class="addfriend" type="submit" value="Add" user-id=${response[i].id} " 
                        onclick="
                        {   
                            
                            $(this).attr('class','addfriend_done')
                            let data = new FormData
                            data.append('_token','${tokenn}')
                            data.append('user_id',$(this).attr('user-id'));
                            fetch('${a}'+'/api/addFriend', {
                                method: 'POST',
                                body:data,
                                headers: {
                                    'X-CSRF-TOKEN': +'${tokenn}'
                                }
                                })
                         }" >
                     
                             
                        </div>
        
                    </div>
        
                </div>
            </div>
            <!-- Card -->
        
        </div>
        <br>
            `)
        }

    });
}
