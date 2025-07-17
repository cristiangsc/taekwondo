<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Balance General</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            max-width: 130px;
            margin-bottom: 15px;
            top: 0;

        }

        .title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .total-row {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .text-success {
            color: #28a745;
        }

        .text-danger {
            color: #dc3545;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 12px;
            color: #666;
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="header">
    <img src="{{ base_path('public/images/logo.png') }}" class="logo" alt="Logo">
    <h1 class="title">Balance General</h1>
    <div class="subtitle">Año: {{ $año }}</div>
</div>

<table>
    <thead>
    <tr>
        <th>Tipo de Movimiento</th>
        <th class="text-right">Ingresos</th>
        <th class="text-right">Gastos</th>
        <th class="text-right">Balance</th>
    </tr>
    </thead>
    <tbody>
    @foreach($records as $record)
        <tr>
            <td>{{ strtoupper($record->tipo) }}</td>
            <td class="text-right">$ {{ number_format($record->ingresos, 0, ",", ".") }}</td>
            <td class="text-right">$ {{ number_format($record->gastos, 0, ",", ".") }}</td>
            <td class="text-right {{ $record->balance >= 0 ? 'text-success' : 'text-danger' }}">
                $ {{ number_format($record->balance, 0, ",", ".") }}
            </td>
        </tr>
    @endforeach
    <tr class="total-row">
        <td>TOTALES</td>
        <td class="text-right">$ {{ number_format($totales['ingresos'], 0, ",", ".") }}</td>
        <td class="text-right">$ {{ number_format($totales['gastos'], 0, ",", ".") }}</td>
        <td class="text-right {{ $totales['balance'] >= 0 ? 'text-success' : 'text-danger' }}">
            $ {{ number_format($totales['balance'], 0, ",", ".") }}
        </td>
    </tr>
    </tbody>
</table>

<div class="footer">
    Generado el {{ now()->format('d/m/Y H:i:s') }}
    <br>
    SISTEMA DIRECTIVA CURSO
</div>
</body>
</html>
