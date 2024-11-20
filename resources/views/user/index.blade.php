<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Below line is notificaiton toast --}}
            @if(session('message'))
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2"> 
                {{ session('message') }}
            </div>
            @endif

            <div class="pb-3">
                <a 
                    href="{{ route('user.create')}}" 
                    class="items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase">
                    Add New User
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
                <div class="p-6 text-gray-900">
                    {{-- {{ __("You're logged in!") }} --}}

                    <table class="w-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="">
                            @foreach($users as $user)
                            <tr class="border-b">
                                <td class="px-6 py-4 border-1">{{ $user->id }}</td>
                                <td class="px-6 py-4 border-1">{{ $user->name }}</td>
                                <td class="px-6 py-4 border-1">{{ $user->email }}</td>
                                <td class="px-6 py-4 border-1">{{ $user->role }}</td>
                                <td class="px-6 py-4 border-1">{{ $user->status }}</td>
                                <td>
                                    {{-- kena letak form sebab nak pakai delete, and delete api is using DELETE method --}}
                                    <form 
                                        method="POST" 
                                        action="{{ route('user.destroy', $user->id) }}"
                                        onsubmit="return confirm(`Are you sure to delete?`)"
                                        > 

                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf

                                        <a 
                                            href="{{ route('user.edit', $user->id) }}" 
                                            class="items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase">
                                            Edit
                                        </a>
                                        <x-danger-button class="ms-3">
                                            Delete
                                        </x-danger-button>

                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
