@extends('layouts.master_template')
    @section('content')
    <div class="py-1">
        <h1 class="h5">Edit Data Product</h1>
        <p>
            Users &raquo; {{$item->name}} &raquo; Edit
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
                    <form action="{{ route('products.update', $item->id) }}" class="w-full" method="post" enctype="">
                        @csrf 
                        @method('PUT')
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Name</label>
                                <input value="{{ old('name') ?? $item->name }}" name="name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 py-3 px-4 leading-tight focus:bg-white focus:outline-none focus:border-gray-500" id="grid-last-name" type="text" placeholder="Name">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Price</label>
                                <input value="{{ old('price') ?? $item->price}}" name="price" class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 border-gray-200 leading-tight focus:bg-white focus:outline-none focus:border-gray-500" id="grid-last-name" type="text" placeholder="Price">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Descriptions</label>
                                <input value="{{ old('description') ?? $item->description }}" name="description" class="appearance-none block w-full bg-gray-200 text-gray-700 border py-4 px-3 border-gray-200 leading-tight focus:bg-white focus:outline-none focus:border-gray-500" id="grid-last-name" type="text" placeholder="Description">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Stock</label>
                                <input value="{{ old('stock') ?? $item->stock }}" name="stock" class="appearance-none block w-full bg-gray-200 text-gray-700 border py-4 px-3 border-gray-200 leading-tight focus:bg-white focus:outline-none focus:border-gray-500" id="grid-last-name" type="text" placeholder="Stock">
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Tags</label>
                                <input value="{{ old('tags') ?? $item->tags }}" name="tags" class="appearance-none block w-full bg-gray-200 text-gray-700 border py-4 px-3 border-gray-200 leading-tight focus:bg-white focus:outline-none focus:border-gray-500" id="grid-last-name" type="text" placeholder="Tags">
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                    Category
                                </label>
                                <select name="categories_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
                                    @foreach ($category as $item2)
                                        <option value="{{$item2->id}}"{{old('categories_id', $item->categories_id) == $item2->id ? 'selected' : null }}>{{$item2->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 text-right">
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Update Product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
