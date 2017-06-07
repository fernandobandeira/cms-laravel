@extends('main')

@section('app')
<layout>
    <datatable>
        <component is="{{$component}}"></component>
    </datatable>
</layout>
@endsection