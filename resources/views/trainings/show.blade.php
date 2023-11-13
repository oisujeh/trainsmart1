<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col bg-white">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table
                                class="min-w-full border text-center text-sm font-light dark:border-neutral-500">
                                <thead class="border-b bg-neutral-800 font-medium text-white dark:border-neutral-500 dark:bg-neutral-900">
                                <tr>
                                    <th
                                        scope="col"
                                        class="border-r px-6 py-4 dark:border-neutral-500">
                                        Name
                                    </th>
                                    <th
                                        scope="col"
                                        class="border-r px-6 py-4 dark:border-neutral-500">
                                        Email
                                    </th>
                                    <th
                                        scope="col"
                                        class="border-r px-6 py-4 dark:border-neutral-500">
                                        sex
                                    </th>
                                    <th
                                        scope="col"
                                        class="border-r px-6 py-4 dark:border-neutral-500">
                                        Designation
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trainingLists as $list)
                                <tr class="border-b dark:border-neutral-500">
                                    <td
                                        class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                        {{ ucwords($list->name)}}
                                    </td>
                                    <td
                                        class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                        {{ $list->email}}
                                    </td>
                                    <td
                                        class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                        {{ $list->sex}}
                                    </td>
                                    <td
                                        class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                                        {{ ucwords($list->designation)}}
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


