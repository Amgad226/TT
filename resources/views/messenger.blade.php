
<!DOCTYPE html>
<html lang="en">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Head -->
   
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>TT</title>
        <link rel="shortcut icon" href="{{asset('img/logo.png')}}" type="image/x-icon">
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="./assets/img/favicon/favicon.ico" type="image/x-icon">

        <!-- Font -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
    	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <!-- Template CSS -->
        {{-- <link rel="stylesheet" href="{{asset('assets/css/template.bundle.css')}}"> --}}
        <link rel="stylesheet" href="{{asset('assets/css/template.dark.bundle.css')}}" >
    </head>

    
    {{-- $(this).attr('chat-id') --}}
    
    <body>
   




        <div class="" id="Loader" style="  top: 40%;  right: 35%;  z-index: 100000;  position: absolute;">
            <div class="loader"></div>
        </div>
<style>.loader {
    /* border: 16px solid #5f5b5b;  */
    border: 5px solid var(--loder); 
     /* border-top: 20px solid #adadad; */
    border-top: 40px solid #3498db; 
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin .5s linear infinite;
  }
  .loader {
    border: 5px solid var(--loder); 
    border-top: 60px solid #4965A6; 
    border-bottom: 20px solid var(--loder); 
    border-left: 10px solid transparent ; 
    border-right: 30px solid transparent ; 
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin .5s linear infinite;
  }
  
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }</style>




    
        <!-- Notification -->
        <div class="toast" style="  top: 10%;  background-color: var(  --bs-gray-dark);right: 0%;  z-index: 100000;  position: absolute;animation-name: example;animation-duration: 3s;">
            <div class="goToChat"  onclick="{open_chat($(this).attr('chat-id'));}"  chat-id=12  style=" max-height:85px;  max-width:240px;min-width:240px;min-height:85  ;overflow: hidden;  ">
                <div class="toast-body " style="  ;border: 3px rgb(32, 3, 138) solid;" >
                    <div  style="  font-size: 24px; "><i class="headarToast"><p>Toast</p></i></div>
                    <div class="bodyToast" style=" font-size: 12px;max-height:8px;  max-width:240px;">toast  dunread-message-countsd asda s asdasdas</div>
                </div>
            </div>
        </div>
        <!-- Notification -->

        
        <!-- Layout -->
        <div class="layout overflow-hidden">
            {{-- <img src="http://127.0.0.1:8000/img/group/(633d9613f1610)first%20group.jpg" alt="#" class="avatar-img"> --}}

            <!-- Navigation -->
            <nav class=" navigation d-flex flex-column text-center navbar navbar-light hide-scrollbar">
                <!-- logo -->
                
                 <a href="#" title="TT" class="d-none d-xl-block mb-6  welcome-text to-return-home" onclick="{ 
                     $(`#soso`).empty();
                  
                    $(`.toast`).toast({ delay: 6000 });$('.toast').toast('show'); 
                     play();
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
                    <li class="nav-item d-none d-xl-block invisible " >{{-- flex-xl-grow-1 --}}
                        <a class="nav-link " href="#" title="">
                            <div class="icon icon-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"class="feather feather-x"> <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </div>
                        </a>
                    </li>

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
                                    <img class="avatar-img" src="{{asset(Auth::user()->img)}}" alt="">
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
                                                                    <img style="display: none" class="avatar-img" src="{{Auth::user()->img}}" alt="" id="blah">
        
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

                                                    <button class="btn btn-lg btn-danger w-100 d-flex align-items-center if-arrayGroup" style="">{{__('no member yet')}}</button>
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
                                        <h2 class="fw-bold m-0">Users</h2>
                                    </div>

                                    <!-- Search -->
                                    <div class="mb-6">
                                        <div class="mb-5">
                                            <form  action="#" >
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <div class="icon icon-lg">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                                        </div>
                                                    </div>

                                                    <input scrept name="name" type="text" class="form-control form-control-lg ps-0" placeholder="{{__('Search users')}}" aria-label="Search for messages or users...">
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
                                        <form id = "search_users" action="{{route('search.users')}}" method="POST">
                                            @csrf
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <div class="icon icon-lg">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                                    </div>
                                                </div>

                                                <input name="name" type="text" class="form-control form-control-lg ps-0" placeholder="{{__('Search friend')}}" aria-label="Search for messages or users...">
                                            </div>
                                        </form>

                                    </div>

                                    <!-- List -->
                                    <div id="users_in_searsh" class="card-list">
                                         <form class= "say_hi"  action="http://127.0.0.1:8000/api/messages" method="post">
                                            @csrf
                                            <input type= "hidden"  name="message" value="Hi">
                                            <input type= "hidden"  name="user_id" value=1>
                                            <input type= "submit"  value="Hi">
                                            </form> 
                                   

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chats -->
                    <div class="tab-pane fade h-100 show active" id="tab-content-chats" role="tabpanel">
                        <div style="background-color:var(--back)" class="d-flex flex-column h-100 position-relative">
                            <div class="hide-scrollbar">

                                <div class="container py-8">
                                    <!-- Title -->
                                    <div class="mb-8">
                                        <h2 class="fw-bold m-0">{{__('Chats')}}</h2>

                                    </div>
                                    
                                    <!-- Search -->
                                    <div class="mb-6">
                                        
                                        
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
                                    </div>

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
                                                        <img src="{{Auth::user()->img}}" alt="#" class="avatar-img">

                                                        <div class="badge badge-circle bg-secondary border-outline position-absolute bottom-0 end-0">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                                        </div>
                                                        {{-- <input id="upload-profile-photo" class="d-none" type="file"> --}}
                                                        {{-- <label class="stretched-label mb-0" for="upload-profile-photo"></label> --}}
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h5>{{Auth::user()->name}}</h5>
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
                                                                        <input  name='old_pass' type="password" class="form-control  " id="profile-current-password" placeholder="{{__('Current password')}}" autocomplete="">
                                                                        <label for="profile-current-password">{{__('Current password')}}</label>
                                                                    </div>

                                                                    <div class="form-floating mb-6">
                                                                        <input name='new_pass'type="password" class="form-control " id="profile-new-password" placeholder="{{__('New password')}}" autocomplete="">
                                                                        <label for="profile-new-password">{{__('New password')}}</label>
                                                                    </div>

                                                                    <div class="form-floating mb-6">
                                                                        <input name='c_pass'type="password" class="form-control" id="profile-verify-password" placeholder="{{__('Verify password')}}" autocomplete="">
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
        

               {{--                 
                 <div class="message">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-user-profile" class="avatar avatar-responsive">
                        <img class="avatar-img" src="{{Auth::user()->img}}" alt="">
                    </a>

                    <div class="message-inner">
                        <div class="message-body">
                            <div class="message-content">
                                <div class="message-text">
                                    <p>Hey, Marshall! How are you? Can you please change the color theme of the website to pink and purple?</p>
                                </div>

                        
                            </div>

                        </div>

                        <div class="message-footer">
                            <span class="extra-small text-muted">08:45 PM</span>
                        </div>
                    </div>
                </div> --}}



                <div class="container h-100" >
                    
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
                        </div>
                           
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
                                                    <div class="col-auto">
                                                        <div class="avatar avatar-online d-none d-xl-inline-block">
                                                            <img class="avatar-img" id='chat-img' src="" alt="">
                                                        </div>
                                                    </div>

                                                    <div class="col overflow-hidden" style="margin-top: 10px">
                                                        <h5 class="text-truncate" id="chat-name" style="font-size: 25px;"> </h5>
                                                        <p id="is-typing"class="text-truncate d-none">{{__('is typing')}}<span class='typing-dots'><span>.</span><span>.</span><span>.</span></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                

                                </div>


                            </div>
                      </div>
                        <!-- Chat: Header -->

                        <!-- Chat: Content -->
                        {{--  --}}
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
                            <form  style="top: 20px;" id="targetttt" class="chat-form rounded-pill bg-dark" data-emoji-form="" method= "post" action="{{route('api.message.store')}}">
                               @csrf
                         {{-- {{  request()->get('id')}} --}}
                         {{-- {{Request::id}} --}}
                                   
                               <input id ="conversation-id-input-target" type="hidden" name= "conversation_id">
                               {{--  value="{{$activeChat->id}}" --}}

                                <div class="row align-items-center gx-0">
                                    <div class="col-auto">
                                        
                                        <a href="#" class="btn btn-icon btn-link text-body rounded-circle" id="dz-btn">
                                            
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                                        </a>
                                    </div>
                                    

                                    <div class="col">
                                        <div class="input-group">
                                            <input name ="message" class="input-have-message form-control px-0"  placeholder="{{__('Type your message...')}}" rows="1" data-emoji-input="" data-autosize="true">
                                            {{-- <input  name= "message" value=> --}}

                                            <a href="#" class="input-group-text text-body pe-0" >

                                            <div class="holder">
                                                <div data-role="controls" >
                                                    <button  type="button"  style=";padding: 0px px;background-color:inherit  ; border: 0px solid #900; border-radius:20px"   onclick="{return false; this.css('background-color','red');}">
                                                        <span class="icon icon-lg">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                                                                    <path fill="var(--arrow)" d="M36 57V23c0-7.7 6.3-14 14-14s14 6.3 14 14v34c0 7.7-6.3 14-14 14s-14-6.3-14-14zm42 0c0-1.1-.9-2-2-2s-2 .9-2 2c0 13.2-10.8 24-24 24S26 70.2 26 57c0-1.1-.9-2-2-2s-2 .9-2 2c0 14.8 11.5 26.9 26 27.9V91h-7c-1.1 0-2 .9-2 2s.9 2 2 2h18c1.1 0 2-.9 2-2s-.9-2-2-2h-7v-6.1c14.5-1 26-13.1 26-27.9z"/>
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
            [data-role="controls"] > button[data-recording="true"] {
                background-color: #ff2038;
                background-image: -webkit-gradient(linear, left bottom, left top, from(#ff2038), to(#b30003));
                background-image: -o-linear-gradient(bottom, #ff2038 0%, #b30003 100%);
                background-image: linear-gradient(0deg, #ff2038 0%, #b30003 100%);
            }
           
                </style>
                   {{-- <div class="holder" style="z-index: 111; position: absolute;left:87%;bottom:25%">
                    <div data-role="controls" >
                        <button style="background-color:inherit  ; border: 0px solid #900; border-radius:20px"   onclick="{return false; this.css('background-color','red');}">
                            <span class="icon icon-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                                        <path fill="var(--arrow)" d="M36 57V23c0-7.7 6.3-14 14-14s14 6.3 14 14v34c0 7.7-6.3 14-14 14s-14-6.3-14-14zm42 0c0-1.1-.9-2-2-2s-2 .9-2 2c0 13.2-10.8 24-24 24S26 70.2 26 57c0-1.1-.9-2-2-2s-2 .9-2 2c0 14.8 11.5 26.9 26 27.9V91h-7c-1.1 0-2 .9-2 2s.9 2 2 2h18c1.1 0 2-.9 2-2s-.9-2-2-2h-7v-6.1c14.5-1 26-13.1 26-27.9z"/>
                                    </svg>
                            </span>
                        </button>
                        
                    </div>
                    <div data-role="recordings"></div>
                </div> --}}
                            <!-- Chat: Form -->
                        </div>
                     </div>
                     
                        <!-- Chat: Footer -->
                    </div>

                </div>
             
            </main>
            <!-- Chat -->


        </div>
        
        <!-- Modal: Profile -->
         <div class="modal fade" id="modal-profile" tabindex="-1" aria-labelledby="modal-profile" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down">
            <div class="modal-content">

                <!-- Modal body -->
                <div class="modal-body py-0">
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
                                <img class="avatar-img" src="{{asset(Auth::user()->img)}}" alt="#">
                            </div>

                            <h4 class="mb-1">{{Auth::user()->name}}</h4>
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
                            <a href="#tab-settings" class="text-reset" data-theme-toggle="tab" title="{{__('Settings')}}" data-bs-dismiss="modal">{{__('Settings')}}</a>
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
         
            let userId=                {{    Auth::id();            }} ;
            let userimg=              "{{    Auth::user()->img;     }}";
            let username=             "{{    Auth::user()->name     }}";
            let stringHi=             "{{    __('Hi')               }}";
            let stringAdd=            "{{    __('Add')              }}";
            let stringHide=           "{{    __('Hide')             }}";
            let stringConfirm=        "{{    __('Confirm')          }}";
            let stringPasswordChanged="{{    __('Password Changed') }}";
            let stringPasswordUpdated="{{    __('Your password has been updated successfully.')}}";
    
            function play() {
                var audio = new Audio('{{asset("sound/1.wav")}}');
                  audio.play();
            }
    
        </script>
    
        <script src="{{ asset ('assets/js/template.js')}}" ></script>
        <script src="{{ asset ('assets/js/vendor.js')  }}" ></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
        <script src="{{ asset ('js/messenger.js')}}" ></script>
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        <script src="{{ asset ('assets/js/ss.js')  }}" crossorigin="anonymous"></script>
        <script src="{{ asset ('assets/js/moment.js')  }}" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script src="{{ asset ('js/pusher.js')}}" ></script>
        <script src="{{ asset ('js/record.js')}}" ></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery.min.js"></script>
        <script src="https://markjivko.com/dist/recorder.js"></script>
        @vite('resources/js/app.js')    



    </body>

       
    </head>
    
        
</html>
