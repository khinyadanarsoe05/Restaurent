<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Your Cart</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@php $total = 0; @endphp

{{-- <ul>
@forelse($cartItems as $item)
    <li>
        {{ $item->product->name }} - Qty: {{ $item->quantity }} -
        Price: MMK {{ number_format($item->product->price, 2) }} -
        Subtotal: MMK {{ number_format($item->product->price * $item->quantity, 2) }}
        @php $total += $item->product->price * $item->quantity; @endphp
    </li>
@empty
    <li>No items in your cart.</li>
@endforelse
</ul> --}}


<ul>
@forelse($cartItems as $item)
    <li>
        {{ $item->product->name }} -
        Price: MMK {{ number_format($item->product->price, 2) }} <br>

        <!-- Quantity Update Form -->
        <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display:inline;">
            @csrf
            <label>Qty:</label>
            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" required>
            <button type="submit">Update</button>
        </form>

        <!-- Remove Item Form -->
        <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" onclick="return confirm('Remove this item?')">Remove</button>
        </form>

        <br>
        Subtotal: MMK {{ number_format($item->product->price * $item->quantity, 2) }}
        @php $total += $item->product->price * $item->quantity; @endphp
    </li>
@empty
    <li>No items in your cart.</li>
@endforelse
</ul>
@if($cartItems->count())
    <p><strong>Total: MMK {{ number_format($total, 2) }}</strong></p>

    <form method="POST" action="{{ route('cart.order') }}">
        @csrf
        <button type="submit">Place Order</button>
    </form>
@endif
</body>
</html>
