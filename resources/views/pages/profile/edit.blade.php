@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4 w-50 p-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1 class="mb-0 fw-semibold fs-5">Change Password</h1>
                </div>
                <div class="card-body">
                    <div class="card-text alert bg-primary">
                        <p class="fw-semibold p-1">
                            You can change your password by requesting a reset link to your registered email address.
                        </p>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="change-password-form" method="POST" action="{{route('profile.update')}}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')

@endpush
