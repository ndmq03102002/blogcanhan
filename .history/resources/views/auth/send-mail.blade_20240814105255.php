<!-- resources/views/emails/otp.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Mã OTP</title>
</head>
<body>
    <h1>Hi {{$user -> name}}</h1>
    <p>
        <a href="{{route('verify', ['otp' => $user -> otp])}}">Click here</a> to verify your account.
    </p>
</body>
</html>
