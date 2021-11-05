<x-app-layout>
   <div class="container">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                + Create User
                </a>
            </div>
            <div class="">
                <table class="table table-striped mt-3">
                    <thead>
                        <tr class="text-center">
                            <th class="border px-6 py4">ID</th>
                            <th class="border px-6 py4">Name</th>
                            <th class="border px-6 py4">Email</th>
                            <th class="border px-6 py4">Roles</th>
                            <th class="border px-6 py4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user as $item)
                            <tr class="text-center">
                                <td class="">{{ $item->id }}</td>
                                <td class="">{{ $item->name }}</td>
                                <td class="">{{ $item->email }}</td>
                                <td class="">{{ $item->roles }}</td>
                                <td class="">
                                    <a href="{{ route('users.edit', $item->id)}}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('users.destroy', $item->id) }}" class="inline-block">
                                        {!! method_field('delete') . csrf_field() !!}
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   </div>
</x-app-layout>
