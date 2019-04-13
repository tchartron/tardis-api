@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Company {{ $company->name }}</div>

                <div class="card-body">
                    {{ $company->description }}
                    <a class="d-block" href="{{ route('companies.index') }}">{{ __('Back to companies') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
