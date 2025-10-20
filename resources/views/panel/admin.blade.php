@extends('layouts.app') {{-- o tu HTML base --}}
@section('content')
<div class="container py-4">
    <h1>Panel {{ auth()->user()->rol }}</h1>
</div>
@endsection