@component('mail::message')
# A new post added to your followed category: {{ $post->category->name }}

A post titled {{ $post->title }} has been added to {{ $post->category->name }} category on your favorite Web site.

@component('mail::button', ['url' => route('posts.show', $post)])
Come check it
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
