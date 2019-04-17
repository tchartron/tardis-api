@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Company {{ $company->name }}</div>

                <div class="card-body">
                    <div class="my-2">{{ $company->description }}</div>
                    {{-- <a class="d-block btn btn-warning" href="{{ route('companies.index') }}">{{ __('Start to work for') }} {{ $company->name }}</a> --}}
                    {{-- On click we should trigger a vuejs component to track time visually  and change the button to pause / stop--}}
                    <hr />
                    <div class="text-center">
                        <h5 class="card-title">{{ __('Work for') }} {{ $company->name }}</h5>
                        <div id="timer">00:00:00</div>
                        <form id="time_spent" method="POST" action="{{ route('times.store') }}">
                            @csrf
                            <input type="hidden" name="total_time" value="00:00:00" />
                        </form>
                        <button id="start" class="btn btn-primary">{{ __('Start') }}</button>
                        <button id="pause" class="btn btn-warning">{{ __('Pause') }}</button>
                        <button id="reset" class="btn btn-danger">{{ __('Reset') }}</button>
                        <button id="save" class="btn btn-success" onclick="event.preventDefault(); document.getElementById('time_spent').submit();">{{ __('Save') }}</button>
                    </div>
                    <hr />
                    <div class="text-center">
                        <h5 class="card-title">{{ __('Time spent for') }} {{ $company->name }}</h5>
                    </div>
                    <hr />
                    <a class="btn btn-dark" href="{{ route('companies.index') }}" role="button"><-{{ __('Back to companies') }}</a>
                    <a class="btn btn-success" href="{{ route('companies.edit', ['id' => $company->id]) }}" role="button">{{ __('Edit') }} {{ $company->name }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
