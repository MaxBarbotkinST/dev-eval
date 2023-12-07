<x-app-layout>
    <x-slot name="header">
        <h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task action') }}
        </h2>
    </x-slot>
    <div class="py-6 relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-gray-900" id="form"></div>
        </div>
    </div>
</x-app-layout>
