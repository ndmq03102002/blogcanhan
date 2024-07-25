@include('dashboard.component.breadcrumb', ['title' => config('apps.user.title')])
<div class="row mt20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{config('apps.user.tableHeadling')}}</h5>
                @include('user.component.toolbox')
            </div>
            <div class="ibox-content">
                @include('user.component.filter')
                @include('user.component.table')
            </div>
        </div>
    </div>
</div>


