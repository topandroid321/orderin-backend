<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .table-css tr td{
            padding: 2px;
        }
    </style>
</head>
<body>
    <h1>Orderin</h1>
    <table class="table-css">
        <thead>
            <tr>
                <td>Casier</td><td>:</td><td>{{$transaction->user->name}}</td>
            </tr>
            <tr>
                <td>Kode Pemesanan</td><td>:</td><td>{{$transaction->id}}</td>
            </tr>
            <tr>
                <td>Atas Nama</td><td>:</td><td>{{$transaction->atas_nama}}</td>
            </tr>
            <tr>
                <td>Total Price</td><td>:</td><td>{{ number_format($transaction->total_price) }}</td>
            </tr>
        </thead>
    </table>
    <p>Pesanan</p>
    <table border="1">
                @foreach ($items as $item)
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qyt</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                         {{$item->product->name}}
                        </td>
                        <td>
                            {{$item->product->price}}
                        </td>
                        <td>
                            {{$item->quantity}}
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
</body>
</html>

