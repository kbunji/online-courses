@extends('layouts.app1')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    @if ($errors->has('error'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('error') }}</strong>
                                    </span>
                    @endif
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('verify.phone.update') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="phone_number" value="{{ $phoneNumber }}">

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone_code" class="col-md-4 control-label">На номер телефона - {{ $phoneNumber }} был отправлен код, введите его для подтверждения.</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="phone_code"
                                           value="" required>

                                    @if ($errors->has('phone_code'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Подтвердить
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection