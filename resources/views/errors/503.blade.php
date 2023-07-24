@extends('errors::layout')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message')
    <i class="uil uil-exclamation-triangle text-red-700"></i>
    <div>Sorry, we are now undergoing maintenance.<br>Please check back soon.</div>
@endsection
