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
                                        <label for="institution" class="block text-sm font-bold text-gray-700">Directorate</label>
                                        {{csrf_field()}}
                                        <select id="sub_category_name" name="directorate_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                            <option value="" disabled selected hidden>Choose Directorate</option>
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
                                        <label for="location" class="block text-sm font-bold text-gray-700">Organizing Office</label>
                                        <select id="location" name="location" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                            <option value="" disabled selected hidden>Choose</option>
                                            <option value="Abuja">Abuja</option>
                                            <option value="Benue">Benue</option>
                                            <option value="Ogun">Ogun</option>
                                            <option value="Ondo">Ondo</option>
                                            <option value="Oyo">Oyo</option>
                                            <option value="Plateau">Plateau</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="method" class="block text-sm font-bold text-gray-700">Training Method</label>
                                        <select id="method" name="method" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                            <option value="" disabled selected hidden>Choose Training Method</option>
                                            <option value="Physical Meeting">Physical Meeting</option>
                                            <option value="Virtual">Virtual</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3 form-floating">
                                            <input type="date" name="start_date"
                                                   class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding
                                                   border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white
                                                   focus:border-blue-600 focus:outline-none"
                                                   placeholder="Select a date" />
                                            <label for="floatingInput" class="text-gray-700">Start Date</label>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3 form-floating">
                                        <input type="date" name="end_date"
                                               class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding
                                                   border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white
                                                   focus:border-blue-600 focus:outline-none"
                                               placeholder="Select a date" />
                                        <label for="floatingInput" class="text-gray-700">End Date</label>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="venue" class="block text-sm font-bold text-gray-700">Venue</label>
                                        <label>
                                            <input type="text" name="venue" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required/>
                                        </label>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="comment" class="block text-sm font-bold text-gray-700">Training Information</label>
                                        <label>
                                            <input type="text" name="comment" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required/>
                                        </label>
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
    @section('scripts')
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
    @endsection
</x-app-layout>

