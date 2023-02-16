const a ='http://192.168.43.194:8000/';
$("#targetttt").on('submit',function(e){
    // console.log('angadsasdoas');
    e.preventDefault();
    let msg=$(this).find('textarea').val()
    $.post($(this).attr('action') ,$(this).serialize() , function(response){
        // console.log(response[0].html);
        addMessage(response.obj_msg ,'message-out')
        // if(response.status==1)
        // {
        //     $(".sended").replaceWith(`${response.obj_msg.html} `);
        // }
        // else
        // $(".sended").replaceWith(`${response.html} `);
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
                        fetch(a+"api/messages", {
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

    <a href=a+"a/${res[i].conversation_id}" class="card border-0 text-reset">
    
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





const addMessage = function(msg ,c = ''){


    $("#soso").append(`
    
    
    
    <div class="message ${c} ">
<a href="#" data-bs-toggle="modal" data-bs-target="#modal-profile" class="avatar avatar-responsive">
</a>

<div class="message-inner">
    <div class="message-body">
        <div class="message-content">
            <div class="message-text ">
            
                <p>${msg.body} 
                <spam class="sended  fas fa-check" style="
                position:relative ;
                bottom:-12px;
                right:-10px;
                z-index:12;
          
                "
                ></spam> 
                </p>
            </div>

            <!-- Dropdown -->
            <div class="message-action">
                <div class="dropdown">
                    <a class="icon text-muted" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <span class="me-auto">Edit</span>
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <span class="me-auto">Reply</span>
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center text-danger" href="#">
                                <span class="me-auto">Delete</span>
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        
    </div>

    <div class="message-footer">
        <span class="extra-small text-muted">${moment(msg.created_at).fromNow()}</span>
    </div>
</div>
</div>`);

}

const getConversations=function(){
    $.get(a+'api/conversations',function(response){
  
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
   
    e.preventDefault();
    let id =$(this).attr('data-messages');
    $(`#soso`).empty();
    $('input[name=conversation_id]').val(id)
    $.get(a+`api/conversations/${id}/messages` , function(response){
        
        $('#chat-name').text(response.conversation.partiscipants[0].name);
        $('#chat-img').attr('src',response.conversation.partiscipants[0].img);
        for(i in response.messeges)
        {
            // alert(1)
            // console.log(userId);
        let msg = response.messeges[i];
        let c  = msg.user_id ==userId ? 'message-out' :'';
        addMessage(msg , c)
        }    
    })
})

$(`#tab-chats`).on('click',function(e){
    $(`#chat-list`).empty();
    getConversations();

});


$(`#tab-friends`).on('click',function(e){
    $(`#users_in_searsh`).empty();
    getUsers();
    // alert(response[0].id)

});

const getUsers=function(){
    $.get(a+'api/getUsers',function(response){
        for(i in response) 
        {


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

                            <input   onclick=myFunction()  type="submit" value="Hi" user-id=${response[i].id}  style="text-decoration: none;border-radius: 9px;border:solid 1px #3e444f ;cursor : pointer;padding:0px 15px ;text-align: center;color:#fff;background-color: #16191c ;" >
                            <input type='hidden' onclick={alert($('.useridv').val())}   class='useridv' user-id=${response[i].id} type="text" name="user_id" value="${response[i].id}">
                            
                            <script>
                            function myFunction() {
                                alert('message [hi] sended , go to chat to complete conversation')
                               
                                let ID=$('.useridv').text();
                                let data = new FormData
                                data.append('message','Hi');
                                data.append('user_id',${response[i].id});
                                fetch(a+"api/messages", {
                                    method: "POST",
                                    body:data,
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                    });
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
// document.getElementById("useridv").innerHTML
// console.log(document.getElementById("useridv"))
// alert(document.getElementById("useridv").childNodes[0].textContent);


