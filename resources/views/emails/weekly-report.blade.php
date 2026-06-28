<!doctype html>
<html>
<head>
<meta charset="utf-8">

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    margin:0;
    padding:0;
    color:#333;
}

.wrapper{
    width:900px;
    margin:30px auto;
    background:#fff;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

/* Header */
.header{
    background:linear-gradient(135deg,#1976d2,#2196f3);
    color:white;
    padding:25px;
}

.header h2{
    margin:0;
    font-size:22px;
}

.header small{
    display:block;
    margin-top:5px;
    opacity:0.9;
}

/* Section */
.section{
    padding:20px 25px;
    border-bottom:1px solid #eee;
}

.section:last-child{
    border-bottom:none;
}

/* Summary cards */
.summary{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.card{
    flex:1;
    min-width:180px;
    background:#f9fafc;
    border-radius:8px;
    padding:15px;
    border:1px solid #eaeaea;
}

.card h4{
    margin:0 0 5px 0;
    font-size:14px;
    color:#666;
}

.card b{
    font-size:18px;
}

/* Titles */
.title{
    font-size:16px;
    margin-bottom:15px;
    padding-left:10px;
    border-left:4px solid #1976d2;
}

.title.red{ border-color:#e53935; }
.title.green{ border-color:#43a047; }

/* Table */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
    font-size:14px;
}

th{
    background:#f1f3f5;
    text-align:left;
    padding:10px;
    font-weight:600;
}

td{
    padding:10px;
    border-bottom:1px solid #eee;
}

tr:hover{
    background:#fafafa;
}

/* Badge */
.badge-pass{
    background:#e8f5e9;
    color:#2e7d32;
    padding:3px 8px;
    border-radius:12px;
    font-size:12px;
}

.badge-fail{
    background:#ffebee;
    color:#c62828;
    padding:3px 8px;
    border-radius:12px;
    font-size:12px;
}
</style>

</head>

<body>

<div class="wrapper">

    <div class="header">
        <h2>📊 รายงานสรุปการเรียนประจำสัปดาห์</h2>
        <small>ประจำวันที่ {{ now()->format('d/m/Y') }}</small>
    </div>

    <div class="section">

        <div class="title">สรุปผลการสอบ</div>

        <div class="summary">
            <div class="card">
                <h4>ผู้เข้าสอบทั้งหมด</h4>
                <b>{{ $totalExam }} คน</b>
            </div>

            <div class="card">
                <h4>สอบผ่าน</h4>
                <b style="color:#43a047">{{ $totalPass }} คน</b>
            </div>

            <div class="card">
                <h4>สอบไม่ผ่าน</h4>
                <b style="color:#e53935">{{ $totalFail }} คน</b>
            </div>

            <div class="card">
                <h4>อัตราการผ่าน</h4>
                <b style="color:#1976d2">{{ $passRate }} %</b>
            </div>
        </div>

    </div>

    <div class="section">

        <div class="title green">ผู้สอบผ่าน</div>

        <table>
            <tr>
                <th>Username</th>
                <th>หลักสูตร</th>
                <th>คะแนน</th>
                <th>วันที่สอบ</th>
            </tr>

            @foreach($pass as $item)
            <tr>
                <td>{{ $item->username }}</td>
                <td>{{ $item->course_title }}</td>
                <td>
                    <span class="badge-pass">
                        {{ $item->score_number }}/{{ $item->score_total }}
                    </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($item->create_date)->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </table>

    </div>

    <div class="section">

        <div class="title red">ผู้สอบไม่ผ่าน</div>

        <table>
            <tr>
                <th>Username</th>
                <th>หลักสูตร</th>
                <th>คะแนน</th>
                <th>วันที่สอบ</th>
            </tr>

            @foreach($fail as $item)
            <tr>
                <td>{{ $item->username }}</td>
                <td>{{ $item->course_title }}</td>
                <td>
                    <span class="badge-fail">
                        {{ $item->score_number }}/{{ $item->score_total }}
                    </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($item->create_date)->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </table>

    </div>

</div>

</body>
</html>