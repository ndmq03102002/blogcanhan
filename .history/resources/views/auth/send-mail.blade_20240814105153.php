<!-- resources/views/emails/otp.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Mã OTP</title>
</head>
<body>
    <h1>Hi {{$user -> name}}</h1>
    <p>Mã OTP của bạn là: {{ $otp }}</p>
</body>
</html>
