@extends('layouts.master_template')
{{-- table --}}
@section('content')
<div class="card">
    <div class="card-body grid grid-cols-1 lg:grid-cols-1">
        <h1 class="h5">Transaction Koki</h1>
        <p>
            {!! __('Dashboard &raquo; Transaction') !!}
            </p>
                <div class="mb-10 py-5">
                    <div class="inline-block relative w-40 py-4">
                    </div>
                <table id="table1" class="py-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Pesanan Atasnama</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                            
                        </tbody>
                    </table>       
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('js')
    <script type="text/javascript">
        let sts = $("#status")
        $(document).ready(function(){
            var table = $('#table1').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: '{{route('transaction.indexKoki')}}',
                },
                columns: [
                    {data : null, sortable: false, width: '5%',
                        render: function (data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                    }  
                        },
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

            $('.filter').change(function(){
                table.columns($(this).data('column'))
                .search( $(this).val())
                .draw();
            });
            setInterval( function () {
                table.ajax.reload();
            }, 5000 )

            new $.fn.dataTable.FixedHeader( table );
        });


    </script>
    @endsection
    
    
    
