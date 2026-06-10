@extends('layout/mainlayout')
@section('content')


<style>
    .col-lg-4 {
        margin-bottom: 18px;
    }

    .main-content {
        height: 100vh;
    }

    img {
        width: 100%;
    }

    .title-page {
        margin: 18px 0;
    }

    .all-news .card {
        position: relative;
    }


    .all-news .card .card-body {
        position: absolute;
        bottom: 0;
        color: #fff !important;
        height: auto;
        width: 100%;
        margin: 0;
        padding: 0;
        border: none;
        background-color: #6f6f6fa6;
        text-align: start;
        padding: 2px 8px;
        white-space-collapse: preserve-breaks;
        overflow-wrap: break-word;

        h5 {
            color: #fff;
        }

        .card-title {
            font-size: 20px !important;
            line-height: 0 !important;
        }
    }

    .card-body {
        p {
            margin: 0;
            padding: 0;
        }
    }
</style>

<body>
    <div class="main-content all-news">
        <h3 class="text-center title-page">ข่าวประชาสัมพันธ์</h3>
        <div class="container-fluid">
            <div class="row">
                @if($news_desc->isNotEmpty())
                @foreach ($news_desc as $new)
                <div class="col-lg-4">
                    <a href="{{ route('new_detail',$new->cms_id) }}">
                        <div class="card position-relative">
                            <img src="{{ asset('images/uploads/news/'.$new->cms_id.'/original/'.$new->cms_picture) }}" alt="announcement image" class="card-img">
                            <div class="card-body">
                                <p class="card-title">{!! trim(strip_tags(html_entity_decode($new->cms_short_title))) ?: '-' !!}</p>
                                <p class="mb-0"><i class="fa-solid fa-computer"></i> {{ $new->create_date ? \Carbon\Carbon::parse($new->create_date)->locale('th')->isoFormat('D MMMM') . ' ' . (\Carbon\Carbon::parse($new->create_date)->year + 543) : '-' }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                @else
                <div class="card position-relative">
                    <h3>ไม่มีข่าวสารในตอนนี้ กรุณารออัพเดต</h3>
                </div>
                @endif
            </div>
        </div>

    </div>
</body>
@endsection