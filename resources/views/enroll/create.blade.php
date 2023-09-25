<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Participants to Training') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <x-jet-validation-errors class="mt-5 ml-2 md:mt-0 md:col-span-2" />
                    <form action="{{route('enroll.store')}}" method="POST" class="">
                        {{csrf_field()}}
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-12">
                                    <div class="col-span-12 {{--sm:col-span-3--}}">
                                        <label for="directorate" class="block text-sm font-bold text-gray-700">Participants' Names</label>
                                        <select id="names" data-placeholder="Search for participants" data-allow-clear="1" name=participant_id[] multiple="multiple"
                                                class="select2 mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm
                                                focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                            <option value="0">

                                            </option>

                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-12">
                                    <div class="col-span-12 {{--sm:col-span-3--}}">
                                        <label for="training" class="block text-sm font-bold text-gray-700">Training</label>
                                        <select id="training" data-placeholder="Choose Training" data-allow-clear="1" name="training_id"
                                                class="select2 mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm
                                                focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                            <option value="0"></option>
                                            @foreach($trainings as $training)
                                                <option value="{{ $training->id}}">{{strtoupper($training->title->title)}} - Organized by {{$training->location}} started on {{$training->start_date}}</option>
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
    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#names').select2({
                    minimumInputLength: 2,
                    ajax:{
                        url: "{{route('getEmployees')}}",
                        type: "POST",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: 'json',
                        delay: 250,
                        data: function(params){
                            return{
                                _token:"{{ csrf_token() }}",
                                search: params.term
                            };
                        },
                        processResults: function(response){
                            return{
                                results: response
                            };
                        },
                        cache:true
                    },
                    allowClear:Boolean($(this).data('allow-clear')),
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#training').select2({
                    minimumInputLength: 2,
                    allowClear:Boolean($(this).data('allow-clear')),
                });
            });
        </script>
    @endsection
</x-app-layout>

