</button>
<div x-show="showModal"
     id="modalWindow"
        {{$attributes->class(['hidden fixed z-50 inset-0 bg-gray-900 bg-opacity-80 overflow-y-auto h-full w-full px-4 modal'])}}>
    <div class="relative top-10 mx-auto max-w-[1800px] shadow-xl bg-white h-[90%] dark:bg-gray-700">
        <header class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <div class="text-xl font-semibold text-gray-900 dark:text-gray-400">{{$title ?? ''}}</div>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="close()">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </header>
        @isset($body)
            <div {{$body->attributes->class(['h-[90%] overflow-y-scroll p-4'])}}>{{$body}}</div>
        @endisset

        @isset($footer)

            <footer class="flex items-center p-4 md:p-5 border-t border-gray-200  dark:border-gray-600">
                {{$footer}}
            </footer>
        @endisset
    </div>
</div>

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