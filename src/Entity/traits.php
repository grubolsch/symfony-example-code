<?php
trait Animal {
    public function taste() : string {
        return 'Chicken';
    }
}

interface AnimalInterface {
    public function eat();
    public function sleep();
    public function taste() : string;
}

class Monkey implements AnimalInterface {
    use Animal;

    public function eat()
    {
        return 'banana';
    }

    private function sleep()
    {

    }
}

class Donkey implements AnimalInterface {
    use Animal;

    public function eat()
    {
        return 'carrot';
    }
}

function feedAnimal($animal) {
    echo $animal->eat();
    echo PHP_EOL;
    echo $animal->sleep();
}
feedAnimal(new Monkey());