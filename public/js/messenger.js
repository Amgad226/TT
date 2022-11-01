// count of message un-read          {done}
// onclick toust go to chat          {done}
// store theme and lang in cookie    {done}
// lang                              {done}
// icon                              {done}
// send records                      {done}
// only 50 messages will be received {done}
// button to show all message        {done}
// Loader                            {done}
// is typing ...                     {done}
// send image                        {done}
// send attachment                   {done}
// pwa app                           {done}
// delete message                    {done}
// fix searchad                      {done}
// group info :members,description   {done}
// group info edit group name and img{done}
// count msg for all member          {done} 
// delete message                    {done}  
// loader to send img/attachment     {done}  
// date messages                     {done} 
// count message un readed           {done} 
// check to send message             {done} 
// firebase notification             {done} 
// toast validation                  {done} 
// edit profile                      {done} 
// delete chat
// voice chat  


// ----------------------------------------
function makeid(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

function inputImageMessage(){
    let fileElm= document.createElement('input');
    //    fileElm.type = "text";
    //    fileElm.accept('jpg');
    fileElm.setAttribute('type','file');
    
    fileElm.addEventListener('change',(e)=>{
        var random=makeid(5)
        // alert(random);
        // return
        var filePath = fileElm.value;
        extension= fileElm.value.split('.').pop();
      console.log(extension);

        // var allowedExtensions_ =/(\.jpg|\.jpeg|\.png|\.JPG|\.JPEG|\.PNG|\.gif)$/;
        
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
    const formData = new FormData();

    formData.append('type', 'img');
    formData.append('img',attachment);
    formData.append('conversation_id',response_conversation_id);
        fetch('api/messages', {
        method: 'Post',
        body: formData
      })
        .then((response) => response.json())
        .then((result) => {
            if(result.status==0)
            {
                alert(result.message);
                return;
            }
       
            
            
            
            
            
            $('#'+random).attr('src', result.link_attachment);
            
            
            
        // var attachment =result.obj_msg.body
        // var date = result.obj_msg.created_at
        // var msg={'body':attachment  ,'created_at':date ,'id':result.obj_msg.id};
        // addMessage(msg,'message-out',true);
        // $('.send-image-loader').css('display','none')
                

        })
        .catch((error) => {
          console.error('Error:', error);
          alert('Error:', error);
          $('.send-image-loader').css('display','none')

        });
 
    
   });
   fileElm.click()
    
   
}

function selectFile(){
    let fileElm= document.createElement('input');
    //    fileElm.type = "text";
    //    fileElm.accept('jpg');
    fileElm.setAttribute('type','file');
 
    fileElm.addEventListener('change',()=>{
        $('.send-image-loader').css('display','block')

        const fsize = fileElm.files[0].size;
        const file = Math.round((fsize / (1024*1024)));
        if (file >= 15) {
            alert(
              "File too Big, please select a file less than 15mb");
            $('.send-image-loader').css('display','none')

              return ;
        } 

 

     
     if(fileElm.files==0){
         return;
     }
     let attachment=fileElm.files[0];
     const formData = new FormData();
 
     formData.append('type', 'attachment');
     formData.append('attachment',attachment);
     formData.append('conversation_id',response_conversation_id);
     fetch('api/messages', {
         method: 'Post',
         body: formData
       })
         .then((response) => response.json())
         .then((result) => {
             if(result.status==0)
             {
                 alert(result.message);
                 return;
             }

         var attachment =result.obj_msg.body
         var date = result.obj_msg.created_at
         var msg={'body':attachment  ,'created_at':date ,'id':result.obj_msg.id ,'attachment':result.attachment,'type':result.obj_msg.type};
         // addMessage(msg,'message-out',true,true,true,record,date);//false
         addMessage(msg,'message-out',true);
        $('.send-image-loader').css('display','none')

         })
         .catch((error) => {
           console.error('Error:', error);
           alert('Error:', error);
        $('.send-image-loader').css('display','none')

         });
  
    });
    fileElm.click()
     
    
 }
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

//----------dropdown----------
var drop_down=false
function deleteMessge (element){
    let id =   $(element).attr('message-id')   ;
    console.log(id)
var a =$(element.parentElement.parentElement.parentElement.parentElement);
// return;
   
 
         fetch(`/api/messages/${id}`, {
         method: 'POST',
        //  headers: {
        //      'X-CSRF-TOKEN': '${tokenn}'
        //  }
         })
                a.replaceWith (`
     <div class="message-content">
 
         <div class="message-text " style=" background-color:  ;height:90% display: flex;flex-direction: column;justify-content: space-between;">
             <p>deleted message  

             </p>
         </div> 
    </div>    
         `)
       

}
function dropdown(thiss){
    
    {
        if(drop_down==false)
        {

        $(thiss.childNodes[3]).removeClass('dropdown-menu');
        drop_down=true
        }
        else
        {

        $(thiss.childNodes[3]).addClass('dropdown-menu')
        drop_down=false
        } 
    }
    
}
 //0----------Loader----------
function hideLoader(thiss=''){
    if(thiss!='')
    thiss.css('visibility','visible');
  
    $('#Loader').addClass('hide');
}
function addLoader(thiss=''){
    if(thiss!='')
    thiss.css('visibility','hidden');
  
    $('#Loader').removeClass('hide');
}
//----------send message manually----------

$("#targetttt").on('submit',function(e){
    e.preventDefault();
    
    let body=$(this).find('.input-have-message').val()
    if(body==''){
        return;
    }
    var data=new FormData
    data.append('conversation_id',response_conversation_id)
    data.append('body',body)
    data.append('title',username+' send message')
    // fetch(`api/send`,{ method: 'POST', body:data, })

     var random_class_to_add_message_id=makeid(5);
     var deleteAction =makeid(5);
    // alert(body)
    // console.log($(this).serialize())
    // return;
    // alert(1)
    $.post($(this).attr('action') ,$(this).serialize() , function(response){
        // $('.sended').css("visibility", "");
        $(`.${deleteAction}`).removeClass("visibilty-hidden");
        $(`.${random_class_to_add_message_id}`).attr('message-id',response.obj_msg.id);
        
        // addMessage(response.obj_msg ,'message-out')
    }
    
    );
    var user={'img':`${userimg}`,"name":`${username}`}
    
    var msgg = {
        'random_class_to_add_message_id':random_class_to_add_message_id,
        'deleteAction':deleteAction,
        'body': body,
    //     'body':`<div class="message-text " style=" background-color:  ;height:90% display: flex;flex-direction: column;justify-content: space-between;">
    //     <p>${body} <span class="sended" style="position:relative ;bottom:-12px;right:-10px;z-index:0;visibility:hidden"> 
    //        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
    //     width="15px" height="15px" viewBox="0 0 78.369 78.369" style="enable-background:new 0 0 78.369 78.369;"
    //     xml:space="preserve"><g>
    //    <path fill="var( --bs-white)" d="M78.049,19.015L29.458,67.606c-0.428,0.428-1.121,0.428-1.548,0L0.32,40.015c-0.427-0.426-0.427-1.119,0-1.547l6.704-6.704
    //        c0.428-0.427,1.121-0.427,1.548,0l20.113,20.112l41.113-41.113c0.429-0.427,1.12-0.427,1.548,0l6.703,6.704
    //        C78.477,17.894,78.477,18.586,78.049,19.015z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
    //     </svg></span>
    //     </p></div>`,
        'id':102,
        'user':user,
        'type':'text'
    }
    addMessage(msgg,'message-out',true,true ,'visibilty-hidden')
    // addMessage(msgg,'message-out',true,false)

    $(this).find('.input-have-message').val('');
    // Typing(false)


});
const addMessagesToGroup = function(msg ,c = '' ,isAnimate = true ,deleteAction=true){
    const $container = $('.form-ccontainer');
    if (isAnimate) 
    {
        $container.animate({
          scrollTop: $container.prop('scrollHeight')
        });
    }
    // else 
    // {
    //     $container.scrollTop($container.prop('scrollHeight'))
    //     // $container.scrollTop = 9c9;
    // }
    // -------------


    var something=msg.body;

    var dropdown  = '' ;
    var dir;
        if(c=='')
        {
             something=something.replace('visibility:','visibility:hidden')
            //  ${something}
        
        dir=`
        <img class="avatar" src="${msg.user.img}" alt="" style="">
        <div  style=" display: flex;flex-direction: column; ">
                <p style=" font-size:;   position: relative;top: 5px; background-color:  ;margin-bottom:0px "> ${msg.user.name}</p>
                


                <div class="message-text" >
                        <p>${something} 
                            <span class="sended  " style="position:relative ;bottom:-12px;right:-10px;z-index:0;visibility:">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="15px" height="15px" viewBox="0 0 78.369 78.369" style="enable-background:new 0 0 78.369 78.369;"xml:space="preserve"><g><path fill="var( --bs-white)" d="M78.049,19.015L29.458,67.606c-0.428,0.428-1.121,0.428-1.548,0L0.32,40.015c-0.427-0.426-0.427-1.119,0-1.547l6.704-6.704c0.428-0.427,1.121-0.427,1.548,0l20.113,20.112l41.113-41.113c0.429-0.427,1.12-0.427,1.548,0l6.703,6.704C78.477,17.894,78.477,18.586,78.049,19.015z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                </svg>
                            </span>
                        </p>
                </div> 
                
                
        </div>   
        `;
        
        }
      
        else
        // else
        {
            // dir= something;
            dir=` 
            <div class="message-text " style=" background-color:  ;height:90% display: flex;flex-direction: column;justify-content: space-between;">
                <p>${something} 
                    <span class="sended  " style="position:relative ;bottom:-12px;right:-10px;z-index:0;visibility:">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="15px" height="15px" viewBox="0 0 78.369 78.369" style="enable-background:new 0 0 78.369 78.369;"xml:space="preserve"><g><path fill="var( --bs-white)" d="M78.049,19.015L29.458,67.606c-0.428,0.428-1.121,0.428-1.548,0L0.32,40.015c-0.427-0.426-0.427-1.119,0-1.547l6.704-6.704c0.428-0.427,1.121-0.427,1.548,0l20.113,20.112l41.113-41.113c0.429-0.427,1.12-0.427,1.548,0l6.703,6.704C78.477,17.894,78.477,18.586,78.049,19.015z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                        </svg>
                    </span>
                </p>
            </div> `;

            if(deleteAction==true)
            {
            dropdown=`<div class="message-action">
            <div class="dropdown"  onclick="dropdown(this)">
                    <a class="icon text-muted" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                    </a>

                    <ul id="dropdown-menu" class="dropdown-menu ">

                        <li message-id=${msg.id} onclick ="{deleteMessge(this)}">
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
        }
            
        $("#soso").append(`
        <div class="name-to-group message ${c} ">
            <div class="message-inner" >
                   <div class="message-body">
                         <div class="message-content">
                               ${dir}
                               ${dropdown}
                        </div> 
                    </div>
                    <div class="message-footer">
                        <span class="extra-small text-muted">${moment(msg.created_at).fromNow()}</span>
                    </div>
            </div>
        </div>
          `); 
    
}
const addMessage = function(msg ,c = '' ,isAnimate = true ,deleteAction=true ,classDeletMessage=''){
    const $container = $('.form-ccontainer');
    if (isAnimate) 
    {
        $container.animate({
          scrollTop: $container.prop('scrollHeight')
        });
    }
    // // else 
    // // {
    // //     $container.scrollTop($container.prop('scrollHeight'))
    // //     // $container.scrollTop = 9c9;
    // // }
    // // -------------


    var something=msg.body;
    var link_attachment=msg.body;
    // console.log(msg)
    if(msg.type=='text')
    {
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
        something= `<img  width="200"  class="img-fluid rounded" src="${link_attachment}" data-action="zoom" alt="">`;

    }

    else if(msg.type=='audio')
    {
        // alert()
        something=`
        <audio style='border: 5px solid #2787F5; border-radius: 50px;'  controls ><source src="${link_attachment}" type="audio/WAV"></audio>
        
        <span class="sended ${msg.deleteAction} ${classDeletMessage}  "   style="position:absolute;right:23px; z-index:120;visibility:visiable"> 
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 78.369 78.369" style="enable-background:new 0 0 78.369 78.369;" xml:space="preserve"><g>
               <path fill="#2787F5" d="M78.049,19.015L29.458,67.606c-0.428,0.428-1.121,0.428-1.548,0L0.32,40.015c-0.427-0.426-0.427-1.119,0-1.547l6.704-6.704 c0.428-0.427,1.121-0.427,1.548,0l20.113,20.112l41.113-41.113c0.429-0.427,1.12-0.427,1.548,0l6.703,6.704 C78.477,17.894,78.477,18.586,78.049,19.015z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
            </svg>
        </span>`;
    }
   
    else if(msg.type=='attachment')
    {
//     console.log(msg.attachment.link_attachment )
// return;
        // console.log(attachment)
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
     

    var dropdown  = '' ;

        if(c=='')
        {
             something=something.replace('visibility:','visibility:hidden')
        }
        else
        {
            if(deleteAction==true)
            {
               
                dropdown=`<div class="message-action  ${msg.deleteAction} ${classDeletMessage} " >
                <div class="dropdown"  onclick="dropdown(this)">
                        <a class="icon text-muted" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                        </a>

                        <ul id="dropdown-menu" class="dropdown-menu" style ='list-style-type: none' >

                            <li  class=${msg.random_class_to_add_message_id} message-id=${msg.id} onclick ="{deleteMessge(this)}" style = 'background-color:var("--delete-message") '>
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
        }
        // ${something}
             $("#soso").append(`
  
             <div class="name-to-group message ${c} ">
        
             <div class="message-inner" >
                 <div class="message-body">
                     <div class="message-content">
                    ${something}       
        
                    ${dropdown }
                     </div> 
                 </div>

                 <div class="message-footer">
                     <span class="extra-small text-muted">${moment(msg.created_at).fromNow()}</span>
                 </div>
             </div>
         </div>
  
             `); 
    //  }
    
 
}

//------------messages in chat----------
var u=0;
// var response_conversation_id=0

Object.defineProperty(this, 'response_conversation_id', {
    get: function () { return u; },
    set: function (set) {
        // response_conversation_id = v;
        u=set 
       
        $('#is-typing').addClass('d-none')  
       
      console.log('Value changed! New Conversation: ' + set);
    }
  });


$(`#chat-list`).on('click','[data-messages]',function(e){
    e.preventDefault();
    // $(`#chat-list`)
    // $(`.text-reset`).css('background-color','var(--bs-gray-dark)')
    $(`.add-shadow`).removeClass('shadowww')
    // $(this).css('background-color','green')
    $(this).addClass('shadowww')

    
                                         //to hide (Loader)
    open_chat($(this).attr('data-messages')  ,$(this));
    // $(this).css('background-color','red')
})

const showAllMessages=function(){
    $(".show-all-messages").css('visibility','hidden'); 
    addLoader()
    $(`#soso`).empty();
    $.get(`/api/conversations/${response_conversation_id}/allMessages` , function(response)
    {

   
        if(response.conversation.type=='peer')
        {
            for(i in response.messeges)
            {
                let msg = response.messeges[i];
                let c  = msg.user_id ==userId ? 'message-out' :'';
                addMessage(msg , c ,false)
            }   
            hideLoader()
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
            hideLoader()
            const $container = $('.form-ccontainer');
            $container.scrollTop($container.prop('scrollHeight'))

        }
        
    })
}
var arrayInviteToGroup=[];
const open_chat=function(thiss, toLoader=''){
    
    $('.group-description').css('visibility','hidden'); 
    $('.group-description').css('display','none'); 
    addLoader(toLoader)
    // alert(1)
    $(`#soso`).empty();
    
    $(".to-return-home").removeClass("welcome-text");
    $(".footer-input-chat").css("display", "block");
    $(".app-bar-name-and-img").css("display", "block");
    $(".welcome-text").css("display", "none");
    $(".form-ccontainer").css("display", "block");
    $(".to-return-home").addClass("welcome-text");
//    return;
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
    $.get(`/api/conversations/${id}/messages` , function(response)
    {
        console.log(response)
        // return;

         response_conversation_id=response.conversation.id;
         $('#conversation-id-input-target').text(response_conversation_id)
        //  response_conversation_id=response.conversation.partiscipants[0].pivot.user_id;
      
        
        $('#chat-name').text(response.conversation.lable);
        $('#chat-img').attr('src',response.conversation.img);
        $('#chat-img').attr('data-action','zoom');
        // $('#chat-img').attr('src',response.conversation.partiscipants[0].img);
        
        if(response.read_more)
        $(".show-all-messages").css('visibility','visible'); 

        else
        $(".show-all-messages").css('visibility','hidden'); 


     
        if(response.conversation.type=='peer')
        {   
            
            for(i in response.messeges)
            { 
                // let message_id= response.messages
                let msg = response.messeges[i];
                // break;
                let c  = msg.user_id ==userId ? 'message-out' :'';
                addMessage(msg , c ,false)
            }   
            hideLoader(toLoader)
            const $container = $('.form-ccontainer');
            $container.scrollTop($container.prop('scrollHeight'))

            
        }
        else
        {
            console.log(response)
            $('.group-description').css('visibility','visible'); 
            $('.group-description').css('display','block'); 
            $('.group-description-name').empty();
            $('.group-description-name').append(response.conversation.lable);
            $('.group-description-description').empty();
            $('.group-description-description').append(response.conversation.description);
            $('.group-description-img').attr('src',response.conversation.img)
            $('.group-description-members').empty();
            // $('.invite-friend-group').empty()

            fetch(`api/conversations/${response.conversation.id}/getParticipants`, 
            {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': +tokenn
                }})
                .then(res =>
                    {

                      return res.json()
                    }
                        ).then(data=>
                        {
                            // return;
                            for(let i in data)
                            $('.group-description-members').append(`<li class="list-group-item">
                            <div class="row align-items-center gx-5">
                                <div class="col-auto">
                                    <a href="#" class="avatar avatar-online">
                                        <img class="avatar-img" src="${data[i].user.img}" alt="">
                                    </a>
                                </div>
                
                                <div class="col">    <h5><a href="#">  ${data[i].user.name} </a></h5>   
                                <span class="extra-small text-primary"> ${data[i].message_count}</span>
                                </div>
                                
                                <div class="col-auto">
                                            <span class="extra-small text-primary"> ${data[i].role}</span>
                                        </div>
                            </div>
                        </li>`)
                         });
         
            fetch(`api/users_not_in_group/${response.conversation.id}`, 
            {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': +tokenn
                }})
                .then(res =>
                    {

                      return res.json()
                    }
                        ).then(data=>
                        {
                            // alert(data)
                            // return;
                            for(let i in data)
                            // <li class="list-group-item">
                            $('.invite-friend-group').append(`
                            <div class="card-body" style="background-color:var(--bs-body-bg)">

                                <div class="row align-items-center gx-5">
                                    <div class="col-auto">
                                        <div class="avatar avatar-online">
               
                                                <img class="avatar-img" src="${data[i].img}" alt="">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5>${data[i].name}</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check">
                                  
                                        
                                     <input class="form-check-input cheack-invite-to-group" type="checkbox" value="${data[i].id}" id="" onclick="{
                                         if (this.checked == true)
                                         {
                                             if(!arrayInviteToGroup.includes($(this).attr('value')))
                                             {
                                                 arrayInviteToGroup.push($(this).attr('value'));
                                             }
                                         }
                                        else
                                        {
                                         const index = arrayInviteToGroup.indexOf($(this).attr('value'));
                                         arrayInviteToGroup.splice(index, 1);
                                        }
                                     console.log(arrayInviteToGroup)

                                      }" >
                     
                                        <label class="form-check-label" for="id-member-9"></label>
                                        </div>
                                    </div>
                                </div>
                           <div>
                           `)
                        //    </li>
            });
            
            
           
            for(i in response.messeges)
            {
                let msg = response.messeges[i];
                let c  = msg.user_id ==userId ? 'message-out' :'';
                addMessagesToGroup(msg , c ,false,true)
            }   
            hideLoader(toLoader)
            const $container = $('.form-ccontainer');
            $container.scrollTop($container.prop('scrollHeight'))

        }
        
    })
}
// $('.')
// arrayInviteToGroup
//----------change_pass---------------

