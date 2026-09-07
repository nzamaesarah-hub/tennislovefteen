<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - {{ $product->title }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: #f4f6f9;">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-5">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <img src="{{ asset('/storage/products/'.$product->image) }}" class="rounded img-fluid w-100">
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3>{{ $product->title }}</h3>
                        <h4 class="text-success my-3">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>
                        <p><strong>Stok Tersedia:</strong> {{ $product->stock }}</p>
                        <hr>
                        <h5>Deskripsi Produk:</h5>
                        <div>{!! $product->description !!}</div>
                        <hr>
                        <a href="{{ route('user.home') }}" class="btn btn-secondary">Kembali ke Katalog</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>