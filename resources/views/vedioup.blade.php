@extends('layouts.temp')
{{-- title --}}
@section('title', 'edit')
{{-- content --}}
@section('temp-html')
    {{-- nav --}}
    @include('complements.nav-back')
    {{-- popup อัปโหลดวิดีโอ --}}
    <div id="" style="" class="container py-3">
        <h3>อัปโหลดวิดีโอ</h3>
        <form id="popupForm_edit" method="POST" action="{{ route('up_vedio.up_vedio_in') }}" enctype="multipart/form-data">
            @csrf
            {{-- ปุ่ม --}}
            <div class="button-container">
                <button type="submit" class="btn">Save</button>
            </div><br>
            <div class="flex-container">
                {{-- ชื่อเจ้าของบัญชี --}}
                <div class="group">
                    <label>ชื่อเจ้าของบัญชี</label>
                    <input type="text" id="bank_user" name="bank_user" list="bank_user_list"
                        value="{{ $banks->bank_user }}" readonly>
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
                </div><br>
                {{-- vdo --}}
                <div class="group" id="">
                    <label>ชื่อวีดีโอที่เลือก</label>
                    <input type="text" name="vdo_name" id="vdo_name" readonly><br>
                    <select id="videoSelect" name="videoSelect">
                        @foreach ($vedios as $name)
                            <option value="{{ asset('storage/vdo/' . $name->vedio_name) }}">{{ $name->vedio_name }}</option>
                        @endforeach
                    </select><br>
                    <video controls id="selectedVideo" width="300">
                        <source src="" type="video/mp4">
                    </video>
                </div>
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
                icon: 'error',
                title: 'error',
                text: "{{ session('message') }}",
            });
        </script>
    @endif
    <script>
        // ฟังก์ชัน ใส่ชื่อ vdo
        document.getElementById('videoSelect').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var videoName = selectedOption.value;
            var videoText = selectedOption.text;
            document.getElementById('vdo_name').value = videoText;
            document.getElementById('selectedVideo').src = videoName;
        });
    </script>
@endsection
