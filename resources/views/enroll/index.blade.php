<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Participant Training List') }}
        </h2>
    </x-slot>
    <div class="py-12">

           {{--@foreach ($alreadyEnrolledParticipants as $participant)
                <!-- Display participant information -->
                <p>{{ $participant->name }}</p>
                <p>{{ $participant->email }}</p>
            @endforeach--}}

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Top Left Buttons -->
            <div class="flex justify-end md:py-1">
                <a href="{{ url('/enroll/create') }}"
                   class="inline-block mr-1 mb-4 px-4 py-4 border border-transparent text-sm leading-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 hover: focus:outline-none focus:shadow-outline">
                    Add Participant
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-6 lg:mt-0 rounded shadow">
                <table id="example" class="stripe" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Organizing Office</th>
                        <th>Directorate</th>
                        <th>Training</th>
                        <th>Started</th>
                        <th>Ended</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($list as $value)
                        <tr class="transition-all hover:bg-gray-100 hover:shadow-lg pt-1">
                            <td>{{ucwords($value->name)}}</td>
                            <td>{{$value->location}}</td>
                            <td>{{ucwords($value->directorate)}}</td>
                            <td>{{ucwords($value->training)}}</td>
                            <td>{{$value->start_date}}</td>
                            <td>{{$value->end_date}}</td>

                            <td class='pt-1 py-1 px-1'>
                                <a href='$show' class='button bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 mr-2 mb-2 rounded'>
                                    <i class='uil uil-eye'></i>
                                </a>
                                <a href='$edit' class='button bg-brightGreenLight hover:bg-green-700 text-white font-bold py-1 px-4 mr-2 mb-2 rounded'>
                                    <i class='uil uil-edit'></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    {{--<script>
        $(document).ready(function(){
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url:'{{route('enroll.fetch')}}',
                    dataType: 'json',
                    type: 'GET'
                },
                columns: [
                    {data:'name'},
                    {data:'location'},
                    {data:'directorate'},
                    {data:'training'},
                    {data:'start_date'},
                    {data:'end_date'},
                    {data:'Action'},
                ],
                responsive: true,
                dom: 'Blfrtip',
                "buttons": [
                    'copy','csv','excel','print'
                ],
                "lengthMenu": [[50,100,200],[50,100,200]]

            });
        });
    </script>--}}
    <script>
        $(document).ready(function(){
            $('#example').DataTable({
                dom: 'Blfrtip',
                "buttons": [
                    'copy','csv','excel','print'
                ],
                "lengthMenu": [[50,100,200],[50,100,200]]

            });
        });
    </script>

</x-app-layout>

