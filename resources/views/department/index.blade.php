<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Department') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('message'))
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2"> 
                {{ session('message') }}
            </div>
            @endif

            <div class="pb-3">
                <a 
                    href="{{ route('department.create')}}" 
                    class="items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase">
                    Add New Department
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
                <div class="p-6 text-gray-900">
                    {{-- {{ __("You're logged in!") }} --}}

                    <table class="w-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Deparment Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="">
                            @foreach($departments as $department)
                            <tr class="border-b">
                                <td class="px-6 py-4 border-1">{{ $department->id }}</td>
                                <td class="px-6 py-4 border-1">{{ $department->name }}</td>
                                <td class="px-6 py-4 border-1">{{ $department->description }}</td>
                                <td class="px-6 py-4 border-1">{{ $department->status }}</td>
                                <td>
                                    {{-- kena letak form sebab nak pakai delete, and delete api is using DELETE method --}}
                                    <form 
                                        method="POST" 
                                        action="{{ route('department.destroy', $department->id) }}"
                                        onsubmit="return confirm(`Are you sure to delete?`)"
                                        > 

                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf

                                        <a 
                                            href="{{ route('department.edit', $department->id) }}" 
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
