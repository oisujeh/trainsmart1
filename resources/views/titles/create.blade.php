<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Participant') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <x-jet-validation-errors class="mt-5 ml-2 md:mt-0 md:col-span-2" />
                    <form action="{{route('trainingtitles.store')}}" method="POST" class="">
                        {{csrf_field()}}
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="full-name" class="block text-sm font-bold text-gray-700">Training Title</label>
                                        <input type="text" name="title" value="{{ old('name') }}" id="full-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required placeholder="Title of Training">
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="institution" class="block text-sm font-bold text-gray-700">Directorate</label>
                                        {{csrf_field()}}
                                        <select id="institution" name="directorate_id" class="selectpicker mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                            <option value="" disabled selected hidden>--Choose Directorate--</option>
                                            @foreach($directorates as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-bold rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
