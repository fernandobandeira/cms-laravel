@extends('layout')

@section('content')
<datatable>
    <component is="{{$component}}"></component>
</datatable>
@endsection