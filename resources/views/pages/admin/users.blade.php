Users blade
@extends('layouts.admin-layout')

@section('admin-content')
    <x-success-message></x-success-message>
    <x-fail-message></x-fail-message>
    <!-- Admin dashboard content -->
    <div class="flex items-center justify-end mt-2">
        <a href="{{ route('admin.add.user') }}">
            <x-primary-button href="route">
                <span class="material-symbols-outlined">
                    add_circle
                </span>
                Create User
            </x-primary-button>
        </a>
    </div>

    <form method="GET" action="{{ route('users.index') }}">
        @csrf
        <div class="grid grid-cols-4 gap-4">
            <!-- Search bar -->
            <div class="col-span-3">
                <x-search-bar placeholder="Search for username, email, first or last name" name="search" :value="request('search')" />
            </div>
            <!-- Dropdown -->
            <div class="col-span-1">
                <x-dropdown-input triggerText="{{ ucfirst($filterType ?? 'All') }}">
                    <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('')">All</div>
                    <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('admin')">Admins</div>
                    <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('staff')">Staff</div>
                    <div class="cursor-pointer hover:bg-gray-100 p-2" onclick="selectFilter('customer')">Customers</div>
                </x-dropdown-input>
                <input type="hidden" id="filter_type" name="filter_type" value="{{ request('filter_type') }}" />
            </div>
        </div>
    </form>
    <br>
    <!-- display data -->
    <x-table style="color:black;">
        <x-slot name="header">
            <x-table-col>ID</x-table-col>
            <x-table-col>FIRST NAME</x-table-col>
            <x-table-col>LAST NAME</x-table-col>
            <x-table-col>EMAIL</x-table-col>
            <x-table-col>ROLE</x-table-col>
            <x-table-col>ACTION</x-table-col>
        </x-slot>

        @if ($searchQuery && $users->isEmpty())
            <tr>
                <x-table-col colspan="5">No users found.</x-table-col>
            </tr>
        @else
            @foreach ($users as $user)
                <tr class="border">
                    <x-table-col>{{ $user->id }}</x-table-col>
                    <x-table-col>{{ $user->personal->firstname }}</x-table-col>
                    <x-table-col>{{ $user->personal->lastname }}</x-table-col>
                    <x-table-col>{{ $user->email }}</x-table-col>
                    <x-table-col>{{ $user->role }}</x-table-col>
                    <x-table-col>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="showDeleteConfirmation(event);">
                            <a href="{{ route('users.show', ['user' => $user->id]) }}">
                                <x-secondary-button>
                                    {{ __('Details') }}
                                </x-secondary-button>
                            </a>
                            @csrf
                            @method('DELETE')
                            <x-delete-button type="submit" class="btn">Delete</x-delete-button>
                        </form>
                    </x-table-col>
                </tr>
            @endforeach
        @endif
    </x-table>

    <script>
        function selectFilter(filterType) {
            document.getElementById('filter_type').value = filterType;
            document.getElementById('filter_type').closest('form').submit();
        }

        function showDeleteConfirmation(event) {
            event.preventDefault(); // Prevent form submission
    
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#bd2020',
                cancelButtonColor: '#362640',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    event.target.submit();
                }
            });
        }
    </script>
@endsection
