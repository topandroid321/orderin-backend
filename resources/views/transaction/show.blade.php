<style>
    .isDisabled {
  color: currentColor;
  cursor: not-allowed;
  opacity: 0.5;
  text-decoration: none;
}
</style>
@extends('layouts.master_template')
{{-- table --}}
@section('content')
<div class="card">
    <div class="card-body grid grid-cols-1 lg:grid-cols-1">
        <h2>Detail Transaksi</h2>
        @if (Auth::user()->role_id == 3)
        <a class="isDisabled inline-block w-32 border border-blue-700 bg-blue-700 text-white rounded-md px-2 py-2 mb-2 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline" 
        href="">
        <i class="fad fa-print text-xs mr-2"></i> 
        Print Bills
        </a>
        @elseif($transaction->status == "SUCCESS" || $transaction->status == "ONPROCESS")
        <a class="inline-block w-32 border border-blue-700 bg-blue-700 text-white rounded-md px-2 py-2 mb-2 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline" 
        href="{{route('transaction.print', $transaction->id)}}">
        <i class="fad fa-print text-xs mr-2"></i> 
        Print Bills
        </a>
        @else
        <a class="isDisabled inline-block w-32 border border-blue-700 bg-blue-700 text-white rounded-md px-2 py-2 mb-2 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline" 
        href="">
        <i class="fad fa-print text-xs mr-2"></i> 
        Print Bills
        </a>
        @endif

        
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

                    <div class="relative h-20 w-600">
                        {{-- tombol back ketika role user koki --}}
                        @if (Auth::user()->role_id === 3)
                        <div class="absolute top-15 left-0 h-16 w-20 py-10">
                            <a class="text-center inline-block w-15 border border-blue-700 bg-red-700 text-white rounded-md px-2 py-2 mb-2 transition duration-500 ease select-none hover:bg-red-800 focus:outline-none focus:shadow-outline" 
                            href="{{route('transaction.indexKoki')}}">
                            <i class="fad fa-chevron-left text-xs mr-2"></i>Back
                            </a>
                        </div>
                        {{-- tombol back ketika role user admin dan kasir --}}
                        @else
                        <div class="absolute top-15 left-0 h-16 w-20 py-10">
                            <a class="text-center inline-block w-15 border border-blue-700 bg-red-700 text-white rounded-md px-2 py-2 mb-2 transition duration-500 ease select-none hover:bg-red-800 focus:outline-none focus:shadow-outline" 
                            href="{{route('transaction.index')}}">
                            <i class="fad fa-chevron-left text-xs mr-2"></i>Back
                            </a>
                        </div>
                        @endif
                        {{-- hanya aktif ketika role user koki --}}
                        @if (Auth::user()->role_id === 3)
                        <div class="absolute top-15 right-0 h-16 w-23 py-10">
                            <form action="{{Route('transaction.updateStatus')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{$transaction->id}}">
                                <input type="hidden" name="status" value="SUCCESS">
                                <button class="text-center inline-block w-15 border border-blue-700 bg-green-700 text-white rounded-md px-2 py-2 mb-2 transition duration-500 ease select-none hover:bg-green-800 focus:outline-none focus:shadow-outline" type="submit">
                                    <i class="fad fa-check-circle text-xs mr-2"></i> Done
                                </button>
                            </form>
                            
                        </div>
                        @endif
                      </div>
                    
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