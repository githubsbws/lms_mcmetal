@extends('layouts.temp')
{{-- title --}}
@section('title', 'bank')
{{-- content --}}
@section('temp-html')
    {{-- nav --}}
    @include('complements.nav')
    {{-- Content --}}
    {{-- แสดงข้อมูลรายชื่อเจ้าของบัญชี --}}
    <div class="container py-3">
        @if (count($banks) > 0)
            <h3>รายชื่อเจ้าของบัญชี</h3><br>
            <div class="container2_dis">
                @foreach ($banks as $item)
                    <div class="box2_dis">
                        ชื่อเจ้าของบัญชี : {{ $item->bank_user }}<br>
                        ชื่อธนาคาร : {{ $item->bank_name }}<br>
                        สาขา : {{ $item->bank_branch }}<br>
                        เลขบัญชี : {{ $item->bank_number }}<br>
                        อัปเดตล่าสุด : {{ $item->update_date }}<br>
                        สถานะ :
                        @if ($item->active == 'y')
                            <label style="color: darkgreen">เปิดใช้งาน</label><br>
                            {{-- ปุ่มแก้ไข --}}
                            <a href="{{ route('edit', $item->bank_id) }}" name="edit_in" id="edit_in" class="btn"
                                style="background-color: #00B8A9; color: #F6F1F1;">แก้ไข</a>
                            {{-- ปุ่มอัปวิดีโอ --}}
                            <a href="{{ route('up_vedio', $item->bank_id) }}" name="vedio_in" id="vedio_in" class="btn"
                                style="background-color: #F6416C; color: #F6F1F1;">อัปโหลดวิดีโอ</a>
                        @else
                            <label style="color:#ce0000">ปิดใช้งาน</label><br>
                            {{-- ปุ่มแก้ไข --}}
                            <a href="{{ route('edit', $item->bank_id) }}" name="edit_in" id="edit_in" class="btn"
                                style="background-color: #00B8A9; color: #F6F1F1; display: none;">แก้ไข</a>
                            {{-- ปุ่มอัปวิดีโอ --}}
                            <a href="{{ route('up_vedio', $item->bank_id) }}" name="vedio_in" id="vedio_in" class="btn"
                                style="background-color: #F6416C; color: #F6F1F1; display: none;">อัปโหลดวิดีโอ</a>
                        @endif
                        {{-- ปุ่ม --}}
                        <a href="{{ route('change', $item->bank_id) }}" name="change_in" id="change_in" class="btn"
                            style="background-color: #ce0000; color: #F6F1F1;"
                            onclick="return confirm('คุณต้องการเปลี่ยนสถานะ หรือไม่ ?')">เปลี่ยนสถานะ</a><br><br>

                        {{-- แสดงรูป --}}
                        <div id="picture_show" style="">
                            <img src="{{ asset('storage/images/' . $item->bank_picture) }}" alt="รูปภาพ"
                                style="width: 300px; " id="selected_picture"><br><br>
                        </div>
                    </div>
                @endforeach
                <a href="{{ route('vedio', $item->bank_id) }}" name="vedio_in" id="vedio_in" class="btn"
                    style="background-color: #FFDE7D; color: #000;">เพิ่มวิดีโอ</a>
            </div><br>
        @else
            <h2>ไม่พบรายชื่อ</h2>
        @endif
        {{ $banks->appends(request()->input())->links() }}
    </div>

    {{-- popup เพิ่มข้อมูล --}}
    <div id="popup_insert" style="display: none;">
        <h3>เพิ่มข้อมูล</h3><br>
        <form id="popupForm_insert" method="POST" action="insert" enctype="multipart/form-data">
            @csrf
            <div class="flex-container">
                {{-- ชื่อเจ้าของบัญชี --}}
                <div class="group">
                    <label>ชื่อเจ้าของบัญชี</label>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <input type="text" id="bank_user" name="bank_user" list="bank_user_list" required>
                    <datalist id="bank_user_list">
                        @foreach ($ascs as $id => $name)
                            <option value="{{ $name }}">
                        @endforeach
                    </datalist>
                    @error('bank_user')
                        <div class="my-2">
                            <span class="text text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                {{-- ชื่อธนาคาร --}}
                <div class="group">
                    <label>ชื่อธนาคาร</label>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <input type="text" name="bank_name" required>
                    @error('bank_name')
                        <div class="my-2">
                            <span class="text text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                {{-- สาขา --}}
                <div class="group">
                    <label>สาขา</label>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <input type="text" name="bank_branch" required>
                    @error('bank_branch')
                        <div class="my-2">
                            <span class="text text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                {{-- เลขบัญชี --}}
                <div class="group">
                    <label>เลขบัญชี</label>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <input type="text" name="bank_number" required>
                    @error('bank_number')
                        <div class="my-2">
                            <span class="text text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                {{-- รูป --}}
                <div class="group">
                    <label>รูป</label>
                    <input type="file" name="bank_picture" id="bank_picture" required>
                    @error('bank_picture')
                        <div class="my-2">
                            <span class="text text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                {{-- วันที่ --}}
                <div class="group">
                    <label>วันที่</label>
                    <input type="datetime-local" name="create_date" id="create_date" required>
                    @error('create_date')
                        <div class="my-2">
                            <span class="text text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                {{-- ปุ่ม --}}
            </div>
            <button type="submit" class="btn">Save</button>
        </form><br>
        <button class="btn" onclick="hidePopup_insert()">Close</button>
    </div>

    {{-- แสดงข้อมูล --}}
    <div id="popup_user" style="display: none;" class="container py-3">
        <button class="btn" onclick="hidePopup_user()">Close</button>
        <form id="popupForm_user" method="POST" action="insert" enctype="multipart/form-data">
            @csrf
            <div class="flex-container">
                {{-- แสดงข้อมูลรายชื่อเจ้าของบัญชี --}}
                <div class="container py-3">
                    @if (count($users) > 0)
                        <h3>รายชื่อผู้ใช้</h3>
                        {{-- ค้นหาชื่อ --}}
                        <div class="form-group">
                            <label for="search_name">ค้นหาชื่อ:</label>
                            <input type="text" name="search_name" id="search_name" class="form-control">
                        </div>
                        <table class="table">
                            <tr>
                                <th>No.</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Name</th>
                            </tr>
                            @foreach ($users as $key => $item)
                                <tr class="user-row">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->name }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <h2>ไม่พบรายชื่อ</h2>
                    @endif
                    {{-- {{ $users->links() }} --}}
                </div>
            </div>
        </form><br>
    </div>

    {{-- แสดงวีดีโอ --}}
    <div id="popup_vdo" style="display: none;" class="container py-3">
        <button class="btn" onclick="hidePopup_vdo()">Close</button>
        <form id="popupForm_vdo" method="POST" action="insert" enctype="multipart/form-data">
            @csrf
            <div class="flex-container">
                {{-- แสดงข้อมูลรายชื่อเจ้าของบัญชีและวิดีโอ --}}
                <div class="container py-3">
                    @if (count($users) > 0)
                        <h3>วิดีโอ</h3>
                        {{-- ค้นหาชื่อ --}}
                        <div class="form-group">
                            <label for="search_name_user">ค้นหาชื่อ:</label>
                            <input type="text" name="search_name_user" id="search_name_user" class="form-control">
                        </div>
                        <table class="table">
                            <tr>
                                <th>No.</th>
                                <th>Username</th>
                                <th>VDO</th>
                                <th>ลบ</th>
                            </tr>
                            @foreach ($vedios as $key => $item)
                                <tr class="user-row">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td><video controls width="30%" class="group">
                                            <source src="{{ asset('storage/vdo/' . $item->vedio_name) }}"
                                                type="video/mp4">
                                        </video>
                                    </td>
                                    <td>
                                        <a href="{{ route('del', $item->id) }}" name="del_in" id="del_in"
                                            class="btn" style="background-color: #ce0000; color: #F6F1F1;"
                                            onclick="return confirm('คุณต้องการลบวิดีโอ หรือไม่ ?')">ลบ</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <h2>ไม่พบรายชื่อ</h2>
                    @endif
                    {{-- {{ $users->links() }} --}}
                </div>
            </div>
        </form><br>
    </div>
    {{-- footers --}}
    @include('complements.footers')

    {{-- เเจ้งเตือน --}}
    @if (session('message'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('message') }}",
            });
        </script>
    @endif

    {{-- ฟังก์ชัน script js --}}
    <script>
        // เมื่อพิมพ์ที่ input field
        document.getElementById('search_name').addEventListener('input', function() {
            // ดึงค่าที่พิมพ์มา
            var inputText = this.value.toLowerCase();

            // กรองแถวของผู้ใช้ที่ตรงกับค่าที่พิมพ์
            var userRows = document.querySelectorAll('.user-row');

            userRows.forEach(function(row) {
                // ซ่อนแถวทั้งหมด
                row.style.display = 'none';

                // ตรวจสอบว่าชื่อในแถวตรงกับค่าที่พิมพ์หรือไม่
                var userName = row.querySelector('td:nth-child(4)').textContent.toLowerCase();

                // แสดงแถวที่ตรงกับค่าที่พิมพ์
                if (userName.includes(inputText)) {
                    row.style.display = '';
                }
            });
        });
    </script>
    <script>
        // เมื่อพิมพ์ที่ input field
        document.getElementById('search_name_user').addEventListener('input', function() {
            // ดึงค่าที่พิมพ์มา
            var inputText = this.value.toLowerCase();

            // กรองแถวของผู้ใช้ที่ตรงกับค่าที่พิมพ์
            var userRows = document.querySelectorAll('.user-row');

            userRows.forEach(function(row) {
                // ซ่อนแถวทั้งหมด
                row.style.display = 'none';

                // ตรวจสอบว่าชื่อในแถวตรงกับค่าที่พิมพ์หรือไม่
                var userName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

                // แสดงแถวที่ตรงกับค่าที่พิมพ์
                if (userName.includes(inputText)) {
                    row.style.display = '';
                }
            });
        });
    </script>
@endsection
