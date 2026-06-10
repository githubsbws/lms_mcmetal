@extends('layouts.temp')
{{-- title --}}
@section('title', 'login')
{{-- content --}}
@section('temp-html')
    {{-- Navbar --}}
    <nav class="navbar nave2">
        <div class="container-fluid">
            <H2 class="" style="color:#276678">Banking</H2>
            <a class="btn" id="insertt" href='/' style="background-color: #276678; color: #F6F1F1;">กลับ</a>
        </div>
    </nav>
    <form action="login_in" method="post" class="container py-3">
        @csrf
        <div class="shdis">
            <div class="container3">
                <img src="storage/images/2023112994224_Picture.jpg" alt="image">
                <div class="container-text3">
                    <h2>Login</h2>
                    <br>
                    <input type="email" class="tx" name="email" id="email" placeholder="Email address" required>
                    <input type="password" class="tx" name="password" id="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                    <span>ตรวจสอบว่าอีเมลและรหัสผ่านถูกต้องหรือไม่</span>
                </div>
            </div>
        </div>
    </form>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    </form>
    {{-- footers --}}
    @include('complements.footers')
@endsection
