<!DOCTYPE html>
<html>
<head>
    <title>Sua Conta de Avaliador Foi Criada</title>
</head>
<body>
    <h1>Olá, {{ $mailData['name'] }}!</h1>
    <p>Sua conta de avaliador foi criada com sucesso.</p>

    <p>Aqui estão suas credenciais:</p>
    <ul>
        <li><strong>Email:</strong> {{ $mailData['email'] }}</li>
        <li><strong>Senha:</strong> {{ $mailData['password'] }}</li>
    </ul>

    <p>Você pode acessar sua conta e começar a utilizar a plataforma.</p>

    <p>Atenciosamente,<br>Equipe da Plataforma</p>
</body>
</html>
