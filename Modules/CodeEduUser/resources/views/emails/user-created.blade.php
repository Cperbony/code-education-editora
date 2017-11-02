<h3>{{config_path('app.name')}}</h3>
<p><strong> Sua conta na plataforma foi criada com sucesso! </strong></p>
<p>Usuário: <strong>{{ $user->email }}</strong></p>
<p>
    <?php $link = route('codeeduuser.email-verification.check', $user->verification_token).'?email='.urlencode($user->email); ?>
    Clique aqui para verificar sua conta <a href="{{ $link }}">{{ $link }}</a>
</p>
<p>Obs.: Não responda este email. Ele é gerado automaticamente.</p>