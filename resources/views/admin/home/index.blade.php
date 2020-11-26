@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('global.dashboard') }}
                    </div>

                    <div class="card-body">
                        <div class="row">
                            {{ __('global.welcome') }} &nbsp;<b>{{ auth()->user()->email }}</b>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
