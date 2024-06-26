<section>
    <h1>
        Hello world!
    </h1>
    <div class="bg-skin-info">
        This is home page
    </div>
    <div x-data="{ open: false }">
        <button @click="open = true">Show More...</button>

        <ul x-show="open" @click.outside="open = false">
            <li>
                <button wire:click="archive">Archive</button>
            </li>
            <li>
                <button wire:click="delete">Delete</button>
            </li>
        </ul>
    </div>
</section>
