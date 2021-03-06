@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tasks</div>

                <div class="card-body">
                    {{-- <a href="{{ route('tasks.create') }}" class="btn btn-primary" role="button">{{ __('Create new task') }}</a> --}}
                    <hr />
                    @foreach ($tasks as $task)
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div>
                                    <span class="font-weight-bold">{{ __('Title :') }}</span>
                                    <a class="" href="/tasks/{{ $task->id }}">{{ $task->title }}</a>
                                </div>
                                <div>
                                    <span class="font-weight-bold">{{ __('Group : ') }}</span>
                                    {{ $task->group->name }}
                                </div>
                                <div>
                                    <span class="font-weight-bold">{{ __('Status : ') }}</span>
                                    @if (!$task->completed)
                                        {{ __('Open') }}
                                    @else
                                        {{ __('Closed') }}
                                    @endif
                                </div>
                                {{-- <div>
                                    <span class="font-weight-bold">{{ __('User : ') }}</span>
                                    {{ $task->user }}
                                </div> --}}
                                <a href="{{ route('tasks.edit', ['id' => $task->id]) }}" class="btn btn-success" role="button">{{ __('Edit') }}  {{ $task->title }}</a>
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
