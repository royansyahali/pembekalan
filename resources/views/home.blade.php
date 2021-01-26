@extends('layouts.app')

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <section class="content">
        <div class="card card-secondary card-outline">
            <div class="card-header">
                <h3 class="card-title">Deskripsi Sistem Rent</h3>
            </div>
            <div class="card-body">

            </div>
        </div>
    </section>





@endsection
