<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">My Account</h2>
    </x-slot>

    @php
        $currentSub = trim((string)($user->subscription ?? 'None'));

        $plans = [
            'Basic' => ['price' => '£500/month','features' => ['Access to digital measurement platform','Order processing','Fabric Books (Basic)'],'bg' => 'bg-black'],
            'Pro' => ['price' => '£1500/month','features' => ['Access to digital measurement platform','Order processing','Fabric Books (Pro)','Training for Staff','Fitting Support'],'bg' => 'bg-black'],
            'Enterprise' => ['price' => '£3000/month','features' => ['Access to digital measurement platform','Order processing','Fabric Books (Pro)','Training for Staff','Fitting Support','Dedicated Support','Marketing Assets','Trunk Shows'],'bg' => 'bg-black'],
        ];

        $orderedPlans = $plans;
        if (isset($plans[$currentSub])) {
            $orderedPlans = array_merge([$currentSub => $plans[$currentSub]], array_diff_key($plans, [$currentSub => true]));
        }
    @endphp

    <div class="container mx-auto py-12">
        {{-- ✅ Force 12 cols at lg, explicit horizontal gap, and good spacing on smaller screens --}}
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 md:gap-12 gap-x-12">

            <!-- LEFT: Account Form -->
            <div class="lg:col-span-7">
                <div class="rounded-2xl  p-6">
                    <h3 class="text-2xl font-semibold mb-4">Account Form</h3>

                    <form method="POST" action="{{ route('account.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="block mt-1 w-full"
                                value="{{ old('name') }}" placeholder="{{ $user->name ?? 'Enter your name' }}"
                                title="Enter your full name" autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Company -->
                        <div>
                            <x-input-label for="company" :value="__('Company')" />
                            <x-text-input id="company" name="company" type="text" class="block mt-1 w-full"
                                value="{{ old('company') }}" placeholder="{{ $user->company ?? 'Enter your company name' }}"
                                title="Your business or organization name (optional)" autocomplete="organization" />
                            <x-input-error :messages="$errors->get('company')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="block mt-1 w-full"
                                value="{{ old('email') }}" placeholder="{{ $user->email ?? 'Enter your email address' }}"
                                title="Your contact email address" autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Phone -->
                        <div>
                            <x-input-label for="phone_number" :value="__('Phone Number')" />
                            <x-text-input id="phone_number" name="phone_number" type="text" class="block mt-1 w-full"
                                value="{{ old('phone_number') }}" placeholder="{{ $user->phone_number ?? 'Enter your phone number' }}"
                                title="Include country code, e.g. +44 7700 900123" />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>

                        <!-- Country -->
                        <div>
                            <x-input-label for="country" :value="__('Country')" />
                            <select id="country" name="country"
                                class="block w-full p-4 border border-gray-300 bg-white text-black rounded-xl
                                       focus:text-black focus:font-bold focus:bg-white focus:border-gray-300 focus:ring-white"
                                title="Select your country of residence" required>
                                <option value="" disabled {{ old('country', $user->country ?? '') == '' ? 'selected' : '' }}>
                                    {{ __('Select Country') }}
                                </option>
                                <option value="IE" {{ old('country', $user->country ?? '') == 'IE' ? 'selected' : '' }}>Ireland</option>
                                <option value="GB" {{ old('country', $user->country ?? '') == 'GB' ? 'selected' : '' }}>United Kingdom</option>
                                <option value="US" {{ old('country', $user->country ?? '') == 'US' ? 'selected' : '' }}>United States</option>
                            </select>
                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                        </div>

                        <!-- Address Line 1 -->
                        <div>
                            <x-input-label for="address_line_1" :value="__('Address Line 1')" />
                            <x-text-input id="address_line_1" name="address_line_1" type="text" class="block mt-1 w-full"
                                value="{{ old('address_line_1') }}" placeholder="{{ $user->address_line_1 ?? 'Enter your address' }}"
                                title="Street address, P.O. box, or company address" autocomplete="address-line1" />
                            <x-input-error :messages="$errors->get('address_line_1')" class="mt-2" />
                        </div>

                        <!-- Address Line 2 -->
                        <div>
                            <x-input-label for="address_line_2" :value="__('Address Line 2 (Optional)')" />
                            <x-text-input id="address_line_2" name="address_line_2" type="text" class="block mt-1 w-full"
                                value="{{ old('address_line_2') }}" placeholder="{{ $user->address_line_2 ?? 'Apartment, suite, etc.' }}"
                                title="Apartment, suite, unit, building, floor, etc." autocomplete="address-line2" />
                            <x-input-error :messages="$errors->get('address_line_2')" class="mt-2" />
                        </div>

                        <!-- Post Code -->
                        <div>
                            <x-input-label for="post_code" :value="__('Postcode')" />
                            <x-text-input id="post_code" name="post_code" type="text" class="block mt-1 w-full"
                                value="{{ old('post_code') }}" placeholder="{{ $user->post_code ?? 'Enter your postcode' }}"
                                title="Your postal or ZIP code" autocomplete="postal-code" />
                            <x-input-error :messages="$errors->get('post_code')" class="mt-2" />
                        </div>

                        <!-- County -->
                        <div>
                            <x-input-label for="county" :value="__('County')" />
                            <x-text-input id="county" name="county" type="text" class="block mt-1 w-full"
                                value="{{ old('county') }}" placeholder="{{ $user->county ?? 'Enter your county' }}"
                                title="County, state, or region name" autocomplete="address-level1" />
                            <x-input-error :messages="$errors->get('county')" class="mt-2" />
                        </div>

                        <!-- Submit -->
                        <div class="flex items-center justify-end pt-2">
                            <x-primary-button class="ms-3">
                                {{ __('Update Account') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

           <!-- RIGHT: Subscription Overview -->
<div class="lg:col-span-5">
    <div class="rounded-2xl bg-white/0 p-0">
        <div class="space-y-6">
            <div class="rounded-2xl  p-6 {{ $currentSub === 'None' ? 'bg-emerald-950/40' : 'bg-white/5' }}">
                <h3 class="text-2xl font-semibold mb-4">Current Subscription</h3>

                {{-- 🔹 Handle no active subscription --}}
                @if ($currentSub === 'None' || str_contains(strtolower($currentSub), 'no active'))
                    <div class="rounded-xl bg-emerald-950/30 border border-white/10 p-6 text-center">
                        <p class="text-white text-xl font-semibold mb-2">No Active Subscriptions</p>
                        <p class="text-white/70 text-sm">
                            You currently don’t have any active subscription plans.
                        </p>
                    </div>
                @else
                    {{-- Active plan card --}}
                    @php $active = $orderedPlans[array_key_first($orderedPlans)]; @endphp
                    <div class="rounded-xl bg-black text-white p-6 shadow-md border border-white/10">
                        <div class="flex items-start justify-between rounded-xl">
                            <div>
                                <div class="text-3xl font-extrabold">{{ array_key_first($orderedPlans) }}</div>
                                <div class="text-white/80 mt-1">{{ $active['price'] }}</div>
                            </div>
                            <span class="inline-flex items-center rounded-full bg-emerald-600/20 text-emerald-300 px-3 py-1 text-sm font-semibold">Active</span>
                        </div>
                        <ul class="mt-4 space-y-2 text-sm">
                            @foreach($active['features'] as $f)
                                <li class="flex items-start gap-2">
                                    <span class="mt-1 h-1.5 w-1.5 rounded-full bg-white/70"></span>{{ $f }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Remaining plans --}}
                    @foreach($orderedPlans as $planName => $plan)
                        @if($planName === $currentSub)
                            @continue
                        @endif

                        <div class="mt-6 rounded-xl bg-gray-200 p-6 border border-white/10">
                            <div class="flex items-start justify-between rounded-xl">
                                <div>
                                    <div class="text-3xl font-extrabold">{{ $planName }}</div>
                                    <div class="text-white/80 mt-1">{{ $plan['price'] }}</div>
                                </div>
                            </div>
                            <ul class="mt-4 space-y-2 text-sm">
                                @foreach($plan['features'] as $f)
                                    <li class="flex items-start gap-2">
                                        <span class="mt-1 h-1.5 w-1.5 rounded-full bg-white/70"></span>{{ $f }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                @endif

                {{-- ✳️ Contact section --}}
                <div class="mt-8 rounded-xl bg-white/5 p-6 text-center">
                    <p class="text-white/80 text-sm">
                        If you wish to <span class="font-semibold">upgrade</span>,
                        <span class="font-semibold ">downgrade</span>, or
                        <span class="font-semibold ">cancel</span> a subscription,
                        please contact
                        <a href="mailto:admin@mtm-connect.com" class="text-emerald-400 hover:text-emerald-300 underline">
                            admin@mtm-connect.com
                        </a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


        {{-- Optional success banner --}}
        @if (session('success'))
            <div class="mt-8 rounded-xl bg-emerald-600 text-white text-center py-3">
                {{ session('success') }}
            </div>
        @endif
    </div>
</x-app-layout>

