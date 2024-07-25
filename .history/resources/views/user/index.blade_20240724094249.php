<div class="row wapper borde-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{config('apps.user.title')}}</h2>
        <ol class="breadcrumb" style="margin-bottom: 10px;">
            <li>
                <a href="{{route('auth.dashboard')}}">Dashboard</a>
            </li>
            <li class="active"><strong>{{config('apps.user.title')}}</strong></li>
        </ol>
    </div>
</div>
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


