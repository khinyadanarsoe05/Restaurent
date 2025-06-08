<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@if (session('status'))
<div class="alert alert-success alert-dismissible">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>

        {{ session('status') }}

</strong>
</div>
@endif
    @extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <div class="card">
              <div class="card-header">
                <h3 class="card-title">Dish Data</h3>
                <form action="/dish/create" method="get">
                    @csrf
                    <button type="submit" class="btn btn-success" style="float: right">Create Dish</button>
                </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dishes" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Dish Name</th>
                    <th>Category Name</th>
                    <th>Image</th>
                    <th>Created</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  @foreach ($dishes as $dish )
                  <tr>
                    <td>{{$dish->name}}</td>
                    <td>{{$dish->category->name}}</td>
                    <td><img src="{{ asset('storage/' . $dish->dish_image) }}" alt="Dish Image" width="150px" height='100px'></td>
                    <td>{{$dish->created_at}}</td>
                    <td><form action="dish/{{$dish->id}}" method="post">@csrf @method('delete')<a href="dish/{{$dish->id}}/edit" class="btn btn-primary">Edit</a>
                    <button type="submit" class="btn btn-danger">Delete</button></form></td>
                  </tr>

                  @endforeach
                   </table>
              </div>
              <!-- /.card-body -->
     </div>
</body>
</html>


  </div>
  <!-- /.content-wrapper -->
  <script src="plugins/jquery/jquery.min.js"></script>
<script>
  $(function () {

    $('#dishes').DataTable({
      "paging": true,
      "pageLength": 20,
        "order": [[0, "desc"]]
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection





