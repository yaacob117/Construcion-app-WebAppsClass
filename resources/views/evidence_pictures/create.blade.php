<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Evidence Picture</title>
</head>
<body>
    <h1>Create Evidence Picture</h1>
    <form action="{{ route('evidence_pictures.store') }}" method="POST">
        @csrf

        <label for="order_id">Order ID:</label>
        <select name="order_id" id="order_id" required>
            @foreach($customerOrders as $order)
                <option value="{{ $order->id }}">{{ $order->id }}</option>
            @endforeach
        </select><br>

        <label for="sent_photo_url">Sent Photo URL:</label>
        <input type="text" name="sent_photo_url" id="sent_photo_url" required><br>

        <label for="received_photo_url">Received Photo URL:</label>
        <input type="text" name="received_photo_url" id="received_photo_url"><br>

        <label for="sent_at">Sent At:</label>
        <input type="datetime-local" name="sent_at" id="sent_at" required><br>

        <label for="received_at">Received At:</label>
        <input type="datetime-local" name="received_at" id="received_at"><br>

        <label for="uploaded_by">Uploaded By:</label>
        <input type="text" name="uploaded_by" id="uploaded_by" required><br>

        <button type="submit">Save</button>
    </form>
    <a href="{{ route('evidence_pictures.index') }}">Back</a>
</body>
</html>