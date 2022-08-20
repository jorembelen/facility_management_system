@component('mail::message')
# Welcome to your new home {{ $tenant->name }}.

Please click the button below to proceed to SADARA Housing login page. <br>
Your username is: <strong>{{ $tenant->username }}</strong> <br>
Password: <strong>{{ $password }}</strong>

@component('mail::button', [ 'url' => route('home')])
Click Here
@endcomponent

Thanks,<br>
{{ config('app.name') }} Admin
@endcomponent
