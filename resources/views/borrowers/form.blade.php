@extends('layouts.app2')

@section('content')
    <borrower-form :id="{{ isset($id) ? $id : 0 }}"></borrower-form>
@endsection