@extends('layouts.mainpage')

@section('title', 'Главная страница')

@section('content')



    @include('foundation-items.orbit')
    @include('foundation-items.grid')
    @include('foundation-items.callout')
    @include('foundation-items.table')
    @include('foundation-items.pagination')
    <br>
    @include('foundation-items.modal')
    <br>
    @include('foundation-items.tabs')
    <br>
    @include('foundation-items.other')



@endsection
