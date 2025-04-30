<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Evidence Picture List</title>
</head>
<body>
    <h1>Evidence Picture List</h1>
    <a href="{{ route('evidence_pictures.create') }}">Create Evidence Picture</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>Sent Photo URL</th>
                <th>Received Photo URL</th>
                <th>Sent At</th>
                <th>Received At</th>
                <th>Uploaded By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($evidencePictures as $evidencePicture)
                <tr>
                    <td>{{ $evidencePicture->id }}</td>
                    <td>{{ $evidencePicture->order_id }}</td>
                    <td>{{ $evidencePicture->sent_photo_url }}</td>
                    <td>{{ $evidencePicture->received_photo_url }}</td>
                    <td>{{ $evidencePicture->sent_at }}</td>
                    <td>{{ $evidencePicture->received_at }}</td>
                    <td>{{ $evidencePicture->uploaded_by }}</td>
                    <td>
                        <a href="{{ route('evidence_pictures.show', $evidencePicture->id) }}">View</a>
                        <a href="{{ route('evidence_pictures.edit', $evidencePicture->id) }}">Edit</a>
                        <form action="{{ route('evidence_pictures.destroy', $evidencePicture->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>