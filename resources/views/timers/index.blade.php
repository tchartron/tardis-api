@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Timers</div>

                <div class="card-body">
                    <a href="{{ route('groups.index') }}" class="btn btn-primary" role="button">{{ __('Go to work') }}</a>
                    <hr />
                    @foreach ($timers as $timer)
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div>
                                    <span class="font-weight-bold">{{ __('By user : ') }}</span>
                                    {{ $timer->user->name }}
                                </div>
                                <div>
                                    <span class="font-weight-bold">{{ __('For task : ') }}</span>
                                    <a href="{{ route('tasks.show', ['task' => $timer->task->id]) }}">{{ $timer->task->title }}</a>
                                </div>
                                <div>
                                    <span class="font-weight-bold">{{ __('For group : ') }}</span>
                                    {{ $timer->task->group->name }} {{-- Thug life --}}
                                </div>
                                <div>
                                    <span class="font-weight-bold">{{ __('Time spent : ') }}</span>
                                    {{ $timer->getTimeSpent() }}
                                </div>
                                {{-- <a href="{{ route('groups.edit', ['id' => $timer->id]) }}" class="btn btn-success" role="button">{{ __('Edit') }}  {{ $timer->name }}</a> --}}
                            </div>
                        </div>
                        <hr />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
