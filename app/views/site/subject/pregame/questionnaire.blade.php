@extends('site.layouts.generic')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Pre-Show Questionnaire</h3>
            </div>

            <div class="panel-body">
                {{ Form::open(array('url'=>$postUrl, 'method'=>'post', 'class'=>'form-horizontal', 'role'=>'form')) }}

                {{-- TV Fan --}}
                <div class="col-sm-11 form-group {{ ($errors->has($tvFan)) ? 'has-error' : '' }} ">
                    {{ Form::label($tvFan, 'Do you like watching TV in general?', ['class'=>'']) }}
                    <p>(1 not very much, 7 more than all other types of entertainment)</p>
                    {{ Form::select($tvFan, $tvFanOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($tvFan) }}</span>
                </div>

                {{-- Action Drama Fan --}}
                <div class="col-sm-11 form-group {{ ($errors->has($actionDramaFan)) ? 'has-error' : '' }} ">
                    {{ Form::label($actionDramaFan, 'Do you like watching Action/Drama/Crime programs like NCIS, NCIS LA, and Person of Interest?', ['class'=>'']) }}
                    <p>(1 not very much, 7 this is my favorite kind of show to watch)</p>
                    {{ Form::select($actionDramaFan, $actionDramaFanOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($actionDramaFan) }}</span>
                </div>

                {{-- Measure Like NCIS --}}
                <div class="col-sm-11 form-group {{ ($errors->has($measureLikeNcis)) ? 'has-error' : '' }} ">
                    {{ Form::label($measureLikeNcis, 'How strongly do you like watching NCIS?', ['class'=>'']) }}
                    <p>(1 not at all, 3 somewhat, 5 a lot, 7 passionately)</p>
                    {{ Form::select($measureLikeNcis, $measureLikeNcisOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($measureLikeNcis) }}</span>
                </div>

                {{-- Measure Like NCIS LA --}}
                <div class="col-sm-11 form-group {{ ($errors->has($measureLikeNcisLa)) ? 'has-error' : '' }} ">
                    {{ Form::label($measureLikeNcisLa, 'How strongly do you like watching NCIS LA?', ['class'=>'']) }}
                    <p>(1 not at all, 3 somewhat, 5 a lot, 7 passionately)</p>
                    {{ Form::select($measureLikeNcisLa, $measureLikeNcisLaOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($measureLikeNcisLa) }}</span>
                </div>

                {{-- Measure Like Person of Interest --}}
                <div class="col-sm-11 form-group {{ ($errors->has($measureLikePersonOfInterest)) ? 'has-error' : '' }} ">
                    {{ Form::label($measureLikePersonOfInterest, 'How strongly do you like watching Person of Interest?', ['class'=>'']) }}
                    <p>(1 not at all, 3 somewhat, 5 a lot, 7 passionately)</p>
                    {{ Form::select($measureLikePersonOfInterest, $measureLikePersonOfInterestOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($measureLikePersonOfInterest) }}</span>
                </div>

                <div class="col-sm-11">
                    {{ Form::button('Submit Questionnaire', ['type'=>'submit', 'class'=>'btn btn-default']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop
