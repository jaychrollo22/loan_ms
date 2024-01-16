@extends('layouts.app')

@section('content')
    <grouping-form :id="{{ $id ? $id : 0 }}"></grouping-form>
@endsection