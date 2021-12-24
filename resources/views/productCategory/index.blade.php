@extends('layouts.master_template')
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
                columns:[
                        {data: 'id', name:'id',width: '5%',},
                        {data:'name',name:'name',width:'10%'},
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
    @section('content')
    <x:notify-messages />
    <div class="card">
        <div class="card-body grid grid-cols-1 lg:grid-cols-1">
            <h1 class="h5">Product Category</h1>
            <p>
                {!! __('Dashboard &raquo; ProductCategory Data') !!}
            </p>
                <div class="mb-10">
                    <a href="{{ route('productCategory.create') }}" class="inline-block bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-2 md-2 rounded">
                    + Create New Data
                    </a>
    
                    <table id="table1" class="py-3">
                        <thead>
                            <tr class="text-center">
                                <th class="bg-green-300 text-white border px-6 py-3">ID</th>
                                <th class="bg-green-300 text-white border px-6 py-3">Name</th>
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
   
