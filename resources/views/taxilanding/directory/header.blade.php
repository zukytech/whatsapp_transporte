<!-- Top Notification Bar -->
@if (session('status'))
<a class="block pt-16 pb-6 bg-blue-900 opacity-100 md:h-16 md:pt-0 md:pb-0">
    <span class="relative flex items-center justify-center h-full max-w-6xl pl-10 pr-20 mx-auto leading-tight text-left md:text-center">
      <span class="text-white">{{ __("".session('status')) }}</span>
    </span>
</a>
@endif
  
<!-- Section 1 - Header -->
<section class="relative w-full bg-top bg-cover md:bg-center" x-data="{ showMenu: false }" style="background-image:url('/taxi/bg.jpeg')">
    
    

    <div class="absolute inset-0 w-full h-full bg-gray-900 opacity-25"></div>
    <div class="absolute inset-0 w-full h-64 opacity-50 bg-gradient-to-b from-black to-transparent"></div>
    <div class="relative flex items-center justify-between w-full h-20 px-8">

        <a href="/" class="relative flex items-center h-full pr-6 text-2xl font-extrabold text-white">{{ strtolower(config('global.site_name','FindMeTaxi')) }}<span class="text-green-400">.</span></a>
        @include('taxilanding.partials.nav')

        <!-- Mobile Nav  -->
        <nav class="fixed top-0 right-0 z-30 z-50 flex w-10 h-10 mt-4 mr-4 md:hidden">
            <button @click="showMenu = !showMenu" class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-white hover:bg-opacity-25 focus:outline-none">
                <svg class="w-5 h-5 text-gray-200 fill-current" x-show="!showMenu" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path></svg>
                <svg class="w-5 h-5 text-gray-500" x-show="showMenu" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </nav>
        <!-- End Mobile Nav -->
    </div>

    <div class="relative z-20 px-4 py-24 mx-auto text-center text-white max-w-7xl lg:py-24">
        <div class="flex flex-wrap text-white">
            <div class="relative w-full px-4 mx-auto text-center xl:flex-grow-0 xl:flex-shrink-0">
    
                <h1 class="mt-0 mb-2 text-4xl font-bold text-white sm:text-5xl lg:text-7xl">Find a Taxi</h1>
                <p class="mt-0 mb-4 text-base text-white sm:text-lg lg:text-xl">
                   Find the drivers nearest to you.
                </p>
    
            </div>
        </div>
    </div>
    
    <div class="relative z-30 h-48 px-10 bg-white lg:h-32">
        <form action="{{ route('cockpit.findtaxi') }}" class="flex flex-col items-center h-auto max-w-lg p-6 mx-auto space-y-3 overflow-hidden transform -translate-y-12 bg-white rounded-lg shadow-md lg:h-24 lg:max-w-6xl lg:flex-row lg:space-y-0 lg:space-x-3">
            <div class="relative flex items-center w-full h-12 border-2 border-gray-200 rounded-lg lg:w-auto lg:border-0 lg:flex-1">
                <input value="{{ $_GET['start'] }}"  name="start" id="txtstartlocation" type="text" class="w-full h-full px-4 font-medium text-gray-700 rounded-lg sm:text-lg focus:bg-gray-50 focus:outline-none" placeholder="Location?">
                <svg class="absolute right-0 w-6 h-6 mr-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
            <div class="w-0.5 bg-gray-100 h-10 lg:block hidden"></div>
            <div class="relative flex items-center w-full h-12 border-2 border-gray-200 rounded-lg lg:w-auto lg:border-0 lg:flex-1">
                <input value="{{ $_GET['end'] }}"  name="end" id="txtendlocation" type="text" class="w-full h-full px-4 font-medium text-gray-700 rounded-lg sm:text-lg focus:bg-gray-50 focus:outline-none" placeholder="Location?">
                <svg class="absolute right-0 w-6 h-6 mr-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            </div>
            <input  value="{{ $_GET['phone'] }}" name="phone" id="phone" type="hidden" />
            <div class="w-full h-full lg:w-auto">
                <button type="submit" class="inline-flex items-center justify-center w-full h-full px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 lg:w-64">{{ __('taxi.form_request')}}</button>
            </div>
        </form>
    </div>

    

</section>



