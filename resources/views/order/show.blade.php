@extends('layouts.app')

@section('content')
    <a href="{{ route('orders.show', $order) }}"><h1>{{$order->name}}</h1></a>
    <div>{{$order->products}}</div>
    <a href="{{ route('orders.destroy', $order) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
@endsection