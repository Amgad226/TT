
<!DOCTYPE html>
<html lang="en">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Head -->        
        <head>
        <meta name="theme-color" content="#6777ef"/>
        <link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">
        <link rel="manifest" href="{{ asset('/manifest.json') }}">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>TT</title>
        <link rel="shortcut icon" href="{{asset('img/logo.png')}}" type="image/x-icon">
        <!-- Favicon -->

        <!-- Font -->
        {{-- <link rel="preconnect" href="https://fonts.gstatic.com"> --}}
        {{-- <link rel="stylesheet" href="{{asset('assets/css/font.Roboto.css')}}"> --}}
        <link rel="stylesheet" href="{{asset('assets/css/Material.Icons.css')}}">
        
        
        <!-- Template CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/template.dark.bundle.css')}}" >

        <style>
            .shadow{
                box-shadow: 0px -0px 3px 1px #4C6AAF!important;
              }
        </style>
    </head>


    
    <body>
        <!-- secondery loader -->
        <div class="send-image-loader lds-ripple " style="display:none;  top: 40%;  right: 35%;  z-index: 100000;  position: absolute;"><div></div><div></div></div>
        <style>
            .lds-ripple {
          display: inline-block;
          position: relative;
          width: 80px;
          height: 80px;
            }
            .lds-ripple div {
              position: absolute;
              border: 4px solid #fff;
              opacity: 1;
              border-radius: 50%;
              animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
            }
            .lds-ripple div:nth-child(2) {
              animation-delay: -0.5s;
            }
            @keyframes lds-ripple {
              0% {
                top: 36px;
                left: 36px;
                width: 0;
                height: 0;
                opacity: 0;
              }
              4.9% {
                top: 36px;
                left: 36px;
                width: 0;
                height: 0;
                opacity: 0;
              }
              5% {
                top: 36px;
                left: 36px;
                width: 0;
                height: 0;
                opacity: 1;
              }
              100% {
                top: 0px;
                left: 0px;
                width: 72px;
                height: 72px;
                opacity: 0;
              }
            }
        </style>

        <div class="popup d-none "
         style="margin: 0;margin-right: -50%;transform: translate(-50%, -50%);z-index:10000;/* Fallback color */background-color: rgba(0,0,0, 0.8);/* Black w/opacity/see-through */color: white;font-weight: bold;border: 3px solid #f1f1f1;position: absolute;top: 45%;left: 50%;transform: translate(-50%, -50%);animation: profile-in .3s ;padding: px;text-align: center;">

               <div style="display: flex; flex-direction: row ;justify-content: space-between">

                   <p style="font-size:28px;height:30px;width: calc(100% /2);margin-left:90px;margin-top:20px; background-color:" >edit profile </p>
                   <div  style="height:22px;width: calc(100% /15);background-color:#a70604; position:;left:90%;top:2%" onclick="{popupFun()}" class=" icon icon-xl   exit">
                       <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"class="feather feather-x"> <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                   </div>
               </div>
               <hr>
                   <div style="display: flex; flex-direction: column ;justify-content: space-between;margin-bottom:40px " >
                       <div style="height:100/2%; margin: 10px;  width:320px;">
                          <span>new name</span>
                          <input style="color:var(--arrow);height:100/2%; text-align:center;width:330px;" class=" input-group-text new_name username" name="new_name" type="text" value="{{Auth::user()->name}}">
                       </div>  
                       <div style="height:100/2%; margin: 10px;  width:320px;">
                           <span>new phone</span>
                           <input style="color:var(--arrow);height:100/2%; text-align:center;width:330px;" class=" input-group-text new_name username" name="new_name" type="text" value="09154891589  {{Auth::user()->phone}}">
                        </div>  
                   {{-- <br> --}}
                       <div style="height:100/2% ;margin: 10px;width:320px">
                           <span style="padding-right:10px; ">new img</span>
                           <input   id="upload-profile-photo"  style="height:100/2%; color:var(--arrow);text-align:center;margin-left:0%" class=" input-group-text new_img " name="new_img" type="file" value=".">
                       </div>
                   
                   </div>
                   <div style="color:var(--arrow);width:330px;margin-bottom:5px" onclick="{fetchUpdateName();}" class="icon icon-xl  btn  btn btn-secondary">
                       send
                   </div>
               
               
                   {{-- <button onclick="{popupFun();fetchUpdateName();}">send</button> --}}
        </div>

        <!-- primary loader -->
        <div class="hide" id="Loader" style="  top: 40%;  right: 35%;  z-index: 100000;  position: absolute;">
            <div class="loader"></div>
        </div>

        <!-- Notification -->
        <!-- toast new message -->
        <div class="toast toast-recive" style="  top: 10%;  background-color: var(  --bs-gray-dark);right: 0%;  z-index: 100000;  position: absolute;animation-name: example;animation-duration: 3s;">
            <div class="goToChat"  onclick="{open_chat($(this).attr('chat-id'));   $('.toast').toast('hide');  }"  chat-id=1  style=" max-height:85px;  max-width:240px;min-width:240px;min-height:85  ;overflow: hidden;  ">
                <div class="toast-body " style="  ;border: 3px rgb(32, 3, 138) solid;" >
                    <div  style="  font-size: 24px; "><i class="headarToast"><p>Toast</p></i></div>
                    <div class="bodyToast" style=" font-size: 12px;max-height:8px;  max-width:240px;">hi amgad you need help ?</div>
                </div>
            </div>
        </div>
        <!--toast change password and create grope validation-->
        <div class="toast toastPassword "  style="top: 22%;  background-color: var(  --bs-gray-dark);right: 0%;  z-index: 100000;  position: absolute;animation-name: toastPassword;animation-duration: 3s;">
                <div class="toast-body "onclick="{console.log(213); $('.toastPassword').toast('hide') }" style="  ;border: 3px rgb(32, 3, 138) solid;" >
                    {{-- <div  style="  font-size: 24px; "><i class="headarToast"><p>password</p></i></div> --}}
                    <div class="bodyToastPassword" style=" font-size: 18px;  max-width:240px;"> passwoed is wrong bro need </div>
                </div>
        </div>
           <!--toast say hi -->
        <div class="toast toast-send-hi "  style="top: 22%;  background-color: var(  --bs-gray-dark);right: 0%;  z-index: 100000;  position: absolute;animation-name: toastPassword;animation-duration: 3s;">
                <div class="hi-goToChat"  onclick="{open_chat($(this).attr('chat-id'));   $('.toast-send-hi').toast('hide');  }"  chat-id=1>
                    <div  class="hi-toast-body " style="border: 3px rgb(32, 3, 138) solid;height:80px; width:250px;" >
                        <div style=" margin: 10px 15px" >
                        <div style="  font-size: 20px; " ><i class="hi-headarToast"><p>you send hi,to amgad</p></i> </div>
                        <div class="hi-bodyToast" style=" font-size: 12px;  max-width:240px;"> click here to go complete chat</div>
                    </div>
                    </div>
                </div>
        </div>

        <!-- Layout -->
        <div class="layout overflow-hidden " >
       
            <!-- Navigation -->
            <nav class=" navigation d-flex flex-column text-center navbar navbar-light hide-scrollbar">
                <!-- logo -->
                
                 <a href="#" title="TT" class="d-none d-xl-block mb-6  welcome-text to-return-home" onclick="{ 
                     $(`#soso`).empty();
                     response_conversation_id=0
                    //  play();
                    // $(`.toast`).toast({ delay: 6000 });
                    // $('.toast').toast('show'); 
                     }">
                    <svg version="1.1" width="46px" height="46px" fill="currentColor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 46 46" enable-background="new 0 0 46 46" xml:space="preserve">
                        <polygon opacity="0.7" points="45,11 36,11 35.5,1 "/>
                        <polygon points="35.5,1 25.4,14.1 39,21 "/>
                        <polygon opacity="0.4" points="17,9.8 39,21 17,26 "/>
                        <polygon opacity="0.7" points="2,12 17,26 17,9.8 "/>
                        <polygon opacity="0.7" points="17,26 39,21 28,36 "/>
                        <polygon points="28,36 4.5,44 17,26 "/>
                        <polygon points="17,26 1,26 10.8,20.1 "/>
                    </svg>
                  
                </a>

                <!-- Nav items -->
                <ul class="  security-chats d-flex nav navbar-nav flex-row flex-xl-column flex-grow-1 justify-content-between justify-content-xl-center align-items-center w-100 py-4 py-lg-2 px-lg-3" role="tablist">
                

                 


                    <!-- Invisible item to center nav vertically -->
                    {{-- flex-xl-grow-1 --}}
                    {{-- <li class="nav-item d-none d-xl-block invisible " >
                        <a class="nav-link " href="#" title="">
                            <div class="icon icon-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"class="feather feather-x"> <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </div>
                        </a>
                    </li> --}}

                    <!-- New chat -->
                      <li class="nav-item " >
                        <a class="nav-link py-0 py-lg-8 tap-friend-group" id="tab-create-chat" href="#tab-content-create-chat" title="Create group" data-bs-toggle="tab" role="tab">
                            <div class="icon icon-xl ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                            </div>
                        </a>
                    </li>



                    <!-- All Users -->
                    <li class="nav-item">
                        <a class="nav-link py-0 py-lg-8" id="tab-all-users" href="#tap-content-all-users" title="Create chat" data-bs-toggle="tab" role="tab">
                            <div class="icon icon-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                            </div>
                        </a>
                    </li>

                    <!-- Friends -->
                    <li class="nav-item">
                        <a class="nav-link py-0 py-lg-8" id="tab-friends" href="#tab-content-friends" title="{{__('Friends')}}" data-bs-toggle="tab" role="tab">
                            <div class="icon icon-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                        </a>
                    </li>

                    <!-- Chats -->
                    <li class="nav-item">
                        <a class="nav-link active py-0 py-lg-8" id="tab-chats" href="#tab-content-chats" title="Chats" data-bs-toggle="tab" role="tab">
                            <div class="icon icon-xl icon-badged">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                <div class="badge badge-circle bg-primary">
                                    <span>0</span>
                                </div>
                            </div>
                        </a>
                    </li>

                    <!-- Notification -->
                    <li class="nav-item  d-xl-block">
                        <a class="nav-link py-0 py-lg-8" id="tab-notifications" href="#tab-content-notifications" title="Notifications" data-bs-toggle="tab" role="tab">
                            <div class="icon icon-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                            </div>
                        </a>
                    </li>

                      <!-- theme -->
                      <li class="nav-item d-  d-xl-block ">
                        <a class="nav-link py-0 py-lg-8" id="tab-support" href="#tab-content-support" title="Support" data-bs-toggle="tab" role="tab">
                            <div class="icon icon-xl">        
                                <svg style="cursor: pointer;"class="toggel"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 96 96">
                                        <switch>
                                                    <g fill="#a7a6a8" class="color000000 svgShape">
                                                        <path d="M52 4v8a4 4 0 0 1-8 0V4a4 4 0 0 1 8 0zm-4 76a4 4 0 0 0-4 4v8a4 4 0 0 0 8 0v-8a4 4 0 0 0-4-4zM14.059 14.059a4 4 0 0 0 0 5.657l5.657 5.657a4 4 0 0 0 5.657-5.657l-5.657-5.657a4 4 0 0 0-5.657 0zm56.568 56.568a4 4 0 0 0 0 5.657l5.657 5.657a4 4 0 0 0 5.657-5.657l-5.657-5.657a4 4 0 0 0-5.657 0zM0 48a4 4 0 0 0 4 4h8a4 4 0 0 0 0-8H4a4 4 0 0 0-4 4zm80 0a4 4 0 0 0 4 4h8a4 4 0 0 0 0-8h-8a4 4 0 0 0-4 4zM14.059 81.941a4 4 0 0 0 5.657 0l5.656-5.657a4 4 0 0 0-5.656-5.657l-5.657 5.657a4 4 0 0 0 0 5.657zm56.568-56.568a4 4 0 0 0 5.657 0l5.657-5.657a4 4 0 0 0-5.657-5.657l-5.657 5.657a4 4 0 0 0 0 5.657zM72 48c0 13.255-10.745 24-24 24S24 61.255 24 48s10.745-24 24-24 24 10.745 24 24zm-8 0c0-8.837-7.163-16-16-16s-16 7.163-16 16 7.163 16 16 16 16-7.163 16-16z" class="color000000 svgShape"/>
                                                    </g>
                                        </switch>
                                    </svg>
                            </div>
                        </a>
                    </li>

                    <!-- Settings -->
                    <li class="nav-item d- d-xl-block flex-xl-grow-1">
                        <a class="nav-link py-0 py-lg-8" id="tab-settings" href="#tab-content-settings" title="Settings" data-bs-toggle="tab" role="tab">
                            <div class="icon icon-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            </div>
                        </a>
                    </li>
       

                    <!-- Profile -->
                    {{-- <li class="nav-item " >
                        <a href="#" class="nav-link p-0 mt-lg-2" data-bs-toggle="modal" data-bs-target="#modal-invite">
                            <div class="icon icon-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"class="feather feather-x"> <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </div>
                        </a>
                    </li> --}}


                    <li class="nav-item " >
                        <a href="#" class="nav-link p-0 mt-lg-2" data-bs-toggle="modal" data-bs-target="#modal-profile">
                            <div class="avatar avatar-online mx-auto d- d-xl-block">
                                <div class="avatar ">
                                    <img class="avatar-img update-profile-img" src="{{asset(Auth::user()->img)}}" alt="">
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- Navigation -->

            
            <!-- Sidebar -->
            <aside class="sidebar bg-light">
           
                 <!-- Mobile: close -->
                <div class="col-2 d-xl-none welcome-text to-return-home" style="left: 90%; top:4%;   z-index: 1;  position: absolute;">
                    <a class="icon icon-lg text-muted" href="#" data-toggle-chat="">
                        <svg  width="24px" height="24px" viewBox="0 0 24 24" id="_24x24_On_Light_Arrow-Right" data-name="24x24/On Light/Arrow-Right" xmlns="http://www.w3.org/2000/svg">
                            <rect id="view-box" width="24" height="24" fill="none"/>
                            <path fill="var(--arrow)" id="Shape" d="M.22,10.22A.75.75,0,0,0,1.28,11.28l5-5a.75.75,0,0,0,0-1.061l-5-5A.75.75,0,0,0,.22,1.28l4.47,4.47Z" transform="translate(9.25 6.25)" fill="#141124"/>
                        </svg>
                    </a>
                </div>
                 <!-- Mobile: close -->

                <div class="tab-content h-100" role="tablist">
                     <!-- Create group  -->
                     <div class="tab-pane fade h-100" id="tab-content-create-chat" role="tabpanel">
                        <div class="d-flex flex-column h-100">
                            <div class="hide-scrollbar">

                                <div class="container py-8">

                                    <!-- Title -->
                                    <div class="mb-8">
                                        <h2 class="fw-bold m-0 ">{{__('Create group')}}</h2>
                                    </div>

                                    <!-- Search -->
                                    <div class="mb-6">
                                     

                                        <ul class="nav nav-pills nav-justified  adddd" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="pill" href="#create-chat-info" role="tab" aria-controls="create-chat-info" aria-selected="true">
                                                  {{__('Details')}}
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link " data-bs-toggle="pill" href="#create-chat-members" role="tab" aria-controls="create-chat-members" aria-selected="true">
                                                  {{__('Member')}}

                                                </a>
                                            </li>
                                        
                                        </ul>
                                    </div>

                                    <!-- Tabs content -->
                                    <div class="tab-content" role="tablist">
                                        <div class="tab-pane fade show active" id="create-chat-info" role="tabpanel">

                                            <div class="card border-0">
                                           

                                                <div class="card-body">
                                                    <form id="groupForm" autocomplete="off">
                                                        <div class="profile">
                                                            <div class="profile-img text-primary rounded-top">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 400 140.74"><defs><style>.cls-2{fill:#fff;opacity:0.1;}</style></defs><g><g><path d="M400,125A1278.49,1278.49,0,0,1,0,125V0H400Z"/><path class="cls-2" d="M361.13,128c.07.83.15,1.65.27,2.46h0Q380.73,128,400,125V87l-1,0a38,38,0,0,0-38,38c0,.86,0,1.71.09,2.55C361.11,127.72,361.12,127.88,361.13,128Z"/><path class="cls-2" d="M12.14,119.53c.07.79.15,1.57.26,2.34v0c.13.84.28,1.66.46,2.48l.07.3c.18.8.39,1.59.62,2.37h0q33.09,4.88,66.36,8,.58-1,1.09-2l.09-.18a36.35,36.35,0,0,0,1.81-4.24l.08-.24q.33-.94.6-1.9l.12-.41a36.26,36.26,0,0,0,.91-4.42c0-.19,0-.37.07-.56q.11-.86.18-1.73c0-.21,0-.42,0-.63,0-.75.08-1.51.08-2.28a36.5,36.5,0,0,0-73,0c0,.83,0,1.64.09,2.45C12.1,119.15,12.12,119.34,12.14,119.53Z"/><circle class="cls-2" cx="94.5" cy="57.5" r="22.5"/><path class="cls-2" d="M276,0a43,43,0,0,0,43,43A43,43,0,0,0,362,0Z"/></g></g></svg>
                                                            </div>
        
                                                            <div class="profile-body p-0">
                                                                <div class="avatar avatar-lg">
                                                                    <span class="avatar-text bg-primary add-group-img span-icon-group">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                                                    </span>
                                                                    <img style="display: none" class="avatar-img" src="" alt="" id="blah">
        
                                                                    <div class="badge badge-lg badge-circle bg-primary border-outline position-absolute bottom-0 end-0">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                                    </div>
        
                                                                    <input name="img"id="upload-chat-img"  class="d-none imgGroup " type="file">
                                                                    <label class="stretched-label mb-0" for="upload-chat-img"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <input name="img" id="upload-chat-img" class="d-none" type="file"> --}}
                                                        {{-- <label class="stretched-label mb-0" for="upload-chat-img"></label> --}}
                                                        <div class="row gy-6">
                                                            <div class="col-12">
                                                                <div class="form-floating">
                                                                    {{-- <label style="position: absolute ; top:-40px;"> {{__("Enter group name")}}</label> --}}
                                                                    <input style="placeholder {
                                                                        color: red;
                                                                   }" name='groupName' type="text" class="form-control groupName" id="floatingInput " placeholder="{{__('Enter a chat name')}}">
                                                                </div>
                                                            </div>
                                                            {{-- <br><br> --}}
                                                            <div class="col-12">
                                                                <div class="form-floating">
                                                                    {{-- <label  style="position: absolute ; top:-40px;">{{__("What is a description?")}}</label> --}}
                                                                    <textarea  name='groupDescription' class="form-control groupDescription" placeholder="{{__('Description')}}" id="floatingTextarea groupDescription" rows="8" data-autosize="true" style="min-height: 100px;"></textarea>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                            {{-- <input type="submit" /> --}}
                                                        <div class="container mt-n4 mb-8 position-relative button-create-group" style="display:none">
                                                            <button class="btn btn-lg btn-primary w-100 d-flex align-items-center" type="submit" onclick="{ }">
                                                                {{ __('create') }}
                                                                <span class="icon ms-auto">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                    <div class="container mt-n4 mb-8 position-relative ">

                                                    <button class="btn btn-lg btn-danger w-100 d-flex align-items-center if-arrayGroup" style="">{{__('no selected members yet')}}</button>
                                                </div>

                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center mt-4 px-6">
                                                <small class="text-muted me-auto">{{__('Enter chat name and add an optional photo.')}}</small>
                                            </div>

                                           
                                        </div>

                                        <!-- Members -->
                                        <div class="tab-pane fade" id="create-chat-members" role="tabpanel">
                                            <nav class="friends-create-group">
                                                <!-- users from jQuery -->
                                            </nav>
                                        </div>
                                    </div>
                                    <!-- Tabs content -->
                                </div>

                            </div>
                            
                            <!-- Button -->
                            
                            <!-- Button -->
                        </div>
                    </div>
                    <!-- all users -->
                    <div class="tab-pane fade h-100" id="tap-content-all-users" role="tabpanel">
                        <div class="d-flex flex-column h-100">
                            <div class="hide-scrollbar">

                                <div class="container py-8">

                                    <!-- Title -->
                                    <div class="mb-8">
                                        <h2 class="fw-bold m-0">{{__('Users')}}</h2>
                                    </div>

                                    <!-- Search -->
                                    <div class="mb-6">
                                        <div class="mb-5">
                                            <form  id="form-search-users" action="{{route('search.users')}}" method="POST" >
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <div class="icon icon-lg">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                                        </div>
                                                    </div>

                                                    <input id="input-search-users"scrept name="name" type="text" class="form-control form-control-lg ps-0" placeholder="{{__('Search users')}}" aria-label="Search for messages or users...">
                                                </div>

                                            </form>
                                        </div>
                                     <!-- list for all users -->
                                    <div id="all_users_in_app">
                                   
                                    </div>

                                 
                                   
                                    </div>
                                    <!-- Tabs content -->
                               
                                    <!-- Tabs content -->
                                </div>

                            </div>

                       
                        </div>
                    </div>

                    <!-- Friends -->
                    <div class="tab-pane fade h-100" id="tab-content-friends" role="tabpanel">
                        <div class="d-flex flex-column h-100">
                            <div class="hide-scrollbar">
                                <div class="container py-8">

                                    <!-- Title -->
                                    <div class="mb-8">
                                        <h2 class="fw-bold m-0">{{__('Friends')}}</h2>
                                    </div>

                                    <!-- Search -->
                                    {{-- search user --}}
                                    <div class="mb-6">
                                        {{-- {{route('search.users')}} --}}
                                        <form id = "search_friends" action="{{route('search.friends')}}" method="POST">
                                            @csrf
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <div class="icon icon-lg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                                    </div>
                                                </div>

                                                <input id= "input-search-friends"name="name" type="text" class="form-control form-control-lg ps-0" placeholder="{{__('Search friend')}}" aria-label="Search for messages or users...">
                                            </div>
                                        </form>

                                    </div>

                                    <!-- List -->
                                    <div id="friends_in_searsh" class="card-list">
                                         {{-- <form class= "say_hi"  action="api/messages" method="post">
                                            @csrf
                                            <input type= "hidden"  name="message" value="Hi">
                                            <input type= "hidden"  name="user_id" value=1>
                                            <input type= "submit"  value="Hi">
                                            </form>  --}}
                                   

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chats     show active -->
                    <div class="tab-pane fade h-100 show active  " id="tab-content-chats" role="tabpanel">
                        <div style="background-color:var(--back)" class="d-flex flex-column h-100 position-relative">
                            <div class="hide-scrollbar">

                                <div class="container py-8">
                                    <!-- Title -->
                                    <div class="mb-8">
                                        <h2 class="fw-bold m-0">{{__('Chats')}}</h2>

                                    </div>
                                    
                                    <!-- Search chats -->
                                    <!-- search conversation -->
                                    {{-- <div class="mb-6">
                                        
                                        
                                        <form id="searchhh_chats" action="{{route('search.chat')}}" method="POST">
                                            @csrf
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <div class="icon icon-lg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                                    </div>
                                                </div>
                                                <input id="aso" name="name" type="text" class="form-control form-control-lg ps-0" placeholder="{{__('Search chat')}}" aria-label="Search for messages or users...">
                                            </div>
                                        </form>
                                    </div> --}}


                                    <!-- Chats -->
                                    <div  class="card-list  security-chats" id="chat-list">
                                            <div id="card_to_append_search">
                                               

                                            </div>
                                    </div>
                                    <!-- Chats -->
                                </div>

                            </div>
                        </div>
                    </div>

                   <!-- Notifications  -->
                   <div class="tab-pane fade h-100" id="tab-content-notifications" role="tabpanel">
                    <div class="d-flex flex-column h-100">
                        <div class="hide-scrollbar">
                            <div class="container py-8">

                                <!-- Title -->
                                <div class="mb-8">
                                    <h2 class="fw-bold m-0">{{__('Notifications')}}</h2>
                                </div>

                         
                                <!-- Today -->
                                <div class="card-list">
                                    <!-- Title -->
                                    <div class="d-flex align-items-center my-4 px-6">
                                        <small class="text-muted me-auto"> </small>

                                        <a href="#" class="text-muted small">{{__('Clear all')}}</a>
                                    </div>
                                    <!-- Title -->
                                    <div id="cards-notification">
                                          
                               
                                    </div>




                              
                                </div>
                               
                          
                                <!-- Card -->
                               
                            </div>
                        </div>
                    </div>
                   </div>

                    <!-- Settings -->
                    <div class="tab-pane fade h-100" id="tab-content-settings" role="tabpanel">
                        <div class="d-flex flex-column h-100">
                            <div class="hide-scrollbar">
                                <div class="container py-8">

                                    <!-- Title -->
                                    <div class="mb-8">
                                        <h2 class="fw-bold m-0">{{__('Settings')}}</h2>
                                    </div>

                                    <!-- Search -->
                              

                                    <!-- Logout -->
                                    
                                    <div class="d-flex align-items-center my-4 px-6">
                                        <small class="text-muted me-auto">{{__('Logout')}}</small>
                                    </div>
                                    <div class="card border-0">
                                        <div class="card-body">
                                            <div class="row align-items-center gx-5">
                                                <div class="col-auto">
                                                    <div class="avatar">
                                                        <img  data-action='zoom' src="{{Auth::user()->img}}" alt="#" class="avatar-img update-profile-img">
                                                      
                                                        <div class="badge badge-circle bg-secondary border-outline position-absolute bottom-0 end-0">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                                        </div>

                                                      
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h5 class="username">{{Auth::user()->name}}</h5>
                                                    <p>{{Auth::user()->email}}</p>
                                                </div>
                                           
                                                <div class="col-auto">
                                                    <form action="{{route('logout')}}" method="post">
                                                        @csrf
                                                    {{-- <a type="submit" href="/api/logout" class="text-muted"> --}}
                                                        <div  class="icon">
                                                            {{-- <input style="display: inline" type="submit" class="text-muted" value="."> --}}
                                                            <button style="padding: 2px 10px;" type="submit" class="btn btn-primary">
                                                                {{-- <i class="fa fa-power-off"></i> --}}
                                                                <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                                              </button>
                                                        </div>
                                                    </form>
                                                        {{-- <form action=""></form> --}}

                                                        
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Security -->
                                    <div class="mt-8">
                                        <div class="d-flex align-items-center my-4 px-6">
                                            <small class="text-muted me-auto">{{__('Security')}}</small>
                                        </div>

                                        <div class="card border-0">
                                            <div class="card-body py-2">
                                                <!-- Accordion -->
                                                <div class="accordion accordion-flush" id="accordion-security">
                                                    <div class="accordion-item">
                                                        <div class="accordion-header" id="accordion-security-1">
                                                            <a href="#" class="accordion-button text-reset collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-security-body-1" aria-expanded="false" aria-controls="accordion-security-body-1">
                                                                <div>
                                                                    <h5>{{__('password')}}</h5>
                                                                    <p>{{__('Change your password')}}</p>
                                                                </div>
                                                            </a>
                                                        </div>

                                                        <div id="accordion-security-body-1" class="accordion-collapse collapse" aria-labelledby="accordion-security-1" data-parent="#accordion-security">
                                                            <div class="accordion-body">
                                                                <form id = 'change_pass' action="{{route('change_password')}}" method="POST" autocomplete="on">
                                                                    @csrf
                                                                    <div class="form-floating mb-6">
                                                                        <input  name='current_password' type="password" class="form-control  " id="profile-current-password" placeholder="{{__('Current password')}}" autocomplete="">
                                                                        <label for="profile-current-password">{{__('Current password')}}</label>
                                                                    </div>

                                                                    <div class="form-floating mb-6">
                                                                        <input name='new_password'type="password" class="form-control " id="profile-new-password" placeholder="{{__('New password')}}" autocomplete="">
                                                                        <label for="profile-new-password">{{__('New password')}}</label>
                                                                    </div>

                                                                    <div class="form-floating mb-6">
                                                                        <input name='verify_password'type="password" class="form-control" id="profile-verify-password" placeholder="{{__('Verify password')}}" autocomplete="">
                                                                        <label for="profile-verify-password">{{__('Verify password')}}</label>
                                                                        <input  class="" type="checkbox" onclick="showHidePassword()">{{__('Show password')}}
                                                                        
                                                                    </div>
                                                                    <button type="submit" class="btn btn-block btn-lg btn-primary w-100">{{__('Save')}}</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- language -->
                                    <div class="mt-8">
                                        <div class="d-flex align-items-center my-4 px-6">
                                            <small class="text-muted me-auto">{{__('language')}}</small>
                                        </div>

                                        <div class="card border-0" >
                                            <div class="card-body py-2">
                                                <!-- Accordion -->
                                                <div class="accordion accordion-flush"  >
                                                    <div class="accordion-item">
                                                        <div class="custom-select">
                                                            {{-- <a href="{{URL::current().'?local=en'}}" style="text-decoration: none;border-radius: 4px;border:solid 1px #3e444f;cursor : pointer;padding:0px 15px ;text-align: center;color:#fff;background-color: #16191c ">Engilsh</a> --}}
                                                            {{-- <a href="{{URL::current().'?local=ar'}}" style="text-decoration: none;border-radius: 4px;border:solid 1px #3e444f;cursor : pointer;padding:0px 15px ;text-align: center;color:#fff;background-color: #16191c ">العربية</a> --}}
                                                            <form action="{{URL::current()}}" method="get">
                                                                <select style="" class="lang"  name="local"  onchange="{this.form.submit()}">
                                                                    <option  value="en">{{__('language')}}</option>
                                                                    <option  value="ar">العربية</option>
                                                                    <option  value="en">Engilsh</option>
                                                                </select>
                                                            </form>
                                                        </div>   
                                                 </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <!-- Sidebar -->
         
            
            <!-- Chat -->
            <main class="main is-visible" data-dropzone-area="">
              
                <div class="container h-100" >
                    {{-- <div class="message-text " style=" background-color:  ;height:90% display: flex;flex-direction: column;justify-content: space-between;">
                        <p>${body} 
                            <span class="sended  fas fa-check" style="position:relative ;bottom:-12px;right:-10px;z-index:12;:"> 
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                width="15px" height="15px" viewBox="0 0 78.369 78.369" style="enable-background:new 0 0 78.369 78.369;"
                                xml:space="preserve"><g>
                               <path d="M78.049,19.015L29.458,67.606c-0.428,0.428-1.121,0.428-1.548,0L0.32,40.015c-0.427-0.426-0.427-1.119,0-1.547l6.704-6.704
                                   c0.428-0.427,1.121-0.427,1.548,0l20.113,20.112l41.113-41.113c0.429-0.427,1.12-0.427,1.548,0l6.703,6.704
                                   C78.477,17.894,78.477,18.586,78.049,19.015z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                           </svg>
                        </span>
                            <i class="fa fa-check" aria-hidden="true"></i>
                        </p>
                    </div> --}}
                  
                    <!-- Mobile: close -->

                        <div class="col-2 d-xl-none welcome-text" style=" left:5%; top:4%; z-index: 1; position: absolute;  z-index: 1; width:50%; width:50%;">
                            <a class="icon icon-lg text-muted" href="#" data-toggle-chat="">
                                <svg fill="var(--arrow)" width="50px" height="50px" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">    <path d="M25 42c-9.4 0-17-7.6-17-17S15.6 8 25 8s17 7.6 17 17-7.6 17-17 17zm0-32c-8.3 0-15 6.7-15 15s6.7 15 15 15 15-6.7 15-15-6.7-15-15-15z"/>    <path fill="var(--arrow)"  d="M25.3 34.7L15.6 25l9.7-9.7 1.4 1.4-8.3 8.3 8.3 8.3z"/>    <path fill="var(--arrow)"   d="M17 24h17v2H17z"/></svg>
                            </a>
                        </div>
            
                    <!-- Mobile: close -->
                    
                    <div  class="d-flex flex-column h-100 position-relative">
                      
                        <!-- Chat: Header -->
                     
                        <div class="welcome-text welcome"  style="">
                             {{__('Welcome in TT')}} 
                            
                             
                             {{-- <button onclick="cheakTokennnn()">checkToken</button> --}}

                        </div>
                        <script>
            
                            Bearer ='6|CBthXqMu51f1klz593yAt06m4wHIGpu5FeMSz5Ot';
                            function cheakTokennnn() {
                                      
                                      let Token='{{Cookie::get('apiToken')}}';
                                      var FormDataa = new FormData;
                                      FormDataa.append('token',Token);
                                      fetch('api/cheakToken',{
                                        method:'post',
                                        body:FormDataa ,
                                        headers: {'Authorization':`Bearer ${Token}`,'Content-Type':'application/json'}
                                                  
                                         }).then(res=>{
                                             return res.json()
                                           }).then(data=>{
                                             console.log(data)
                                           });
                                    }
                   
                            // function ff(){
                            //     fetch('/api/test', {
                            //     method: 'get',
                                
                            //     headers: {
                            //     'Authorization':`Bearer ${tt}`
                            //     }
                            //     }).then(response=>{
                                 
                            //        return response.json()
                                 
                            //         }).then(data=>{
                            //             alert(JSON.stringify(data))
                            //     });
                            // }
                        </script>
                           
                      <div class="app-bar-name-and-img" style="display: none;">  
                            <div class="chat-header border-bottom py-4 py-lg-7">
                                <div class="row align-items-center">

                                    <!-- Mobile: close -->
                                    <div class="col-2 d-xl-none app-bar-name-and-img" style="display: none;">
                                        <a class="icon icon-lg text-muted" href="#" data-toggle-chat="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" color="var(--arrow)" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>

                                        </a>
                                    </div>
                                    <!-- Mobile: close -->

                                    <!-- Content -->

                                    <div class="col-8 col-xl-12">
                                        <div class="row align-items-center text-center text-xl-start">
                                            <!-- Title -->
                                            <div class="col-12 col-xl-6">
                                                <div class="row align-items-center gx-5">
                                                    <div class="col-auto" style="display: flex; flex-direction: row;justify-content: space-around;margin-left: 50px; ">
                                                        <div class="avatar avatar-online d- d-xl-inline-block">
                                                            <img class="avatar-img" id='chat-img' src="" alt="">
                                                        </div>
                                                        <div class="col overflow-hidden" >
                                                            <h5 class="text-truncate" id="chat-name" style="font-size: 25px;"> </h5>
                                                            <p style="display:inline  z-index: 100000;  position: absolute;"  id="is-typing"class="text-truncate d-none">{{__('is typing')}}<span class='typing-dots'><span>.</span><span>.</span><span>.</span></span></p>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="col overflow-hidden" style="margin-top: 10px">
                                                        <h5 class="text-truncate" id="chat-name" style="font-size: 25px;"> </h5>
                                                        <p id="is-typing"class="text-truncate d-none">{{__('is typing')}}<span class='typing-dots'><span>.</span><span>.</span><span>.</span></span></p>
                                                    </div> --}}
                                                </div>
                                            </div>

                                            <!-- Toolbar -->
                                              <div class=" group-description col-xl-6 d-none d-xl-block">
                                                <div class="row align-items-center justify-content-end gx-6">
                                                    <div class="col-auto">
                                                        <a href="#" class="icon icon-lg text-muted" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-more-group" aria-controls="offcanvas-more-group">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                        </a>
                                                    </div>
    
                                                </div>
                                            </div>
                                            <!-- Toolbar -->
                                               
                                        </div>
                                         <!-- Mobile: more -->
                                    
                                    <!-- Mobile: more -->
                                    </div>
                                    <div class="group-description  col-2 d-xl-none text-end">
                                        <a class="dropdown-item" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-more-group" aria-controls="offcanvas-more-group">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>
                                  
                                    </div>

                                </div>


                            </div>
                      </div>
                        <!-- Chat: Header -->

                        <!-- Chat: Content -->

                    <div class="form-ccontainer chat-body hide-scrollbar flex-1 h-100" style="display:none;">

                        <button class="show-all-messages" style="visibility:hidden; width:100%; text-align:center;color:#4C6AAF;background-color:transparent ;    border: .5px solid var(--loder);border-radius: 20px;"   onclick="{showAllMessages()}">show all messages</button>
                            <div class="chat-body-inner" style="padding-bottom:0px; margin:110px;">
                                {{-- <div class='form-ccontainer'> --}}
                                    {{-- $("#soso").append(` <button class="" >get all messages</button> `);  --}}
                                    <div id="soso" class=" py-6 my-lg-12 " style="padding:0px " id="chat-body" >
                                       <!-- Message -->
                                  
           
                            

                                        <!-- Divider -->
                                        <div class="message-divider">
                                            {{-- <small class="text-muted">Monday, Sep 16</small> --}}
                                        </div>

                                    </div>
                            </div>
                    </div>
                        
                        <!-- Chat: Content -->
                        

                        <!-- Chat: Footer -->
                     <div class="footer-input-chat" style="display:none; " >
                        <div class="chat-footer pb-3 pb-lg-7 position-absolute bottom-0 start-0">
                            <!-- Chat: Files -->
                            <div class="dz-preview bg-dark" id="dz-preview-row" data-horizontal-scroll="">
                            </div>
                            <!-- Chat: Files -->

                            <!-- Chat: Form -->
                            <form  style="top: 20px; z-index: 200000;  ; " id="targetttt" class=" chat-form rounded-pill bg-dark" data-emoji-form="" method= "post" action="{{route('api.message.store')}}">
                               @csrf
                               <input id ="conversation-id-input-target" type="hidden" name= "conversation_id">
                               <input id ="" type="hidden" name= "type" value="text">
                                <div class="row align-items-center gx-0">

                                    <div class="col-auto d-none">
                                        <a href="#"  class="btn btn-icon btn-link text-body rounded-circle" id="dz-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                                        </a>
                                    </div>

                                    <div class="col-auto">
                                        <a href="#"onclick="selectFile()"  class="btn btn-icon btn-link text-body "id="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                                        </a>
                                       
                                    </div>
                                  
                                    <div class="col-auto">
                                       <a href="#"onclick="inputImageMessage()"   class="btn btn-icon btn-link text-body " id=""> 
                                           <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="images" class="svg-inline--fa fa-images " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M528 32H144c-26.51 0-48 21.49-48 48v256c0 26.51 21.49 48 48 48H528c26.51 0 48-21.49 48-48v-256C576 53.49 554.5 32 528 32zM223.1 96c17.68 0 32 14.33 32 32S241.7 160 223.1 160c-17.67 0-32-14.33-32-32S206.3 96 223.1 96zM494.1 311.6C491.3 316.8 485.9 320 480 320H192c-6.023 0-11.53-3.379-14.26-8.75c-2.73-5.367-2.215-11.81 1.332-16.68l70-96C252.1 194.4 256.9 192 262 192c5.111 0 9.916 2.441 12.93 6.574l22.35 30.66l62.74-94.11C362.1 130.7 367.1 128 373.3 128c5.348 0 10.34 2.672 13.31 7.125l106.7 160C496.6 300 496.9 306.3 494.1 311.6zM456 432H120c-39.7 0-72-32.3-72-72v-240C48 106.8 37.25 96 24 96S0 106.8 0 120v240C0 426.2 53.83 480 120 480h336c13.25 0 24-10.75 24-24S469.3 432 456 432z"></path></svg>                                            </a>
                                      
                                    </div>

                                    <div class="col">
                                        <div class="input-group">
                                            <input name ="body" class="input-have-message form-control px-0"onkeyup="countChar(this)"  placeholder="{{__('Type your message...')}}" rows="1" data-emoji-input="" data-autosize="true" autocomplete="off">

                                            <a href="#" class="input-group-text text-body pe-0" >
                                                <div class="holder">
                                                    <div data-role="controls" >
                                                        <button class=" ss" type="button"  style=";padding: 0px px;background-color:transparent   ; border: 0px solid #900; border-radius:20px"   onclick="{return false; }">
                                                            <span class="icon icon-lg">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                                                                        <path fill="var(--bs-body-color)" d="M36 57V23c0-7.7 6.3-14 14-14s14 6.3 14 14v34c0 7.7-6.3 14-14 14s-14-6.3-14-14zm42 0c0-1.1-.9-2-2-2s-2 .9-2 2c0 13.2-10.8 24-24 24S26 70.2 26 57c0-1.1-.9-2-2-2s-2 .9-2 2c0 14.8 11.5 26.9 26 27.9V91h-7c-1.1 0-2 .9-2 2s.9 2 2 2h18c1.1 0 2-.9 2-2s-.9-2-2-2h-7v-6.1c14.5-1 26-13.1 26-27.9z"/>
                                                                    </svg>
                                                            </span>
                                                        </button>

                                                    </div>
                                                    <div data-role="recordings"></div>
                                                </div>
                                          
                                            </a>

                                            <a href="#" class="input-group-text text-body pe-0" style="margin: 1; padding:5px" data-emoji-btn="">
                                                <span class="icon icon-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smile"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                                                </span>
                                            </a>
                                            
                                            
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-auto">
                                        <button class="btn btn-icon btn-primary rounded-circle ms-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                        </button>
                                    </div>

                                </div>
                            </form>
                
                            <style>
                                [data-role="controls"] > button[data-recording="true"] 
                                {
                                    background-color: #ff2038;
                                    background-image: -webkit-gradient(linear, left bottom, left top, from(#ff2038), to(#b30003));
                                    background-image: -o-linear-gradient(bottom, #ff2038 0%, #b30003 100%);
                                    background-image: linear-gradient(0deg, #ff2038 0%, #b30003 100%);
                                }
                            
                            </style>

                
                            <!-- Chat: Form -->
                        </div>
                     </div>
                     
                        <!-- Chat: Footer -->
                    </div>

                </div>
             
            </main>
            <!-- Chat -->

          <!-- Chat: Info -->
          {{-- <div class="tab-content h-100" role="tablist"> --}}

         <div class="group-description  offcanvas offcanvas-end offcanvas-aside" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvas-more-group">
            <div class="offcanvas-header py-4 py-lg-7 border-bottom">
                <a class="icon icon-lg text-muted" href="#" data-bs-dismiss="offcanvas">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </a>
            </div>
            <!-- Offcanvas Header -->

            <!-- Offcanvas Body -->
            <div class="offcanvas-body hide-scrollbar">
            <!-- Avatar -->
            <div class="text-center py-10">
                <div class="row gy-6">
                    <div class="col-11">
                        <div class="avatar avatar-xl mx-auto">
                            <img class="group-description-img" src="" alt="#" class="avatar-img">
                        </div>
                    </div>

                    <div class="col-11">
                        <h4 class="group-description-name">Bootstrap Community</h4>
                        <p class="group-description-description"> Bootstrap is an open source <br> toolkit for developing web with <br> HTML, CSS, and JS.</p>
                    </div>
                </div>
            </div>
            <!-- Avatar -->

            <!-- Tabs -->
            <ul class="nav nav-pills nav-justified " role="tablist">
                <li class="nav-item shadow">
                    <a class="nav-link active" data-bs-toggle="pill" href="#offcanvas-group-tab-members" role="tab" aria-controls="offcanvas-group-tab-members" aria-selected="true">
                        People
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="pill" href="#offcanvas-group-tab-media" role="tab" aria-controls="offcanvas-group-tab-media" aria-selected="true">
                        Media
                    </a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="pill" href="#offcanvas-group-tab-files" role="tab" aria-controls="offcanvas-group-tab-files" aria-selected="false">
                        <span class="avatar-text" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<strong>Add People</strong><p>Invite friends to group</p>">
                          add
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> --}}
                        </span>
                    </a>
                </li>
            </ul>
            <!-- Tabs -->

            <!-- Tabs: Content -->
            <div class="tab-content py-2" role="tablist">
                <!-- Members -->
                <div class="tab-pane fade show active" id="offcanvas-group-tab-members" role="tabpanel">
                    <ul class=" group-description-members list-group list-group-flush">
                   
                                                
                    </ul>
                </div>
                <!-- Members -->

                <!-- Media -->
                <div class="tab-pane fade" id="offcanvas-group-tab-media" role="tabpanel">
                    <div class="row row-cols-3 g-3 py-6">
                        <div class="col">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-media-preview" >
                                <img class="img-fluid rounded update-profile-img " data-action="zoom"src="{{Auth::user()->img}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Media -->

                <!-- Files -->
                <div class="tab-pane fade" id="offcanvas-group-tab-files" role="tabpanel" 
                style="height: 240px;display: flex; flex-direction: column;"
                >
                    {{-- <ul class="list-group list-group-flush "> --}}
                        {{-- <div class="tab-pane fade h-100" id="tap-content-all-users" role="tabpanel">
                            <div class="d-flex flex-column h-100">
                                <div class="hide-scrollbar"> --}}
                                    
                    <div  class=" invite-friend-group" style="height: 80%;overflow: auto;">
                    </div>
                          
                    
                    {{-- </div>
                            </div>
                        </div> --}}
                    {{-- </ul> --}}
                    <!-- Offcanvas Footer -->
                    <div class="offcanvas-footer border-top py-4 py-lg-7" style="height: 20%">
                        <button class="btn btn-lg btn-primary w-100 d-flex align-items-center" type="submit" onclick="{

                             console.log(arrayInviteToGroup) ;
                             inviteToGroup();
                             }">
                            invite
                            <span class="icon ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </span>
                        </button>
                        <script>
                            function inviteToGroup(){
                                let data = new FormData
                                data.append('conversation_id',response_conversation_id)
                                data.append('users_id',arrayInviteToGroup)
                                fetch('api/conversations/participants',{
                                    method:"post", 
                                body:data}
                                );
                            }
                        </script>
                    </div>
                </div>
                <style>
                    /* width */
                    ::-webkit-scrollbar {
                      width: 5px;
                      background-color: #24292e; 
                      background-color:   var( --bs-secondary);
                    

                    }
                    
                    /* Track */
                    ::-webkit-scrollbar-track {
                      box-shadow: inset 0 0 5px #16191C; 
                      border-radius: 10px;
                    }
                     
                    /* Handle */
                    ::-webkit-scrollbar-thumb {
                      background: #4C6AAF; 
                      border-radius: 5px;
                    }
                    
                    /* Handle on hover */
                    ::-webkit-scrollbar-thumb:hover {
                      background: #21325d; 
                    }
                </style>
                <!-- Files -->
            </div>
            <!-- Tabs: Content -->
            </div>
            <!-- Offcanvas Body -->
         </div>


        </div>

        <!-- Modal: Profile -->
         <div class="modal fade" id="modal-profile" tabindex="-1" aria-labelledby="modal-profile" aria-hidden="true" >
            <div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down" >
            <div class="modal-content"  >

                <!-- Modal body -->
                <div class="modal-body py-0"  >
                    <!-- Header -->
                    <div class="profile modal-gx-n">
                        <div class="profile-img text-primary rounded-top-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 400 140.74"><defs><style>.cls-2{fill:#fff;opacity:0.1;}</style></defs><g><g><path d="M400,125A1278.49,1278.49,0,0,1,0,125V0H400Z"/><path class="cls-2" d="M361.13,128c.07.83.15,1.65.27,2.46h0Q380.73,128,400,125V87l-1,0a38,38,0,0,0-38,38c0,.86,0,1.71.09,2.55C361.11,127.72,361.12,127.88,361.13,128Z"/><path class="cls-2" d="M12.14,119.53c.07.79.15,1.57.26,2.34v0c.13.84.28,1.66.46,2.48l.07.3c.18.8.39,1.59.62,2.37h0q33.09,4.88,66.36,8,.58-1,1.09-2l.09-.18a36.35,36.35,0,0,0,1.81-4.24l.08-.24q.33-.94.6-1.9l.12-.41a36.26,36.26,0,0,0,.91-4.42c0-.19,0-.37.07-.56q.11-.86.18-1.73c0-.21,0-.42,0-.63,0-.75.08-1.51.08-2.28a36.5,36.5,0,0,0-73,0c0,.83,0,1.64.09,2.45C12.1,119.15,12.12,119.34,12.14,119.53Z"/><circle class="cls-2" cx="94.5" cy="57.5" r="22.5"/><path class="cls-2" d="M276,0a43,43,0,0,0,43,43A43,43,0,0,0,362,0Z"/></g></g></svg>

                            <div class="position-absolute top-0 start-0 py-6 px-5">
                                <button type="button" class="btn-close btn-close-white btn-close-arrow opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>

                        <div class="profile-body">
                            <div class="avatar avatar-xl">
                                <img class="avatar-img update-profile-img"   src="{{asset(Auth::user()->img)}}" alt="#">
                                <div class="badge badge-lg badge-circle bg-primary border-outline position-absolute bottom-0 end-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                </div>
                                <label class="stretched-label mb-0" for="upload-profile-photo"></label>
                            </div>
                            
                            {{-- <input id="upload-profile-photo"  class="d-none" type="file"> --}}
                       
                            <div style="">
                                <div class="mb-1 username">{{Auth::user()->name}}</div>
                                <div class="btn btn-sm btn-icon btn-dark"   onclick="{
                                  console.log(123)
                                  pop=true;
                                    $('.popup').removeClass('d-none');
                                    $('.layout').addClass('to-edit-name');
                                    // $('.modal').addClass('to-edit-name');
                                    $('.modal').addClass('d-none');
                                 
                            }">
                            {{-- edit --}}
                                    <svg   fill="white"  height="50" viewBox="0 0 20 20" width="50" id="cds-4">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.47 2.888L4.544 13.732l-1.51 3.233 3.214-1.501L17.175 4.608a1.34 1.34 0 00.012-1.732 1.34 1.34 0 00-1.718.012zm2.397-.746a2.34 2.34 0 00-3.065 0l-.012.011L3.715 13.148l-2.75 5.887 5.866-2.739L17.904 5.293l.011-.013a2.34 2.34 0 000-3.09l-.048-.048z" fill="white"
                                         ></path>
                                         <path fill-rule="evenodd" clip-rule="evenodd" d="M16.257 6.194l-2.44-2.43.706-.708 2.44 2.43-.706.708zM6.216 16.233l-2.44-2.44.708-.707 2.44 2.44-.708.707z" fill="white"  ></path>
                                    </svg>
                                </div>
                            </div>
                           
                            {{-- <p>last seen 5 minutes ago</p> --}}

                        </div>
                    </div>
                    <!-- Header -->

                    <hr class="hr-bold modal-gx-n my-0">

                    <!-- List -->
                    <ul class="list-group list-group-flush">
       
                        <li class="list-group-item">
                            <div class="row align-items-center gx-6">
                                <div class="col">
                                    <h5>{{__('E-mail')}}</h5>
                                    <p>{{Auth::user()->email}}</p>
                                </div>

                                <div class="col-auto">
                                    <div class="btn btn-sm btn-icon btn-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row align-items-center gx-6">
                                <div class="col">
                                    <h5>{{__('Phone')}}</h5>
                                    <p>1-800-275-2273</p>
                                </div>

                                <div class="col-auto">
                                    <div class="btn btn-sm btn-icon btn-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone-call"><path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- List  -->

                    <hr class="hr-bold modal-gx-n my-0">

                    <!-- List -->
                    <ul class="list-group list-group-flush">
          
                    </ul>
                    <!-- List -->

                    <hr class="hr-bold modal-gx-n my-0">

                    <!-- List -->
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <p href="#tab-settings"  title="{{__('Settings')}}" data-bs-dismiss="modal">{{__('Settings')}}</p>
                        </li>

                        <li class="list-group-item">
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <input type="submit" value="{{__('Logout')}}"  class="text-danger"style=" background-color: transparent !important ; border:solid 0px #3e444f;">
                        </li>
                    </ul>
                    <!-- List -->
                </div>
                <!-- Modal body -->
                 

            </div>
            </div>
         </div>

        <!-- Layout -->
        
    
    
        <!-- Scripts -->
        <script>
            let tokenn = "{{csrf_token()}}"
            let userId=                {{    Auth::id();            }} ;
            let userimg=              "{{    Auth::user()->img;     }}";
            let username=             "{{    Auth::user()->name     }}";
            let stringHi=             "{{    __('Hi')               }}";
            let stringAdd=            "{{    __('Add')              }}";
            let stringHide=           "{{    __('Hide')             }}";
            let stringConfirm=        "{{    __('Confirm')          }}";
            let DeleteForAll=         "{{    __('Delete for all')   }}";  
            let noSelectedMemberYet  ="{{__('no selected members yet')}}"
            let stringPasswordChanged="{{    __('Password Changed') }}";
            let stringPasswordUpdated="{{    __('Your password has been updated successfully.')}}";
            let tele=      '{{asset("sound/tele.mp3")}}';
            let soundErorr= '{{asset("sound/error.mp3")}}';
            let soundDone=  '{{asset("sound/done.mp3")}}';
            let logo = "{{asset('img/logo.png')}}"
            let gif= "{{asset('/img/loading.gif')}}"
            var envTyping=" {{ config('app.envTyping') }}"
            console.log(envTyping)
        </script>

        <script src="{{ asset ('assets/js/template.js')}}" ></script>
        <script src="{{ asset ('assets/js/vendor.js')  }}" ></script>
        <script src="{{ asset ('assets/js/moment.js')  }}" crossorigin="anonymous"></script>
        <script src="{{ asset ('js/jquery.js')}}" ></script>
        <script src="{{ asset ('js/7.2.pusher.min.js')}}" ></script>
        <script src="{{ asset ('js/pusher.js')}}" ></script>
        <script src="{{ asset ('js/record.js')}}" ></script>
        <script src="{{ asset ('js/markjivo.recorder.js')}}" ></script>
        
        @if ( config('app.envTyping')  ==true)
       
         @vite('resources/js/app.js')    
         <script>
             console.log('Typing working')
            
             setTimeout( () => {
                
             Echo.private('chat')
             .listenForWhisper('typing', (e) => {
                 // console.log(e.conversation_id);
                 
                 // if(userId == e.user_id)
                 // {
                     if(response_conversation_id==e.conversation_id)
                     {
                      if(e.typing)
                          $('#is-typing').removeClass('d-none')
                         
                      else
                          $('#is-typing').addClass('d-none')        
                        
                      }
                 // }
                 // this.typing = e.typing;
                     
                     
             })
             }, 3000)
            
         </script>
        @endif
        
        <script src="{{ asset ('js/messenger.js')}}" ></script>

     
{{-- <script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script> --}}
    </body>

       
    </head>
    
        
</html>
