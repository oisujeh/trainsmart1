<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trainings List') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Top Left Buttons -->
            {{--<div class="flex justify-end md:py-1">
                <a href="{{ url('/titles/create') }}"
                   class="inline-block mr-1 mb-4 px-4 py-4 border border-transparent text-sm leading-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 hover: focus:outline-none focus:shadow-outline">
                    Add Title
                </a>
            </div>--}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-6 lg:mt-0 rounded shadow">
                <livewire:trainings/>
            </div>
        </div>
    </div>

</x-app-layout>


