<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Title List') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Top Left Buttons -->
            <div class="flex justify-end md:py-1">
                <a href="{{ url('/titles/create') }}"
                   class="inline-block mr-1 mb-4 px-4 py-4 border border-transparent text-sm leading-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 hover: focus:outline-none focus:shadow-outline">
                    Add Title
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-6 lg:mt-0 rounded shadow">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <table id="tt" class="stripe" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Directorate</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($trainingTitle as $title)
                        <tr class="transition-all hover:bg-gray-100 hover:shadow-lg pt-1">
                            <td>{{ ucwords($title->title) }}</td>
                            <td>{{ $title->directorate->name}}</td>
                            <td class='pt-1 py-1 px-1 flex items-center'>
                                <a href="{{ route('trainingtitles.edit', $title->id) }}" class="button bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 mb-2 rounded mr-4">Edit</a>
                                <form action="{{ route('trainingtitles.destroy', $title->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button bg-red-700 hover:bg-red-600 text-white font-bold py-1 px-4 mr-2 mb-2 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <script>

        $(document).ready(function() {
            $('#tt').DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                dom: 'Blfrtip',
                "buttons": [
                    'copy','csv','excel','print'
                ],
                "lengthMenu": [[50,100,200],[50,100,200]]
            });
        });
    </script>
</x-app-layout>


