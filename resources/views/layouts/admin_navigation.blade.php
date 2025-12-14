<!-- Nav Top Area -->
<div class=" fixed w-full  h-30 px-10 pt-6 pb-11 mt-0 flex  bg-black items-center justify-between z-50">
       <!-- Page Heading -->
       @isset($header)
                <header class="mr-4 ml-72 ">
                    <div class="font-hanken w-full font-white">
                        {{ $header }}
                    </div>
                </header>
            @endisset
  <!-- Search Bar Section -->
<div class="flex items-center w-1/3">
    <form method="GET" action="{{ route('admin.orders.index') }}" class="w-full">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Order..."
            class="w-full py-3 px-6 rounded-full border border-gray-300 focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition duration-200 ease-in-out"
        />
    </form>
</div>
    
    
    <!-- Container for User Info & New Order Button -->
    <div class="flex items-center space-x-4 "> <!-- Flex container to align items side by side -->
    
        


    </div>
</div>

<nav x-data="{ open: false }" class="fixed z-50 bg-black h-screen w-72 top-0 left-0 p-4 flex flex-col justify-between">
    
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
        <a href="{{ route('admin.dashboard') }}" class="flex items-center text-white text-xl py-3 px-4 rounded-lg font-hanken tracking-tight hover:outline hover:outline-2 hover:outline-white transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-7 w-7 mr-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
            </svg>
            {{ __('Dashboard') }}
        </a>
    </li>

    <li>
        <a href="{{ route('admin.orders.index') }}" class="flex items-center text-white text-xl py-3 px-4 font-hanken tracking-tight rounded-lg hover:outline hover:outline-2 hover:outline-white hover:text-white transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-7 w-7 mr-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
            {{ __('Orders') }}
        </a>
    </li>

    <!-- Clients -->
    <li>
    <a href="{{ route('admin.clients.index') }}" class="flex items-center text-white text-xl py-3 px-4 font-hanken tracking-tight rounded-lg hover:outline hover:outline-2 hover:outline-white hover:text-white transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-7 w-7 mr-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 12c2.485 0 4.5-2.015 4.5-4.5S14.485 3 12 3 7.5 5.015 7.5 7.5 9.515 12 12 12z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 21a7.5 7.5 0 0115 0v.75H4.5V21z" />
        </svg>
        {{ __('Clients') }}
        </a>
</li>




    <!-- Settings -->
    <li>
    <a href="{{ route('admin.prices.edit') }}" class="flex items-center text-white text-xl py-3 px-4 font-hanken tracking-tight rounded-lg hover:outline hover:outline-2 hover:outline-white hover:text-white transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-7 w-7 mr-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.781l.893.149c.543.09.941.56.941 1.11v1.094c0 .55-.398 1.02-.94 1.11l-.894.149c-.424.07-.764.384-.93.78-.164.398-.142.855.108 1.205l.527.737c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.737-.527c-.35-.25-.806-.272-1.204-.107-.397.165-.71.505-.781.93l-.149.893c-.09.543-.56.941-1.11.941h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.449l.527-.737c.25-.35.272-.806.107-1.204-.165-.397-.505-.71-.93-.781l-.894-.149c-.542-.09-.94-.56-.94-1.11v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.071.764-.384.93-.781.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.806.272 1.204.107.397-.165.71-.505.781-.93l.149-.894z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        {{ __('Pricing') }}
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
