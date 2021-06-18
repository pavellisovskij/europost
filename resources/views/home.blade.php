@extends('layouts.app')

@section('content')
<div class="container">
    <city-selector-component :offices='@json($offices)'></city-selector-component>
</div>
@endsection
