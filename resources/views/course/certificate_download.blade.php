<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>
body{
    font-family: garuda;
    margin:0;
    padding:0;
}

.bg{
    position:absolute;
    top:0;
    left:0;
    width:297mm;
    height:210mm;
    z-index:-1;
}

.center{
    text-align:center;
}

.full-width{
    width:297mm;
}

.title{
    font-size:24pt;
}

.name{
    font-size:30pt;
    color:#A36C2C;
}

.course{
    font-size:24pt;
    color:#A36C2C;
}

.date{
    font-size:16pt;
}
</style>

</head>
<body>


<div class="full-width center title"
     style="position:absolute; top:45mm;">
    MC METAL SERVICE ASIA [THAILAND] CO.,LTD
</div>

<div class="full-width center"
     style="position:absolute; top:75mm; font-size:22pt;">
    มอบใบประกาศนียบัตรให้แก่
</div>

<div class="full-width center name"
     style="position:absolute; top:95mm;">
    {{ $fullname }}
</div>

<div class="full-width center"
     style="position:absolute; top:120mm; font-size:22pt;">
    ผ่านการอบรมหลักสูตร
</div>

<div class="full-width center course"
     style="position:absolute; top:140mm;">
    {{ $certificate->course->course_title ?? $certificate->cert_course }}
</div>

<div class="full-width center date"
     style="position:absolute; top:180mm;">
    วันที่ออกใบประกาศ : {{ now()->format('d/m/Y') }}
</div>

</body>
</html>