<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
</head>
<body>
    <h1>Add Item to Cart</h1>

    <p>
        Welcome, {{ Auth::user()->name }} |
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
    </p>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    {{-- Success and error messages --}}
    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    {{-- Add to Cart Form --}}
    <form method="POST" action="{{ route('cart.add') }}">
        @csrf

        <label>Product Name:</label><br>
        <input type="text" name="product_name" required><br><br>

        <label>Quantity:</label><br>
        <input type="number" name="quantity" required min="1"><br><br>

        <label>Amount (MMK):</label><br>
        <input type="number" name="amount" required min="0" step="0.01"><br><br>

        <button type="submit">Add to Cart</button>
    </form>

    <hr>

    {{-- Cart Items List --}}
    <h2>Your Cart Items</h2>

    @php $total = 0; @endphp

    <ul>
        @forelse($cartItems as $item)
            <li>
                {{ $item->product_name }} - Qty: {{ $item->quantity }} - MMK {{ number_format($item->amount, 2) }}
                @php $total += $item->amount * $item->quantity; @endphp
            </li>
        @empty
            <li>No items in your cart.</li>
        @endforelse
    </ul>

    {{-- Show total and Place Order --}}
    @if($cartItems->count())
        <p><strong>Total: MMK {{ number_format($total, 2) }}</strong></p>

        <form method="POST" action="{{ route('cart.order') }}">
            @csrf
            <button type="submit">Place Order</button>
        </form>
    @endif
</body>
</html>
