<!-- Nav Top Area -->
<div class="fixed w-full h-30 px-10 pt-6 pb-11 mt-0 flex bg-emerald-950 items-center justify-between z-50">
    <!-- Page Heading -->
    @isset($header)
        <header class="mr-4 ml-72">
            <div class="font-hanken w-full font-white">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Search Bar Section -->
    <div class="flex items-center w-1/3">
        <form method="GET" action="{{ route('orders.index') }}" class="w-full">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search Order..."
                class="w-full py-3 px-6 rounded-full border border-gray-300 focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition duration-200 ease-in-out"
            />
        </form>
    </div>

    <!-- Container for Notifications & New Order Button -->
    <div class="flex items-center space-x-4 ">
   <!-- Notification Wrapper (does NOT affect button layout) -->
<div x-data="{ open: false, notifications: [], unread: 0 }"
     x-init="
        fetch('{{ route('notifications.json') }}', { headers: { 'Accept': 'application/json' } })
          .then(r => r.json())
          .then(d => { notifications = d.items; unread = d.unreadCount; });
     "
     class="relative">

    <!-- 🔔 Your existing button -->
    <button 
        @click="open = true"
        class="relative p-2 rounded-lg hover:bg-gray-200 transition mt-1 font-hanken tracking-tight hover:outline hover:outline-2 hover:outline-white transition-al"
    >   
    <!-- 🔴 Unread Badge -->
        <template x-if="unread > 0">
            <span class="absolute top-1 right-0 flex items-center justify-center
                         w-1 h-1 text-[10px] bg-red-500 text-white font-semibold rounded-full">
                <span x-text="unread"></span>
            </span>
        </template>

        <!-- Bell Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
             fill="none" stroke="white" stroke-width="1.8"
             stroke-linecap="round" stroke-linejoin="round"
             class="h-6 w-6">
            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9" />
            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
        </svg>

     
    </button>

    <!-- ⚫ Overlay -->
    <div x-show="open"
         @click="open = false"
         class="fixed inset-0 bg-black/40 z-40"
         x-transition.opacity></div>

    <!-- 🧭 Slide-In Panel -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed top-0 right-0 h-full w-80 bg-white shadow-xl z-50 flex flex-col">

        <!-- Header -->
        <div class="flex items-center justify-between p-4">
            <h2 class="text-lg font-semibold">Notifications</h2>
            <button @click="open = false" class="text-gray-500 hover:text-gray-700">✕</button>
        </div>

        <!-- Body -->
        <div class="flex-1 overflow-y-auto">
            <template x-if="notifications.length === 0">
                <p class="p-4 text-sm text-gray-500">No notifications yet.</p>
            </template>

            <ul>
                <template x-for="n in notifications" :key="n.id">
                    <li class="p-12 m-4 border-b hover:bg-gray-50 flex justify-between items-start">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm py-2 px-4 font-medium" x-text="n.message"></p>
                            <p class="text-xs py-2 px-4 text-gray-500" x-text="n.time"></p>
                        </div>
                        <button
                            x-show="!n.read"
                            @click="
                                fetch('{{ route('notifications.read', ':id') }}'.replace(':id', n.id), {
                                    method: 'POST',
                                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                                }).then(() => {
                                    n.read = true;
                                    unread = Math.max(0, unread - 1);
                                })
                            "
                            class="text-xs text-emerald-700 hover:underline"
                        >
                            Mark read
                        </button>
                    </li>
                </template>
            </ul>
        </div>

        <!-- Footer -->
        <div class="p-3  text-right">
            <button
                @click="
                    fetch('{{ route('notifications.readAll') }}', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                    }).then(() => {
                        notifications.forEach(n => n.read = true);
                        unread = 0;
                    })
                "
                class="text-sm px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-lg"
            >
                Mark all read
            </button>
        </div>
    </div>
</div>


        <!-- New Order Button -->
        <div class="rounded-full p-2  bg-gray-100 mt-1 flex hover:text-gray-300 focus:outline-none transition ease-in-out duration-15">
            <a
                href="{{ route('order.create') }}"
                class=" inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-xl text-black  transition ease-in-out duration-150 w-full"
            >
                {{ __('Create Order') }}
            </a>
        </div>
    </div>
</div>


<nav x-data="{ open: false }" class="fixed z-50 bg-emerald-950 h-screen w-72 top-0 left-0 p-4 flex flex-col justify-between">
    
    <!-- Top Section -->
    <div class="px-4 py-6 flex flex-col items-center">
        <!-- Logo -->
        <div class="text-xl text-white font-bold mb-12 flex justify-center items-center mt-12">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block fill-current text-gray-800 bg-red-400" />
            </a>
        </div>

<!-- Navigation Links -->
<ul class="space-y-4 w-full">
    <li>
        <a href="{{ route('dashboard') }}" class="flex items-center text-white text-xl py-3 px-4 rounded-lg font-hanken tracking-tight hover:outline hover:outline-2 hover:outline-white transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-7 w-7 mr-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
            </svg>
            {{ __('Dashboard') }}
        </a>
    </li>

    <li>
        <a href="{{ route('orders.index') }}" class="flex items-center text-white text-xl py-3 px-4 font-hanken tracking-tight rounded-lg hover:outline hover:outline-2 hover:outline-white hover:text-white transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-7 w-7 mr-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
            {{ __('Orders') }}
        </a>
    </li>

    <li>
        <a href="{{ route('account.index') }}" class="flex items-center text-white text-xl py-3 px-4 font-hanken tracking-tight rounded-lg hover:outline hover:outline-2 hover:outline-white hover:text-white transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-7 w-7 mr-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 12c2.485 0 4.5-2.015 4.5-4.5S14.485 3 12 3 7.5 5.015 7.5 7.5 9.515 12 12 12z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 21a7.5 7.5 0 0115 0v.75H4.5V21z" />
        </svg>
            {{ __('Account') }}
        </a>
    </li>
</ul>


    </div>




<!-- Company Name & Logout (Centered & Spaced) -->
<div class="relative w-full flex flex-col items-center p-2">
    <!-- Company Name -->
    <span class="text-lg font-semibold text-white text-center mb-2">{{ Auth::user()->company }}</span>

    <!-- Logout Button -->
    <form method="POST" action="{{ route('logout') }}" class="w-full mb-4">
        @csrf
        <button type="submit" class="flex justify-center items-center gap-2 w-full px-4 py-3 text-sm font-medium text-white rounded-lg border border-white transition 
            opacity-50 hover:opacity-100 focus:opacity-100">
            <span>Log Out</span>
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h6.586l-2.293-2.293a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H6a1 1 0 01-1-1z" clip-rule="evenodd"/>
            </svg>
        </button>
    </form>
</div>





</nav>






<!-- Mobile Hamburger Button -->
<div class="sm:hidden">
    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

<!-- Mobile Menu (Hidden by default) -->
<div :class="{'block': open, 'hidden': ! open}" class="sm:hidden fixed inset-0 bg-gray-800 bg-opacity-75 z-50">
    <div class="relative w-64 bg-yellow-500 h-full px-4 py-6">
        <!-- Mobile Navigation Links -->
        <ul class="space-y-4">
            <li>
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
            </li>
            <li>
                <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                    {{ __('Orders') }}
                </x-nav-link>
            </li>
            <!-- More links for mobile -->
        </ul>

        <!-- Close Button -->
        <button @click="open = false" class="absolute top-4 right-4 text-white">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>
