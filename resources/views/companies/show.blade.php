@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Company {{ $company->name }}</div>

                <div class="card-body">
                    <div class="my-2">{{ $company->description }}</div>
                    <a class="d-block btn btn-warning" href="{{ route('companies.index') }}">{{ __('Start to work for') }} {{ $company->name }}</a> {{-- On click we should trigger a vuejs component to track time visually  and change the button to pause / stop--}}
{{--                     <h2><time>00:00:00</time></h2>
                    <button id="start">START</button>
                    <button id="stop">STOP</button>
                    <button id="clear">RESET</button> --}}
                    <div class="text-center">
                        <div id="timer">00:00:00</div>
                        <button id="start">Start</button>
                        <button id="pause">Pause</button>
                        <button id="stop">Stop</button>
                    </div>
                    <hr />
                    <a class="d-block" href="{{ route('companies.index') }}">{{ __('Back to companies') }}</a>
                    <a href="{{ route('companies.edit', ['id' => $company->id]) }}" class="btn btn-success" role="button">{{ __('Edit') }}</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
