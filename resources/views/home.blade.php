@extends('layouts.app')

@section('title', 'خدمة الطباعة 3D')

@section('content')
    @include('sections.hero')
    @include('sections.services')
    @include('sections.calculator')
    @include('sections.order-form')
    @include('sections.orders')
@endsection
