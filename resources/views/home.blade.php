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
                        <span class="d-block">Welcome to Tardis <span class="font-weight-bold">{{ Auth::user()->name }}</span></span>
                        <p>Manage times spent on tasks for groups</p>
                    </div>
                    {{-- STATS GOES HERE  --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
