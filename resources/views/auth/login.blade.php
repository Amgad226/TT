<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <title>sign in</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if ( config('app.online')  ==true)
    <link rel="stylesheet"    href="{{secure_asset('assets/css/loging.css')}}">
    <link rel="shortcut icon" href="{{secure_asset('img/logo.png')}}" type="image/x-icon">
    @endif

    @if ( config('app.online')  ==false)
    <link rel="stylesheet"    href="{{asset('assets/css/loging.css')}}">
    <link rel="shortcut icon" href="{{asset('img/logo.png')}}" type="image/x-icon">
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <style>
 
  </style>
  <body>
    <div class="container">
    
      <div class="wrapper">
        <div class=" o">
            <i class="fas fa-user "></i>
          </div>
          <div class="title"><div class="oo">sign in </div></div>
        <form method="POST" action="{{ route('login') }}">  
          @csrf    

          <div class="row">
            {{-- <i class="fas fa-user"></i> --}}
            <input name="email" type="text" placeholder="Email " required>
          </div>
          <div class="row">
            {{-- <i class="fas fa-lock"></i> --}}
            <input name="password" type="password" placeholder="Password" required>
          </div>
          
          <div class="row button">
            <input type="submit" value="Login">
          </div>
          <div class="signup-link">Dont have account !? 
            <div>
              <a  href="{{ route('register') }}">{{ __('Register') }}</a>
            </div>
          </div>
          <br>
        </form>
      </div>
    </div>

  </body>
</html>
