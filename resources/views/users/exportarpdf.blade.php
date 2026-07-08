<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Usuários</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #3b82f6; padding-bottom: 10px; }
        .title { font-size: 20px; font-weight: bold; color: #1e3a8a; }
        .meta { font-size: 10px; color: #666; margin-top: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { bg-color: #f3f4f6; background-color: #f3f4f6; border: 1px solid #e5e7eb; padding: 8px; text-align: left; font-weight: bold; color: #4b5563; }
        td { border: 1px solid #e5e7eb; padding: 8px; }
        tr:nth-child(even) { background-color: #f9fafb; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Relatório de Usuários Cadastrados</div>
        <div class="meta">Gerado em: {{ now()->format('d/m/Y H:i:s') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 10%;">ID</th>
                <th style="width: 45%;">Nome</th>
                <th style="width: 45%;">E-mail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>#{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>