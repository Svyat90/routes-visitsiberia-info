@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <div class="login-logo">
            <a href="{{ route('admin.home') }}">
                {{ config('app.name') }}
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                {{ trans('global.reset_password') }}
            </p>

            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    <div class="form-group">
                        <input type="hidden" name="locale" value="{{ app()->getLocale() }}">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required autocomplete="email" autofocus placeholder="{{ trans('global.email') }}" value="{{ old('email') }}">

                        @if($errors->has('email'))
                            <span class="text-danger">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary btn-flat btn-block" style="background-color: #970C13; border-color: #970C13;">
                            {{ trans('global.send_password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
