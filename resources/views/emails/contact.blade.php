<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo mensaje de contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            background: #EE5E10;
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            margin: -30px -30px 30px -30px;
        }
        .field {
            margin-bottom: 15px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 5px;
            border-left: 4px solid #EE5E10;
        }
        .field strong {
            color: #EE5E10;
            display: block;
            margin-bottom: 5px;
        }
        .message {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
            white-space: pre-line;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>📧 Nuevo Mensaje de Contacto</h1>
        <p>Recibido desde el sitio web de Taekwondo</p>
    </div>

    <div class="field">
        <strong>👤 Nombre:</strong>
        {{ $name }}
    </div>

    <div class="field">
        <strong>📧 Email:</strong>
        <a href="mailto:{{ $email }}">{{ $email }}</a>
    </div>

    <div class="field">
        <strong>📱 Teléfono:</strong>
        {{ $phone }}
    </div>

    <div class="field">
        <strong>📋 Asunto:</strong>
        {{ $subject }}
    </div>

    <div class="field">
        <strong>💬 Mensaje:</strong>
        <div class="message">{{ $message }}</div>
    </div>

    <div class="footer">
        <p><strong>Información técnica:</strong></p>
        <p>IP: {{ $ip }} | Fecha: {{ $timestamp }}</p>
        <p>User Agent: {{ $user_agent }}</p>
        <hr style="margin: 20px 0;">
        <p>Este mensaje fue enviado desde el formulario de contacto del sitio web.<br>
            Para responder, simplemente responde a este email.</p>
    </div>
</div>
</body>
</html>
