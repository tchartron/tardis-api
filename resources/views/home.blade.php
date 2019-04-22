@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Timeinator dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="border border-primary rounded">
                        <span class="d-block">Welcome to timeinator <span class="font-weight-bold">{{ Auth::user()->name }}</span></span>
                        <p>This is the web front end to manage times spent on tasks for companies</p>
                    </div>
                    {{-- STATS GOES HERE  --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
