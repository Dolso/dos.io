@extends('layouts.app')


@section('content')
    {{ Form::model($order, ['url' => route('orders.update', $order), 'method' => 'PATCH']) }}
	    @include('order.form')
	    {{ Form::submit('Обновить') }}
    {{ Form::close() }}
@endsection