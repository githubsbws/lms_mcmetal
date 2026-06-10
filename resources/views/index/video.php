@extends('layout/mainlayout')
@section('title', 'Brother e-learning')
@section('content')
@php
use App\Models\Downloadcategoty;
use App\Models\DownloadFile;

@endphp

<style>
    /* ===== BREADCRUMB ===== */
    .video-breadcrumb {
        padding: 10px 20px;
    }

    .video-breadcrumb .breadcrumb {
        background-color: transparent;
        margin-bottom: 0;
    }

    .video-breadcrumb .breadcrumb>li {
        font-size: 24px;
        color: #464646;
    }

    .video-breadcrumb .breadcrumb>.active {
        color: #464646;
    }

    /* ===== SEARCH ===== */
    .video-search {
        display: flex;
        justify-content: center;
        text-align: center;
        margin-bottom: 60px;
    }

    .video-search-label {
        font-size: 20px;
        color: #000;
        margin-right: 28px;
        vertical-align: middle;
        line-height: 42px;
    }

    .video-search-wrapper {
        display: inline-block;
        position: relative;
    }

    .video-search-input {
        width: 480px;
        height: 42px;
        padding: 6px 40px 6px 12px;
        font-size: 18px;
        border: 1px solid #1F7BCC;
        border-radius: 4px;
        outline: none;
    }

    .video-search-btn {
        position: absolute;
        right: 0;
        top: 0;
        width: 41px;
        height: 42px;
        background-color: #1F7BCC;
        color: #fff;
        border: none;
        border-radius: 0 4px 4px 0;
        cursor: pointer;
        font-size: 16px;
    }

    .video-search-btn:hover {
        background-color: #093880;
    }

    /* ===== VIDEO CARD ===== */
    .video-card {
        border: 1px solid #000;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .video-card-iframe {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
    }

    .video-card-iframe iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    .video-card-label {
        padding: 12px 16px;
        font-size: 16px;
        color: #333;
        border-top: 1px solid #000;

    }

    /* ===== PAGINATION ===== */
    .video-pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        margin-bottom: 40px;
    }

    .video-pagination .pagination {
        display: inline-flex;
        gap: 10px;
    }

    .video-pagination .pagination>li>a {
        color: #000;
        margin-left: 0;
    }

    .video-pagination .pagination>.active>a {
        background-color: #1F7BCC;
        border-color: #1F7BCC;
        color: #fff;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 767px) {
        .video-breadcrumb {
            padding: 8px 15px;
        }

        .video-breadcrumb .breadcrumb>li {
            font-size: 18px;
        }

        .video-search {
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .video-search-label {
            font-size: 18px;
            margin-right: 15px;
        }

        .video-search-input {
            width: 260px;
        }

        .video-pagination {
            margin-top: 10px;
            margin-bottom: 30px;
        }

        .video-pagination .pagination {
            gap: 5px;
        }

        .video-pagination .pagination>li>a {
            padding: 4px 8px;
            font-size: 13px;
        }
    }
</style>


<body>

    <div class="main-content">
        <div class="container-fluid">

            <!-- ===== BREADCRUMB ===== -->
            <div class="video-breadcrumb">
                <ol class="breadcrumb">
                    <li class="active">วิดีโอแนะนำ</li>
                </ol>
            </div>

            <!-- ===== CONTENT ===== -->
            <div class="container">

                <!-- ===== SEARCH ===== -->
                <div class="video-search">
                    <span class="video-search-label">Search</span>
                    <div class="video-search-wrapper">
                        <input type="text" class="video-search-input" placeholder="search">
                        <button class="video-search-btn">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Video grid: 6 cards -->
                <div class="row">
                    <!-- Video 1 -->
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="video-card">
                            <div class="video-card-iframe">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/njX2bu-_Vw4?si=Kt3_fLnGoNYKIbCU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                            <div class="video-card-label">Video Name</div>
                        </div>
                    </div>

                    <!-- Video 2 -->
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="video-card">
                            <div class="video-card-iframe">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/njX2bu-_Vw4?si=Kt3_fLnGoNYKIbCU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                            <div class="video-card-label">Video Name</div>
                        </div>
                    </div>

                    <!-- Video 3 -->
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="video-card">
                            <div class="video-card-iframe">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/njX2bu-_Vw4?si=Kt3_fLnGoNYKIbCU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                            <div class="video-card-label">Video Name</div>
                        </div>
                    </div>
                    <!-- Video 4 -->
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="video-card">
                            <div class="video-card-iframe">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/njX2bu-_Vw4?si=Kt3_fLnGoNYKIbCU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                            <div class="video-card-label">Video Name</div>
                        </div>
                    </div>

                    <!-- Video 5 -->
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="video-card">
                            <div class="video-card-iframe">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/njX2bu-_Vw4?si=Kt3_fLnGoNYKIbCU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                            <div class="video-card-label">Video Name</div>
                        </div>
                    </div>

                    <!-- Video 6 -->
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="video-card">
                            <div class="video-card-iframe">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/njX2bu-_Vw4?si=Kt3_fLnGoNYKIbCU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                            <div class="video-card-label">Video Name</div>
                        </div>
                    </div>
                </div>

                <!-- ===== PAGINATION ===== -->
                <div class="video-pagination">
                    <ul class="pagination">
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">หน้าถัดไป&gt;</a></li>
                        <li><a href="#">หน้าสุดท้าย&gt;&gt;</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

</body>


<script>

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection