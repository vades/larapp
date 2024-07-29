<x-web.layout :title="$page->metaTitle" :description="$page->metaDescription" :keywords="$page->keywords">
    <x-web.partials.page-header :page="$page" />
    <article>
       Content
    </article>
    <x-utils.pagination />
</x-web.layout>