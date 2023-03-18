<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-4">
                    <x-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('role.update', $role) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $role->name)" required autofocus autocomplete="name" />
                        </div>
                        @unless ($role->name == env('APP_SUPER_ADMIN', 'super-admin'))
                        <h3 class="inline-flex font-semibold text-xl text-gray-800 leading-tight py-4">Permissions</h3>
                        <div class="grid grid-cols-4 gap-4">
                            @forelse ($permissions as $permission)
                            <label for="permission" class="inline-flex">
                                <input type="checkbox" name="permissions[]" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $permission->name }}" {{ in_array( $permission->id, $roleHasPermissions) ? 'checked' : ''}}/>
                                    <span class="ml-2 text-sm text-gray-600">{{ __( $permission->name ) }}</span>
                            </label>
                            @empty
                            {{ __('No permissions Found') }}
                            @endforelse
                        </div>
                        @endunless
                        <div class="flex mt-4">
                            <x-button>
                                {{ __('Save') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>