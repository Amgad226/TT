<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script src="{{asset("js/app.js")}}"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('337a574efe26825afd27', {
      authEndpoint:'http://127.0.0.1:8000/broadcasting/auth',       
      cluster: 'ap2'

    });

    var channel = pusher.subscribe('presence-Messnger.1');
    channel.bind('App\Events\MessageCreated', function(data) {
      alert(JSON.stringify(data));
    });
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>presence-Messnger.${user_id}</code>
    with event name <code>my-event</code>.
  </p>
</body>