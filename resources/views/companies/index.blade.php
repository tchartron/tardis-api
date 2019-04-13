@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Companies</div>

                <div class="card-body">
                    <a href="{{ route('companies.create') }}" class="btn btn-primary" role="button">{{ __('Create new company') }}</a>
                    <hr />
                    @foreach ($companies as $company)
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div>
                                    <span class="font-weight-bold">{{ __('Company name : ') }}</span>
                                    <a href="/companies/{{ $company->id }}">{{ $company->name  }}</a>
                                    <a href="{{ route('companies.edit', ['id' => $company->id]) }}" class="btn btn-success" role="button">{{ __('Edit') }}</a>

                                </div>
                                <div>
                                    <span class="font-weight-bold">{{ __('Company Description : ') }}</span>
                                    {{ $company->description }}
                                </div>
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
