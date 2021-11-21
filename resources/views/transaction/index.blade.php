@extends('layouts.master_template')
{{-- table --}}
@section('content')
<div class="card">
    <div class="card-body grid grid-cols-1 lg:grid-cols-1">
        <h1 class="h5">Transaction</h1>
        <p>
            {!! __('Dashboard &raquo; Transaction') !!}
            </p>
            <div class="mb-10">
                
                <table id="table1" class="py-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pegawai</th>
                            <th>Pesanan Atasnama</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>       
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#table1').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: '{!! url()->current() !!}',
                },
                columns: [
                    { data: 'id', name: 'id', width: '5%'},
                    { data: 'user.name', name: 'user.name' },
                    { data: 'atas_nama', name: 'atas_nama' },
                    { data: 'total_price', name: 'total_price' },
                    { data: 'status', name: 'status' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '25%'
                    },
                ],
            });
            new $.fn.dataTable.FixedHeader( table );
        });
    </script>
    @endsection
    
    
    
