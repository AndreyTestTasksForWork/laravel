@extends('layout')

@section('content')
    <div class="mt-4">
        <div class="mt-4 mb-4">
            <h1>{{ $title }}</h1>
        </div>
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif
        <form method="post" action="{{ route('order.update', $order->id ) }}">
            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="client_email">Client Email:</label>
                <input type="text" class="form-control" name="client_email" value="{{ $order->client_email }}" required/>
            </div>
            <div class="form-group">
                <label for="partner">Partner :</label>
                <select class="form-control form-select-lg" name="partner_id" required>
                    @foreach($partners as $partner)
                        @if ($partner->id === $order->getPartner()->id)
                            <option value="{{ $partner->id }}" selected>{{ $partner->name }}</option>
                        @else
                            <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="partner">Products :</label>
                @foreach($products as $orderProduct)
                    <div class="card mt-1 mb-2">
                        <div class="card-body">
                            <p class="mb-0">{{ $orderProduct->getAttribute('name') }}
                                <span class="badge badge-pill badge-primary">{{ $orderProduct->getAttribute('quantity') }}</span>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="form-group">
                <label for="status">Status :</label>
                <select class="form-control form-select-lg" name="status" required>
                    @foreach($order->getStatusMap() as $statusCode => $statusLabel)
                        @if ($statusCode === $order->status)
                            <option value="{{ $statusCode }}" selected>{{ $statusLabel }}</option>
                        @else
                            <option value="{{ $statusCode }}">{{ $statusLabel }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group m3">
                <h3>Totals : {{ $order->getTotal() }} ₽</h3>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    <div>
@endsection
