@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('global.export') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.export.export") }}">
                @method('POST')
                @csrf

                <div class="row">
                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="required" for="{{ $name = 'type' }}">{{ __("global.export") }}</label>
                        <select name="{{ $name }}" id="{{ $name }}" class="form-control">
                            @foreach($types as $type)
                                <option value="{{ $type }}" {{ old($name) == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ __('global.export') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
@endsection
