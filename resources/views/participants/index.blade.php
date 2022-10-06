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
                <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th data-priority="1">Name</th>
                        <th data-priority="2">Email</th>
                        <th data-priority="3">Sex</th>
                        <th data-priority="4">Phone No</th>
                        <th data-priority="5">Institution</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($participants as $participant)
                        <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                            <td>{{$participant->name}}</td>
                            <td>{{$participant->email}}</td>
                            <td>{{$participant->sex}}</td>
                            <td>{{$participant->phone}}</td>
                            <td>{{$participant->institution->facility_name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <!-- Top Left Buttons -->
                                <div class="flex justify-end md:py-1">
                                    <a href="participants/{{$participant->id}}" class="text-white bg-gradient-to-r from-red-400 via-red-500
                                        to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300
                                        dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80
                                        font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"  onclick="
                                        let result = confirm('Are you sure you want to delete this record?');
                                        if(result){
                                        e.preventDefault();
                                        document.getElementById('delete-form-{{$participant->id}}').submit();
                                        }">
                                        <i class="uil uil-trash-alt"></i>
                                        <form method="POST" id="delete-form-{{$participant->id}}" action="{{route('participants.destroy',$participant->id)}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </a>

                                    <a href="{{URL::to('participants/show/'.$participant->id)}}" class="text-white bg-gradient-to-r from-green-400 via-green-500
                                        to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300
                                        dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80
                                        font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                        <i class="uil uil-eye"></i>
                                    </a>
                                    <button type="button" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600
                                        hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800
                                        shadow-lg shadow-cyan-500/50 dark:shadow-lg dark:shadow-cyan-800/80 font-medium rounded-lg text-sm px-5
                                        py-2.5 text-center mr-2 mb-2">
                                        <i class="uil uil-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
