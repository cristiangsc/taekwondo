<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="logo">
    <img src="{{ $logoPath }}" alt="Logo" width="150">
</div>
<h3 style="text-align: center;">
    Reporte de asistencia correspondiente al mes de {{ $monthName }} del año {{ $year }}
    @if ($group)
        - Grupo: {{ $group }}
    @endif
</h3>
<table>
    <thead>
    <tr>
        <th>DEPORTISTAS</th>
        @foreach ($days as $day)
            <th>
                {{ \Carbon\Carbon::parse($day)->locale('es')->isoFormat('dd') }}
                <br>
                {{ \Carbon\Carbon::parse($day)->format('d') }}
            </th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach ($data as $row)
        <tr>
            <td>{{ $row['name'] }}</td>
            @foreach ($days as $day)
                <td>
                    {{ $row[$day] }}
                </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
