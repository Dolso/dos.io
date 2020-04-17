@extends('layouts.app')

@section('content')
    <a href="{{ route('orders.show', $order) }}"><h1>{{$order->name}}</h1></a>
    <div>{{$order->products}}</div> 
    
    @if ($is_this_creator == 1) 
	    <a href="{{ route('orders.destroy', $order) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
	    <a href="{{ route('orders.edit', $order) }}">Редактировать</a>
    @endif
@endsection