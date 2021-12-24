@extends('layouts.master_template')
{{-- table --}}
@section('content')
<div class="card">
    <x:notify-messages />
    <div class="card-body grid grid-cols-1 lg:grid-cols-1">
        <h1 class="h5">Product Gallery</h1>
        <p>
            {!! __('Dashboard &raquo; Products Gallery') !!}
            </p>
            <div class="mb-10">
                <a href="{{ route('products.gallery.create', $product->id) }}" class="inline-block bg-blue-500 hover:bg-blue-800 text-white font-bold py-2 px-2 md-2 rounded">
                    + Upload Photos
                </a>
                
                <table id="table1" class="py-3">
                    <thead>
                        <tr class="text-center">
                            <th class="px-2 py-4">ID</th>
                            <th class="px-6 py-4">Photo</th>
                            <th class="px-6 py-4">Featured</th>
                            <th class="px-6 py-4">Action</th>
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
                columns:[
                    { data: 'id', name: 'id', width: '5%'},
                    { data: 'url', name: 'url' },
                    { data: 'is_featured', name: 'is_featured' },
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
    
    
    
