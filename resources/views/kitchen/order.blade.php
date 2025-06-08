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
                <h3 class="card-title">Order Data</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dishes" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Dish Name</th>
                    <th>Table Name</th>
                    <th>Order Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  @foreach ($orders as $order )
                  <tr>
                    <td>{{$order->dish->name}}</td>
                    <td>{{$order->category_id}}</td>
                    <td>{{$status[$order->status]}}</td>
                    <td><a href="/order/{{$order->id}}/approve" class="btn btn-success">Approve</a>
                        <a href="/order/{{$order->id}}/cancel" class="btn btn-danger">Cancle</a>
                        <a href="/order/{{$order->id}}/ready" class="btn btn-success">Ready</a>
                    </td>
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





