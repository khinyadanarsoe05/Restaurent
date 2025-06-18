<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Available Products</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@foreach($products as $product)
    <div style="border:1px solid #ccc; padding:10px; margin:10px;">
        <strong>{{ $product->name }}</strong><br>
        Price: MMK {{ number_format($product->price, 2) }}
        <form method="POST" action="{{ route('cart.add', $product->id) }}">
            @csrf
            <label>Quantity:</label>
            <input type="number" name="quantity" value="1" min="1" required>
            <button type="submit">Add to Cart</button>
        </form>
    </div>
@endforeach

</body>
</html>
