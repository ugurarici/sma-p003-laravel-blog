@component('mail::message')
# Post Created

Your {{ $post->title }} post has been created!

@component('mail::button', ['url' => route('posts.show', $post)])
Read Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
