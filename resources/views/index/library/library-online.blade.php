@extends('layout/mainlayout')
@section('title', 'Library Online')
@section('content')

<style>
    .library-folder-ui {
        max-width: 1200px;
        margin: 0 auto;
        padding: 32px 20px 60px;
    }

    .library-pathbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f3f3f3;
        border: 1px solid #d8d8d8;
        border-radius: 12px;
        padding: 14px 18px;
        margin-bottom: 20px;
    }

    .library-pathbar .path-label {
        display: flex;
        gap: 8px;
        align-items: center;
        font-size: 20px;
        color: #333;
    }

    .library-pathbar .path-label span {
        color: #6b6b6b;
    }

    .library-pathbar .path-search {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .library-pathbar .path-search input {
        border: 1px solid #c7c7c7;
        border-radius: 999px;
        padding: 10px 16px;
        width: 260px;
        font-size: 16px;
    }

    .library-pathbar .path-search button {
        font-size: 15px;
        padding: 9px 18px;
    }

    .library-files-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 24px;
    }

    .library-file-card {
        border: 1px solid #e1e1e1;
        border-radius: 16px;
        background: #ffffff;
        padding: 24px 18px 18px;
        text-align: center;
        transition: transform 0.18s ease, box-shadow 0.18s ease;
        cursor: pointer;
        min-height: 224px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .library-file-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.09);
    }

    .library-file-card .file-icon {
        display: inline-flex;
        width: 88px;
        height: 88px;
        border-radius: 22px;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        font-size: 36px;
        color: #fff;
    }

    .library-file-card .file-icon.pdf {
        background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
    }

    .library-file-card .file-icon.video {
        background: linear-gradient(135deg, #0f83ff 0%, #003ea6 100%);
    }

    .library-file-card .file-title {
        font-size: 15px;
        font-weight: 600;
        color: #1f1f1f;
        margin-bottom: 8px;
        line-height: 1.35;
    }

    .library-file-card .file-subtitle {
        font-size: 13px;
        color: #6c6c6c;
    }

    .library-file-card .file-meta {
        display: flex;
        justify-content: center;
        gap: 10px;
        font-size: 12px;
        color: #777;
        margin-top: 14px;
    }

    .library-file-card .file-meta span {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .library-file-card .file-meta i {
        font-size: 12px;
    }

    .library-file-card .file-name {
        font-size: 14px;
        color: #444;
        word-break: break-word;
        margin-bottom: 12px;
    }

    @media (max-width: 768px) {
        .library-folder-ui {
            padding: 20px 12px 40px;
        }

        .library-pathbar {
            flex-wrap: wrap;
            gap: 12px;
        }

        .library-pathbar .path-search input {
            width: 100%;
        }
    }
</style>

<div class="main-content">
    <div class="container-fluid library-folder-ui">
        <div class="library-pathbar">
            <div class="path-label">
                <strong>Library Online</strong>
                <span>&gt;</span>
                <span>Documents</span>
                <span>&gt;</span>
                <span>My Files</span>
            </div>
            <div class="path-search">
                <input type="text" placeholder="ค้นหาไฟล..." aria-label="Search files">
                <button type="button" class="btn btn-default" style="border: 1px solid #c7c7c7; border-radius: 999px; padding: 8px 14px; background: #fff;">ค้นหา</button>
            </div>
        </div>

        <div class="library-files-grid">
            @php
                $mockFiles = [
                    ['type' => 'pdf', 'title' => 'สรุปการเรียนร้.pdf', 'subtitle' => 'PDF Document', 'size' => '1.3 MB'],
                    ['type' => 'pdf', 'title' => 'ค่มือใช้งาน.pdf', 'subtitle' => 'PDF Document', 'size' => '2.1 MB'],
                    ['type' => 'video', 'title' => 'วิดีอสอนพื้นาน.mp4', 'subtitle' => 'Video File', 'size' => '54 MB'],
                    ['type' => 'video', 'title' => 'คลิปสรุปบทเรียน.mp4', 'subtitle' => 'Video File', 'size' => '79 MB'],
                    ['type' => 'pdf', 'title' => 'เอกสารประกอบการสอน.pdf', 'subtitle' => 'PDF Document', 'size' => '880 KB'],
                    ['type' => 'video', 'title' => 'ตัวอย่างการใช้งาน.mp4', 'subtitle' => 'Video File', 'size' => '120 MB'],
                ];
            @endphp

            @foreach ($mockFiles as $file)
                <div class="library-file-card">
                    <div class="file-icon {{ $file['type'] }}">
                        @if ($file['type'] === 'pdf')
                            <i class="fas fa-file-pdf"></i>
                        @else
                            <i class="fas fa-file-video"></i>
                        @endif
                    </div>
                    <div class="file-name">{{ $file['title'] }}</div>
                    <div class="file-title">{{ $file['subtitle'] }}</div>
                    <div class="file-meta">
                        <span><i class="fas fa-clock"></i> 12 มิ.ย. 2569</span>
                        <span><i class="fas fa-database"></i> {{ $file['size'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
