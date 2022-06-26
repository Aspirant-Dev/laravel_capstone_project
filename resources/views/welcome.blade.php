<!DOCTYPE html>
<head>
    <title>Pusher Test</title>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        $(document).ready(function () {

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('bdd702fa83485adf2106', {
            cluster: 'mt1'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('form-submitted', function(data) {
            $('#try').html(data.text);
            $('#pe').html(data.text1);
            $('#pr').html(data.text2);
            $('#fd').html(data.text3);
            $('#de').html(data.text4);
            $('#ca').html(data.text5);
            });
        });

    </script>
  </head>
  <body>
    {{-- <h1>Pusher Test</h1> --}}
    @guest
    <p>
        Try publishing an event to channel <code>my-channel</code>
        with event name <code>my-event</code>.

      </p>
    @else
    <h1>{{ Auth::user()->username }} Order Count:</h1>
    <p>Total Order: <span id="try">{{ $count }}</span></p>
    <p>Pending: <span id="pe">{{ $pe }}</span></p>
    <p>Processing: <span id="pr">{{ $pr }}</span></p>
    <p>For Delivery: <span id="fd">{{ $fd }}</span></p>
    <p>Delivered: <span id="de">{{ $de }}</span></p>
    <p>Cancelled: <span id="ca">{{ $ca }}</span></p>
    @endguest
    {{-- <p id="try"></p> --}}
  </body>
</html>
