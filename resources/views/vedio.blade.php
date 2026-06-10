@extends('layouts.temp')
{{-- title --}}
@section('title', 'Add VDO')
{{-- content --}}
@section('temp-html')
    {{-- nav --}}
    @include('complements.nav-back')
    {{-- popup เพิ่มวิดีโอ --}}
    <div id="" style="" class="container py-3">
        <h3>เพิ่มวิดีโอ</h3>
        <form id="popupForm_edit" method="POST" action="{{ route('vedio.vedio_in') }}" enctype="multipart/form-data">
            @csrf
            {{-- ปุ่ม --}}
            <div class="button-container">
                <button type="submit" class="btn">Save</button>
            </div>
            <div class="flex-container">
                {{-- vdo --}}
                <div class="group" id="">
                    <label>วิดีโอ</label>
                    <input type="file" name="vedio_name" id="vedio_name" required>
                    @error('vedio_name')
                        <div class="my-2">
                            <span class="text text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                </div><br>
            </div>
            <div class="video-grid">
                @foreach ($vedios as $item)
                    <video controls class="video-item" width="100%">
                        <source src="{{ asset('storage/vdo/' . $item->vedio_name) }}" type="video/mp4">
                        {{-- Your browser does not support the video tag. --}}
                    </video>
                @endforeach
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
