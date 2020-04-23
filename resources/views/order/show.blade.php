@extends('layouts.app')

@section('content')
    <a href="{{ route('orders.show', $order) }}"><h1>{{$order->name}}</h1></a>
    <div>{{$order->products}}</div> 

    @can('update', $order)
        <a href="{{ route('orders.edit', $order) }}">Редактировать</a>
    @endcan
    
    @can('delete', $order)
	    <a href="{{ route('orders.destroy', $order) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
    @endcan

    @can('viewAny', App\Order::class)
	    {{ Form::model($order, ['url' => route('orders.update', $order), 'method' => 'PATCH']) }}
            {{ Form::label('status', 'Напишите "принимаю", для того чтобы принять заказ') }}
            {{ Form::text('status') }}<br>
	        {{ Form::submit('Принять') }}
        {{ Form::close() }}
    @endcan
    {{ $order->status}}
@endsection