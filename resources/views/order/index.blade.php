<!-- Хранится в resources/views/about.blade.php -->

@extends('layouts.app')

<!-- Секция, содержимое которой обычный текст. -->
@if (Session::has('status'))
	{{ Session::get('status') }}
@endif
<!-- Секция, содержащая HTML блок. Имеет открывающую и закрывающую часть. -->
@section('content')
    <h1>Список заказов</h1>
    @foreach ($orders as $order)
        <div>
	        <a href= "{{ route('orders.show', $order)}}" ><h2>{{$order->name}}</h2></a>
	        <h4>{{$order->city}}</h4>
	        <h4>{{$order->address}}</h4>
	        {{-- Str::limit – функция-хелпер, которая обрезает текст до указанной длины --}}
	        {{-- Используется для очень длинных текстов, которые нужно сократить --}}
	        <div>{{Str::limit($order->products, 200)}}</div>
        </div>
    @endforeach
@endsection