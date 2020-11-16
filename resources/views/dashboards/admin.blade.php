@extends('layouts.app')

@section('content')
    <div class="row justify-content-around">
        <div class="col-sm-12 col-md-10 col-lg-8">
            @livewire('qa_app::admin-dashboard')
        </div>
    </div>
@endsection