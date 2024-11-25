<x-web.layout :title="$page->metaTitle" :description="$page->metaDescription" :keywords="$page->keywords">
    <x-web.partials.page-header :page="$page" />
{{--     <x-utils.lightbox :images="$images"/> --}}

    <!-- component -->
    <section x-data="modal"

             @keydown.window="closeOnEscape($event)">
        
        <button class="bg-blue-500 text-white rounded-md px-4 py-2 hover:bg-blue-700 transition"
                @click="open()">Open modal
        </button>
        <div  x-show="show"
             class="fixed z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 modal">
            <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">
                <!-- Modal header -->
                <header class="flex justify-between items-center bg-green-500 text-white text-xl rounded-t-md px-4 py-2">
                    <h3>Modal header</h3>
                    <button @click="close()">x</button>
                </header>

                <!-- Modal body -->
                <article class="max-h-48 overflow-y-scroll p-4">
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

                <!-- Modal footer -->
                <footer class="px-4 py-2 border-t border-t-gray-500 flex justify-end items-center space-x-4">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition"
                            @click="close()">Close (ESC)
                    </button>
                </footer>
            </div>
        </div>
    </section>



    <script type="text/javascript">
        document.addEventListener('alpine:init', () => {
            Alpine.data('modal', () => ({
                show: false,
                open() {
                    this.show = true;
                    document.body.classList.add('overflow-y-hidden');
                },
                close() {
                    this.show = false;
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