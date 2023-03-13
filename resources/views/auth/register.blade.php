{{-- @extends('layouts.app') --}}

<meta name="csrf-token" content="{{ csrf_token() }}">

<!doctype html>
<html lang="en">
<head>
<title>Sign Up</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset ('assets/css/register.css')}}" >

<body style="background-color: #1A1D21">
<section class="ftco-section">
<div class="container">
<div class="row justify-content-center">

</div>
<div class="row justify-content-center">

<div class="col-md-7 col-lg-5">

<div class="login-wrap p-4 p-md-5">
    {{-- <li class="nav-item"> --}}
    {{-- </li> --}}
<div class="icon d-flex align-items-center justify-content-center">
<span class="fa fa-user-o"></span>
</div>

<h3 class="text-center mb-4">Sign Up</h3>
<form  id= "f"method="POST" action="{{ route('register') }}">
      @csrf
        <div class="form-group">
               <input name="name" id="name"  type="text" class="form-control rounded-left" placeholder="name" required>
        </div>

        <div class="form-group d-flex">
              <input name="email"  id="email"type="text" class="form-control rounded-left" placeholder="email" required>
        </div>

        <div class="form-group d-flex">
            <input name="password" id="pass"type="password" class="form-control rounded-left" placeholder="Password" required>
        </div>

        <div class="form-group d-flex">
          <input name="password_confirmation" id="cname"type="password" class="form-control rounded-left" placeholder="Password" required>
        </div>

        <input type="checkbox" class="d-" name="" id="checkbox-deviceToken" onclick="{initFirebaseMessagingRegistration()}" required>
        <label for="vehicle1"> accept all terms and conditions</label><br>
        <input id="deviceToken" type="text" class="deviceToken d-none" name="deviceToken">


        <div class="form-group">


        <button  id="sign-up-submit" type="submit" class="d-  form-control btn btn-primary rounded submit px-3">Register</button>
              {{--
                      <div id="sign-up-hide" style="cursor:default;background-color: red; color:#fff; font-size:13px" onclick="{return;}" class="form-control btn btn-danger rounded submit px-3 d-">
                          please connect on any vpn to create account
                  <span  style="cursor:pointer;display:inline-block;background-color: #fff ; color:#000  ;border-radius: 15px;   border: 5px solid rgb(126, 123, 123) ;width:100px;text-align:center " onclick="{cheack();}">try again</span>
                  and close it after created account
                </div> --}}

    </form>


      <div class="form-group d-md-flex">
      <div class="w-50">you have account ?
      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
    </div>
    </div>
</div>
</div>
</section>

</body>
</html>


<script src="{{ asset ('js/jquery.js')}}" ></script>
<script src="{{ asset ('js/firebase.js')}}" ></script>

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
      // const messaging = firebase.messaging.isSupported() ? firebase.messaging() : null

    console.log(messaging)
      function initFirebaseMessagingRegistration() {

              messaging
              .requestPermission()
              .then(function () {
                  return messaging.getToken()
              })
              .then(function(token) {
                  console.log(token);
                // alert(token)
                $('.deviceToken').val(token)

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
{{-- <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
