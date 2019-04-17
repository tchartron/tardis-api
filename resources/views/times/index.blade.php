@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Times</div>

                <div class="card-body">
                    <a href="{{ route('companies.index') }}" class="btn btn-primary" role="button">{{ __('Go to work') }}</a>
                    <hr />
                    @foreach ($times as $time)
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div>
                                    <span class="font-weight-bold">{{ __('Started at :') }}</span>
                                    {{ $time->started_at }}
                                </div>
                                <div>
                                    <span class="font-weight-bold">{{ __('Finished at : ') }}</span>
                                    {{ $time->finished_at }}
                                </div>
                                <div>
                                    <span class="font-weight-bold">{{ __('By user : ') }}</span>
                                    {{ $time->user_id }}
                                </div>
                                <div>
                                    <span class="font-weight-bold">{{ __('For company : ') }}</span>
                                    {{ $time->company_id }}
                                </div>
                                {{-- <a href="{{ route('companies.edit', ['id' => $time->id]) }}" class="btn btn-success" role="button">{{ __('Edit') }}  {{ $time->name }}</a> --}}
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
