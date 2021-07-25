@extends('layout')

@section('content')
    <div class="mt-4">
        <div class="mt-4 mb-4">
            <h1>{{ $title }}</h1>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <td>ID</td>
                <td>Partner</td>
                <td>Totals</td>
                <td>Products</td>
                <td>Status</td>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>
                        <a href="{{ route('order.edit', $order->id) }}">{{ $order->id }}</a>
                    </td>
                    <td>{{ $order->getPartner()->name }}</td>
                    <td><b>{{ $order->getTotal() }} ₽</b></td>
                    <td>
                        @foreach($order->getProducts() as $orderProduct)
                            <p>{{ $orderProduct->getAttribute('name') }}
                                <span class="badge badge-pill badge-primary">{{ $orderProduct->getAttribute('quantity') }}</span>
                            </p>
                        @endforeach
                    </td>
                    <td>
                        <span class="badge badge-{{ strtolower($order->getStatus()) }}">{{ $order->getStatus() }}</span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    <div>
@endsection