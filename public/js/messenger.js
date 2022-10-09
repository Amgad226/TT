const a ='http://127.0.0.1:8000';
const tokenn =  $('meta[name="csrf-token"]').attr('content')

// count of message un-read       {done}
// onclick toust go to chat       {done}
// store theme and lang in cookie {done}
// lang                           {done}
// icon                           {done}
// send records                   {done}
// send image 
// fix search
// delete message 
// group info :members ,count msg for all member , description
// edit group name and img 
// is typing
// pwa app 
// voice chat  


// ----------switch theme--------------

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
  }

if(getCookie('theme')==`<link rel="stylesheet" type="text/css" href="assets/css/template.bundle.css">`){
    $('head').append(getCookie('theme'));
    $(".toggel").empty(); 

        $(".toggel").append(` 
        <svg  style="cursor: pointer;"class="toggel" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
        <path fill="#95aac9" d="M29.56 19.36a1 1 0 0 0-1.21.07A10.49 10.49 0 0 1 21.51 22 10.17 10.17 0 0 1 11.2 12a9.94 9.94 0 0 1 4.28-8.1 1 1 0 0 0 .36-1.17 1 1 0 0 0-1-.64A14.1 14.1 0 0 0 2 16a14.21 14.21 0 0 0 14.37 14 14.34 14.34 0 0 0 13.57-9.44 1 1 0 0 0-.38-1.2ZM16.37 28A12.2 12.2 0 0 1 4 16a12 12 0 0 1 7.57-11.11A11.82 11.82 0 0 0 9.2 12a12.17 12.17 0 0 0 12.31 12 12.49 12.49 0 0 0 4.89-1 12.5 12.5 0 0 1-10.03 5Z" data-name="Layer 46"/>
        </svg>
        `);
}

var dark= true;
$(`.toggel`).on('click',function(e){
  
    if(dark)
    {
        //light mode
        dark=false;
        $('head').append('<link rel="stylesheet" type="text/css" href="assets/css/template.bundle.css">');
        document.cookie='theme=<link rel="stylesheet" type="text/css" href="assets/css/template.bundle.css">'
        $(".toggel").empty(); 

        $(".toggel").append(` 
        <svg  style="cursor: pointer;"class="toggel" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
        <path fill="#95aac9" d="M29.56 19.36a1 1 0 0 0-1.21.07A10.49 10.49 0 0 1 21.51 22 10.17 10.17 0 0 1 11.2 12a9.94 9.94 0 0 1 4.28-8.1 1 1 0 0 0 .36-1.17 1 1 0 0 0-1-.64A14.1 14.1 0 0 0 2 16a14.21 14.21 0 0 0 14.37 14 14.34 14.34 0 0 0 13.57-9.44 1 1 0 0 0-.38-1.2ZM16.37 28A12.2 12.2 0 0 1 4 16a12 12 0 0 1 7.57-11.11A11.82 11.82 0 0 0 9.2 12a12.17 12.17 0 0 0 12.31 12 12.49 12.49 0 0 0 4.89-1 12.5 12.5 0 0 1-10.03 5Z" data-name="Layer 46"/>
        </svg>
        `);
    }
    else
    {
        //dark mode
        dark=true;
        $('head').append('<link rel="stylesheet" type="text/css" href="assets/css/template.dark.bundle.css">');
        document.cookie='theme=<link rel="stylesheet" type="text/css" href="assets/css/template.dark.bundle.css">'

        $(".toggel").empty(); 
        $(".toggel").append(` 
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 96 96"><switch><g fill="#a7a6a8" class="color000000 svgShape">
            <path d="M52 4v8a4 4 0 0 1-8 0V4a4 4 0 0 1 8 0zm-4 76a4 4 0 0 0-4 4v8a4 4 0 0 0 8 0v-8a4 4 0 0 0-4-4zM14.059 14.059a4 4 0 0 0 0 5.657l5.657 5.657a4 4 0 0 0 5.657-5.657l-5.657-5.657a4 4 0 0 0-5.657 0zm56.568 56.568a4 4 0 0 0 0 5.657l5.657 5.657a4 4 0 0 0 5.657-5.657l-5.657-5.657a4 4 0 0 0-5.657 0zM0 48a4 4 0 0 0 4 4h8a4 4 0 0 0 0-8H4a4 4 0 0 0-4 4zm80 0a4 4 0 0 0 4 4h8a4 4 0 0 0 0-8h-8a4 4 0 0 0-4 4zM14.059 81.941a4 4 0 0 0 5.657 0l5.656-5.657a4 4 0 0 0-5.656-5.657l-5.657 5.657a4 4 0 0 0 0 5.657zm56.568-56.568a4 4 0 0 0 5.657 0l5.657-5.657a4 4 0 0 0-5.657-5.657l-5.657 5.657a4 4 0 0 0 0 5.657zM72 48c0 13.255-10.745 24-24 24S24 61.255 24 48s10.745-24 24-24 24 10.745 24 24zm-8 0c0-8.837-7.163-16-16-16s-16 7.163-16 16 7.163 16 16 16 16-7.163 16-16z" class="color000000 svgShape"/></g></switch></svg>
        `);
    }

});


