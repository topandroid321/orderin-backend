@extends('layouts.master_template')
{{-- table --}}
@section('content')
<div class="card">
    <div class="card-body grid grid-cols-1 lg:grid-cols-1">
        <h1 class="h5">Transaction</h1>
        <p>
            {!! __('Dashboard &raquo; Transaction') !!}
            </p>
                <div class="mb-10 py-5">
                    <div class="inline-block relative w-40 py-4">
                    <select data-column="4" name="status-order" id="status" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline filter">
                        <option value="">Filter Status</option>
                        <option value="PENDING">PENDING</option>
                        <option value="SUCCESS">SUCCESS</option>
                        <option value="ONPROCESS">ONPROCESS</option>
                        <option value="CANCELLED">CANCELLED</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                      </div>
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
                    url: '{{route('transaction.index')}}',
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
    
    
    
