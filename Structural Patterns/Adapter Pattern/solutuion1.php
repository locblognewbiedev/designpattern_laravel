Bối cảnh:
Bạn có một hệ thống thương mại điện tử và sử dụng một dịch vụ thanh toán cũ
 (OldPaymentService). Bây giờ, bạn muốn tích hợp một dịch vụ thanh toán mới
  (NewPaymentService) vào hệ thống của mình.

<?php
class OldPaymentService
{
    public function makePayment($amount)
    {
        echo "Payment of $amount made using Old Payment Service.\n";
    }
}
class NewPaymentService
{
    public function processPayment($amount)
    {
        echo "Payment of $amount processed using New Payment Service.\n";
    }
}
interface PaymentInterface
{
    public function pay($amount);
}

class OldPaymentServiceAdapter implements PaymentInterface
{
    private $oldPaymentService;

    public function __construct(OldPaymentService $oldPaymentService)
    {
        $this->oldPaymentService = $oldPaymentService;
    }

    public function pay($amount)
    {
        $this->oldPaymentService->makePayment($amount);
    }
}

class NewPaymentServiceAdapter implements PaymentInterface
{
    private $newPaymentService;

    public function __construct(NewPaymentService $newPaymentService)
    {
        $this->newPaymentService = $newPaymentService;
    }

    public function pay($amount)
    {
        $this->newPaymentService->processPayment($amount);
    }
}
function makePayment(PaymentInterface $paymentService, $amount)
{
    $paymentService->pay($amount);
}

$oldPaymentService = new OldPaymentServiceAdapter(new OldPaymentService());
$newPaymentService = new NewPaymentServiceAdapter(new NewPaymentService());

makePayment($oldPaymentService, 100);
makePayment($newPaymentService, 200);
/**
 * 
 * thật ra ta hiểu vấn đề như này:
 * trong class 1 để thực hiện chức năng thanh toán thì ta dùng
 * class1->makePayment
 * nhưng trong class 2 để thực hiện chức năng thanh toán thì ta dùng
 * class2->processPayment 
 * mặc dù cùng chức năng nhưng khác tên :))=> đổi tên=> ko lỡ nó của bên thứ 3 thì sao àm đổi
 * 
 * ta tạo ra 1 interface để nói rằng 2 này đều thực hiện chức năng thanh
 * toán thôi
 * interface PaymentInterface
 *{
 *   public function pay($amount);
 *}
 * cái adapter chỉ đơn giản là gọi lại hàm class1->makePayment,class2->processPayment 
 * trong hàm pay để chuẩn hóa thôi
 * 
public function pay($amount) { gọi cái cũ
        $this->oldPaymentService->makePayment($amount);
    }
 public function pay($amount) { gọi cái mới
        $this->newPaymentService->processPayment($amount);
    }
 * 
 * 
 */