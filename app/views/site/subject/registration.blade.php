@extends('site.layouts.generic')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Registration Form</h3>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url'=>$postUrl, 'method'=>'post', 'class'=>'form-horizontal', 'role'=>'form')) }}

                {{-- First Name --}}
                <div class="form-group {{ ($errors->has($firstName)) ? 'has-error' : '' }} ">
                    {{ Form::label($firstName, 'First Name', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-sm-6">
                        {{ Form::text($firstName, Input::old($firstName), ['class'=>'form-control', 'placeholder'=>'First Name']) }}
                        <span class="error">{{ $errors->first($firstName) }}</span>
                    </div>
                </div>

                {{-- Last Name --}}
                <div class="form-group {{ ($errors->has($lastName)) ? 'has-error' : '' }} ">
                    {{ Form::label($lastName, 'Last Name', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-sm-6">
                        {{ Form::text($lastName, Input::old($lastName), ['class'=>'form-control', 'placeholder'=>'Last Name']) }}
                        <span class="error">{{ $errors->first($lastName) }}</span>
                    </div>
                </div>

                {{-- Work Status --}}
                <div class="form-group {{ ($errors->has($workStatus)) ? 'has-error' : '' }} ">
                    {{ Form::label($workStatus, 'Work Status', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-sm-6">
                        {{ Form::select($workStatus, $workStatusOptions, 'default', ['class'=>'form-control']) }}
                        <span class="error">{{ $errors->first($workStatus) }}</span>
                    </div>
                </div>

                {{-- Education --}}
                <div class="form-group {{ ($errors->has($education)) ? 'has-error' : '' }} ">
                    {{ Form::label($education, 'Education', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-sm-6">
                        {{ Form::select($education, $educationOptions, 'default', ['class'=>'form-control']) }}
                        <span class="error">{{ $errors->first($education) }}</span>
                    </div>
                </div>


                {{-- Gender --}}
                <div class="form-group {{ ($errors->has($gender)) ? 'has-error' : '' }} ">
                    {{ Form::label($gender, 'Gender', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-sm-6">
                        {{ Form::select($gender, $genderOptions, 'default', ['class'=>'form-control']) }}
                        <span class="error">{{ $errors->first($gender) }}</span>
                    </div>
                </div>

                {{-- Age --}}
                <div class="form-group {{ ($errors->has($age)) ? 'has-error' : '' }} ">
                    {{ Form::label($age, 'Age', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-sm-6">
                        {{ Form::select($age, $ageOptions, 'default', ['class'=>'form-control']) }}
                        <span class="error">{{ $errors->first($age) }}</span>
                    </div>
                </div>

                {{-- Income --}}
                <div class="form-group {{ ($errors->has($income)) ? 'has-error' : '' }} ">
                    {{ Form::label($income, 'Income', ['class'=>'col-sm-3 control-label']) }}
                    <div class="col-sm-6">
                        {{ Form::select($income, $incomeOptions, 'default', ['class'=>'form-control']) }}
                        <span class="error">{{ $errors->first($income) }}</span>
                    </div>
                </div>

                <div class="col-md-offset-3">
                    {{ Form::button('Register', ['type'=>'submit', 'class'=>'btn btn-default']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop
