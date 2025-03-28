<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Customer details</title>
</head>
<body>
    <h1>Customer details</h1>

    <p><strong>Id:</strong> {{ $customer->customerNumber }}</p>
    <p><strong>Name:</strong> {{ $customer->name }}</p>
    <p><strong>Company Name:</strong> {{ $customer->companyName }}</p>
    <p><strong>Fiscal Data:</strong> {{ $customer->fiscalData }}</p>
    <p><strong>Address:</strong> {{ $customer->address }}</p>

    <a href="{{ route('customers.index') }}">Back</a>
</body>
</html>