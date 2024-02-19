@extends('admin.layout.default')

@section('title', __('Reception Home'))

@section('body')

@can('admin.owner')
@include('admin.owners.index')
@endcan

@if (Auth::user()->inDepartment('reception'))
@include('admin.reception.index')
@endif

@if (Auth::user()->inDepartment('general_consulation'))

@include('admin.general-consulation.index')
@endif

@if (Auth::user()->inDepartment('accounting'))
@include('admin.accounting.index')
@endif

@if (Auth::user()->inDepartment('pharmacy'))
@include('admin.pharmacy.index')
@endif

@if (Auth::user()->inDepartment('lab_department'))
@include('admin.lab-department.index')
@endif




@endsection
