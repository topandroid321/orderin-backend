@extends('layouts.master_template')
{{-- table --}}
@section('content')
<form class="w-full" action="{{ route('products.updateStock') }}" method="POST">
    {{ csrf_field() }}
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                Name Product
            </label>
            <input type="hidden" name="id" value="{{ old('id') ?? $item->id }}">
            <input disabled value="{{ old('name') ?? $item->name }}" name="name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 py-3 px-4 leading-tight focus:bg-white focus:outline-none focus:border-gray-500" id="grid-last-name" type="text" placeholder="Name">
            
            <br>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                Update Stok
            </label>
            <input value="{{ old('stok') ?? $item->stock }}" type="text" name="stock" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
        </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3 text-right">
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Update Stock Product
            </button>
        </div>
    </div>
</form>
@endsection
@section('js')
@endsection
