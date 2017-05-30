@extends('layout')

@section('content')
<div class="datatable">
    <datatable>
        @yield('columns')
    </datatable>
</div>
@endsection