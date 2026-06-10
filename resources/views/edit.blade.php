@extends('layouts.temp')
{{-- title --}}
@section('title', 'edit')
{{-- content --}}
@section('temp-html')
    {{-- nav --}}
    @include('complements.nav-back')
    <div id="" style="" class="container py-3">
        <h3>แก้ไขข้อมูล</h3>
        <form id="popupForm_edit" method="POST" action="{{ route('update', $banks->bank_id) }}" enctype="multipart/form-data">
            @csrf
            {{-- ปุ่ม --}}
            <div class="button-container">
                <button type="submit" class="btn">Save</button>
            </div>
            <div class="flex-container">
                {{-- ชื่อเจ้าของบัญชี --}}
                <div class="group">
                    <label>ชื่อเจ้าของบัญชี</label>
                    <input type="text" id="bank_user" name="bank_user" list="bank_user_list"
                        value="{{ $banks->bank_user }}" required>
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
                    <input type="text" name="bank_name" value="{{ $banks->bank_name }}" required>
                    @error('bank_name')
                        <div class="my-2">
                            <span class="text text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                {{-- สาขา --}}
                <div class="group">
                    <label>สาขา</label>
                    <input type="text" name="bank_branch" value="{{ $banks->bank_branch }}" required>
                    @error('bank_branch')
                        <div class="my-2">
                            <span class="text text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                {{-- เลขบัญชี --}}
                <div class="group">
                    <label>เลขบัญชี</label>
                    <input type="text" name="bank_number" value="{{ $banks->bank_number }}" required>
                    @error('bank_number')
                        <div class="my-2">
                            <span class="text text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                {{-- วันที่ --}}
                <div class="group">
                    <label>วันที่</label>
                    <input type="datetime-local" name="update_date" id="update_date" required>
                    <input type="datetime-local" name="create_date" id="create_date" style="display: none"
                        value="{{ $banks->create_date }}" required>
                    @error('create_date')
                        <div class="my-2">
                            <span class="text text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                {{-- รูป --}}
                <div class="group">
                    <label>รูป</label>
                    {{-- แสดงรูป --}}
                    {{-- รูปเดิม --}}
                    <div id="picture_show" style="">
                        รูปเดิม : <br>
                        <img src="{{ asset('storage/images/' . $banks->bank_picture) }}" alt="รูปภาพ"
                            style="width: 300px; " id="selected_picture" value="{{ $banks->bank_picture }}"
                            name="bank_picture_o"><br><br>
                    </div>
                    {{-- รูปใหม่ --}}
                    <input type="file" name="bank_picture_n" id="bank_picture">
                    @error('bank_picture')
                        <div class="my-2">
                            <span class="text text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                {{-- vdo --}}
            </div>
        </form>
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
@endsection
