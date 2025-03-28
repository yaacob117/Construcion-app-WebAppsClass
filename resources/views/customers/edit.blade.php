<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Edit Customer</title>
</head>
<body>
    <h1>Edit Customer</h1>

    <form action="{{ route('customers.update', $customer->customerNumber) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="customerNumber">Id:</label>
            <input type="text" name="customerNumber" id="customerNumber" value="{{ $customer->customerNumber }}" required>
        </div>

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $customer->name }}" required>
        </div>

        <div>
            <label for="companyName">Company Name:</label>
            <input type="text" name="companyName" id="companyName" value="{{ $customer->companyName }}" required>
        </div>

        <div>
            <label for="fiscalData">Fiscal Data:</label>
            <input type="text" name="fiscalData" id="fiscalData" value="{{ $customer->fiscalData }}" required>
        </div>

        <div>
            <label for="address">Address:</label>
            <textarea name="address" id="address">{{ $customer->address }}</textarea>
        </div>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('customers.index') }}">Volver</a>
</body>
</html>