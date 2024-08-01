<x-web.layout :title="$page->metaTitle" :description="$page->metaDescription" :keywords="$page->keywords">
    <x-web.partials.page-header :page="$page" />
    <article>
        {!! $page->content !!}
    </article>
</x-web.layout>