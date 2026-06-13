@extends('layouts.app')
@section('title', 'Profil Saya')
@section('content')

<div class="profile-page">
    <h1 class="profile-title">👤 Profil Saya</h1>
    <p class="profile-sub">Kelola informasi akun, password, dan preferensi keamanan Anda.</p>

    <div class="profile-section">
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="profile-section">
        @include('profile.partials.update-password-form')
    </div>

    <div class="profile-section profile-danger-section">
        @include('profile.partials.delete-user-form')
    </div>
</div>

@endsection
