<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20  border-b border-gray-200">
                    <!-- Top Left Buttons -->
                    <div class="flex justify-end md:py-1">
                        <a href="{{ url('/participants/create') }}"
                           class="inline-block mr-1 px-4 py-4 border border-transparent text-sm leading-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 hover: focus:outline-none focus:shadow-outline">
                            Add Participant
                        </a>
                        <a href=""
                           class="inline-block mr-1 px-4 py-4 border border-transparent text-sm leading-3 font-medium text-white bg-red-700 hover:bg-brightRedLight focus:outline-none focus:shadow-outline">
                            Add Facilitator
                        </a>
                        <a href=""
                           class="inline-block px-4 py-4 border border-transparent text-sm leading-3 font-medium text-white bg-brightGreen hover:bg-brightGreenLight focus:outline-none focus:shadow-outline">
                            Add Training
                        </a>
                    </div>

                    <!-- Cards Section-->
                    <div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-1 lg:grid-cols-4">
                        <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg bg-indigo-600">
                            <div class="flex items-start justify-between">
                                <div class="flex flex-col space-y-2">
                                    <span class="text-white">Trainings</span>
                                    <span class="text-lg text-white font-semibold">{{$trainings->count()}}</span>
                                </div>
                                <x-entypo-basecamp class="w-7 h-7 text-white"/>
                            </div>
                        </div>
                        <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg bg-brightRed">
                            <div class="flex items-start justify-between">
                                <div class="flex flex-col space-y-2">
                                    <span class="text-white">Trainers</span>
                                    <span class="text-lg text-white font-semibold">96</span>
                                </div>
                                <x-entypo-users class="w-7 h-7 text-white"/>
                            </div>
                        </div>
                        <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg bg-indigo-800">
                            <div class="flex items-start justify-between">
                                <div class="flex flex-col space-y-2">
                                    <span class="text-white">Participants</span>
                                    <span class="text-lg text-white font-semibold">{{$participants->count()}}</span>
                                </div>
                                <x-entypo-users class="w-7 h-7 text-white"/>
                            </div>
                        </div>
                        <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg bg-brightGreenLight">
                            <div class="flex items-start justify-between">
                                <div class="flex flex-col space-y-2">
                                    <span class="text-white">Future Trainings</span>
                                    <span class="text-lg text-white font-semibold">{{$future_trainings->count()}}</span>
                                </div>
                                <x-entypo-ticket class="w-7 h-7 text-white"/>
                            </div>
                        </div>
                    </div>

                    <h3 class="mt-6 text-xl">Upcoming Trainings</h3>
                    <div class="flex flex-col mt-2">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                                    <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                                                Directorate
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-xs font-bold tracking-wider text-left text-bold text-gray-500 uppercase">
                                                Training Title
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                                                Organizing Office
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                                                Training Method
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                                                Start Date
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                                                End Date
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($future_trainings as $value)
                                                <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{$value->directorate}}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{$value->title}}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{$value->location}}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{$value->method}}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{$value->start_date}}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{$value->end_date}}</div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="flex flex-col mt-12">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                                    <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                                                First
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-xs font-bold tracking-wider text-left text-bold text-gray-500 uppercase">
                                                Total
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-xs font-bold tracking-wider text-left text-gray-500 uppercase">
                                                Fiscal Year ( Since FY23 Q1)
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        {{--Check this for transition--}}
                                        <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Participants ({{$participants->count() }} Unique)</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{$participants->count()}}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{$participants->count()}}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Trainings</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{$trainings->count()}}</div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>







                </div>

            </div>

        </div>
    </div>
</x-app-layout>
