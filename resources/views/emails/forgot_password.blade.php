@component('mail::message')

    Hi, {{ $user->name }}. Forgot Your Password?

    <p>It Happends. Click the link below to reset your password.</p>

    @component('mail::button', ['url' => url('reset/' . $user->remember_token)])
        Reset Your Password
    @endcomponent

    <p>
        ! in case you have any issue recovering your passcode, please contact using the form from contactUs page
        Thanks, </p><br>

    {{ config('app.name') }}

@endcomponent
