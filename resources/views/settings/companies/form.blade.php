@extends('layouts.app')

@section('content')
    <company-form :id="{{ $id ? $id : 0 }}"></company-form>
@endsection