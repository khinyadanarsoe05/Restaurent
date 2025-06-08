<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
</head>
<body>
    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>  {{ session('status') }}</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
        <!-- ./row -->
        <div class="card">
            <div class="card-body">
              <form action="{{ url('/order') }}" method="GET">
    <input type="text" name="search" class="form-control d-inline-block w-25" placeholder="Search..." value="{{ request('search') }}">
    <button type="submit" class="btn btn-success">Search</button>
    <button type="reset" class="btn btn-secondary">Clear</button>

</form>

        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Profile</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                     <form action="{{route("order.form")}}" method="POST">@csrf
                            <div class="row">
                                 @foreach ($dishes as $dish)
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <div class="card">
                                        <div class="card-body">
                                 <img src="{{ asset('storage/' . $dish->dish_image) }}" alt="Dish Image" width="100px" height='100px'><br><br>
                                 <p>{{$dish->name}}</p>
                                <input type="number" name="{{$dish->id}}" value="0">
                                        </div>
                                        </div>
                                    </div>


                                @endforeach
                                <div class="col-12 col-sm-6">
                                <select name="table">
                                    <option >Choose Table</option>
                                @foreach ($tables as $table )
                                    <option value="{{$table->id}}">{{$table->number}}</option>
                                @endforeach
                                </select>

                            <button type="submit" class="btn btn-success" width="100">Order</button>



                    </div>
                            </form></div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
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
                    <td>{{$order->table->number}}</td>
                    <td>{{$status[$order->status]}}</td>
                    <td><a href="/order/{{$order->id}}/serve" class="btn btn-success">Serve</a>
                    </td>
                  </tr>

                  @endforeach
                   </table>
                  </div>
                </div>
              </div>

              </div>
          </div>



 {{-- <form action="" method="POST">@csrf
                            <div class="row">
                                 @foreach ($dishes as $dish)
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <div class="card">
                                        <div class="card-body">
                                 <img src="{{ asset('storage/' . $dish->dish_image) }}" alt="Dish Image" width="100px" height='100px'><br><br>
                                <input type="number" name="{{$dish->id}}" value="0">
                                        </div>
                                        </div>
                                    </div>


                                @endforeach
                            <button type="submit" class="btn btn-success" width="100">Order</button>

                            </form></div> --}}
</body>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
</html>
