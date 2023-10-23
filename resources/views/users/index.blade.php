<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Top Left Buttons -->
            <div class="flex justify-end md:py-1">
                <a href="{{ url('/users/create') }}"
                   class="inline-block mr-1 mb-4 px-4 py-4 border border-transparent text-sm leading-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 hover: focus:outline-none focus:shadow-outline">
                    Add User
                </a>
            </div>
            <div class="flex flex-col bg-white">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-center text-sm font-light">
                                <thead class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:bg-neutral-900">
                                <tr>
                                    <th scope="col" class="px-6 py-2">Name</th>
                                    <th scope="col" class="px-6 py-2">Email</th>
                                    <th scope="col" class="px-6 py-2">Role</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
                                        <td class="whitespace-nowrap px-6 py-2">{{$user->name}}</td>
                                        <td class="whitespace-nowrap px-6 py-2"><a href="mailto:{{ $user->email }}" title="email {{ $user->email }}">{{ $user->email }}</a></td>
                                        <td class="whitespace-nowrap px-6 py-2">
                                            @foreach ($user->roles as $user_role)
                                                @if ($user_role->name == 'User')
                                                    @php $badgeClass = 'inline-block whitespace-nowrap rounded-[0.27rem] bg-success-100
                                                            px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline
                                                            text-[0.75em] font-bold leading-none text-success-700'
                                                    @endphp
                                                @elseif ($user_role->name == 'Admin')
                                                    @php $badgeClass = 'inline-block whitespace-nowrap rounded-[0.27rem] bg-green-100
                                                            px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline
                                                            text-[0.75em] font-bold leading-none text-primary-700'
                                                    @endphp
                                                @elseif ($user_role->name == 'Unverified')
                                                    @php $badgeClass = 'inline-block whitespace-nowrap rounded-[0.27rem] bg-danger-100
                                                            px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline
                                                            text-[0.75em] font-bold leading-none text-danger-700'
                                                    @endphp
                                                @else
                                                    @php $badgeClass = 'inline-block whitespace-nowrap rounded-[0.27rem]
                                                            bg-neutral-800 px-[0.65em] pb-[0.25em] pt-[0.35em]
                                                            text-center align-baseline text-[0.75em] font-bold
                                                            leading-none text-neutral-50 dark:bg-neutral-900'
                                                    @endphp
                                                @endif
                                                <span class="{{$badgeClass}}">{{ $user_role->name }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

