<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Candidatura Recebida</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fb; /* Cor de fundo suave */
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            background-color: #007bff; /* Azul suave */
            color: white;
            padding: 20px;
            border-radius: 8px;
        }
        .email-body {
            margin-top: 20px;
            font-size: 16px;
        }
        .email-body p {
            margin: 10px 0;
        }
        .email-body strong {
            color: #0056b3; /* Azul escuro */
        }
        .cta-button {
            background-color: #007bff; /* Azul para os botões */
            color: white; /* Texto branco */
            padding: 15px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            display: inline-block;
            margin-top: 20px;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            border: 2px solid transparent;
        }
        .cta-button:hover {
            background-color: #0056b3; /* Azul mais escuro */
            transform: translateY(-2px); /* Efeito de elevação ao passar o mouse */
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="email-header">
            <h2>Nova Candidatura Recebida</h2>
            <p>Você tem uma nova candidatura para a vaga <strong>{{ $jobPost->titulo }}</strong></p>
        </div>

        <div class="email-body">
            <p><strong>Candidato:</strong> {{ $candidatura->candidato->user->username }}</p>
            <p><strong>E-mail:</strong> {{ $candidatura->candidato->user->email }}</p>
            <p><strong>Data de Candidatura:</strong> {{ $candidatura->created_at->format('j/n/y \P\e\l\a\s G:i') }}</p>

            @if ($candidatura->carta_candidatura)
    <p style="text-align: center;">
        <a href="{{ asset('storage/' . $candidatura->carta_candidatura) }}" class="cta-button" style="color: white;">Clique aqui para baixar a carta de candidatura</a>
    </p>
@else
    <p style="text-align: center; font-style: italic;">Não fornecida</p>
@endif

@if ($candidatura->anexo)
    <p style="text-align: center;">
        <a href="{{ asset('storage/' . $candidatura->anexo) }}" class="cta-button" style="color: white;">Clique aqui para baixar o anexo</a>
    </p>
@endif

        </div>

        <div class="footer">
            <p>Atenciosamente,<br><strong>Equipe Emprega+</strong></p>
            <p>Se você tiver alguma dúvida, entre em contato conosco em <a href="mailto:empregaplus.service@gmail.com">empregaplus.service@gmail.com</a>.</p>
            <p>&copy; {{ date('Y') }} Emprega+. Todos os direitos reservados.</p>
        </div>
    </div>

</body>
</html>
