@include('dashboard.component.breadcrumb', ['title' => $config['seo']['delete']['title']])

<form action="{{ route('post.destroy', $post->id) }}" method="post" class="box">
    @csrf
    @method('DELETE')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>Bạn đang muốn xóa bài viết có tên là là: {{ $post->name }}</p>
                        <p>Lưu ý: Không thể khôi phục thành viên sau khi xóa. Hãy chắc chắn bạn muốn thực hiện chức năng này</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-12" >
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Title <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="title"
                                        value="{{ old('title', ($post->title) ?? '' ) }}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                        readonly
                                    >
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Avatar<span class="text-danger">(*)</span></label>
                                    <img src="{{asset($post->image)}}" alt="#" class="img-responsive" style="width: 100px; height: 100px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="text-right mb15">
            <button class="btn btn-danger" type="submit" name="send" value="send">Xóa dữ liệu</button>
        </div>
    </div>
</form>
