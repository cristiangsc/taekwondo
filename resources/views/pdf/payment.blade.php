<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Pago {{$payment->anio}}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 20px; }
        .logo { width: 150px; }
        .section { margin-bottom: 10px; }
        .label { font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td, th { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
<div class="header">
    <img src="{{ public_path('images/logo2.png') }}" class="logo" alt="Logo">
    <h2>Comprobante de Pago {{$payment->anio}}</h2>
</div>

<div class="section">
    <p><span class="label">Nombre Deportista:</span> {{ $payment->student->name }} {{ $payment->student->last_name_paternal }} {{ $payment->student->last_name_maternal }}</p>
    <p><span class="label">Fecha de Pago:</span> {{ $payment->payment_date->format('d/m/Y') }}</p>
    <p><span class="label">Monto Cancelado:</span> ${{ number_format($payment->amount,0,",",".") }}</p>
    <p><span class="label">Método de Pago:</span> {{ $payment->payment_method }}</p>
</div>

<div class="section">
    <p><span class="label">Pago de Clases desde:</span> {{ $payment->payment_start_date->format('d/m/Y') }}</p>
    <p><span class="label">Clases hasta:</span> {{ $payment->payment_end_date->format('d/m/Y') }}</p>
    <p><span class="label">Próximo Pago:</span> {{ $payment->next_payment_due->format('d/m/Y') }}</p>
</div>

@if ($payment->notes)
    <div class="section">
        <p><span class="label">Observaciones:</span> {{ $payment->notes }}</p>
    </div>
@endif

<div style="text-align: center; margin-top: 40px;">
    <small>Recibo Conforme: Elizabeth Muñoz Orellana.</small>
    <br>
    <small>Email: elizabethtaekwondo@gmail.com</small>
</div>
</body>
</html>
