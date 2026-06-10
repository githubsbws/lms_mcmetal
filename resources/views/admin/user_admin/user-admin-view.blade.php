@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<body>
    <div id="wrapper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">ระบบจัดการสมาชิก</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('user_admin')}}">
                                <button class="btn btn-warning d-flex align-items-center">
                                    <i class="fas fa-angle-left mr-2"></i>
                                    กลับหน้าหลัก
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        รายละเอียดสมาชิก
                    </div>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="cms_title">ชื่อ</label>
                                <h4>{{ @$query->Profiles->Fullname() ?? '-' }}</h4>
                            </div>

                            <div class="form-group">
                                <label for="cms_title">ชื่อEN</label>
                                <h4>{{ @$query->Profiles->FullnameEN() ?? '-' }}</h4>
                            </div>

                            <div class="form-group">
                                <label for="cms_short_title">เลขบัตรประชาชน </label>
                                <h4>{{ @$query->Profiles->identification ?? '-' }}</h4>
                            </div>

                            <div class="form-group">
                                <label for="cms_short_title">Email </label>
                                <h4>{{ @$query->email ?? '-' }}</h4>
                            </div>
                            {{-- แสดง org path --}}
                            <div class="form-group">
                                <label>สังกัดองค์กร</label>
                                @if(!empty($orgPath))
                                    <div class="d-flex align-items-center flex-wrap" style="gap: 8px;">
                                        @foreach($orgPath as $index => $orgId)
                                            @php $org = \App\Models\Orgchart::find($orgId); @endphp
                                            @if($org)
                                                @if($index > 0)
                                                    <i class="fas fa-angle-right text-muted"></i>
                                                @endif
                                                <span class="badge badge-primary" style="font-size: 14px; padding: 6px 12px;">
                                                    {{ $org->title }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                @else
                                    <h4>-</h4>
                                @endif
                            </div>

                    </div>
                </div>
            </div>
            <div id="sidebar">
            </div><!-- sidebar -->
        </div>
    </div>
    <div class="clearfix"></div>
</body>
@endsection
