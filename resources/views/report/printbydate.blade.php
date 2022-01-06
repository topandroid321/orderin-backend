<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Transaksi All</title>
    <style>
       table {
            margin: auto;
            border-collapse: collapse;
            border-spacing: 0;
            width: 90%;
            border: 1px solid #ddd;
            text-align: center;
            }

            th, td {
            text-align: left;
            padding: 8px;
            }
            tr:nth-child(even){background-color: #f2f2f2}

            h1.title{
                margin-bottom: -20px;
            }
            h3.title{
                margin-bottom: -6px;
            }
            hr.title{
                margin-bottom: 20px;
            }
    </style>
</head>
<body>
        <h1 class="title">Report Transaction</h1>
        <h3 class="title">Application Orderin</h3>
        <hr class="title">
        <h2 align="center">Report By Date Transaction</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Tgl Transaksi</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach ($transaction as $item)
                    <tr>

                        <td><?= $no++?></td>
                        <td>{{$item->user->name}}</td>
                        <td>{{$item->created_at->toDateString()}}</td>
                        <td>{{'Rp '.number_format($item->total_price)}}</td>
                    </tr>
                @endforeach
                    <tr>
                        <td colspan="3">Total Revenue</td>
                        <td>{{'Rp '.number_format($total)}}</td>
                    </tr>
            </tbody>
        </table>
       
</body>
</html>