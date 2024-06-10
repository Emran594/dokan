@extends('layout.sidenav-layout')
@section('content')
    @include('components.sale.sale-list')
    @include('components.category.category-delete')
    @include('components.category.category-update')
@endsection