<?php
class CategoryNotFound extends Exception {
    private function __construct($message)
    {
        parent::__construct($message);
    }

    static function bookNotFound(string $lang, int $id) {
        switch($lang) {
            case 'en':
                $msg = 'We had trouble finding your book in the Library: '. $id;
                break;
            case 'nl':
                $msg = 'We hadden problemen om je boek te vinden';
                break;
            case 'fr':
                $msg = 'oui oui';
                break;
        }

        return new Self($msg);
    }

    static function categoryIsPrivate() {
        return new Self('Category is private');
    }
}

class ProductNotFound extends Exception {}

class Category {
    public function __construct(int $id, $lang='en')
    {
        if($id !== 1) {
            throw CategoryNotFound::bookNotFound($lang, $id);
        }
        if($this->private) {
            throw CategoryNotFound::categoryIsPrivate();
        }
    }

    public function getProduct(int $id) : Product
    {
        //db query...
        if($id === 1) {
            return new Product;
        }
        throw new ProductNotFound('No product found');
        // return;


        die('STOP');
    }
}

function loadShop() {
    $cat = new Category(5);
    $product = $cat->getProduct(5);
}


try {
    loadShop();
}
catch(ProductNotFound $e) {
    echo $e->getMessage();
    die('Are you maybe interested in: '. $cat->getPromoProduct());
}
catch(CategoryNotFound $e) {
    echo $e->getMessage();
    die('go to homepage');
}
catch(Exception $e) {
    die('This should never happend, omg this is terrible');//<- joke

    if($e->getMessage() === 'No product found') {
        die('Are you maybe interested in: '. $cat->getPromoProduct());
    }
    elseif($e->getMessage() === 'We had trouble finding your book in the Libary') {
        die($e->getMessage());
    }
}