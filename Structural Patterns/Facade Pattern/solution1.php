
<?php
class ProductCatalog
{
    public function getProductDetails($productId)
    {
        echo "Getting details for product ID: $productId.\n";
    }
}

class CustomerManagement
{
    public function getCustomerDetails($customerId)
    {
        echo "Getting details for customer ID: $customerId.\n";
    }
}

class PaymentSystem
{
    public function processPayment($amount)
    {
        echo "Processing payment of amount: $amount.\n";
    }
}
class OrderFacade
{
    protected $productCatalog;
    protected $customerManagement;
    protected $paymentSystem;

    public function __construct()
    {
        $this->productCatalog = new ProductCatalog();
        $this->customerManagement = new CustomerManagement();
        $this->paymentSystem = new PaymentSystem();
    }

    public function placeOrder($customerId, $productId, $amount)
    {
        $this->customerManagement->getCustomerDetails($customerId);
        $this->productCatalog->getProductDetails($productId);
        $this->paymentSystem->processPayment($amount);
    }
}
$orderFacade = new OrderFacade();
$orderFacade->placeOrder(1, 101, 50.0);

/**
 * bản chất là tạo ra 1 class để tống mấy cái logic phức tạp
 * vào thôi ez
 * 
 * 
 */