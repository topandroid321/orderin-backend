@extends('layouts.master_template')
{{-- table --}}
@section('content')
<form class="w-full" action="{{ route('transaction.update', $item->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                Status
            </label>
            <select name="status" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
                <option value="{{ $item->status }}">{{ $item->status }}</option>
                <option disabled>-------</option>
                <option value="PENDING">PENDING</option>
                <option value="ONPROCESS">ONPROCESS</option>
                <option value="SUCCESS">SUCCESS</option>
                <option value="CANCELLED">CANCELLED</option>
            </select>
        </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3 text-right">
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Update Transaction
            </button>
        </div>
    </div>
</form>
@endsection
@section('js')
@endsection
