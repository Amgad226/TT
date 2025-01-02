
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



const conversation=function(chat){

var countUnReadMsg=chat.unRead_message
// alert(countUnReadMsg)
if(countUnReadMsg!=0){
    counter=`
    <div class="div-count-msg badge badge-circle bg-primary ms-5 unread-message-count"  style="visibility:visible" onclick={

    }>
        <span class="unread-message-count" data-messages=${chat.id} >${countUnReadMsg}</span>
    </div>`;
}
else{
    counter=`
    <div class="div-count-msg badge badge-circle bg-primary ms-5  unread-message-count  d-none" data-messages=${chat.id} onclick={
    }>
        <span class="unread-message-count" data-messages=${chat.id} style= >new message</span>
    </div>`;

}

    var message_body_with_slice;
    if(chat.last_massege.type=='text'){
        aa=chat.last_massege.body.slice(143,-842);
        message_body_with_slice=aa.slice(0,10);
    }
    else
    message_body_with_slice=chat.last_massege.type;
counter=`
    <div class="div-count-msg badge badge-circle bg-primary ms-5 unread-message-count"  style="visibility:visible" onclick={

    }>
        <span class="unread-message-count" data-messages=${chat.id} >1</span>
    </div>`;
    $('#chat-list').append(`


    <a onclick="{  $('main').addClass('is-visible');}" href=""  data-messages=${chat.id} class="card border-0 text-reset add-shadow zz  ">

    <div style="" class="card-body zz" >
        <div class="row gx-5">
            <div class="col-auto">
                <div class="avatar avatar-online">

                    <img src="${chat.img}" alt="#" class="avatar-img">
                </div>
            </div>

            <div class="col">
                <div class="d-flex align-items-center mb-3">

                    <h5 class="me-auto mb-0">${chat.lable}</h5>
                   
                    <span class="text-muted extra-small ms-2">${moment(chat.last_massege.created_at).fromNow()}</span>
                </div>

                <div class="d-flex align-items-center ">
                    <div class="line-clamp me-auto last-message" data-messages=${chat.id}>
                    ${chat.msg}
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
function popupFun(){

    $('.layout').removeClass('to-edit-name');
    $('.modal').removeClass('to-edit-name');
    $('.modal').removeClass('d-none');
    // $('.popup').addClass('d-none');

    $(".popup").animate({'top':'-1000px'}, "fast");
    setTimeout(() => {
    $(".popup").animate({'top':'45%'}, "fast");
    $('.popup').addClass('d-none');
    }, 100);


}




$(`#chat-list`).on('click','[data-messages]',function(e){
    // alert()
    e.preventDefault();
    // $(`#chat-list`)
    // $(`.text-reset`).css('background-color','var(--bs-gray-dark)')
    $(`.add-shadow`).removeClass('shadowww')
    // $(this).css('background-color','green')
    $(this).addClass('shadowww')


     //to hide (Loader)
    open_chat(1);
    // $(this).css('background-color','red')
});
function  open_chat_css_action(){
    $('.group-description').css('visibility','hidden');
    $('.group-description').css('display','none');
    $(`#messages_container`).empty();
    $(".to-return-home").removeClass("welcome-text");
    $(".footer-input-chat").css("display", "block");
    $(".app-bar-name-and-img").css("display", "block");
    $(".welcome-text").css("display", "none");
    $(".form-ccontainer").css("display", "block");
    $(".to-return-home").addClass("welcome-text");
}
const open_chat=function(conversation_id, toLoader=''){
    $('.to-return-home').click();

    open_chat_css_action();
    // addLoader(toLoader)
    conversationPageId=1 //to change active page of chat
    $('input[name=conversation_id]').val(conversation_id)
    // $.get(`/api/conversations/999/messages?page=${conversationPageId}` , function(response)
    // {
        response_conversation_id=conversation_id; //to change active chat id
        $('#conversation-id-input-target').text(conversation_id)

        $('#chat-name').text(response.conversation.lable);
        $('#chat-img').attr('src',response.conversation.img);
        $('#chat-img').attr('data-action','zoom');

        if(response.read_more)
        $(".show-all-messages").css('visibility','visible');

        else
        $(".show-all-messages").css('visibility','hidden');


        if(response.conversation.type=='peer')
        {
            for(i in response.messeges)
            {
                let msg = response.messeges[i];
                let c  = msg.user_id ==userId ? 'message-out' :'';
                addMessage(msg , c ,false)
            }
        }
        else
        {
            $('.group-description').css('visibility','visible');
            $('.group-description').css('display','block');
            $('.group-description-name').empty();
            $('.group-description-name').append(response.conversation.lable);
            $('.group-description-description').empty();
            $('.group-description-description').append(response.conversation.description);
            $('.group-description-img').attr('src',response.conversation.img)
            $('.group-description-members').empty();

            getAndAppendGroupMembers(conversation_id)

            for(i in response.messeges)
            {
                let msg = response.messeges[i];
                let c  = msg.user_id ==userId ? 'message-out' :'';
                addMessagesToGroup(msg , c ,false,true)
            }

        }
        // hideLoader(toLoader)
        $('.form-ccontainer').scrollTop($('.form-ccontainer').prop('scrollHeight'))

    // })
}
function  open_chat_css_action(){
    $('.group-description').css('visibility','hidden');
    $('.group-description').css('display','none');
    $(`#messages_container`).empty();
    $(".to-return-home").removeClass("welcome-text");
    $(".footer-input-chat").css("display", "block");
    $(".app-bar-name-and-img").css("display", "block");
    $(".welcome-text").css("display", "none");
    $(".form-ccontainer").css("display", "block");
    $(".to-return-home").addClass("welcome-text");
}
const addMessage = function(msg ,c= '' ,isAnimate = true ,deleteAction=true ,classDeletMessage=''){

    if (isAnimate)
    {
        animateMessage();
    }
    var message =styleMessage(msg,classDeletMessage)

        if(c=='') //receiver message //to remove received check from received messages
        {
             message=message.replace('visibility:','visibility:hidden')
        }
        else
        {
            if(deleteAction==true)
            {
               var dropdown=appendDeleteDropDown(msg.deleteAction,classDeletMessage,msg.random_class_to_add_message_id,msg.id,DeleteForAll);
            }
        }
        appendMessageInChat(c,message,dropdown='',msg.created_at);
}
function styleMessage(msg,classDeletMessage){
    if(msg.type=='text'){
            something= `<div class="message-text " style=" background-color:  ;height:90% display: flex;flex-direction: column;justify-content: space-between;">
                            <p>${msg.body}
                                <span class="sended ${msg.deleteAction} ${classDeletMessage}  " style="position:relative ;bottom:-12px;right:-10px;z-index:0;visibility:">
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="15px" height="15px" viewBox="0 0 78.369 78.369" style="enable-background:new 0 0 78.369 78.369;"xml:space="preserve"><g><path fill="var( --bs-white)" d="M78.049,19.015L29.458,67.606c-0.428,0.428-1.121,0.428-1.548,0L0.32,40.015c-0.427-0.426-0.427-1.119,0-1.547l6.704-6.704c0.428-0.427,1.121-0.427,1.548,0l20.113,20.112l41.113-41.113c0.429-0.427,1.12-0.427,1.548,0l6.703,6.704C78.477,17.894,78.477,18.586,78.049,19.015z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                    </svg>
                                </span>
                            </p>
                        </div> `
    }

    else if(msg.type=='img'){
        if(msg?.input==true)
        something=msg.body;
        else
        something= ` <img  width="200"  class="img-fluid rounded" src="${msg.body}" data-action="zoom" alt="">`;
    }

    else if(msg.type=='audio'){
        something=`
        <audio style='border: 5px solid #2787F5; border-radius: 50px;'  controls ><source src="${msg.body}" type="audio/WAV"></audio>

        <span class="sended ${msg.deleteAction} ${classDeletMessage}  "   style="position:absolute;right:23px; z-index:120;visibility:visiable">
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 78.369 78.369" style="enable-background:new 0 0 78.369 78.369;" xml:space="preserve"><g>
               <path fill="#2787F5" d="M78.049,19.015L29.458,67.606c-0.428,0.428-1.121,0.428-1.548,0L0.32,40.015c-0.427-0.426-0.427-1.119,0-1.547l6.704-6.704 c0.428-0.427,1.121-0.427,1.548,0l20.113,20.112l41.113-41.113c0.429-0.427,1.12-0.427,1.548,0l6.703,6.704 C78.477,17.894,78.477,18.586,78.049,19.015z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
            </svg>
        </span>`;
    }

    else if(msg.type=='attachment')
    {
//
        something=`<div class="message-text">
        <div class="row align-items-center gx-4">
            <div class="col-auto">
                <a href="${msg.attachment.link_attachment}" class="avatar avatar-sm" target="_blank">
                    <div class="avatar-text bg-white text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-down"><line x1="12" y1="5" x2="12" y2="19"></line><polyline points="19 12 12 19 5 12"></polyline></svg>
                    </div>
                </a>
            </div>
            <div class="col overflow-hidden">
                <h6 class="text-truncate text-reset">
                    <a href="#" class="text-reset">${msg.attachment.name}</a>
                </h6>
                <ul class="list-inline text-uppercase extra-small opacity-75 mb-0">
                    <li class="list-inline-item">${msg.attachment.stringSize}</li>
                </ul>
            </div>
        </div>
      </div>`;
    }
return something

}
function appendMessageInChat(c,message,dropdown,created_at ){
    $("#messages_container").append(`

    <div class="name-to-group message ${c} ">

    <div class="message-inner" >
        <div class="message-body">
            <div class="message-content">
           ${message}

           ${dropdown }
            </div>
        </div>

        <div class="message-footer">
            <span class="extra-small text-muted">${moment(created_at).fromNow()}</span>
        </div>
    </div>
</div>
    `);

}
function appendDeleteDropDown(deleteAction,classDeletMessage,random_class_to_add_message_id,id,DeleteForAll ){
    return `<div class="message-action  ${deleteAction} ${classDeletMessage} " >
    <div class="dropdown"  onclick="dropdown(this)">
            <a class="icon text-muted" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
            </a>

            <ul id="dropdown-menu" class="dropdown-menu" style ='list-style-type: none' >

                <li  class=${random_class_to_add_message_id} message-id=${id} onclick ="{deleteMessge(this)}" style = 'background-color:var("--delete-message") '>
                    <a class="dropdown-item d-flex align-items-center text-danger" href="#">
                        <span class="me-auto" >${DeleteForAll}</span>
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        </div>
                    </a>
                </li>

            </ul>
        </div>
    </div>`;

}
var styleHi=" text-decoration: none;border-radius: 9px;border:solid 1px #3e444f;cursor : pointer;padding:0px 15px ;text-align: center;color:#fff;background-color: #16191c ; display:block"
// var stringHi = 'hi'
const getFriends=function(){
    // $.get('/api/getUsers',function(response){
    // addLoader(toLoader)

    var response = [{"id":2,"img":"\/img\/ayham.jpg","name":"ayham"},{"id":3,"img":"\/img\/rozet.jpg","name":"rozet"},{"id":4,"img":"\/img\/ahmad.jpg","name":"ahmad"}]
        // $.get('/api/friend',function(response){
            // console.log(response)
        for(i in response)
        {

         $('#friends_in_searsh').append(`

            <div id="friends_in_searsh" class="card-list">

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
                        <input type="submit" value="${stringHi}" user-id=${response[i].id}  style="${styleHi}"
                        onclick="
                        {
                         $('.send-image-loader').css('display','block')
                         play(soundDone)
                         $('.send-image-loader').css('display','none')
                             
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
    $('#lodder').addClass('hide');
    // hideLoader(toLoader)

        // user(response[i])
    // });
}




$(`#tab-all-users`).on('click',function(e){
    $(`#all_users_in_app`).empty();
    getUsers($(`#tab-all-users`));

});

const getUsers=function(){
    // addLoader(toLoader)

    // $.get('/api/getUsers',function(response){
        var response =[{"id":5,"name":"samer","email":"samer@gmail.com","img":"\/img\/samer.jpg","email_verified_at":null,"deviceToken":" ","created_at":"2023-03-13T20:00:04.000000Z","updated_at":"2023-03-13T20:00:04.000000Z"},{"id":6,"name":"dana","email":"dana@gmail.com","img":"\/img\/dana.jpg","email_verified_at":null,"deviceToken":" ","created_at":"2023-03-13T20:00:04.000000Z","updated_at":"2023-03-13T20:00:04.000000Z"},{"id":7,"name":"Ali","email":"Ali@gmail.com","img":"\/img\/ali.jpg","email_verified_at":null,"deviceToken":" ","created_at":"2023-03-13T20:00:04.000000Z","updated_at":"2023-03-13T20:00:04.000000Z"},{"id":8,"name":"hesham","email":"hisham@gmail.com","img":"\/img\/hesham.jpg","email_verified_at":null,"deviceToken":" ","created_at":"2023-03-13T20:00:04.000000Z","updated_at":"2023-03-13T20:00:04.000000Z"},{"id":9,"name":"joli","email":"joli@gmail.com","img":"\/img\/user_default.png","email_verified_at":null,"deviceToken":" ","created_at":"2023-03-13T20:00:04.000000Z","updated_at":"2023-03-13T20:00:04.000000Z"}] ;
        for(i in response)
        {

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

                        <input class="addfriend" type="submit" value="${stringAdd}" user-id=${response[i].id} "
                        onclick="
                        {
                            $(this).attr('class','addfriend_done')
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
    // hideLoader(toLoader)


    // });
}





$(`#tab-notifications`).on('click',function(e){
    $(`#cards-notification`).empty();
    getNotification($(`#tab-notifications`));

});

const getNotification=function(toLoader){
    // addLoader(toLoader)

var response = [{"id":7,"title":"Password Changed","body":"Your password has been updated successfully..","type":"password","user_id":3,"owner_id":3,"refernce":null,"created_at":"2023-04-26 18:53:39","updated_at":"2023-04-26 18:53:39","img":"\/img\/rozet.jpg"},{"id":2,"title":"amgad","body":"Send you a friend request.","type":"request","user_id":1,"owner_id":3,"refernce":2,"created_at":"2023-03-13 20:03:14","updated_at":"2023-03-13 20:03:14","img":"\/img\/amgad.jpg"}]

        for(i in response)
        {
        notification(response[i])
        }

}
$(`.welcome-text`).on('click',function(e){
    $(".to-return-home").removeClass("welcome-text");
    $(".footer-input-chat").css("display", "none");
    $(".app-bar-name-and-img").css("display", "none");
    $(".welcome-text").css("display", "block");
    $(".form-ccontainer").css("display", "none");
    $(".to-return-home").addClass("welcome-text");
});


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
                <input href="#2" type="submit" value="${stringHide}" class="btn btn-sm btn-soft-primary w-100">
            </div>
            <div id = 'button-notification' class="col button-notification">
                <input href="#" type="submit"  value="${stringConfirm}" class="btn btn-sm btn-primary w-100" >
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
                        <h5 class="me-auto mb-0"> ${stringPasswordChanged}</h5>
                        <span class="extra-small text-muted ms-2">${chat.created_at}</span>
                    </div>

                    <div class="d-flex">
                        <div class="me-auto">${stringPasswordUpdated}</div>


                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Card -->
 </div>`)
    }
}


var chat={
    // id:9999,
    img:' ../../../../logo.png ',
    lable:'friendName',
    last_massege:{created_at:22-2-2004},
    msg:'hi'

}
getFriends()
conversation(chat)
conversation(chat)
var response ={"conversation":{"id":8,"user_id":1,"lable":"amgad alwattar","img":"\/img\/amgad.jpg","type":"peer","description":null,"last_message_id":101,"partiscipants":[{"id":1,"name":"amgad alwattar","img":"\/img\/amgad.jpg","pivot":{"conversation_id":8,"user_id":1}}]},"messeges":[{"id":97,"conversation_id":8,"user_id":1,"body":"hi","type":"text","attachment":null,"deleted_at":null,"created_at":"2023-04-26T18:30:46.000000Z","user":{"id":1,"name":"amgad alwattar","img":"\/img\/amgad.jpg"}},{"id":98,"conversation_id":8,"user_id":1,"body":"image\/img19_1920x1200.jpg64496ddde0f70.jpg","type":"img","attachment":null,"deleted_at":null,"created_at":"2023-04-26T18:30:53.000000Z","user":{"id":1,"name":"amgad alwattar","img":"\/img\/amgad.jpg"}},{"id":99,"conversation_id":8,"user_id":3,"body":"voice_records\/rozet__64496e0430c7e.wav","type":"audio","attachment":null,"deleted_at":null,"created_at":"2023-04-26T18:31:32.000000Z","user":{"id":3,"name":"rozet","img":"\/img\/rozet.jpg"}},{"id":100,"conversation_id":8,"user_id":3,"body":"nice photo \ud83d\ude0d\ud83d\ude0d","type":"text","attachment":null,"deleted_at":null,"created_at":"2023-04-26T18:31:46.000000Z","user":{"id":3,"name":"rozet","img":"\/img\/rozet.jpg"}},{"id":101,"conversation_id":8,"user_id":3,"body":"attachments\/Screenshot 2022-10-07 154629.png64496e194caeb.png","type":"attachment","attachment":{"link_attachment":"attachments\/Screenshot 2022-10-07 154629.png64496e194caeb.png","stringSize":"9KB","name":"Screenshot 2022-10-07 154629.png"},"deleted_at":null,"created_at":"2023-04-26T18:31:53.000000Z","user":{"id":3,"name":"rozet","img":"\/img\/rozet.jpg"}}],"read_more":1}


const addMessagesToGroup = function(msg ,c= '' ,isAnimate = true ,deleteAction=true){

    if (isAnimate)
    {
        animateMessage();
    }
   var  message=styleMessage(msg, '');

        if(c=='')//receiver message //to remove received check from received messages
        {
           message=message.replace('visibility:','visibility:hidden');
           message= appendWithGroupMessageStyle(msg.user.img, msg.user.name, message);/////////
        }
        else
        {
            if(deleteAction==true)
            {
               var dropdown=appendDeleteDropDown('','','',msg.id,DeleteForAll);
            }
        }
        appendMessageInChat(c,message,dropdown='',msg.created_at)
}

function animateMessage(){
    $('.form-ccontainer').animate({  scrollTop: $('.form-ccontainer').prop('scrollHeight')});
}
function makeid(){
    return 1 ;
} 
function random_class_to_add_message_id (){
    return 1 ;
}

$("#targetttt").on('submit',function(e){
    // alert();
    e.preventDefault();
    // return ;

    let body=$(this).find('.input-have-message').val()
    if(body==''){
        return;
    }
 
    var user={'img':`${userimg}`,"name":`${username}`}

    var msgg = {
        'random_class_to_add_message_id':random_class_to_add_message_id,
        'deleteAction':'',
        'body': body,
        'id':102,
        'user':user,
        'type':'text'
    }
    addMessage(msgg,'message-out',true,true ,'visibilty-hidden')

    $(this).find('.input-have-message').val('');

});



const showMoreMessages=function(){

return ;
}

function inputImageMessage(){
    // alert();
    let fileElm= document.createElement('input');
    //    fileElm.type = "text";
    //    fileElm.accept('jpg');
    fileElm.setAttribute('type','file');

    fileElm.addEventListener('change',(e)=>{
        var random=makeid(5)
 
        extension= fileElm.value.split('.').pop();


        const allowedExtensions = ["jpg", "jpeg", "png", "JPG", "JPEG", "PNG","webp"];
        if (allowedExtensions.includes(extension)==false) {
            alert('Invalid file type');
            fileElm.value = '';
            return ;
        }
        // return;
        // var x= URL.createObjectURL(e.target.files[0]);
        var user={'img':`${userimg}`,"name":`${username}`}
        var msgg = {
            'input':true,
            'type':'img',
            'body':`
            <img id="${random}" width="200" class="img-fluid rounded" src="${gif}" data-action="zoom" alt="">
            `,
            'user':user
        }

        addMessage(msgg,'message-out',true,false)


    // $('.send-image-loader').css('display','block')
    if(fileElm.files==0){
        return;
    }

    let attachment=fileElm.files[0];
  
   });
   fileElm.click()


}

function selectFile(){
alert('to try this sign in please');
return;

 }

 function play(sound=tele) {

    var url = sound;
          window.AudioContext = window.AudioContext||window.webkitAudioContext; //fix up prefixing
          var context = new AudioContext(); //context
          var source = context.createBufferSource(); //source node
          source.connect(context.destination); //connect source to speakers so we can hear it
          var request = new XMLHttpRequest();
          request.open('GET', url, true);
          request.responseType = 'arraybuffer'; //the  response is an array of bits
          request.onload = function() {
              context.decodeAudioData(request.response, function(response) {
                  source.buffer = response;
                  source.start(0); //play audio immediately
                  source.loop = false;
              }, function () { console.error('The request failed.'); } );
          }
          request.send();
}