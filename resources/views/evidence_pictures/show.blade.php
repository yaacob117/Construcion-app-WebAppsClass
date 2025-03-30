<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Evidence Picture Details</title>
</head>
<body>
    <h1>Evidence Picture Details</h1>
    <p><strong>ID:</strong> {{ $evidencePicture->id }}</p>
    <p><strong>Order ID:</strong> {{ $evidencePicture->order_id }}</p>
    <p><strong>Sent Photo URL:</strong> {{ $evidencePicture->sent_photo_url }}</p>
    <p><strong>Received Photo URL:</strong> {{ $evidencePicture->received_photo_url }}</p>
    <p><strong>Sent At:</strong> {{ $evidencePicture->sent_at }}</p>
    <p><strong>Received At:</strong> {{ $evidencePicture->received_at }}</p>
    <p><strong>Uploaded By:</strong> {{ $evidencePicture->uploaded_by }}</p>
    <a href="{{ route('evidence_pictures.index') }}">Back</a>
</body>
</html>