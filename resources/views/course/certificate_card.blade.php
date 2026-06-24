<style>
body{
    font-family:garuda;
    margin:0;
    padding:0;
}

.container{
    width:100%;
    height:100%;
}

.left{
    width:40%;
    float:left;
    border-right:3px solid #c7c7c7;
    min-height:700px;
    padding:20px 30px;
}

.right{
    width:49%;
    float:right;
    min-height:700px;
    padding:20px 30px;
}

.header{
    font-size:28px;
    font-weight:bold;
    margin-bottom:10px;
}

.logo{
    font-size:52px;
    color:#4f66ff;
    font-weight:bold;
}

.no{
    font-size:48px;
    font-weight:bold;
    text-align:right;
    padding-top:10px;
}

.company{
    font-size:16px;
    font-weight:bold;
}

.qr{
    text-align:right;
    margin-top:30px;
    margin-right:10px;
}

.qr img{
    width:160px;
}

.info{
    margin-top:40px;
    font-size:22px;
    line-height:1.8;
}

.logo-right{
    font-size:52px;
    color:#4f66ff;
    font-weight:bold;
}

.company-right{
    font-size:16px;
    font-weight:bold;
}

.topic{
    text-align:center;
    font-size:32px;
    font-weight:bold;
    margin:10px 0 20px;
}

.rule{
    font-size:20px;
    line-height:1.45;
    margin-bottom:18px;
}
</style>

<div class="container">

<div class="left">

<div class="header">
บัตรอนุญาตพนักงานขับรถ
</div>

<table width="100%">
<tr>
<td width="50%">
<div class="logo">MSAT</div>
</td>

<td width="50%">
<div class="no">01747</div>
</td>
</tr>
</table>

<div class="company">
MC METAL SERVICE ASIA (THAILAND) CO.,LTD.
</div>

<div class="qr">
<img src="{{ public_path('images/card/qr.png') }}">
</div>

<div class="info">
<b>ชื่อ-สกุล :</b> {{ $fullname }}<br>
<b>บริษัท :</b> MSAT<br>
<b>ทะเบียน :</b> กข-1234<br>
<b>วันออกบัตร :</b> {{ date('d/m/Y') }}
</div>

</div>

<div class="right">

<div class="logo-right">
MSAT
</div>

<div class="company-right">
MC METAL SERVICE ASIA (THAILAND) CO.,LTD.
</div>

<div class="topic">
การใช้บัตร
</div>

<div class="rule">
1. บัตรนี้เป็นบัตรผ่านสำหรับพนักงานขับรถที่กล่าวถึงในหน้าแรก เข้ามาติดต่อรับ-ส่งงานภายในบริษัท MSAT เท่านั้น ซึ่งบัตรไม่สามารถใช้แทนกันได้
</div>

<div class="rule">
2. โปรดแสดงบัตรนี้ต่อพนักงานรักษาความปลอดภัยของบริษัท MSAT ก่อนเข้ามาในพื้นที่บริษัท MSAT
</div>

<div class="rule">
3. หากไม่มีบัตรอนุญาต จะไม่สามารถเข้ามาปฏิบัติงานในพื้นที่ของบริษัท MSAT ได้
</div>

<div class="rule">
4. ต้องคืนบัตรนี้ให้บริษัท MSAT เมื่อพ้นสภาพจากการเป็นพนักงานขับรถ
</div>

</div>

</div>