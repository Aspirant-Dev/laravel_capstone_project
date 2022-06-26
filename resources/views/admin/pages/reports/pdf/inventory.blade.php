
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Inventory Report PDF</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.min.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>
<div class="wrapper">


<section id="invoice" class="content printMe">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card "  style="border-radius: 0px!important">
                    <div class="card-header" style="border-bottom: none!important">
                        <h3 class="text-center mb-0">Inventory Report</h3>
                    </div>
                    <div class="card-body p-2 m-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Category</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Brand</th>
                                                <th>Type</th>
                                                <th>Price</th>
                                                <th>Stocks</th>
                                                <th>Critical Level</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="text-center">
                                            <tr>
                                                <th>Category</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Brand</th>
                                                <th>Type</th>
                                                <th>Price</th>
                                                <th>Stocks</th>
                                                <th>Critical Level</th>
                                                <th>Status</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($prods as $item)
                                                <tr class="text-center">
                                                    <input type="hidden" class="del_val_id" value="{{ $item->id }}">
                                                    <input type="hidden" class="del_val_name" value="{{ $item->name }}">
                                                    <td>{{ $item->category->name }}</td>
                                                    <td>{{ $item->p_code}}</td>
                                                    <td>{{ $item->name}}</td>
                                                    <td>{{ $item->brand }}</td>
                                                    <td>{{ $item->product_type }}</td>
                                                    <td>&#8369; {{ number_format($item->price,2) }}</td>
                                                    @if($item->stocks <= 0)
                                                        <td>Out of Stocks</td>
                                                    @else
                                                        <td>{{ $item->stocks }}</td>
                                                    @endif
                                                    <td>{{ $item->critical_level }}</td>
                                                    @if ($item->status == 1)
                                                    <td>Active</td>
                                                    @else
                                                        <td><span class="badge badge-danger badge-pill">Inactive</span></td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p>
                            <span>As of : <strong>{{ Carbon\Carbon::now()->format('F d, Y (l)') }}</strong> </span><br>
                            <span>Total Products : <strong>{{ count($prods) }}</strong> </span><br>
                            <span>Out of Stock(s) :
                                <strong>
                                    @php use App\Product;
                                        $out_of_stocks = Product::where('stocks','<=','0')->get();

                                        echo count($out_of_stocks);
                                    @endphp
                                </strong>
                            </span><br>
                            <span>Products under Critical Level :
                                <strong>
                                    @php
                                        $crit_level = Product::whereRaw('critical_level >= stocks')->get();
                                        echo count($crit_level);
                                    @endphp
                                </strong>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<?php $name = Carbon\Carbon::now()->format('M d, Y'); ?>
<script>
    function generatePDF()
    {
        const element = document.getElementById("invoice");
        html2pdf()
        .from(element)
        .save('Inventory {{ $name }}');
    }
</script>
<script>
    window.addEventListener("load", generatePDF());
  </script>
</body>
</html>
