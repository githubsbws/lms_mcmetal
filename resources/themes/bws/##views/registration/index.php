<style>
    .span3 {
        width: 220px;
    }
    .span4{
        width: 300px;
    }
    .form-control{
        border: 1px solid #D1D1D1;
    }
    .span-red{
        color: red;
    }
</style>
<div class="container">
    <div class="page-section">
        <div class="row">
            <div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2 class="text-center" style="margin-bottom: 30px;">สมัครสมาชิก</h2>
                        <form name="regis" method="post" action="<?php echo $this->createUrl('login/index'); ?>">
                            <p>ข้อมูลที่มี <span class="span-red">*</span> จะต้องกรอกให้ครบ</p>
                            <div class="form-group">
                                <label for="exampleInputEmail1">เลขประจำตัวประชาชน <span class="span-red">*</span></label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="เลขประจำตัวประชาชน">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">รหัสผ่าน <span class="span-red">*</span></label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="รหัสผ่าน">
                                <p>ข้อมูลควรเป็น (A-z0-9) และต้องมากกว่า 6 ตัวอักษร	</p>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">ยืนยันรหัสผ่าน <span class="span-red">*</span></label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="ยืนยันรหัสผ่าน">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">อีเมล์ <span class="span-red">*</span></label>
                                <input type="email" class="form-control" id="exampleInputPassword1" placeholder="อีเมล์">
                                <p>ตัวอย่าง example@example.com</p>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">คำนำหน้าชื่อ <span class="span-red">*</span></label>
                                <select class="form-control span3">
                                    <option>-- กรุณากรอกคำนำหน้าชื่อ--</option>
                                    <option>นาย</option>
                                    <option>นาง</option>
                                    <option>นางสาว</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputname">ชื่อ <span class="span-red">*</span></label>
                                <input type="text" class="form-control" id="exampleInputname" placeholder="ชื่อ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputlastname">นามสกุล <span class="span-red">*</span></label>
                                <input type="text" class="form-control" id="exampleInputlastname" placeholder="นามสกุล">
                            </div>
                            <div class="form-group">
                                <label for="datepicker">วัน/เดือน/ปี เกิด <span class="span-red">*</span></label>
                                <input id="datepicker" class="form-control datepicker" type="text">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">เพศ <span class="span-red">*</span></label>
                                <select class="form-control span3">
                                    <option>-- กรุณาเลือกเพศ--</option>
                                    <option>ชาย</option>
                                    <option>หญิง</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputlastname">เบอร์โทรศัพท์ <span class="span-red">*</span></label>
                                <input type="text" class="form-control" id="exampleInputlastname" placeholder="เบอร์โทรศัพท์">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputlastname">ที่อยู่ <span class="span-red">*</span></label>
                                <textarea class="form-control" rows="3" placeholder="ที่อยู่"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">จังหวัด <span class="span-red">*</span></label>
                                <select class="form-control span4">
                                    <option value="">---กรุณาเลือกจังหวัด---</option>
                                    <option value="1">กระบี่</option>
                                    <option value="2">กรุงเทพมหานคร</option>
                                    <option value="3">กาญจนบุรี</option>
                                    <option value="4">กาฬสินธุ์</option>
                                    <option value="5">กำแพงเพชร</option>
                                    <option value="6">ขอนแก่น</option>
                                    <option value="7">จันทบุรี</option>
                                    <option value="8">ฉะเชิงเทรา</option>
                                    <option value="9">ชลบุรี</option>
                                    <option value="10">ชัยนาท</option>
                                    <option value="11">ชัยภูมิ</option>
                                    <option value="12">ชุมพร</option>
                                    <option value="13">ตรัง</option>
                                    <option value="14">ตราด</option>
                                    <option value="15">ตาก</option>
                                    <option value="16">นครนายก</option>
                                    <option value="17">นครปฐม</option>
                                    <option value="18">นครพนม</option>
                                    <option value="19">นครราชสีมา</option>
                                    <option value="20">นครศรีธรรมราช</option>
                                    <option value="21">นครสวรรค์</option>
                                    <option value="22">นนทบุรี</option>
                                    <option value="23">นราธิวาส</option>
                                    <option value="24">น่าน</option>
                                    <option value="25">บุรีรัมย์</option>
                                    <option value="26">ปทุมธานี</option>
                                    <option value="27">ประจวบคีรีขันธ์</option>
                                    <option value="28">ปราจีนบุรี</option>
                                    <option value="29">ปัตตานี</option>
                                    <option value="30">พระนครศรีอยุธยา</option>
                                    <option value="31">พะเยา</option>
                                    <option value="32">พังงา</option>
                                    <option value="33">พัทลุง</option>
                                    <option value="34">พิจิตร</option>
                                    <option value="35">พิษณุโลก</option>
                                    <option value="36">ภูเก็ต</option>
                                    <option value="37">มหาสารคาม</option>
                                    <option value="38">มุกดาหาร</option>
                                    <option value="39">ยะลา</option>
                                    <option value="40">ยโสธร</option>
                                    <option value="41">ระนอง</option>
                                    <option value="42">ระยอง</option>
                                    <option value="43">ราชบุรี</option>
                                    <option value="44">ร้อยเอ็ด</option>
                                    <option value="45">ลพบุรี</option>
                                    <option value="46">ลำปาง</option>
                                    <option value="47">ลำพูน</option>
                                    <option value="48">ศรีสะเกษ</option>
                                    <option value="49">สกลนคร</option>
                                    <option value="50">สงขลา</option>
                                    <option value="51">สตูล</option>
                                    <option value="52">สมุทรปราการ</option>
                                    <option value="53">สมุทรสงคราม</option>
                                    <option value="54">สมุทรสาคร</option>
                                    <option value="55">สระบุรี</option>
                                    <option value="56">สระแก้ว</option>
                                    <option value="57">สิงห์บุรี</option>
                                    <option value="58">สุพรรณบุรี</option>
                                    <option value="59">สุราษฎร์ธานี</option>
                                    <option value="60">สุรินทร์</option>
                                    <option value="61">สุโขทัย</option>
                                    <option value="62">หนองคาย</option>
                                    <option value="63">หนองบัวลำภู</option>
                                    <option value="64">อำนาจเจริญ</option>
                                    <option value="65">อุดรธานี</option>
                                    <option value="66">อุตรดิตถ์</option>
                                    <option value="67">อุทัยธานี</option>
                                    <option value="68">อุบลราชธานี</option>
                                    <option value="69">อ่างทอง</option>
                                    <option value="70">เชียงราย</option>
                                    <option value="71">เชียงใหม่</option>
                                    <option value="72">เพชรบุรี</option>
                                    <option value="73">เพชรบูรณ์</option>
                                    <option value="74">เลย</option>
                                    <option value="75">แพร่</option>
                                    <option value="76">แม่ฮ่องสอน</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputlastname">รหัสไปรษณีย์ <span class="span-red">*</span></label>
                                <input type="text" class="form-control" id="exampleInputlastname" placeholder="รหัสไปรษณีย์">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputlastname">รหัสความปลอดภัย <span class="span-red">*</span></label></br>
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/captcha.png"/></br></br>
                                <input type="text" class="form-control" id="exampleInputlastname" placeholder="รหัสความปลอดภัย">
                            </div>
                            <button type="submit" class="btn btn-primary">ยืนยันสมัครสมาชิก</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>