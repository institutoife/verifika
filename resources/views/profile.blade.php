@extends('layouts.app')
@section('title', 'Mi Perfil - Verifika')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/base.css') }}">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 form-card animate__animated animate__fadeIn">
                <div class="card-header text-white text-center p-4" style="background: linear-gradient(115deg, rgb(38,186,165), rgb(55,95,122)); border-top-left-radius:1rem; border-top-right-radius:1rem;">
                    <div class="mb-2">
                        <span class="logo-circle position-relative logo-pulse" style="display:inline-block;width:54px;height:54px;background:#fff;border-radius:50%;box-shadow:0 2px 8px rgba(38,186,165,.10);overflow:hidden;vertical-align:middle;">
                            <img src="{{ asset('images/isologo-ife-educabol-ofical-instituto-de-formacion-educabol.png') }}" alt="Isologo de IFE Educabol" style="width:44px;height:44px;object-fit:contain;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);">
                        </span>
                    </div>
                    <h4 class="mb-0" style="font-weight:900;letter-spacing:1px;">Mi Perfil</h4>
                </div>
                <div class="card-body p-5" style="background:rgba(38,186,165,.03);border-bottom-left-radius:1rem;border-bottom-right-radius:1rem;">
                    @if(session('status') === 'profile-updated')
                        <div class="alert alert-success text-center mb-4 animate__animated animate__fadeInDown" style="border-radius:12px;">
                            <strong>¡Perfil actualizado correctamente!</strong>
                        </div>
                    @endif
                    <form action="{{ route('profile.update') }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <label for="name" class="form-label" style="color:rgb(55,95,122);font-weight:700;">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg" value="{{ old('name', Auth::user()->name) }}" required style="border-radius:12px;">
                            @error('name')
                                <div class="small mt-1" style="color:#dc3545;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="form-label" style="color:rgb(55,95,122);font-weight:700;">Teléfono</label>
                            <input type="text" name="phone" id="phone" class="form-control form-control-lg" value="{{ old('phone', Auth::user()->phone) }}" required style="border-radius:12px;">
                            @error('phone')
                                <div class="small mt-1" style="color:#dc3545;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label" style="color:rgb(55,95,122);font-weight:700;">Nueva contraseña <span class="text-muted small">(opcional)</span></label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg" style="border-radius:12px;">
                            @error('password')
                                <div class="small mt-1" style="color:#dc3545;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label" style="color:rgb(55,95,122);font-weight:700;">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" style="border-radius:12px;">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-corporativo btn-lg" style="border-radius:14px;font-weight:700;letter-spacing:1px;">Actualizar Perfil</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
