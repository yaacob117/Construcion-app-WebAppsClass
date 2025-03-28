<?php

class Customer {
    public $customerNumber;
    public $name;
    public $companyName;
    public $fiscalData;
    public $address;

    public function __construct($customerNumber, $name, $companyName, $fiscalData, $address) {
        $this->customerNumber = $customerNumber;
        $this->name = $name;
        $this->companyName = $companyName;
        $this->fiscalData = $fiscalData;
        $this->address = $address;
    }

    public function getOrderStatus($invoiceNumber) {
        return "Order Status" . $invoiceNumber . ": In process"; 
    }
}

class CustomerFactory {
    public static function createCustomer($customerNumber, $name, $companyName, $fiscalData, $address) {
        return new Customer($customerNumber, $name, $companyName, $fiscalData, $address);
    }
}

$customer1 = CustomerFactory::createCustomer("12345", "Juan Pérez", "My company S.A.", "RFC: MEP123456789", "Main Street #123");
$customer2 = CustomerFactory::createCustomer("67890", "María García", "Other Inc.", "RFC: OTR987654321", "Avenue #456");

echo $customer1->name . "<br>";
echo $customer1->getOrderStatus("INV-001") . "<br>";

echo $customer2->name . "<br>";
echo $customer2->getOrderStatus("INV-002");

?>