$("#change_pass").on('submit',function(e){
    e.preventDefault();
    $('.send-image-loader').css('display','block')

    $.post($(this).attr('action') ,$(this).serialize() , function(response){
        // console.log(response.status)
        if(response.status==0){
            document.documentElement.style.setProperty('--password', 'rgb(246, 30, 37)');
            $('#profile-current-password').val('')
            play(soundErorr)

        }
        else{
            document.documentElement.style.setProperty('--password', 'rgb(15, 161, 44)');
            $('#profile-current-password').val('')
            $('#profile-new-password').val('')
            $('#profile-verify-password').val('')
            play(soundDone)

        }
        $('.bodyToastPassword').empty()
        $('.bodyToastPassword').append(response.message)
        $(`.toastPassword`).toast({ delay: 3000 });
        $('.toastPassword').toast('show'); 
        // alert(response.message)
        $('.send-image-loader').css('display','none')
    });

});

function showHidePassword() {
    var x = document.getElementById("profile-current-password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
    var x = document.getElementById("profile-new-password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
    var x = document.getElementById("profile-verify-password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
}

//-------------searchhh_chats----------------
$("#searchhh_chats").on('submit',function(e){
    e.preventDefault();
    $.post($(this).attr('action') ,$(this).serialize() , function(response){
        console.log(response)
        // return; 
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
        if(res[i].lastMessageType!='text')
            res[i].body='attachment '
            else
            {
                var message_body_with_slice=res[i].body.slice(140, -129);
                res[i].body=message_body_with_slice.slice(0,10);
            }
        
    $("#chat-list").append(`
    <div id="card_to_append_search" style=" chat-id=${res[i].conversation_id} margin-bottom: 13px   " 
    onclick="{   open_chat( ${res[i].conversation_id} );     $('main').addClass('is-visible');   }"   >
    

    <a href="#" class="card border-0 text-reset">
    
        <div  class="card-body">
            <div class="row gx-5">
            <div class="col-auto">
            <div class="avatar avatar-online">
              
                <img src="${res[i].img}" alt="#" class="avatar-img">
            </div>
        </div>

                <div class="col">
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="me-auto mb-0">  ${res[i].lable}</h5>

                        <span class="text-muted extra-small ms-2"> ${moment(res[i].created_at).fromNow()}</span>
                     
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="line-clamp me-auto">
                        ${res[i].body}
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


$(`#tab-chats`).on('click',function(e){
    $(`#chat-list`).empty();
    getConversations();

});

const getConversations=function(pauseLoder=true){
    if(pauseLoder==true)
    addLoader($(`#tab-chats`))
    $.get('/api/conversations',function(response){
  
        for(i in response)
        {
            // console.log(response[i].conversation.lable);
        conversation(response[i])
        }
        if(pauseLoder==true)
        hideLoader($(`#tab-chats`))
    })
}

const conversation=function(chat){
  
var countUnReadMsg=chat.conversation.unRead_message
// alert(countUnReadMsg)
if(countUnReadMsg!=0){
    counter=`
    <div class="div-count-msg badge badge-circle bg-primary ms-5 unread-message-count"  style="visibility:visible" onclick={

    }>
        <span class="unread-message-count" data-messages=${chat.conversation.id} >${countUnReadMsg}</span>
    </div>`;
}
else{
    counter=`
    <div class="div-count-msg badge badge-circle bg-primary ms-5  unread-message-count  d-none" data-messages=${chat.conversation.id} onclick={
    }>
        <span class="unread-message-count" data-messages=${chat.conversation.id} style= >new message</span>
    </div>`;
    
}

    var message_body_with_slice;
    if(chat.conversation.last_massege.type=='text'){
        aa=chat.conversation.last_massege.body.slice(143,-842);
        message_body_with_slice=aa.slice(0,10);
    }
    else
    message_body_with_slice=chat.conversation.last_massege.type;

    $('#chat-list').append(`
    
    
    <a  onclick="{
        
       

    $('main').addClass('is-visible');
    
    $('.unread-message-count[data-messages=${chat.conversation.id}]').html(0);
    $('.unread-message-count[data-messages=${chat.conversation.id}]').addClass('d-none');
    
   
    }" href="" id="roro" data-messages=${chat.conversation.id} class="card border-0 text-reset add-shadow zz  ">

    <div style="" class="card-body zz" >
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

                <div class="d-flex align-items-center ">
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


//--------------------------notifications--------------------------
$(`#tab-notifications`).on('click',function(e){
    $(`#cards-notification`).empty();
    getNotification($(`#tab-notifications`));

});

const getNotification=function(toLoader){
    addLoader(toLoader)

    $.get('/api/getNotification',function(response){
  
        for(i in response)
        {
        notification(response[i])
        }
    hideLoader(toLoader)

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
                <input href="#2" type="submit" value="${stringHide}" class="btn btn-sm btn-soft-primary w-100"
                onclick="{
                    let data = new FormData
                    data.append('_token','${tokenn}')
                   
                    fetch('/api/friend/${chat.refernce}', {
                    method: 'DELETE',
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
                <input href="#" value="${stringConfirm}" class="btn btn-sm btn-primary w-100" onclick="{
                    let data = new FormData
                    data.append('_token','${tokenn}')
                  
                
                    fetch('/api/friend/${chat.refernce}', {
                    method: 'PUT',
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

//--------------------------getFriends------------------------
styleHi=" text-decoration: none;border-radius: 9px;border:solid 1px #3e444f;cursor : pointer;padding:0px 15px ;text-align: center;color:#fff;background-color: #16191c ; display:block"
$(`#tab-friends`).on('click',function(e){
    $(`#friends_in_searsh`).empty();
    getFriends($(`#tab-friends`));

});
const getFriends=function(toLoader){
    // $.get('/api/getUsers',function(response){
    addLoader(toLoader)

        $.get('/api/friend',function(response){
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

                            // alert('message sended')
                            let data = new FormData
                            data.append('_token','${tokenn}')
                            data.append(  'body', '${stringHi}' )
                            data.append('user_id',${response[i].id});
                            data.append('type','text');
                            fetch('/api/messages', {
                                method: 'POST',
                                body:data,
                                headers: {
                                    'X-CSRF-TOKEN': +'${tokenn}'
                                }
                                }).then(res =>
                                    {
                                        if (res.status>=200 && res.status <300) 
                                        return res.json()
                                        else
                                        throw new Error();
                                    }
                                ).then(data=>{
                                    console.log(data);
                            $('.hi-headarToast').empty();
                            $('.hi-bodyToast').empty();

                            $('.hi-goToChat').attr('chat-id',data.obj_msg.conversation_id)
                            $('.hi-headarToast').append('you send hi to '+data.obj_msg.conversation.lable);
                            $('.hi-bodyToast').append('click here to complete chat ');
                            $('.toast-send-hi').toast({ delay: 3000 });
                            $('.toast-send-hi').toast({animation: true});
                            $('.toast-send-hi').toast('show');
                            play(soundDone)
                            $('.send-image-loader').css('display','none')

                                    
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
    $('#lodder').addClass('hide');
    hideLoader(toLoader)

        // user(response[i])
    });
}

//search friends
$('#input-search-friends').on('keyup',function() {
    $(`#friends_in_searsh`).empty();
    $("#search_friends").submit();
});

$("#search_friends").on('submit',function(e){
    e.preventDefault();
    $.post($(this).attr('action') ,$(this).serialize() , function(response){
        search_friends(response)  
    });
// $('#input-search-friends').val('');
});
const search_friends = function(res){
    
    $("#friends_in_searsh").replaceWith(` 
    <div id="friends_in_searsh" class="card-list">
    </div>
`);
for(let i = 0; i<
    res.length ;i++)
{
  console.log(res)  
    $("#friends_in_searsh").append(`
    <div id="friends_in_searsh" class="card-list">
  
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
         
                    <input class="onlL" onclick=myFunction()  type="submit" value="${stringHi}"  style="text-decoration: none;border-radius: 9px;border:solid 1px #3e444f ;cursor : pointer;padding:0px 15px ;text-align: center;color:#fff;background-color: #16191c ;" >
                    <script>
                    function myFunction() {
                        // alert('message [hi] sended , go to chat to complete conversation');
        $('.send-image-loader').css('display','block')

                        let data = new FormData
                                data.append(  'body', '${stringHi}' )
                                data.append('user_id',${res[i].id});
                                data.append('type','text');

                        fetch("/api/messages", {
                            method: "POST",
                            body:data,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        }).then(res =>
                            {
                                if (res.status>=200 && res.status <300) 
                                return res.json()
                                else
                                throw new Error();
                            }
                        ).then(data=>{
                            console.log(data);
                    $('.hi-headarToast').empty();
                    $('.hi-bodyToast').empty();

                    $('.hi-goToChat').attr('chat-id',data.obj_msg.conversation_id)
                    $('.hi-headarToast').append('you send hi to '+data.obj_msg.conversation.lable);
                    $('.hi-bodyToast').append('click here to complete chat ');
                    $('.toast-send-hi').toast({ delay: 3000 });
                    $('.toast-send-hi').toast({animation: true});
                    $('.toast-send-hi').toast('show');
                    play(soundDone)
                    $('.send-image-loader').css('display','none')

                            
                        })
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

//---------------------get users----------------------
$(`#tab-all-users`).on('click',function(e){
    $(`#all_users_in_app`).empty();
    getUsers($(`#tab-all-users`));

});

const getUsers=function(toLoader){
    addLoader(toLoader)

    $.get('/api/getUsers',function(response){

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
                            let data = new FormData
                            data.append('_token','${tokenn}')
                            data.append('user_id',$(this).attr('user-id'));
                            fetch('/api/friend', {
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
    hideLoader(toLoader)


    });
}


//search users
$("#form-search-users").on('submit',function(e){
    e.preventDefault();
    $.post($(this).attr('action') ,$(this).serialize() , function(response){
    $(`#all_users_in_app`).empty();

    search_users(response)  
    });
// $('#form-search-users').val('');
});


$('#input-search-users').on('keyup',function() {
    $(`#all_users_in_app`).empty();
    $("#form-search-users").submit();
});

const search_users = function(res){
    
    $("#all_users_in_app").replaceWith(` 
    <div id="all_users_in_app" class="card-list">
    </div>
`);
for(let i = 0; i<
    res.length ;i++)
{
    $("#all_users_in_app").append(`
  
    <div id="all_users_in_app" class="card-list">
  
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
         
                <input class="addfriend" type="submit" value="${stringAdd}" user-id=${res[i].id} " 
                onclick="
                {   
                    
                    $(this).attr('class','addfriend_done')
                    let data = new FormData
                    data.append('_token','${tokenn}')
                    data.append('user_id',$(this).attr('user-id'));
                    fetch('${a}'+'/api/friend', {
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
}

//---------------------create group---------------------//
var arrayGroup= [];
var imgGroup;
var groupName='';
var groupDescription='';
var groupForm=$('#groupForm');

$(`.tap-friend-group`).on('click',function(e){
    $(`.friends-create-group`).empty();
    getFriendsToCreateGroup();
});

 const getFriendsToCreateGroup =function(){
    $.get('/api/friend',function(response){

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

$('#upload-profile-photo').on('change',function(e){

    var x= URL.createObjectURL(e.target.files[0]);
    var profileImage=e.target.files[0];
    $('.profile-image').attr('src',x);

    let data = new FormData
     data.append('img',profileImage);
 fetch('/api/updateImg', {
     method: 'POST',
     body:data,
     headers: {
     'X-CSRF-TOKEN': tokenn
     }
     }).then(response=>{

        return response.json()
     
         }).then(data=>{
            console.log(data)
            if(data.status==0){
            document.documentElement.style.setProperty('--password', 'rgb(246, 30, 37)');
            play(soundErorr)
         
             }
            else{
                document.documentElement.style.setProperty('--password', 'rgb(15, 161, 44)');
                 $('.update-profile-img').attr('src',x);
            play(soundDone)
             

            }
            $('.bodyToastPassword').empty()
            $('.bodyToastPassword').append(data.message)
            $(`.toastPassword`).toast({ delay: 3000 });
            $('.toastPassword').toast('show'); 
         })
});


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
    e.preventDefault();

    let data = new FormData
     data.append('img',imgGroup);
     data.append('users_id',arrayGroup);
     data.append('groupName',groupName);
     data.append('groupDescription',groupDescription);
     fetch('/api/createGroup', {
     method: 'POST',
     body:data,
     headers: {
     'X-CSRF-TOKEN': tokenn
     }
     }).then(response=>{

        return response.json()
     
         }).then(data=>{
            console.log(data)
            if(data.status==0){
            document.documentElement.style.setProperty('--password', 'rgb(246, 30, 37)');
            play(soundErorr)

         
             }
            else{
                arrayGroup=[];
                imgGroup=''
                groupDescription=''
                imgGroup=null
                $('.groupName').val('')
                $('.groupDescription').val('')
                $('.imgGroup').val('')
                $(".imgGroup").val(null);
                $('#blah').attr('src','');
                $('.cheack-group').prop('checked', false);
                $('.button-create-group').css("display", "none");
                $('.if-arrayGroup').empty();
                $('.if-arrayGroup').append(noSelectedMemberYet);
                $(".if-arrayGroup").css("background-color", "#D32535"); 
                document.documentElement.style.setProperty('--password', 'rgb(15, 161, 44)');

            play(soundDone)

            }
            $('.bodyToastPassword').empty()
            $('.bodyToastPassword').append(data.message)
            $(`.toastPassword`).toast({ delay: 3000 });
            $('.toastPassword').toast('show'); 
         })


});


// --------------responsive-----------
//to show message page in mobile
// $(`.zz`).on('click',function(e){
//     $("main").addClass("is-visible");
// });
    

//------say_hi-----
$(".say_hi").on('submit',function(e){
    e.preventDefault();
    // let msg=$(this).find('textarea').val()
    $.post($(this).attr('action') ,$(this).serialize() , function(response){
    });
    alert('Welcome message arrived , go to chat to complete conversation')

});


var pop =false
$(document).mouseup(function(e)
{
    if(pop==true){
   
var container = $(".popup");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        console.log('in edit')
        // container.hide();
        // $('.exit').click()
        $('.layout').removeClass('to-edit-name');
        // $('.modal').removeClass('to-edit-name');
        $('.popup').addClass('d-none');
        $('.modal').removeClass('d-none');
        pop =false
    }
else
console.log('out')

}
});


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
function fetchUpdateName(){
    $('.send-image-loader').css('display','block')
    
    $('.layout').removeClass('to-edit-name');
    $('.modal').removeClass('to-edit-name');
    $('.modal').removeClass('d-none');
    // $('.popup').addClass('d-none');
    
    $(".popup").animate({'left':'15px'}, "fast");
    setTimeout(() => {
    $(".popup").animate({'left':'50%'}, "fast");
    $('.popup').addClass('d-none');
    }, 100);

    $('.bodyToastPassword').empty()
    var data = new FormData;
    data.append('new_name',$('.new_name').val())
    data.append('new_img',$('.new_img').val())
    fetch('api/updateName',{method:'post',body:data})
    .then(res =>{
                  if (res.status>=200 && res.status <300) 
                  return res.json()
                  else
                  throw new Error();
                })
                .then(data=>
                        {
                         $('.bodyToastPassword').append(data.message)
                         $(`.toastPassword`).toast({ delay: 3000 });
                         $('.toastPassword').toast('show'); 
                         play(soundDone)
                          $('.send-image-loader').css('display','none')
                        })
    $('.username').empty();
    $('.username').append($('.new_name').val());
    $('.modal').removeClass('d-none');

    


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
function countChar(val) {
    if(envTyping==true || envTyping==1 ){
    var length = val.value.length;
    // console.log(length);
    if( length > 0 ) 
    Typing(true);
  
     else
    Typing(false); 
  }
}
const Typing = (boolean) => {


    if(envTyping==true || envTyping==1 ){
        setTimeout( () => {
          console.log('typing'+boolean);
        
        
        
        
          let channel = Echo.private('chat')
        
            channel.whisper('typing', {
              user_id: userId,
              conversation_id:response_conversation_id,
              typing: boolean
            })
        }, 300)
    }
}

$(document).ready(function () {
    
    getConversations(false);
});




