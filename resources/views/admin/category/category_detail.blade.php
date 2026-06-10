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
                            <h4 class="m-0">ระบบหมวดหลักสูตร</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('category')}}">
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
                        รายละเอียดหมวดหลักสูตร
                    </div>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="cms_title">ชื่อหมวดหลักสูตร</label>
                                <h4>{{ $category->cate_title}}</h4>
                            </div>

                            <div class="form-group">
                                <label for="cms_title">รายละเอียดย่อ</label>
                                <h4>{{ $category->cate_short_detail }}</h4>
                            </div>

                            <div class="form-group">
                                <label for="cms_short_title">รายละเอียด </label>
                                {!! htmlspecialchars_decode($category->cate_detail) !!}
                            </div>

                            <div class="form-group">
                                <label for="cms_short_title">ภาพประกอบ </label>
                                <h3><img src="{{ asset('images/uploads/category/'.$category->cate_id.'/original/'. $category->cate_image) }}" alt="รูปภาพ"></h3>
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