//----------send message manually----------
$("#targetttt").on('submit',function(e){
    e.preventDefault();
    let body=$(this).find('.input-have-message').val()
    if(body==''){
        return;
    }
    // alert(body)
    $.post($(this).attr('action') ,$(this).serialize() , function(response){
     
        $('.sended').css("visibility", "");

        // addMessage(response.obj_msg ,'message-out')
    }
    
    );
    var user={'img':`${userimg}`,"name":`${username}`}
     
    // 'body':body,
    var msgg = {
        'body':`<div class="message-text " style=" background-color:  ;height:90% display: flex;flex-direction: column;justify-content: space-between;"><p>${body} <span class="sended  fas fa-check" style="position:relative ;bottom:-12px;right:-10px;z-index:12;visibility:hidden"></span></p></div>`,
        'user':user
    }
    
    addMessage(msgg,'message-out')
$(this).find('.input-have-message').val('');

});


//----------change_pass---------------

$("#change_pass").on('submit',function(e){
    e.preventDefault();
    $.post($(this).attr('action') ,$(this).serialize() , function(response){
        alert(response.message)
    });

});


//-------------searchhh_chats----------------
$("#searchhh_chats").on('submit',function(e){
    e.preventDefault();
    $.post($(this).attr('action') ,$(this).serialize() , function(response){
        search_chats(response)  
    });
// $(this).find('#aso').val('');
});

