


<!doctype html>
<html lang="en">
<head>
<title>sign up </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
@if ( config('app.online')  ==true)
<link rel="stylesheet"    href="{{secure_asset('assets/css/loging.css')}}">
<link rel="shortcut icon" href="{{secure_asset('img/logo.png')}}" type="image/x-icon">
@endif

@if ( config('app.online')  ==false)
<link rel="stylesheet"    href="{{asset('assets/css/loging.css')}}">
<link rel="shortcut icon" href="{{asset('img/logo.png')}}" type="image/x-icon">
@endif


  <div class="check-loader lds-ripple"style="display:none;position:absolute;width:300px;height:200px;z-index:15;top:60%;left:56%;margin:-100px 0 0 -150px;"><div></div><div></div>  </div>

  <style>
      .lds-ripple {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
      }
      .lds-ripple div {
        position: absolute;
        border: 4px solid rgb(139, 2, 142);
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
  

<div class="container">
  <div class="wrapper">

    <div class=" o">
      <i class="fas fa-user "></i>
    </div>

    <div class="title"><div class="oo">sign up </div></div>
    
    <form  id= "f"method="POST" action="{{ route('register1') }}">
      @csrf    
    
        
          <div class="row">
            {{-- <i class="fas fa-lock"></i> --}}
          <input name="name" id="name"  type="text" class="form-control rounded-left" placeholder="name" required>
          </div>
        
          <div class="row">
            {{-- <i class="fas fa-lock"></i> --}}
            <input name="email" type="text" placeholder="Email " required>

          </div>

          <div class="row">
            {{-- <i class="fas fa-user"></i> --}}
            <input name="password" type="password" placeholder="Password" required>

          </div>

          <div class="row">
            {{-- <i class="fas fa-lock"></i> --}}
            <input name="password_confirmation" id="cname"type="password" class="form-control rounded-left" placeholder="Password" required>

          </div>
          <div id="checkbox-deviceToken" style="display:none">
            <label id="note" style="display: none; color:red;" >   قم بتشغيل بروكسي على جهازك قبل الموافقة على الشروط ليتم تفعيل الاشعارات في التطبيق وبعد التسجيل قم ب اغلاقه</label>
              <input  type="checkbox"  name="" onclick="{initFirebaseMessagingRegistration()}" required>
              <label > accept all terms and conditions</label>
              <div class="row"style=" display:none " id="deviceToken">
                <input   type="text" class="deviceToken " name="deviceToken">
              </div>
         </div>

          <div class=" button row" id="sign-up-submit" style="display:none;">

            <input style="" type="submit" value="Register">
          </div>


          <div class="row" id="sign-up-hide" style="display:none;">
             <div style=" ;cursor:default;background-color: red; color:#fff; font-size:13px" onclick="{return;}" class="form-control btn btn-danger rounded submit px-3 d-none">please connect on any vpn to create account 
             <span  style="cursor:pointer;display:inline-block;background-color: #fff ; color:#000  ;border-radius: 15px;   border: 5px solid rgb(126, 123, 123) ;width:100px;text-align:center " onclick="{cheack();}">try again</span>
             and close it after created account
             </div>
          </div>
         

          {{-- <div class="signup-link">you have account ? <a  href="{{ route('login') }}">{{ __('Login') }}</a></div> --}}
          <div class="signup-link">you have account !! 
            <div>
              <a  href="{{ route('login') }}">{{ __('Login') }}</a>
            </div>
          </div>
          <br>

    </form>
  </div>
</div>

</form>



<script src="{{ secure_asset ('js/jquery.js')}}" ></script>

<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>

  var firebaseConfig = {
  apiKey: "AIzaSyCe0NvBofKhiRr4UiwkW7FRL52KbtRCk0k",
  authDomain: "tt-project-dbf57.firebaseapp.com",
  projectId: "tt-project-dbf57",
  storageBucket: "tt-project-dbf57.appspot.com",
  messagingSenderId: "350664799609",
  appId: "1:350664799609:web:432b6095e6c11370c6eba8",
  measurementId: "G-D6JWRECXPD"
  };

  firebase.initializeApp(firebaseConfig);
  const messaging = firebase.messaging();

  function initFirebaseMessagingRegistration() {
          messaging
          .requestPermission()
          .then(function () {
              return messaging.getToken()
          })
          .then(function(token) {
              console.log(token);
            // alert(token)
            $('.deviceToken').empty();
            $('.deviceToken').val(token);
     

          }).catch(function (err) {
              console.log('User Chat Token Error'+ err);
          });
   }

  messaging.onMessage(function(payload) {
      const noteTitle = payload.notification.title;
      const noteOptions = {
          body: payload.notification.body,
          icon: payload.notification.icon,
      };
      new Notification(noteTitle, noteOptions);
  });

</script>


<script>


  var data="Syri"
  function cheack(){
    // alert(2)
   $('.check-loader').css('display','block');

    // if(data=="Syria"){
    //          alert(data)
    //         //  alert(1)
            
    //          $('#sign-up-submit').css('display','none');
    //          $('#sign-up-hide').css('display','block');
      


    //        }
    //        else{
    //         // alert(2)
           
    //         $('#sign-up-submit').css('display','block');
    //          $('#sign-up-hide').css('display','none');
    //         // $('#sign-up-submit').css('background-color','black');
            
    //         }

    //         setTimeout(() => {
               
    //            $('.check-loader').css('display','none');
    //          }, 500);
 
    $('.check-loader').css('display','block');

  //   fetch('https://api.incolumitas.com/')
  // .then(res => res.json())
  // .then(res => alert(res.location.country));

  fetch('https://api.incolumitas.com/')
 .then(res =>{if (res.status>=200 && res.status <300) return res.json()})
 .then(res=>{
           console.log(res.location.country)
           if(res.location.country=="sy"){
             // alert(data.country)
             $('#sign-up-submit').css('display','none');
             $('#checkbox-deviceToken').css('display','none');
             
             $('#sign-up-hide').css('display','block');
             setTimeout(() => {
               
               $('.check-loader').css('display','none');
             }, 500);


           }
           else{
             $('#s').addClass('d-none');
            //  $('#sign-up-submit').removeClass('d-none');
            $('#checkbox-deviceToken').css('display','block');
             $('#sign-up-submit').css('display','block');
             $('#sign-up-hide').css('display','none');

            //  $('#checkbox-deviceToken').removeClass('d-none');
             
             $('#sign-up-hide').addClass('d-none');
             setTimeout(() => {
               
              $('.check-loader').css('display','none');
             }, 500);


           }
       
         })
 .catch((error) => {
  $('.check-loader').css('display','none');

  //  alert('internet very slow'+error)
            $('#note').css('display','block');
             $('#checkbox-deviceToken').css('display','block');
             $('#sign-up-submit').css('display','block');
             $('#sign-up-hide').css('display','none');

            alert('check ip not work please open vpn to recive notification')
            $('.check-loader').css('display','none');
 });

}


         cheack();
</script>

</body>
</html>





