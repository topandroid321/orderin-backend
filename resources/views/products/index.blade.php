@extends('layouts.master_template')
    @section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            var table = $('#table1').DataTable({
                processing: true,
                responsive: true,
                scrollX: true,
                serverSide: true,
                ajax: {
                    url: '{!! url()->current() !!}',
                },
                columns:[
                        {data : null, sortable: false, width: '5%',
                        render: function (data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                    }  
                        },
                        {data:'name',name:'name',width:'10%'},
                        {data:'price',name:'price',width:'10%'},
                        {data:'description',name:'description',width:'10%'},
                        {data:'stock',name:'stock', width: '2%',},
                        {data:'tags',name:'tags', width:'5%'},
                        {data:'category.name',
                        name:'category.name',
                        width: '5%',
                        },
                        {data:'action',
                        name:'action',
                        width: '10%',
                        },
                ],
            });
            new $.fn.dataTable.FixedHeader( table );
        });
    </script>
    @endsection
    {{-- table --}}
    @section('content')
    <x:notify-messages />
    <div class="card">
        <div class="card-body grid grid-cols-1 lg:grid-cols-1">
            <h1 class="h5">Data Products</h1>
            <p>
                {!! __('Dashboard &raquo; Products Data') !!}
            </p>
                <div class="mb-10">
                    <a href="{{ route('products.create') }}" class="inline-block bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-2 md-2 rounded">
                    + Create New Data
                    </a>
    
                    <table id="table1" class="py-3">
                        <thead>
                            <tr class="text-center">
                                <th class="bg-green-300 text-white border px-6 py-3">No</th>
                                <th class="bg-green-300 text-white border px-6 py-3">Name</th>
                                <th class="bg-green-300 text-white border px-6 py-3">Price</th>
                                <th class="bg-green-300 text-white border px-6 py-3">Description</th>
                                <th class="bg-green-300 text-white border px-6 py-3">Stock</th>
                                <th class="bg-green-300 text-white border px-6 py-3">Tags</th>
                                <th class="bg-green-300 text-white border px-6 py-3">Category</th>
                                <th class="bg-green-300 text-white border px-6 py-3">Action</th>
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
    
    
   
