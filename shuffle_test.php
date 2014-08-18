<?php
define('MAX_NUMBER', 1000000000);
define('MIN_NUMBER', 2);

class Test {
    private $n, $k, $npk;
    private $count = 0;
    private $cards = array();

    function __construct($n, $k) {
        $this->n = $n;
        $this->k = $k;
        for($i = 0; $i < $n; $i++) {
            $this->cards[] = $i;
        }
        $this->npk = $n / $k;

        $this->count++;
        $this->shuffle();
    }

    private function is_divided() {
        if ($this->n % $this->k == 0) {
            return true;
        } else {
            return false;
        }
    }

    private function is_in_range() {
        if (MIN_NUMBER <= $this->k
            && $this->k <= $this->n
            && $this->n <= MAX_NUMBER
        ) {
            return true;
        } else {
            return false;
        }
    }

    private function is_equal() {
        for($i = 0; $i < $this->n; $i++) {
            if($this->cards[$i] != $i) {
                return false;
            }
        }
        return true;
    }

    private function shuffle() {
        $cards = array();
        for($i = 0; $i < $this->npk; $i++) {
            for($j = 1; $j <= $this->k; $j++) {
                $index = $this->n - ($this->npk) * $j + $i;
                $cards[] = $this->cards[$index];
            }
        }
        $this->cards = $cards;
    }


    public function count_shuffle() {
        if(!$this->is_divided()) return "Error: N is not divided by K. \n";
        if(!$this->is_in_range()) return "Error: N:$this->n or K:$this->k is invalid data. \n";

        while(!$this->is_equal()) {
            $this->count++;
            $this->shuffle();
        }

        return $this->count;
    }
}


echo "input T > ";
$t = intval(fgets(STDIN));

for ($i = 0; $i < $t; $i++) {
    echo "input N K >";
    $numbers = split(" ", fgets(STDIN));
    $n = intval($numbers[0]);
    $k = intval($numbers[1]);

    $test = new Test($n, $k);
    echo $test->count_shuffle();

    echo "\n";

}

?>
