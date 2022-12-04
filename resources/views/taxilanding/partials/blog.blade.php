

<!-- Section 1 -->
<section class="w-full px-8 pt-20 pb-16 bg-white xl:px-0">
    <div class="flex flex-col max-w-6xl mx-auto">
      <h3 class="text-4xl font-extrabold leading-none sm:text-5xl md:text-6xl lg:leading-7">{{ __('taxi.blog_title') }}</h3>
</section>

  
<!-- Section 1 -->
<section class="bg-white">
    <div class="w-full px-5 py-6 mx-auto space-y-5 sm:py-8 md:py-12 sm:space-y-8 md:space-y-16 max-w-7xl">


        <div class="flex grid grid-cols-12 pb-10 sm:px-5 gap-x-8 gap-y-16">

            @foreach ($blog_posts as $blog_post)
                <div class="flex flex-col items-start col-span-12 space-y-3 sm:col-span-6 xl:col-span-6">
                    <a href="{{$blog_post->link }}" class="block">
                        <img class="object-cover w-full mb-2 overflow-hidden rounded-lg shadow-sm max-w-300" src="{{  $blog_post->image_link }}">
                    </a>
                
                    <h2 class="text-lg font-bold sm:text-xl md:text-2xl"><a href="{{$blog_post->link }}">{{ $blog_post->title }}</a></h2>
                    <p class="text-sm text-gray-500">{{ $blog_post->description }}</p>
                    <p class="pt-2 text-xs font-medium"><a href="{{$blog_post->link }}" class="mr-1 underline">{{$blog_post->link_name }}</a></p>
                </div>
            @endforeach
            
          


        </div>
    </div>
</section>
