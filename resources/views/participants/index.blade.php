<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Participant List') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Top Left Buttons -->
            <div class="flex justify-end md:py-1">
                <a href="{{ url('/participants/create') }}"
                   class="inline-block mr-1 mb-4 px-4 py-4 border border-transparent text-sm leading-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 hover: focus:outline-none focus:shadow-outline">
                    Add Participant
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-6 lg:mt-0 rounded shadow">
                <table id="example" class="stripe" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Sex</th>
                        <th>Phone No</th>
                        <th>Institution</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="transition-all hover:bg-gray-100 hover:shadow-lg pt-1">

                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script>
           $(document).ready(function(){
               $('#example').DataTable({
               processing: true,
               serverSide: true,
               ajax: {
                   url:'{{route('participants.fetch')}}',
                   dataType: 'json',
                   type: 'GET'
               },
               columns: [
                   {data:'name'},
                   {data:'email'},
                   {data:'sex'},
                   {data:'phone'},
                   {data:'facility_name'},
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
    </script>
    {{--<script>
        $(".delete").click(function(){
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name=csrf-token]').attr('content')
                }
            });
            $.ajax({
                url: 'participants/delete'+id,
                dataType: 'json',
                type:'DELETE',
                data:{
                    "id":id
                },
                success: function(response){
                    console.log(response);
                },
                error: function(xhr){
                    console.log(xhr.responseText);
                }
            });
        });
    </script>--}}
</x-app-layout>

