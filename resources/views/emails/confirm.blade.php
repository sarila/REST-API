Hello {{$user->name}}
You changed your email, so verify this new address with given link:
{{route('verify', $user->verification_token)}}