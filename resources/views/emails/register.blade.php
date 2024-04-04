@component('mail::message')

   <p> Hello, {{$user->fname}} <p>

@component('mail::button', ['url' => url('verify/'. $user->remember_token)])
Verify
@endcomponent

<div style="text-align: center;">
   <p>We Noticed, You've Registered On Our Website</p>
   <p>Click on the Verify Button to verify your Account!</p>
   <p>Thank You!</p>
</div>

{{ config('app.name')}}
@endcomponent
