@extends('layouts.app', ['title' => __('Administración de la  compañia')])

@section('content')
    @include('restorants.partials.header', ['title' => $title])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Administración de la  compañia') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('admin.restaurants.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">{{ __('Informacion de la compañia') }}</h6>
                        <div class="pl-lg-4">
                            <form method="post" action="{{ route('admin.restaurants.store') }}">
                                @csrf
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="name">{{ __('Nombre de la compañia') }}</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }} ..." value="" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <hr />
                                <h6 class="heading-small text-muted mb-4">{{ __('Informacion del dueño de la compañia') }}</h6>

                                    <div class="form-group{{ $errors->has('name_owner') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="name_owner">{{ __('Nombre del dueño') }}</label>
                                        <input type="text" name="name_owner" id="name_owner" class="form-control form-control-alternative{{ $errors->has('name_owner') ? ' is-invalid' : '' }}"  value="" required autofocus>
                                        @if ($errors->has('name_owner'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name_owner') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('email_owner') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="email_owner">{{ __('Email') }}</label>
                                        <input type="email" name="email_owner" id="email_owner" class="form-control form-control-alternative{{ $errors->has('email_owner') ? ' is-invalid' : '' }}"  value="" required autofocus>
                                        @if ($errors->has('email_owner'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email_owner') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    @include('partials.input',['type'=>"text", 'name'=>'Owner Phone','id'=>"phone_owner",'placeholder'=>"Telefono",'required'=>true,'value'=>""])
                                    @if (isset($_GET['cloneWith']))
                                        <input type="hidden" id="cloneWith" name="cloneWith" value="{{ $_GET['cloneWith'] }}" />
                                    @endif
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
