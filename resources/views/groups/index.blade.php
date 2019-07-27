@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Groups</div>

                <div class="card-body">
                    <a href="{{ route('groups.create') }}" class="btn btn-primary" role="button">{{ __('Create new group') }}</a>
                    <hr />
                    @foreach ($groups as $group)
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div>
                                    <span class="font-weight-bold">{{ __('Name :') }}</span>
                                    <a class="" href="/groups/{{ $group->id }}">{{ $group->name }}</a>
                                </div>
                                <div>
                                    <span class="font-weight-bold">{{ __('Description : ') }}</span>
                                    {{ $group->description }}
                                </div>
                                <a href="{{ route('groups.edit', ['id' => $group->id]) }}" class="btn btn-success" role="button">{{ __('Edit') }}  {{ $group->name }}</a>
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
