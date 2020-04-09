@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{{ Form::label('name', 'Название') }}
{{ Form::text('name') }}<br>
{{ Form::label('city', 'Город') }}
{{ Form::text('city') }}<br>
{{ Form::label('address', 'Адрес') }}
{{ Form::text('address') }}<br>
{{ Form::label('products', 'Продукты') }}
{{ Form::textarea('products') }}<br>