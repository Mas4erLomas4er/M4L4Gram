@component('mail::message')
# Welcome to M4L4Gram!

Thank you for joining to our amazing community!

@component('mail::button', ['url' => route('profiles.show', $user->id)])
Visit my profile
@endcomponent

All the best,<br>
{{ $user->name }}
@endcomponent
