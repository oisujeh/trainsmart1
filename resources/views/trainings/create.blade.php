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
                    <form action="{{route('trainings.store')}}" method="POST" class="">
                        {{csrf_field()}}
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="institution" class="block text-sm font-bold text-gray-700">Institution</label>
                                        {{csrf_field()}}
                                        <select id="sub_category_name" name="institution_id" class="selectpicker mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                            <option value="" disabled selected hidden>Choose Institution</option>
                                            @foreach($directorate as $item)
                                                <option value="{{$item->id}}">{!! ucwords($item->name) !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="training_title_id" class="block text-sm font-bold text-gray-700">Title</label>
                                        <select id="sub_category" name="training_title_id" class="select2 mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>

                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="cat" class="block text-sm font-bold text-gray-700">Category of Health Workers</label>
                                        <input type="text" name="cat" id="cat" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required placeholder="Category of Health Workers">
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="photo_use" class="block text-sm font-bold text-gray-700">Photo Use Consent</label>
                                        <ul class="items-center w-full text-sm font-bold text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                                <div class="flex items-center pl-3">
                                                    <input checked id="horizontal-list-radio-yes" type="radio" value="Yes" name="photo_consent" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="horizontal-list-radio-yes" class="py-3 ml-2 w-full text-sm font-bold text-gray-900 dark:text-gray-300">Yes</label>
                                                </div>
                                            </li>
                                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                                <div class="flex items-center pl-3">
                                                    <input id="horizontal-list-radio-no" type="radio" value="No" name="photo_consent" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="horizontal-list-radio-no" class="py-3 ml-2 w-full text-sm font-bold text-gray-900 dark:text-gray-300">No</label>
                                                </div>
                                            </li>
                                        </ul>
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
    <script>
        $(document).ready(function() {
            $('#sub_category_name').on('change', function(){
                let id = $(this).val();
                $('#sub_category').empty();
                $('#sub_category').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '../submain/' + id,
                    success: function (response){
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#sub_category').empty();
                        $('#sub_category').append(`<option value="0" disabled selected>--Select--</option>`);
                        response.forEach(element=>{
                            $('#sub_category').append(`<option value="${element['id']}">${element['title'].toUpperCase()}</option>`);
                        });
                    }
                });
            });
        });
    </script>
</x-app-layout>

