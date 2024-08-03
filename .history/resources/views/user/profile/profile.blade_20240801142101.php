<div class="container">
    <h1>Update Profile</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $profile->name ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="dateofbirth">Date of Birth</label>
            <input type="date" name="dateofbirth" id="dateofbirth" class="form-control" value="{{ old('dateofbirth', $profile->dateofbirth ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="sex">Sex</label>
            <select name="sex" id="sex" class="form-control" required>
                <option value="male" {{ (old('sex', $profile->sex ?? '') == 'male') ? 'selected' : '' }}>Male</option>
                <option value="female" {{ (old('sex', $profile->sex ?? '') == 'female') ? 'selected' : '' }}>Female</option>
                <option value="other" {{ (old('sex', $profile->sex ?? '') == 'other') ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $profile->address ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="avatar">Avatar</label>
            <input type="file" name="avatar" id="avatar" class="form-control">
            @if ($profile && $profile->avatar)
                <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" style="width: 100px; height: 100px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>