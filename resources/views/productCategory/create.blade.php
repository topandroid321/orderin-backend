@extends('layouts.master_template')
    @section('content')
    <div class="py-1">
        <h1 class="h5">Add Data Product Category</h1>
        <p>
            {!! __('ProductCategory &raquo; Create') !!}
        </p>

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 py-5">
            <div class="">
                <div>
                    @if($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                            There's Something wrong
                        </div>
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                            <p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </p>
                        </div>
                    </div>
                    @endif
                    <form action="{{ route('productCategory.store') }}" class="w-full" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Category Name</label>
                                <input value="{{ old('name') }}" name="name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 py-3 px-4 leading-tight focus:bg-white focus:outline-none focus:border-gray-500" id="grid-last-name" type="text" placeholder="Category Name">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 text-right">
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Save Product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection