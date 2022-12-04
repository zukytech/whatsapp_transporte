
@if (strlen(config('settings.client_app_link'))>-1||strlen(config('settings.driver_app_link'))>-1)
   <!-- Section 1 -->
<section class="w-full px-8 pt-20 pb-4 bg-white xl:px-0 bg-gray-100">
    <div class="flex flex-col max-w-6xl mx-auto">
      <h3 class="text-4xl font-extrabold leading-none sm:text-5xl md:text-6xl lg:leading-7">{{ __('taxi.apps_title') }}</h3>
</section>


<!-- Section 2 -->
<section class="bg-gray-100">
    <div class="max-w-6xl py-12 mx-auto">
        <div class="grid gap-8 md:grid-cols-2 lg:gap-12 ">
            @if (strlen(config('settings.driver_app_link'))>-1)
            <a href="{{ config('settings.driver_app_link') }}" class="flex flex-col p-6 space-y-6 transition-all duration-500 bg-white border border-indigo-100 rounded-lg shadow hover:shadow-xl lg:p-8 lg:flex-row lg:space-y-0 lg:space-x-6">
                <div class="flex items-center justify-center w-20 h-20 lg:h-32 lg:w-32">
                    <img src="/taxi/app_icon_driver.png" />
                </div>
                <div class="flex-1">
                    <span class="mt-8 flex items-center text-lg font-bold text-green-600">
                        <h4 class="mt-1 mb-2 text-xl font-bold lg:text-2xl">{{ __('taxi.download_driver_app') }}</h4>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </span>
                </div>
            </a>
            @endif
            @if (strlen(config('settings.client_app_link'))>-1)
            <a href="{{ config('settings.client_app_link') }}" class="flex flex-col p-6 space-y-6 transition-all duration-500 bg-white border border-indigo-100 rounded-lg shadow hover:shadow-xl lg:p-8 lg:flex-row lg:space-y-0 lg:space-x-6">
                <div class="flex items-center justify-center w-20 h-20 lg:h-32 lg:w-32">
                    <img src="/taxi/app_icon_taxi.png" />
                </div>
                <div class="flex-1">
                    <span class="mt-8 flex items-center text-lg font-bold text-green-600">
                        <h4 class="mt-1 mb-2 text-xl font-bold lg:text-2xl">{{ __('taxi.download_client_app') }}</h4>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </span>
                </div>
            </a>
            @endif
            
        </div>
    </div>
</section>
 
@endif



