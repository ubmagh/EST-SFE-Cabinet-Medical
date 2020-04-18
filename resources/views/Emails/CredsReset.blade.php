@component('mail::message')
# Bonjour !

pour vous connecter à votre compte, si vous oublié votre Pseudo voici le :

Pseudo : {{$pseudo}}

et pour réinitialiser votre mot de passe en cas d'oublie, cliquez sur ce botton :

@component('mail::button', ['url' => $url])
Button
@endcomponent

ou Allez sur le lien : 

<code>{{$url}}</code>

<small>
    si vous n'avez pas demandé de ce service et de réinitialiser votre mot de passe, just supprimez ce message !
</small>

Merci Bien !<br>
{{ config('app.name') }}
@endcomponent
