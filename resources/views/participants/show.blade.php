<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-4">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">{!! ucwords($participant->name) !!}'s Info</h5>
                        <a href="{{URL::to('/participants')}}" class="text-sm font-medium text-blue-600 hover:bg-gray-300 dark:text-blue-500">
                            <div class="relative flex items-center group">
                                <div class="absolute right-0 flex items-center hidden mr-6 group-hover:flex">
                                    <span class="relative z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-black shadow-lg">Back</span>
                                    <div class="w-3 h-3 -ml-2 rotate-45 bg-black"></div>
                                </div>
                                <x-entypo-back class="h-6 w-6 text-gray-600" /> <span class="text-gray-800">Back</span>
                            </div>
                        </a>
                    </div>
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        @if($participant->name)
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                Name
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                {{ucwords($participant->name)}}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">

                                    <div class="flex-1 min-w-0">
                                        @if($participant->email)
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                Email Address
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                <a href="mailto:{{$participant->email}}">{{$participant->email}}</a>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                           Sex
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{$participant->sex}}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Designation
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{$participant->designation}}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="pt-3 pb-0 sm:pt-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Organization
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{$participant->facility_name}}
                                        </p>
                                    </div>
                                </div>
                            </li>

                            @if($participantTitles)
                                <li class="pt-3 pb-0 sm:pt-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-md underline font-medium text-gray-900 truncate dark:text-white">
                                                Trainings Attended
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            <ul>
                                                @foreach($participantTitles as $title)
                                                    <li>{{ $loop->iteration }}. {{ ucwords($title->title) . ' - ' . date('d/m/Y', strtotime($title->start_date)) }}</li>
                                                @endforeach
                                            </ul>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endif


                        </ul>
                    </div>
                </div>
        </div>
    </div>
</x-app-layout>
