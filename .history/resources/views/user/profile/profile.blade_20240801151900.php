<form action="{{ route('profile.update') }}" method="POST" class="box" enctype="multipart/form-data">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>Nhập thông tin cá nhân của bạn</p>
                        <p>Lưu ý: Những trường đánh dấu <span class="text-danger">(*)</span> là bắt buộc</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="name" class="control-label text-left">Tên <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="name"
                                        id="name"
                                        value="{{ old('name', $profile->name ?? '') }}"
                                        class="form-control"
                                        placeholder="Nhập tên"
                                        autocomplete="off"
                                    >
                                    @if($errors->has('name'))
                                        <p class="error-message">* {{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="dateofbirth" class="control-label text-left">Ngày sinh <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="date"
                                        name="dateofbirth"
                                        id="dateofbirth"
                                        value="{{ old('dateofbirth', $profile->dateofbirth ?? '') }}"
                                        class="form-control"
                                        placeholder="Chọn ngày sinh"
                                        autocomplete="off"
                                    >
                                    @if($errors->has('dateofbirth'))
                                        <p class="error-message">* {{ $errors->first('dateofbirth') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="sex" class="control-label text-left">Giới tính <span class="text-danger">(*)</span></label>
                                    <select name="sex" id="sex" class="form-control setupSelect2" required>
                                        <option value="">Chọn giới tính</option>
                                        <option value="male" {{ old('sex', $profile->sex ?? '') == 'male' ? 'selected' : '' }}>Nam</option>
                                        <option value="female" {{ old('sex', $profile->sex ?? '') == 'female' ? 'selected' : '' }}>Nữ</option>
                                        <option value="other" {{ old('sex', $profile->sex ?? '') == 'other' ? 'selected' : '' }}>Khác</option>
                                    </select>
                                    @if($errors->has('sex'))
                                        <p class="error-message">* {{ $errors->first('sex') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="address" class="control-label text-left">Địa chỉ <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="address"
                                        id="address"
                                        value="{{ old('address', $profile->address ?? '') }}"
                                        class="form-control"
                                        placeholder="Nhập địa chỉ"
                                        autocomplete="off"
                                    >
                                    @if($errors->has('address'))
                                        <p class="error-message">* {{ $errors->first('address') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="avatar" class="control-label text-left">Avatar</label>
                                    <input 
                                        type="file"
                                        name="avatar"
                                        id="avatar"
                                        class="form-control"
                                    >
                                    @if ($profile && $profile->avatar)
                                        <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" style="width: 100px; height: 100px; margin-top: 10px;">
                                    @endif
                                    @if($errors->has('avatar'))
                                        <p class="error-message">* {{ $errors->first('avatar') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>
