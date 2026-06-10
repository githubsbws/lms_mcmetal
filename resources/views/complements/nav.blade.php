<nav class="navbar nave2">
    <div class="container-fluid">
        <H2 class="" style="color:#F6416C">Banking</H2>
        <div class="button-container">
            <button class="btn" id="insertt" onclick="showPopup_insert()"
                style="background-color: #00B8A9; color: #F6F1F1;">เพิ่มข้อมูล</button>&nbsp;
            <button class="btn" id="user" onclick="showPopup_user()"
                style="background-color: #00B8A9; color: #F6F1F1;">ผู้ใช้</button>&nbsp;
            <button class="btn" id="sho_vdu" onclick="showPopup_vdo()"
                style="background-color: #00B8A9; color: #F6F1F1;">VDO</button>&nbsp;
            <a class="btn " id="insertt" href='logout'
                style="background-color: #00B8A9; color: #F6F1F1;">ออกจากระบบ</a>
        </div>
    </div>
</nav>
<script>
    function showPopup_insert() {
        document.getElementById('popup_insert').style.display = 'block';
    }

    function hidePopup_insert() {
        document.getElementById('popup_insert').style.display = 'none';
    }

    function showPopup_user() {
        document.getElementById('popup_user').style.display = 'block';
    }

    function hidePopup_user() {
        document.getElementById('popup_user').style.display = 'none';
    }

    function showPopup_vdo() {
        document.getElementById('popup_vdo').style.display = 'block';
    }

    function hidePopup_vdo() {
        document.getElementById('popup_vdo').style.display = 'none';
    }
</script>