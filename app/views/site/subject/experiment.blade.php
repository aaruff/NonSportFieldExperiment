@extends('site.layouts.generic')

@section('content')

@if ($displayTask)
    @if ($displayRiskAversion)
        @include('site.subject.experiment.treatment.riskAversion', array('isFirstEntry'=>$isFirstEntry, 'endowment'=>$endowment, 'taskId'=>$riskAversionTaskId, 'gambleProbability'=>$gambleProbability, 'lowPrize'=>$lowPrize, 'highPrize'=>$highPrize, 'gamblePayment'=>$gamblePayment))
    @elseif ($displayWillingnessPay)
        @include('site.subject.experiment.treatment.willingnessPay', array('getGood'=>$getGood, 'good'=>$good, 'goodOptions'=>$goodOptions, 'endowment'=>$endowment, 'taskId'=>$willingnessPayTaskId, 'willingPayKey'=>$willingPayKey))
    @elseif ($displayUltimatum)
        @if ($isUltimatumProposer)
            @include('site.subject.experiment.treatment.ultimatum_proposer', array('taskId'=>$ultimatumTaskId, 'totalAmount'=>$ultimatumTotalAmount, 'amountKey'=>$amountKey))
        @else
            @include('site.subject.experiment.treatment.ultimatum_receiver', array('taskId'=>$ultimatumTaskId, 'totalAmount'=>$ultimatumTotalAmount, 'amountKey'=>$amountKey))
        @endif
    @elseif ($displayTrust)
        @if ($isTrustProposer)
            @include('site.subject.experiment.treatment.trust_proposer', array('isFirstEntry'=>$isFirstEntry,'taskId'=>$trustTaskId, 'proposerAllocationOptions'=>$proposerAllocationOptions, 'numProposerAllocations'=>$numProposerAllocations, 'allocationKey'=>$allocationKey))
        @else
            @include('site.subject.experiment.treatment.trust_receiver', array('isFirstEntry'=>$isFirstEntry,'taskId'=>$trustTaskId, 'receiverMultiplier'=>$receiverMultiplier, 'receiverAllocationOptions'=>$receiverAllocationOptions, 'numReceiverAllocations'=>$numReceiverAllocations, 'allocationKey'=>$allocationKey))
        @endif
    @elseif ($displayDictator)
        @include('site.subject.experiment.treatment.dictator', array('taskId'=>$dictatorTaskId, 'getCharity'=>$getCharity, 'charity'=>$charity, 'charityOptions'=>$charityOptions, 'endowment'=>$dictatorEndowment, 'allocationKey'=>$dictatorAllocationKey))
    @endif
@else
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Show Questionnaire</h3>
            </div>

            <div class="panel-body">
                {{ Form::open(array('url'=>$postUrl, 'method'=>'post', 'class'=>'form-horizontal', 'role'=>'form')) }}

                {{-- Surprise Level --}}
                <div class="col-sm-11 form-group {{ ($errors->has($surpriseLevel)) ? 'has-error' : '' }} ">
                    {{ Form::label($surpriseLevel, 'How surprised are you about the recent events in the show, i.e. events since the last commercial break entry?', ['class'=>'']) }}
                    <p>(1 not at all, 3 somewhat, 5 a lot, 7 incredibly)</p>
                    {{ Form::select($surpriseLevel, $surpriseLevelOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($surpriseLevel) }}</span>
                </div>

                {{-- Excitation Level --}}
                <div class="col-sm-11 form-group {{ ($errors->has($excitationLevel)) ? 'has-error' : '' }} ">
                    {{ Form::label($excitationLevel, 'How exciting do you find the show you are watching?', ['class'=>'']) }}
                    <p>(1 not at all, 3 somewhat, 5 a lot, 7 incredibly)</p>
                    {{ Form::select($excitationLevel, $excitationLevelOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($excitationLevel) }}</span>
                </div>

                {{-- Happiness Level --}}
                <div class="col-sm-11 form-group {{ ($errors->has($happinessLevel)) ? 'has-error' : '' }} ">
                    {{ Form::label($happinessLevel, 'How do you feel right now?', ['class'=>'']) }}
                    <p>(1 very unhappy, 2 unhappy, 3 somewhat unhappy, 4 neither happy nor unhappy, 5 somewhat happy,
                         6 happy, 7 very happy)</p>
                    {{ Form::select($happinessLevel, $happinessLevelOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($happinessLevel) }}</span>
                </div>

                {{-- Outcome Certainty --}}
                <div class="col-sm-11 form-group {{ ($errors->has($likelinessWinningLevel)) ? 'has-error' : '' }} ">
                    {{ Form::label($happinessLevel, 'How strongly do you feel you know the final outcome of this episode?', ['class'=>'']) }}
                    <p>(0 means I have no idea, 100 means definitely know.)</p>
                    {{ Form::select($likelinessWinningLevel, $likelinessWinningLevelOptions, 'default', ['class'=>'form-control']) }}
                    <span class="error">{{ $errors->first($likelinessWinningLevel) }}</span>
                </div>

                <div class="col-sm-11">
                    {{ Form::button('Submit', ['type'=>'submit', 'class'=>'btn btn-default']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@endif

@stop
