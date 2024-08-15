<form class="m-t" action="{{route('register')}}" method="post">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control" placeholder="UserName" name="username">
        @if($errors->has('username'))
                <p class="error-message">* {{$errors->first('username')}}</p>
        @endif
    </div>
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Email" name="email">
        @if($errors->has('email'))
                <p class="error-message">* {{$errors->first('email')}}</p>
        @endif
    </div>
    <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password">
        @if($errors->has('password'))
                <p class="error-message">* {{$errors->first('password')}}</p>
        @endif
    </div>
    <div class="form-group">
            <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
    </div>
    <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

    <p class="text-muted text-center"><small>Already have an account?</small></p>
    <a class="btn btn-sm btn-white btn-block" href="{{route('auth.login')}}">Login</a>
</form>