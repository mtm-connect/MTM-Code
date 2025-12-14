<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <div class="max-w-7xl mx-auto">

            {{-- SECOND SEARCH BAR ABOVE TABLE --}}
            <div class="flex justify-end mb-6 mt-4">
                <form method="GET" action="{{ route('admin.clients.index') }}" class="w-full sm:w-1/3">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search Client..."
                        class="w-full py-3 px-6 rounded-full border border-gray-300 focus:outline-none 
                               focus:ring-1 focus:ring-black focus:border-black transition duration-200 ease-in-out"
                    />
                </form>
            </div>

            <div class="bg-yellow overflow-hidden">

                @if ($clients->isEmpty())
                    <p class="p-6 text-gray-900">No clients found.</p>
                @else

                    <div class="overflow-x-auto">
                        <table class="w-full mx-auto border-separate min-w-full border-spacing-y-3">
                            <thead>
                                <tr class="text-black">
                                <th class="px-4 py-2 text-left">Company</th>
                                    <th class="px-4 py-2 text-left">Name</th>
                                   
                                    <th class="px-4 py-2 text-left">Email</th>
                                    <th class="px-4 py-2 text-left">Phone</th>
                                
                                    <th class="px-4 py-2 text-left">Subscription</th>
                                    <th class="px-4 py-2 text-left">Total Orders</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($clients as $client)
                                <tr class="bg-gray-100 border border-emerald-950 hover:bg-gray-300 hover:border-emerald-950 cursor-pointer transition duration-200 ease-in-out"
    onclick="window.location='{{ route('admin.clients.show', $client) }}'">


                                        <td class="px-4 py-5 border-t border-b border-l rounded-l-lg font-semibold">
                                           {{ $client->company ?? '—' }}
                                        </td>

                                        <td class="px-4 py-5 border-t border-b">
                                        {{ $client->name }} 
                                        </td>

                                        <td class="px-4 py-5 border-t border-b">
                                            {{ $client->email }}
                                        </td>

                                        <td class="px-4 py-5 border-t border-b">
                                            {{ $client->phone_number ?? '—' }}
                                        </td>

                                    
                                        

                                        <td class="px-4 py-5 border-t border-b">
                                            {{ $client->subscription ?? '—' }}
                                        </td>

                                        <td class="px-4 py-5 border-t border-b border-r rounded-r-lg">
    {{ $client->orders_count }}
</td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- PAGINATION --}}
                    <div class="mt-6">
                        {{ $clients->links() }}
                    </div>

                @endif
            </div>
        </div>
    </div>

</x-admin-layout>
