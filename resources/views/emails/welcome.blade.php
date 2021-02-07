Hello {{$user->name}}
Thankyou for creating account. Please verify your email using these link:
{{route('verify', $user->verification_token)}}