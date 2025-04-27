<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="file" name="archivo" id="">
    <input type="hidden" name="order_id" value="1"> <!-- Cambiar el valor según sea necesario -->
    <button type="submit">Subir Archivo</button>
</form>

    <hr>

    <form action="{{ route('download', ['path' => $path]) }}" method="POST">
        @csrf
        <input type="hidden" name="path" value="{{ $path }}">
        <input type="submit" value="Descargar">
    </form>
</body>
</html>