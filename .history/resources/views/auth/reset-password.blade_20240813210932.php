<!-- resources/views/auth/reset-password.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Đặt Lại Mật Khẩu</title>
</head>
<body>
    <h1>Đặt Lại Mật Khẩu</h1>
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        @error('email')
            <div>{{ $message }}</div>
        @enderror
        <label for="otp">Mã OTP:</label>
        <input type="text" id="otp" name="otp" required>
        @error('otp')
            <div>{{ $message }}</div>
        @enderror
        <label for="password">Mật Khẩu Mới:</label>
        <input type="password" id="password" name="password" required>
        @error('password')
            <div>{{ $message }}</div>
        @enderror
        <label for="password_confirmation">Nhập Lại Mật Khẩu:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        <button type="submit">Đặt Lại Mật Khẩu</button>
    </form>
</body>
</html>
