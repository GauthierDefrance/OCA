<h1>Bienvenue !</h1>

<p>Voici votre code de vérification :</p>
<p><strong>{{ $check_code }}</strong></p>


<p>Ce code est valide pour une durée limitée de 10 minutes.</p>
<small>Vous pouvez utiliser ce code ici : <a href="{{ route('connect.check_email') }}">utiliser votre code</a> </small>
