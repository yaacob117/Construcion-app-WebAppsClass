# Construction Materials Distribution Management System

This web application is designed for Halcon, a construction materials distributor, to automate their internal processes and provide customers with real-time order tracking capabilities.

## Features

- **Customer Order Tracking**: Customers can track their orders using their customer number and invoice number
- **Role-Based Access Control**: Different user roles with specific permissions
- **Order Management**: Complete order lifecycle management
- **Delivery Evidence**: Photo-based delivery confirmation system
- **Product Management**: Comprehensive product catalog management
- **Enterprise Orders**: Management of orders from external suppliers

## User Roles

1. **Administrator**: Full access to all features
2. **Sales**: Manage customers, orders, and products
3. **Purchasing**: Handle products and enterprise orders
4. **Warehouse**: Manage delivery evidence
5. **Routes**: View and update order statuses

## Order Statuses

- **Ordered**: Initial status when a sales executive enters the order into the system
- **In Process**: Order is being prepared from stock or pending purchase from supplier
- **In Route**: Order is out for delivery
- **Delivered**: Order has been successfully delivered to the customer

## Getting Started

### Prerequisites

- PHP 8.1+
- Composer
- Node.js & NPM
- MySQL

### Installation

1. Clone the repository
```bash
git clone [repository-url]
cd construction-app
```

2. Install PHP dependencies
```bash
composer install
```

3. Install and compile frontend assets
```bash
npm install
npm run dev
```

4. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure database in `.env` file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run migrations
```bash
php artisan migrate
```

7. Start the development server
```bash
php artisan serve
```

## Usage Workflow

### 1. Create a Customer
- Log in as Administrator or Sales
- Navigate to Customers section
- Click "Create Customer"
- Fill in customer details:
  - Customer Number
  - Name
  - Company Name
  - Fiscal Data
  - Address

### 2. Create Products
- Log in as Administrator, Sales, or Purchasing
- Go to Products section
- Click "Create Product"
- Enter product details:
  - Name
  - Description
  - Price
  - Stock

### 3. Create Order Products
- Navigate to Order Products
- Click "Create Order Product"
- Select the product
- Specify quantity
- Set unit price
- The total will be calculated automatically

### 4. Create Customer Orders
- Go to Customer Orders
- Click "Create New Order"
- Fill in order details:
  - Select Customer
  - Invoice Number
  - Order Date
  - Delivery Address
  - Add products from Order Products
  - Set initial status as "ORDERED"

### 5. Upload Delivery Evidence
- Log in as Warehouse user
- Go to Evidence Pictures
- Click "Create Evidence Picture"
- Select the order
- Upload delivery photos:
  - Sent photo
  - Received photo (if available)
- The order status will update to "DELIVERED"

## API Endpoints

### Order Status Tracking
```http
GET /api/order-status?customer_number={number}&invoice_number={invoice}
```

Response includes:
- Customer information
- Order details
- Product list
- Delivery evidence (if delivered)

## Default User Access

All default users have the password: `password`

Example users:
- admin@example.com (Administrator)
- sales@example.com (Sales)
- purchasing@example.com (Purchasing)
- warehouse@example.com (Warehouse)
- routes@example.com (Routes)

## Security

- Authentication using Laravel Breeze
- Role-based access control
- Protected API endpoints using Laravel Sanctum
- Secure password hashing
- CSRF protection

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details
