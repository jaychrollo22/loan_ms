@extends('layouts.app')

@section('content')
@section('content')
  <dashboard :user="'{{ auth()->user()->name }}'"></dashboard> 
@endsection
