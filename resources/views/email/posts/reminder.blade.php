@component('mail::message')
# Weekly Reminder

Hey {{ $user->name }} ! {{ $posts->count() }} new post(s) for you!

@foreach($posts as $post)
- [{{ $post->title }}]({{ route('posts.show', $post) }})
@endforeach

Thanks,<br>
{{ config('app.name') }}
@endcomponent
