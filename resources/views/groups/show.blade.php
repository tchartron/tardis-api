@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Group {{ $group->name }}</div>

                <div class="card-body">
                    <div class="my-2">
                        <p class="lead">{{ $group->description }}</p>
                        <a class="btn btn-dark" href="{{ route('groups.index') }}" role="button"><-{{ __('Back to groups') }}</a>
                        <a class="btn btn-primary" href="{{ route('groups.edit', ['id' => $group->id]) }}" role="button">{{ __('Edit') }} {{ $group->name }}</a>
                    </div>
                    {{-- <a class="d-block btn btn-warning" href="{{ route('groups.index') }}">{{ __('Start to work for') }} {{ $group->name }}</a> --}}
                    {{-- On click we should trigger a vuejs component to track time visually  and change the button to pause / stop--}}
                    <hr />
                    <div class="text-center">
                        <h5 class="card-title">{{ __('Tasks for') }} {{ $group->name }}</h5>
                        <a class="btn btn-secondary" href="{{ route('tasks.create', ['group' => $group->id]) }}" role="button">{{ __('Create new task for') }} {{ $group->name }}</a>
                        <hr />
                        <div class="card-text">
                            {{-- List of tasks --}}
                            @foreach ($group->tasks as $task)
                                <div class="task">
                                    <a class="" href="{{ route('tasks.show', ['task' => $task->id]) }}">{{ $task->title }}</a>
                                </div>
                            @endforeach
                        </div>
                    <hr />
                    </div>
                    {{-- <div class="text-center">
                        <h5 class="card-title">{{ __('Work for') }} {{ $group->name }}</h5>
                        <div id="timer">00:00:00</div>
                        <form id="timer_start" method="POST" action="{{ route('timers.store') }}">
                            @csrf
                            <input id="group_id" type="hidden" name="group_id" value="{{ $group->id }}" />
                        </form>
                        <button id="start" class="btn btn-primary">{{ __('Start') }}</button>
                        <button id="pause" class="btn btn-warning">{{ __('Pause') }}</button>
                        <button id="reset" class="btn btn-danger">{{ __('Reset') }}</button><br /><hr />
                        <button id="save" class="btn btn-success" onclick="">{{ __('Save') }}</button>
                    </div> --}}
                    <div class="text-center">
                        <h5 class="card-title">{{ __('Time spent for') }} {{ $group->name }}</h5>
                        <div class="card-text">
                            {{-- List of timers --}}
                            {{ $group->totalTimeSpent() }}
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
