@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Company {{ $company->name }}</div>

                <div class="card-body">
                    <div class="my-2">
                        <p class="lead">{{ $company->description }}</p>
                        <a class="btn btn-dark" href="{{ route('companies.index') }}" role="button"><-{{ __('Back to companies') }}</a>
                        <a class="btn btn-primary" href="{{ route('companies.edit', ['id' => $company->id]) }}" role="button">{{ __('Edit') }} {{ $company->name }}</a>
                    </div>
                    {{-- <a class="d-block btn btn-warning" href="{{ route('companies.index') }}">{{ __('Start to work for') }} {{ $company->name }}</a> --}}
                    {{-- On click we should trigger a vuejs component to track time visually  and change the button to pause / stop--}}
                    <hr />
                    <div class="text-center">
                        <h5 class="card-title">{{ __('Tasks for') }} {{ $company->name }}</h5>
                        <a class="btn btn-secondary" href="{{ route('tasks.create', ['company' => $company->id]) }}" role="button">{{ __('Create new task for') }} {{ $company->name }}</a>
                        <hr />
                        <div class="card-text">
                            {{-- List of tasks --}}
                            @foreach ($company->tasks as $task)
                                <div class="task">
                                    <a class="" href="{{ route('tasks.show', ['task' => $task->id]) }}">{{ $task->title }}</a>
                                </div>
                            @endforeach
                        </div>
                    <hr />
                    </div>
                    {{-- <div class="text-center">
                        <h5 class="card-title">{{ __('Work for') }} {{ $company->name }}</h5>
                        <div id="timer">00:00:00</div>
                        <form id="timer_start" method="POST" action="{{ route('timers.store') }}">
                            @csrf
                            <input id="company_id" type="hidden" name="company_id" value="{{ $company->id }}" />
                        </form>
                        <button id="start" class="btn btn-primary">{{ __('Start') }}</button>
                        <button id="pause" class="btn btn-warning">{{ __('Pause') }}</button>
                        <button id="reset" class="btn btn-danger">{{ __('Reset') }}</button><br /><hr />
                        <button id="save" class="btn btn-success" onclick="">{{ __('Save') }}</button>
                    </div> --}}
                    <div class="text-center">
                        <h5 class="card-title">{{ __('Time spent for') }} {{ $company->name }}</h5>
                        <div class="card-text">
                            {{-- List of timers --}}
                            {{ $company->totalTimeSpent() }}
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
