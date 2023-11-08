<!DOCTYPE html>
<html>
<head>
    <title>Importar Arquivo JSON</title>
</head>
<body>
    <h1>Importar Arquivo JSON</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/import" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="json_file">Escolha um arquivo JSON para importar:</label>
            <input type="file" name="json_file" class="form-control" accept=".json" required>
        </div>
        <button type="submit" class="btn btn-primary">Importar</button>
    </form>

    <h1>Registros Importados</h1>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Conteúdo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $document)
            <tr>
                <td>{{ $document['title'] }}</td>
                <td>{{ $document['contents'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>