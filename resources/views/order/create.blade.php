@extends('layouts.app')


@section('content')
    {{ Form::model($order, ['url' => route('orders.store')]) }}
	    @include('order.form')
	    {{ Form::submit('Создать') }}
    {{ Form::close() }}
@endsection