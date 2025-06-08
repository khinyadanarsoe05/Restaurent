<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>
    <title>Document</title>
</head>
<body>

    <div class="form-group">
    <div class="card">
  <div class="card-body">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="/dish/{{$dish->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-6">
  <label for="exampleFormControlInput1" class="form-label">Dish Name</label>
  <input type="text" class="form-control" name="name" value={{old('name',$dish->name)}}>
</div><br>
<div class="mb-6">

    <select class="form-control" name="category_id"><option>Choose Category</option>
        @foreach ($categories as $category )
           <option value="{{$category->id}}" {{$category->id == $dish->category_id ? 'selected' :' '}}>{{$category->name}}</option>
        @endforeach

    </select>

</div><br>
<div class="mb-6">
    <!-- Preview image -->
    <img id="dishPreview" src="{{ asset('storage/' . $dish->dish_image) }}" alt="Current Dish Image" width="150" name="dish_image">


    <label for="dish_image" class="form-label">Upload Dish Image</label>
    <input type="file" class="form-control" name="dish_image" id="dish_image" value="ss">
</div>
  <br>
<div class="mb-6">
<button type="submit" class="btn btn-success">Save</button>
 <button class="btn btn-primary"><a href="/dish" style="text-decoration:none; color:black">Go Back</a></button>
</div>
  </div>
</div></div>
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
<script>
document.getElementById('dish_image').addEventListener('change', function (e) {
    const [file] = e.target.files;
    if (file) {
        document.getElementById('dishPreview').src = URL.createObjectURL(file);
    }
});
</script>


</body>

</body>
</html>
