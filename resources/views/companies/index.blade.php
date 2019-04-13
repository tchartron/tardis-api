@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Companies</div>

                <div class="card-body">
                    @foreach ($companies as $company)
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div>
                                    <span class="font-weight-bold">{{ __('Company name : ') }}</span>
                                    <a href="/companies/{{ $company->id }}">{{ $company->name  }}</a>
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
