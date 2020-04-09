<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate();

        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = new Order();
        if (Auth::check()) {
            $order->id_creator = Auth::id();
            return view('order.create', compact('order'));
        }
        //$request->session()->flash('status', 'Пожалуйста, войдите в свой аккаунт!');
        return redirect()->route('orders.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            // Проверка введённых данных
            // Если будут ошибки, то возникнет исключение
            // Иначе возвращаются данные формы
            $data = $this->validate($request, [
                'name' => 'required|min:6',
                'products' => 'required|min:10',
                'address' => 'required|min:6',
                'city' => 'required|min:3',
            ]);

            $order = new Order();
            // Заполнение статьи данными из формы
            $order->fill($data);
            // При ошибках сохранения возникнет исключение
            $order->save();
        }
        // Редирект на указанный маршрут с добавлением флеш-сообщения
        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //$order = Order::findOrFail($order);
        return view('order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        if (Auth::check() && (Auth::id() == $order->id_creator)) {
            return view('order.edit', compact('order'));
        }
        return redirect()->route('orders.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        (Auth::check() && (Auth::id() == $order->id_creator)){
            $data = $this->validate($request, [
                // У обновления немного изменённая валидация. В проверку уникальности добавляется название поля и id текущего объекта
                // Если этого не сделать, Laravel будет ругаться на то что имя уже существует
                'name' => 'required|unique:orders,name,' . $order->id,
                'products' => 'required|min:10',
                'address' => 'required|min:6',
                'city' => 'required|min:3',
            ]);

            $order->fill($data);
            $order->save();
        }
        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        // DELETE — идемпотентный метод, поэтому результат операции всегда один и тот же
        (Auth::check() && (Auth::id() == $order->id_creator)){
            if ($order) {
                $order->delete();
            }
        }
        return redirect()->route('orders.index');
    }
}