const search_chats = function(res){
    
    $("#chat-list").replaceWith(` 
    <div id="chat-list">
</div>
`);
for(let i = 0; i<
    res.length ;i++)
{
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


//------------#search_users-----------------
$("#search_users").on('submit',function(e){
    e.preventDefault();
    $.post($(this).attr('action') ,$(this).serialize() , function(response){
        search_users(response)  
    });
// $(this).find('#aso').val('');
});

const search_users = function(res){
    
    $("#users_in_searsh").replaceWith(` 
    <div id="users_in_searsh" class="card-list">
    </div>
`);
for(let i = 0; i<
    res.length ;i++)
{
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
         
                    <input class="onlL" onclick=myFunction()  type="submit" value="222"  style="text-decoration: none;border-radius: 9px;border:solid 1px #3e444f ;cursor : pointer;padding:0px 15px ;text-align: center;color:#fff;background-color: #16191c ;" >
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


//--------nav bar chat icon--------
$(`#tab-chats`).on('click',function(e){
    $(`#chat-list`).empty();
    getConversations();

});

const getConversations=function(){
    $.get(a+'/api/conversations',function(response){
  
        for(i in response)
        {
            // console.log(response[i].conversation.lable);
        conversation(response[i])
        }
    

    })
}
// data.message.conversation_id
// var countUnReadMsg;
const conversation=function(chat){
// alert(chat.conversation.img);
// console.log(chat.conversation.unRead_message);
var countUnReadMsg=chat.conversation.unRead_message
// alert(countUnReadMsg)
if(countUnReadMsg!=0){
    counter=`
    <div class="div-count-msg badge badge-circle bg-primary ms-5 eq"  style="visibility:visible" onclick={$(this).css("visibility","hidden");}>
        <span data-messages=${chat.conversation.id}  class="asa">${countUnReadMsg}</span>
    </div>`;
}
else{
    counter=`
    <div class="div-count-msg badge badge-circle bg-primary ms-5  eq" data-messages=${chat.conversation.id} style="visibility:hidden">
        <span data-messages=${chat.conversation.id} style= class="asa">new message</span>
    </div>`;
    
}
//  $('.div-count-msg[data-messages=${chat.conversation.id}]').css('display','none');
// console.log(chat);
if(chat.conversation.last_massege.type=='audio')
{
message_body_with_slice='record';
}
else if(chat.conversation.last_massege.body!=null){

    var message_body_with_slice=chat.conversation.last_massege.body.slice(140, -129);
    message_body_with_slice=message_body_with_slice.slice(0,10);
    // alert(message_body_with_slice)
}
else
message_body_with_slice='';
$('#chat-list').append(`


<a  onclick="{ 
    $('main').addClass('is-visible'); 
    
    $('.eq[data-messages=${chat.conversation.id}]').css('visibility','hidden');
    $('.eq[data-messages=${chat.conversation.id}]').css('display','none');
    $('.asa[data-messages=${chat.conversation.id}]').css('display','none');
    $('.asa[data-messages=${chat.conversation.id}]').css('background','res');

   

    

    }" href="" id="roro" data-messages=${chat.conversation.id} class="card border-0 text-reset zz zzz">
    <div  class="card-body zz"      >
        <div class="row gx-5">
            <div class="col-auto">
                <div class="avatar avatar-online">
                  
                    <img src="${chat.conversation.img}" alt="#" class="avatar-img">
                </div>
            </div>

            <div class="col">
                <div class="d-flex align-items-center mb-3">

                    <h5 class="me-auto mb-0">${chat.conversation.lable}</h5>

                    <span class="text-muted extra-small ms-2">${moment(chat.conversation.last_massege.created_at).fromNow()}</span>
                </div>

                <div class="d-flex align-items-center">
                    <div class="line-clamp me-auto last-message" data-messages=${chat.conversation.id}>
                    ${message_body_with_slice} 
                    </div>

                   ${counter}
                </div>
            </div>
        </div>
    </div>
    <!-- .card-body -->

    
</a>

    `)
}



//-----------return home page-------------
$(`.welcome-text`).on('click',function(e){
    $(".to-return-home").removeClass("welcome-text");
    $(".footer-input-chat").css("display", "none");
    $(".app-bar-name-and-img").css("display", "none");
    $(".welcome-text").css("display", "block");
    $(".form-ccontainer").css("display", "none");
    $(".to-return-home").addClass("welcome-text");
});


//------------messages in chat----------
var u=0;
var response_conversation_id=0
const open_chat=function(thiss){
    $(`#soso`).empty();
    
    $(".to-return-home").removeClass("welcome-text");
    $(".footer-input-chat").css("display", "block");
    $(".app-bar-name-and-img").css("display", "block");
    $(".welcome-text").css("display", "none");
    $(".form-ccontainer").css("display", "block");
    $(".to-return-home").addClass("welcome-text");

    // e.preventDefault();
    let id =thiss;
    // let id =$(thiss).attr('data-messages');
    // $(`#soso`).empty();
    $('input[name=conversation_id]').val(id)
    
    let data = new FormData
    data.append('conversation_id',id)
    fetch('/api/readAllMessages', {
    method: 'POST',
    body:data,
    headers: {
        'X-CSRF-TOKEN': '${tokenn}'
        
    }
    })
    $.get(a+`/api/conversations/${id}/messages` , function(response){

         response_conversation_id=response.conversation.id;
        //  response_conversation_id=response.conversation.partiscipants[0].pivot.user_id;
      
   
        
        $('#chat-name').text(response.conversation.lable);
        $('#chat-img').attr('src',response.conversation.img);
        // $('#chat-img').attr('src',response.conversation.partiscipants[0].img);
        
        if(response.conversation.type=='peer')
        {
            for(i in response.messeges)
            {
                let msg = response.messeges[i];
                let c  = msg.user_id ==userId ? 'message-out' :'';

                    addMessage(msg , c ,false)
              
    
            }   
    const $container = $('.form-ccontainer');
    $container.scrollTop($container.prop('scrollHeight'))

            
        }
        else
        {
            for(i in response.messeges)
            {
            let msg = response.messeges[i];
            let c  = msg.user_id ==userId ? 'message-out' :'';

            addMessagesToGroup(msg , c ,false,true)
            }   
            const $container = $('.form-ccontainer');
            $container.scrollTop($container.prop('scrollHeight'))

        }
        
    })
}
$(`#chat-list`).on('click','[data-messages]',function(e){
    e.preventDefault();

open_chat($(this).attr('data-messages'));
})



//-------notifications----
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





//--------getFriends------
styleHi=" text-decoration: none;border-radius: 9px;border:solid 1px #3e444f;cursor : pointer;padding:0px 15px ;text-align: center;color:#fff;background-color: #16191c ; display:block"
$(`#tab-friends`).on('click',function(e){
    $(`#users_in_searsh`).empty();
    getFriends();

});





//---------get users----------
$(`#tab-all-users`).on('click',function(e){
    $(`#all_users_in_app`).empty();
    getUsers();

});




//---------------create group---------------//
var arrayGroup= [];
var imgGroup;
var groupName;
var groupDescription;
var groupForm=$('#groupForm');
$(`.tap-friend-group`).on('click',function(e){
    $(`.friends-create-group`).empty();
    getFriendsToCreateGroup();
});

 const getFriendsToCreateGroup =function(){
    $.get(a+'/api/getFriend',function(response){

        for(i in response) 
        {
            $('.friends-create-group  ').append(`
            <div class="card-body" style="background-color:var(--bs-body-bg)">

                 <div class="row align-items-center gx-5">
                     <div class="col-auto">
                         <div class="avatar avatar-online">

                                 <img class="avatar-img" src="${response[i].img}" alt="">
                         </div>
                     </div>
                     <div class="col">
                         <h5>${response[i].name}</h5>
                     </div>
                     <div class="col-auto">
                         <div class="form-check">
                   
                         
        <input onclick="{
            if (this.checked == true)
            {
                if(!arrayGroup.includes($(this).attr('value')))
                {
                    arrayGroup.push($(this).attr('value'));
                }
            }
           else
           {
            const index = arrayGroup.indexOf($(this).attr('value'));
            arrayGroup.splice(index, 1);
           }
           ifArrayGroup();
            
         }" class="form-check-input cheack-group" type="checkbox" value="${response[i].id}" id="id-member-9">
      
                         <label class="form-check-label" for="id-member-9"></label>
                         </div>
                     </div>
                 </div>
            <div>
    
            `)
        }
    })
}

const ifArrayGroup=function(){
    if (arrayGroup.length!=0){
        $('.button-create-group').css("display", "");
        $('.if-arrayGroup').empty();
        $('.if-arrayGroup').append('access is allowable ('+arrayGroup.length+' member)');
        $(".if-arrayGroup").css("background-color", "#198754");
    }
    else{
        $('.button-create-group').css("display", "none");
        $('.if-arrayGroup').empty();
        $('.if-arrayGroup').append('you must add at least 1 member to your group');
        $(".if-arrayGroup").css("background-color", "#D32535"); 
    }
}

$('.imgGroup').on('change',function(e){
    
    var x= URL.createObjectURL(e.target.files[0]);
    
    imgGroup=e.target.files[0];
    $('#blah').attr('src',x);
    $('#blah').css("display", "");
    $('.span-icon-group').css("display", "none");
    

});

$('.groupName').on('keyup',function() {
    groupName=$('.groupName').val()
});

$('.groupDescription').on('keyup',function() {
    groupDescription=$('.groupDescription').val()
});

$("#groupForm").on('submit',function(e){
    // console.log(imgGroup);
    e.preventDefault();

    let data = new FormData
     data.append('img',imgGroup);
     data.append('users_id',arrayGroup);
     data.append('groupName',groupName);
     data.append('groupDescription',groupDescription);
     fetch(a+'/api/createGroup', {
     method: 'POST',
     body:data,
     headers: {
     'X-CSRF-TOKEN': tokenn
     }
     });


});



// --------------responsive-----------
$(`.zz`).on('click',function(e){
    $("main").addClass("is-visible");
});



//------say_hi-----
$(".say_hi").on('submit',function(e){
    e.preventDefault();
    // let msg=$(this).find('textarea').val()
    $.post($(this).attr('action') ,$(this).serialize() , function(response){
    });
    alert('Welcome message arrived , go to chat to complete conversation')

});




$(document).ready(function () {
    getConversations();

    // $('#groupForm').validate({ // initialize the plugin
    //     rules: {
    //         groupName: {
    //             required: true,
    //             minlength: 1

    //         },
    //         groupDescription    : {
    //             required: true,
    //             minlength: 1
    //         }
    //     },
    //     submitHandler: function (form) { // for demo
    //         alert('valid form submitted'); // for demo
    //         return false; // for demo
    //     }
    // });

});
// const a ='http://192.168.43.194:8000';
