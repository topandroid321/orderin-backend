@extends('layouts.master_template')
{{-- table --}}
@section('content')
<div class="card">
    <div class="card-body grid grid-cols-1 lg:grid-cols-1">
        <h1 class="h5">Report Transaction</h1>
        <p>
            {!! __('Dashboard &raquo; Transaction') !!}
            </p>
                <div class="mb-12 py-5">
                        {{ csrf_field() }}
                        <form class="w-full max-w-lg" action="{{Route('printByDate')}}">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-40 md:w-1/2 px-3 mb-6 md:mb-0">
                                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Start Date
                                  </label>
                                  <input name="start" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="enddate" type="date" required>
                                </div>
                                <div class="w-40 md:w-1/2 px-3">
                                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                    End Date
                                  </label>
                                  <input name="end" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="enddate" type="date" required>
                                </div>
                                <div class="w-40 md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                      Print by Date
                                    </label>
                                    <button class="appearance-none block w-full bg-blue-600 text-white border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-blue focus:border-gray-500" id="enddate" type="submit">Print <i class="fad fa-print text-xs mr-2"></i></button>
                                </div>
                                <div class="w-32 md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                      Print All
                                    </label>
                                    <a href="{{Route('printReportAll')}}" class="appearance-none block w-full bg-blue-600 text-white border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-blue focus:border-gray-500" id="enddate" type="submit">Print <i class="fad fa-print text-xs mr-2"></i></a>
                                </div>
                              </div>
                        </form>
                <table id="table1" class="py-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Pesanan Atasnama</th>
                            <th>Tgl Transaksi</th>
                            <th>Total Harga</th>
                            <th>Status</th>
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
                    url: '{{route('transactionReport')}}',
                },
                columns: [
                    {data : null, sortable: false, width: '5%',
                        render: function (data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                    }  
                        },
                    { data: 'user.name', name: 'user.name' },
                    { data: 'atas_nama', name: 'atas_nama' },
                    { data: 'created_at', name: 'created_at'},
                    { data: 'total_price', name: 'total_price' },
                    { data: 'status', name: 'status' },
                ],
            });
            setInterval( function () {
                table.ajax.reload();
            }, 5000 )

            new $.fn.dataTable.FixedHeader( table );
        });


    </script>
    @endsection
    
    
    
