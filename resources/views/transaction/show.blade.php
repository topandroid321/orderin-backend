@extends('layouts.master_template')
{{-- table --}}
@section('content')
<div class="card">
    <div class="card-body grid grid-cols-1 lg:grid-cols-1">
        <table class="table-auto w-full">
            <tbody>
                <tr>
                    <th class="border px-6 py-4 text-right">Nama Pegawai</th>
                    <td class="border px-6 py-4">{{ $transaction->user->name}}</td>
                </tr>
                <tr>
                    <th class="border px-6 py-4 text-right">Pesanan Atas nama</th>
                    <td class="border px-6 py-4">{{ $transaction->atas_nama }}</td>
                </tr>
                <tr>
                    <th class="border px-6 py-4 text-right">Payment</th>
                    <td class="border px-6 py-4">{{ $transaction->payments }}</td>
                </tr>
                <tr>
                    <th class="border px-6 py-4 text-right">Catatan</th>
                    <td class="border px-6 py-4">{{ $transaction->catatan }}</td>
                </tr>
                <tr>
                    <th class="border px-6 py-4 text-right">Total Price</th>
                    <td class="border px-6 py-4">{{ number_format($transaction->total_price) }}</td>
                </tr>
                <tr>
                    <th class="border px-6 py-4 text-right">Status</th>
                    <td class="border px-6 py-4">{{ $transaction->status }}</td>
                </tr>
            </tbody>
        </table>
    <h2 class="font-semibold text-lg text-gray-800 leading-tight mb-5">Transaction Items</h2>
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="table1">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection
@section('js')
<script>
    // AJAX DataTable
    var datatable = $('#table1').DataTable({
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [
            { data: 'id', name: 'id', width: '5%'},
            { data: 'product.name', name: 'product.name' },
            { data: 'product.price', name: 'product.price' },
            { data: 'quantity', name: 'quantity' },
        ],
    });
    </script>
    @endsection