<?php
namespace App\Entity;

interface ApiCall {
    public function call(int $id);
}

class ExpensiveApiCall implements ApiCall {
    public function call(int $id)
    {
        //fetch an api from a 3th party
        // because each call costed the customer 1 euro

        return [
            'companyname' => $name,
            'creditrating' => $rating
        ];
    }
}

class NullApiCall implements ApiCall {
    public function call(int $id)
    {
        return [
           'companyname' => 'Test VZW',
           'creditrating' => 5
        ];

        // do nothing!
    }
}

interface Logger {
    public function log(string $message);
}

class FileLogger implements Logger {
    public function log(string $message)
    {
        //check if file exists, check if file is readable, ...
        file_put_contents('log.txt', $message, FILE_APPEND);
    }
}

class MailerLogger implements Logger { //polymorphism
    public function log(string $message)
    {
        mail('koen@becode.org', 'Calculated prices', $message);
    }
}

class DatabaseLogger implements Logger {
    public function log(string $message)
    {
        mail('koen@becode.org', 'Calculated prices', $message);
    }

    public function clearDatabaseLog()
    {
        
    }
}

class EmptyLogger implements Logger {
    public function log(string $message) {}
}

$somethingSpecial = true;
$logger = new FileLogger();
if($somethingSpecial) {
    $logger = new DatabaseLogger();
}
$logger->log('Test');

class EntityNotFound extends \Exception {}
class ProductNotFound extends EntityNotFound {}
class ShopNotFound extends EntityNotFound {}
class CategoryNotFound extends EntityNotFound {}


class PriceCalculator
{
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }
    
    public function calculatePrice(float $price, int $vat)
    {
        //seperation of concerns

        $total = $price * $vat;
        $this->logger->log('Price calculated is: '. $total);
        return $total;
    }

    public function calculatePriceWithoutVat(float $price)
    {
        //seperation of concerns

        $total = $price;
        $this->logger->log('Price calculated is: '. $total);
        return $total;
    }

    public function calculatePriceWithDiscount(float $price, int $discount)
    {
        //seperation of concerns

        $total = $price - $discount;
        $this->logger->log('Price calculated is: '. $total);
        return $total;
    }

    public function getProduct() : Product
    {
        throw new \ProductException('This a NOT product');
    }

    public function getLogger(): Logger
    {
        return $this->logger;
    }
}

//// constructor
$vipClient = true;
$database = false;

if($vipClient) {
    $log = new MailerLogger;//this might be problematic?
}
elseif($database) {
    $log = new DatabaseLogger;//this might be problematic?
}
else {
    $log = new FileLogger;//this might be problematic?
}
$calc = new PriceCalculator(new EmptyLogger);
$calc->calculatePrice(100, 1.21);
$calc->calculatePriceWithDiscount(100, 1.21);
$calc->calculatePriceWithoutVat(100);

$product = $calc->getProduct();
if($product !== null) {
    $product->getName();
}

try {
    $commerce->getShop('shoe')->getCategory('high heels')->getProduct(5)->getColor('pink');
}
catch(ProductNotFound $e) {
    die('promote another product');
}
catch(EntityNotFound $e) {
    die($e->getMessage());
}

if($commerce->getShop('shoe') !== null && $commerce->getShop('shoe')->getCategory('high heels') !== null && $commerce->getShop('shoe')->getCategory('high heels')->getProduct(5)) {
    $commerce->getShop('shoe')->getCategory('high heels')->getProduct(5)->getColor('pink');
}