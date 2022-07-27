@component('mail::message')
# Introduction

Welcome to FriendGram. Wish you have the most experience

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
