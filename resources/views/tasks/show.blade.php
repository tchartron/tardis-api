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
                        <p class="lead"><span class="font-weight-bold">{{ __('Company :') }}</span> {{ $task->company_id }}</p>
                        <p class="lead"><span class="font-weight-bold">{{ __('User :') }}</span> {{ $task->user_id }}</p>
                        <p class="lead"><span class="font-weight-bold">{{ __('Finished :') }}</span> {{ $task->completed }}</p>
                        <a class="btn btn-dark" href="{{ route('tasks.index') }}" role="button"><-{{ __('Back to tasks') }}</a>
                        <a class="btn btn-primary" href="{{ route('tasks.edit', ['id' => $task->id]) }}" role="button">{{ __('Edit') }} {{ $task->title }}</a>
                    </div>
                    <hr />
                    <div class="text-center">
                        <h5 class="card-title">{{ __('Times spent on task') }} {{ $task->title }}</h5>
                        <div class="card-text">
                            {{-- List of times --}}
                        </div>
                    </div>
                    <hr />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
