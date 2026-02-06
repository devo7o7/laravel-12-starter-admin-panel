@extends('layouts.admin')

@section('title', 'Profile Settings')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <h4 class="fw-bold mb-0">{{ __('Profile') }}</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active">Settings</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8 mx-auto">
            
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4 p-sm-5">
                    <div style="max-width: 600px;">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4 p-sm-5">
                    <div style="max-width: 600px;">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-3 border-top border-danger border-3">
                <div class="card-body p-4 p-sm-5">
                    <div style="max-width: 600px;">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection