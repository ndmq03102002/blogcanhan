<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSPINIA | Update Profile</title>
    <link href="template/css/bootstrap.min.css" rel="stylesheet">
    <link href="template/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="template/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="template/css/animate.css" rel="stylesheet">
    <link href="template/css/style.css" rel="stylesheet">
    <link href="template/css/customize.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Chiếm toàn bộ chiều cao của viewport */
        }

        .form-container {
            width: 66%; /* Chiếm 2/3 chiều rộng màn hình */
            max-width: 800px; /* Đặt chiều rộng tối đa để đảm bảo không quá rộng trên màn hình lớn */
            margin: 0 auto; /* Căn giữa theo chiều ngang */
        }

        .form-group {
            margin-bottom: 1rem; /* Thêm khoảng cách dưới mỗi nhóm form */
        }

        .form-group label {
            display: block;
            margin-bottom: .5rem;
            font-weight: bold; /* Làm nhãn nổi bật hơn */
        }

        .form-control {
            width: 100%; /* Đảm bảo các ô input chiếm toàn bộ chiều rộng của form */
            box-sizing: border-box; /* Bao gồm padding và border trong tổng chiều rộng */
        }

        .error-message {
            color: red;
            margin-top: .5rem;
        }
    </style>
</head>

<body class="gray-bg">
    <div class="container">
        <div class="form-container">
            <div class="middle-box text-center loginscreen animated fadeInDown">
                <div>
                    <div>
                        <h1 class="logo-name">IN+</h1>
                    </div>
                    <h3>Update Your Profile</h3>
                    <p>Update your profile information.</p>
                    <form class="m-t" role="form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input 
                                type="text" 
                                id="name" 
                                class="form-control" 
                                placeholder="Name" 
                                name="name" 
                                value="{{ old('name', $profile->name ?? '') }}">
                            @if($errors->has('name'))
                                <p class="error-message">* {{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="dateofbirth">Date of Birth</label>
                            <input 
                                type="date" 
                                id="dateofbirth" 
                                class="form-control" 
                                placeholder="Date of Birth" 
                                name="dateofbirth" 
                                value="{{ old('dateofbirth', $profile->dateofbirth ?? '') }}">
                            @if($errors->has('dateofbirth'))
                                <p class="error-message">* {{ $errors->first('dateofbirth') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="sex">Gender</label>
                            <select name="sex" id="sex" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('sex', $profile->sex ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('sex', $profile->sex ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('sex', $profile->sex ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @if($errors->has('sex'))
                                <p class="error-message">* {{ $errors->first('sex') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input 
                                type="text" 
                                id="address" 
                                class="form-control" 
                                placeholder="Address" 
                                name="address" 
                                value="{{ old('address', $profile->address ?? '') }}">
                            @if($errors->has('address'))
                                <p class="error-message">* {{ $errors->first('address') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <input type="file" id="avatar" class="form-control" name="avatar">
                            @if($profile && $profile->avatar)
                                <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" style="width: 100px; height: 100px; margin-top: 10px;">
                            @endif
                            @if($errors->has('avatar'))
                                <p class="error-message">* {{ $errors->first('avatar') }}</p>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Save Changes</button>
                        <p class="text-muted text-center"><small>Want to go back?</small></p>
                        <a class="btn btn-sm btn-white btn-block" href="{{ route('blog.home') }}">Home</a>
                    </form>
                    <p class="m-t"> <small>Inspinia web app framework based on Bootstrap 3 &copy; 2014</small> </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

</html>
