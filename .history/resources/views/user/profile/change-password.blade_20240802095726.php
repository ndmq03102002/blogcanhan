<form action="{{ route('profile.change-password') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="current_password">Mật khẩu hiện tại</label>
        <input type="password" id="current_password" name="current_password" class="form-control" required>
        @error('current_password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="new_password">Mật khẩu mới</label>
        <input type="password" id="new_password" name="new_password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
        @error('new_password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
</form>
