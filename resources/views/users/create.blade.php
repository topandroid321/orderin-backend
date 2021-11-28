@extends('layouts.master_template')
    @section('content')
    <div class="py-1">
        <h1 class="h5">Add Data Users</h1>
        <p>
            {!! __('User &raquo; Create') !!}
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
                    <form action="{{ route('users.store') }}" class="w-full" method="post" enctype="multipart/form-data">
                        @csrf 
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Name</label>
                                <input value="{{ old('name') }}" name="name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 py-3 px-4 leading-tight focus:bg-white focus:outline-none focus:border-gray-500" id="grid-last-name" type="text" placeholder="Name">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Email</label>
                                <input value="{{ old('email') }}" name="email" class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 border-gray-200 leading-tight focus:bg-white focus:outline-none focus:border-gray-500" id="grid-last-name" type="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Username</label>
                                <input value="{{ old('username') }}" name="username" class="appearance-none block w-full bg-gray-200 text-gray-700 border py-4 px-3 border-gray-200 leading-tight focus:bg-white focus:outline-none focus:border-gray-500" id="grid-last-name" type="text" placeholder="Username">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">Phone</label>
                                <input value="{{ old('phone') }}" name="phone" class="appearance-none block w-full bg-gray-200 text-gray-700 border py-4 px-3 border-gray-200 leading-tight focus:bg-white focus:outline-none focus:border-gray-500" id="grid-last-name" type="text" placeholder="Phone">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                    Image
                                </label>
                                <input name="profile_photo_path" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="profile_photo_path" type="file" placeholder="User Image">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                    Password
                                </label>
                                <input value="{{ old('password') }}" name="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="password" placeholder="User Password">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                    Password Confirmation
                                </label>
                                <input value="{{ old('password_confirmation') }}" name="password_confirmation" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="password" placeholder="User Password Confirmation">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                    Roles
                                </label>
                                <select name="role_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
                                    <option value="1">ADMIN</option>
                                    <option value="2">PEGAWAI</option>
                                    <option value="3">KOKI</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 text-right">
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Save User
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
