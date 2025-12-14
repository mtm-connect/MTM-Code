<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            {{ __('Update Prices') }}
        </h2>
    </x-slot>

    @if (session('status'))
        <div class="mt-12 max-w-7xl mx-auto w-auto rounded-xl p-2 text-center border"
             style="color: #064e3b; border-color: #064e3b;">
            <h1 class="text-xl font-bold">
                {{ session('status') }}
            </h1>
        </div>
    @endif

        <form method="POST" action="{{ route('admin.prices.update') }}">
            @csrf
            @method('PUT')

            <div class="max-w-7xl mx-auto w-full  pt-12 pb-4 overflow-hidden sm:rounded-lg">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    @foreach($prices as $price)
                        <div class="bg-white bg-opacity-5 border border-gray-700 rounded-lg p-5">
                            <x-input-label :for="'price_'.$price->id" :value="$price->product . ' Price'" />

                            <x-text-input 
                                id="price_{{ $price->id }}"
                                class="block mt-3 w-full"
                                type="number"
                                name="prices[{{ $price->id }}]"
                                step="0.01"
                                value="{{ old('prices.'.$price->id, $price->price) }}"
                                required
                            />

                            <x-input-error :messages="$errors->get('prices.'.$price->id)" class="mt-2" />
                        </div>
                    @endforeach

                </div>

                <div class="mt-6 text-right">
                    <x-primary-button>
                        {{ __('Update Prices') }}
                    </x-primary-button>
                </div>

            </div>

        </form>


</x-admin-layout>
