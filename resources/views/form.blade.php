<!DOCTYPE html>
<head>
    <title>Pusher Test</title>

  </head>
  <body>
    <h1>FORM</h1>
    <form action="{{ route('form') }}" method="post">
        @csrf
        <input type="text" name="text" >
        <button type="submit">Submit</button>
    </form>
  </body>
</html>
