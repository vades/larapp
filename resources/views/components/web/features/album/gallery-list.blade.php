<x-web.layout :title="$page->metaTitle" :description="$page->metaDescription" :keywords="$page->keywords">
    <x-web.partials.page-header :page="$page" />
<x-utils.lightbox :images="$images"/>

    <!-- component -->
    <section x-data="modalControl"

             @keydown.window="closeOnEscape($event)">

        <button class="bg-blue-500 text-white rounded-md px-4 py-2 hover:bg-blue-700 transition"
                @click="open()">Open modal
        </button>
        <div x-show="showModal"
             id="modalWindow"
             class="hidden fixed z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 modal">
            <div class="relative top-10 mx-auto max-w-[1800px] shadow-xl rounded-md bg-white  h-[90%]">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Modal title
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="close()">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <article class="h-[90%] overflow-y-scroll p-4">
                    <p>Scrollable modal body</p>
                    <p>Scrollable modal body</p>
                    <p>Scrollable modal body</p>
                    <p>Scrollable modal body</p>
                    <p>Scrollable modal body</p>
                    <p>Scrollable modal body</p>
                    <p>Scrollable modal body</p>
                    <p>Scrollable modal body</p>
                    <p>Scrollable modal body</p>
                    <p>Scrollable modal body</p>
                </article>
            </div>
        </div>
    </section>



    <script type="text/javascript">
        document.addEventListener('alpine:init', () => {
            Alpine.data('modalControl', () => ({
                showModal: false,
                open() {
                    this.showModal = true;
                    document.body.classList.add('overflow-y-hidden');
                    document.getElementById('modalWindow').classList.remove('hidden');
                },
                close() {
                    this.showModal = false;
                    document.body.classList.remove('overflow-y-hidden');
                },
                closeOnEscape(event) {
                    if (event.keyCode === 27) {
                        this.close();
                    }
                }
            }));
        });
    </script>
</x-web.layout>