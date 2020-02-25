<?php


class Post
{
    protected $title;
    protected $text;

    public function __construct(string $title, string $text)
    {
        $this->title = $title;
        $this->text = $text;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text): void
    {
        $this->text = $text;
    }
}

class Lesson extends Post
{
    private $homework;

    public function __construct(string $title, string $text, string $homework)
    {
        parent::__construct($title, $text);
        $this->homework = $homework;
    }

    public function getHomework(): string
    {
        return $this->homework;
    }

    public function setHomework(string $homework): void
    {
        $this->homework = $homework;
    }
}

class PaidLesson extends Lesson
{
    private $price;

    public function __construct(string $title, string $text, string $homework, int $price)
    {
        parent::__construct($title, $text, $homework);
        $this->price = $price;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }
}

$paid = new PaidLesson('Заголовок', 'Текст', 'Домашка', 888);
var_dump($paid);
echo '<br>';

// ---------------------------------------------------------------------------

interface CalculateSquare
{
    public function calculateSquare(): float;
}

class Circle implements CalculateSquare
{
    const PI = 3.1416;

    private $r;

    public function __construct(float $r)
    {
        $this->r = $r;
    }

    public function calculateSquare(): float
    {
        return self::PI * ($this->r ** 2);
    }
}

class Rectangle
{
    private $x;
    private $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    // public function calculateSquare(): float
    // {
    //     return $this->x * $this->y;
    // }
}

class Square implements CalculateSquare
{
    private $x;

    public function __construct(float $x)
    {
        $this->x = $x;
    }

    public function calculateSquare(): float
    {
        return $this->x ** 2;
    }
}

$objects = [
    new Square(25),
    new Rectangle(4, 7),
    new Circle(16)
];

foreach ($objects as $object) {
    $text = 'Объект класса ' . get_class($object);
    if ($object instanceof CalculateSquare) {
        echo "$text реализует интерфейс CalculateSquare. Площадь: " . $object->calculateSquare();
        echo '<br>';
    } else {
        echo "$text не реализует интерфейс CalculateSquare.";
        echo '<br>';
    }
}

// ------------------------------------------------------------------

abstract class HumanAbstract
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    abstract public function getGreetings(): string;
    abstract public function getMyNameIs(): string;

    public function introduceYourself(): string
    {
        return $this->getGreetings() . '! ' . $this->getMyNameIs() . ' ' . $this->getName() . '.';
    }
}

class RussianHuman extends HumanAbstract
{
    public function getGreetings(): string
    {
        return "Привет";
    }
    public function getMyNameIs(): string
    {
        return "Меня зовут";
    }
}

class EnglishHuman extends HumanAbstract
{
    public function getGreetings(): string
    {
        return "Hi";
    }
    public function getMyNameIs(): string
    {
        return "My name is";
    }
}
$rus = new RussianHuman('Коля');
$eng = new EnglishHuman('Jon');

var_dump($rus->introduceYourself());
echo '<br>';
var_dump($eng->introduceYourself());
echo '<br>';
