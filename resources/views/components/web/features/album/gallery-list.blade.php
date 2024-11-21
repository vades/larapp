<x-web.layout :title="$page->metaTitle" :description="$page->metaDescription" :keywords="$page->keywords">
    <x-web.partials.page-header :page="$page" />
    <section  x-data="{ activeIndex: 0, items: $el.querySelectorAll('[data-carousel-item]'), showLightbox: true }"
              x-init="items[0].classList.remove('hidden')">
        <article id="controls-carousel" class="relative overflow-hidden shadow-lg bg-black h-[calc(100vh-20%)] mx-auto" x-show="showLightbox">
            di
            <!-- Carousel wrapper -->
            <div class="flex items-center justify-center _h-80 _md:h-96">
                @foreach(collect($images) as $item)
                    <figure class="hidden duration-700 ease-in-out rounded-lg" data-carousel-item>
                        <img src="{{$item->src}}" class="max-w-full rounded-lg border-2 border-silver max-h-[600px] "
                             alt="{{ $item->title}}">
                        <figcaption class="text-white mt-4">{{ $item->title}}</figcaption>
                    </figure>

                @endforeach
            </div>
            <!-- Slider controls -->
            <button type="button"
                    class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-prev
                    @click="items[activeIndex].classList.add('hidden'); activeIndex = (activeIndex - 1 + items.length) % items.length; items[activeIndex].classList.remove('hidden')">
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
                 aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 6 10">
                <path stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M5 1 1 5l4 4" />
            </svg>
            <span class="sr-only">Previous</span>
        </span>
            </button>
            <button type="button"
                    class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-next
                    @click="items[activeIndex].classList.add('hidden'); activeIndex = (activeIndex + 1) % items.length; items[activeIndex].classList.remove('hidden')">
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
                 aria-hidden="true"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 6 10">
                <path stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="m1 9 4-4-4-4" />
            </svg>
            <span class="sr-only">Next</span>
        </span>
            </button>
        </article>
        <article class="grid grid-cols-2 gap-2 md:grid-cols-4 lg:grid-cols-5">
            @foreach(collect($images) as $index => $item)
                <x-utils.card class="bg-skin-base">
                    <x-slot name="header">
                        <img class="mr-auto ml-auto image-thumbnail"
                             src="{{$item->thumbnail}}"
                             alt="{{ $item->title}}"
                             @click="showLightbox = true,items[activeIndex].classList.add('hidden'); activeIndex = {{ $index }}; items[activeIndex].classList.remove('hidden')">
                    </x-slot>
                </x-utils.card>
            @endforeach
        </article>


    </section>
</x-web.layout>