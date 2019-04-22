@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $task->title }}</div>

                <div class="card-body">
                    <div class="my-2">
                        <p class="lead">{{ $task->description }}</p>
                        <p class="lead"><span class="font-weight-bold">{{ __('Company :') }}</span> {{ $task->company->name }}</p>
                        {{-- <p class="lead"><span class="font-weight-bold">{{ __('User :') }}</span> {{ $task->user_id }}</p> --}}
                         @if (!$task->completed)
                            <p class="lead"><span class="font-weight-bold text-success">{{ __('Status : Open') }}</span></p>
                        @else
                            <p class="lead"><span class="font-weight-bold text-danger">{{ __('Status : Closed') }}</span></p>
                        @endif
                        <a class="btn btn-dark" href="{{ route('tasks.index') }}" role="button"><-{{ __('Back to tasks') }}</a>
                        <a class="btn btn-primary" href="{{ route('tasks.edit', ['id' => $task->id]) }}" role="button">{{ __('Edit') }} {{ $task->title }}</a>
                    </div>
                    <hr />
                    <div class="text-center">
                        @if (!$task->completed)
                            <h5 class="card-title">{{ __('Work on task :') }} {{ $task->title }}</h5>
                            <div class="card-text">
                                <div id="timer" class="">
                                    {{-- {{ var_dump($runningTimerSeconds) }} --}}
                                     <timer-component :task-id="'{!! json_encode($task->id) !!}'" :running-timer-seconds='{!! json_encode($runningTimerSeconds) !!}' :timer-id='{!! json_encode($timerId) !!}'></timer-component>
                                </div>
                                 {{-- <form method="POST" action="{{ route('timers.update', ['timer' => 2]) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input id="timer_id" name="timer_id" type="hidden" value="0" />
                                    <button id="stopTimer" type="submit">Stop</button>
                                </form> --}}
                            </div>
                        @else
                            <h5 class="card-title">{{ __('This task is closed reopen it to work on it') }}</h5>
                        @endif
                    </div>
                    <hr />
                    <div class="text-center">
                        <h5 class="card-title">{{ __('Times spent on task') }} {{ $task->title }}</h5>
                        <div class="card-text">
                            {{-- List of times --}}
                            @foreach ($task->timers as $timer)
                                <div>
                                    <div>- By user : {{ $timer->user_id }}</div>
                                    <div>- Started at : {{ $timer->created_at }}</div>
                                    <div>- Finished at : {{ $timer->finished_at }}</div>
                                    <div>- Time spent : {{ $timer->getTimeSpent() }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
