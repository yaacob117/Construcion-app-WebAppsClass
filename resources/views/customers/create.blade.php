<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create customer</title>
</head>
<body>
    <h1>Create customer</h1>

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf

        <div>
            <label for="customerNumber">Id:</label>
            <input type="text" name="customerNumber" id="customerNumber" required>
        </div>

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div>
            <label for="companyName">Company Name:</label>
            <input type="text" name="companyName" id="companyName" required>
        </div>

        <div>
            <label for="fiscalData">Fiscal Data:</label>
            <input type="text" name="fiscalData" id="fiscalData" required>
        </div>

        <div>
            <label for="address">Address:</label>
            <textarea name="address" id="address" required></textarea>
        </div>

        <button type="submit">Create</button>
    </form>

    <a href="{{ route('customers.index') }}">Cancel</a>
</body>
</html>