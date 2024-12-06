<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Registro - {{ config('app.name') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #007bff;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #666;
            text-align: center;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Confirmação de Registro</h1>
        <p>Olá,</p>
        <p>Obrigado por se registrar na {{ config('app.name') }}.</p>
        <p>Seu código de verificação é:</p>
<p style="display: inline-block; background-color: #eaf4fc; color: #007bff; padding: 10px 20px; border-radius: 5px; font-size: 1.2em; font-weight: bold; text-align: center;">
    {{ $code }}
</p>
        <p>Por favor, insira este código no campo apropriado para verificar sua conta.</p>
        <p>Se você não se registrou na nossa plataforma, por favor ignore este e-mail.</p>
        
        <div class="footer">
            <p>Atenciosamente,</p>
            <p>A equipe da {{ config('app.name') }}</p>
           
            <p>Se você tiver alguma dúvida, entre em contato conosco em <a href="mailto:empregaplus.service@gmail.com">empregaplus.service@gmail.com</a>.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>
