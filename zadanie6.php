<?php

class trapezoid{
	private $dot1_1;
	private $dot1_2;
	private $dot2_1;
	private $dot2_2;
	private $dot3_1;
	private $dot3_2;
	private $dot4_1;
	private $dot4_2;

	public function getDot1_1(){
		return $this->dot1_1;
	}

	public function getDot1_2(){
		return $this->dot1_2;
	}

	public function getDot2_1(){
		return $this->dot2_1;
	}

	public function getDot2_2(){
		return $this->dot2_2;
	}

	public function getDot3_1(){
		return $this->dot3_1;
	}

	public function getDot3_2(){
		return $this->dot3_2;
	}

	public function getDot4_1(){
		return $this->dot4_1;
	}

	public function getDot4_2(){
		return $this->dot4_2;
	}

	public function setDot1_1($dot1_1){ //XA
		$this->dot1_1 = $dot1_1;
	}

	public function setDot1_2($dot1_2){ //YA
		$this->dot1_2 = $dot1_2;
	}

	public function setDot2_1($dot2_1){ //XB
		$this->dot2_1 = $dot2_1;
	}

	public function setDot2_2($dot2_2){ //YB
		$this->dot2_2 = $dot2_2;
	}

	public function setDot3_1($dot3_1){ //XC
		$this->dot3_1 = $dot3_1;
	}

	public function setDot3_2($dot3_2){ //YC
		$this->dot3_2 = $dot3_2;
	}

	public function setDot4_1($dot4_1){ //XD
		$this->dot4_1 = $dot4_1;
	}

	public function setDot4_2($dot4_2){ //YD
		$this->dot4_2 = $dot4_2;
	}

	public function getAverageArea(){
		return $this->averageArea;
	}

	public function setAverageArea($averageArea){ //YD
		$this->averageArea = $averageArea;
	}

	private function examination(){  //проверки
		if ($this->equilateralTrapezoid()) {
			echo 'Трапеция является равнобедренной<br>';
		}
		echo 'Длины сторон: ';
		$lengthVector = $this->vectorLength();
		$arrayOfNames = ['AB','BC','CD','DA'];
		$i = 0;
		foreach ($lengthVector as $vector){
			echo $arrayOfNames[$i]." = ".$vector." ; ";
			$i++;
		}
		echo "<br>Периметр = ".$this->perimeter();
		echo "<br>Площадь = ".round($this->square(),3)."<br><br>";
	}


	public function square(){ //площадь
		$semiperimeter = $this->perimeter()/2;
		return (($this->vectorLength()[3]+$this->vectorLength()[1])/(abs($this->vectorLength()[3]-$this->vectorLength()[1])))*(sqrt(($semiperimeter-$this->vectorLength()[3])*($semiperimeter-$this->vectorLength()[1])*($semiperimeter-$this->vectorLength()[3]-$this->vectorLength()[0])*($semiperimeter-$this->vectorLength()[3]-$this->vectorLength()[2]))); 
	}

	private function perimeter(){ //периметр
		$p = 0;
		$i = 0;
		while ($i<4) {
			$p+=$this->vectorLength()[$i];
			$i++;
		}
		return $p;
	}

	private function equilateralTrapezoid(){  //проверка на равнобокую трапеция
		if ($this->vectorLength()[0] == $this->vectorLength()[2]) {
			return 1;
		}
		return 0;
	}


	private function vectorLength(){ //нахождение длин вектора
		$vector = $this->vektor()['vector1']; //вектор AB
		$vector2 = $this->vektor()['vector2']; //вектор BC
		$vector3 = $this->vektor()['vector3']; //вектор СD
		$vector4 = $this->vektor()['vector4']; //вектор DA
		$lengthVector = [];
		$sum = 0;
		$j = 1;
		while ($j<=4) {
			foreach ($this->vektor()['vector'.$j] as $name) {
				$sum +=pow($name,2);
			}
			$lengthVector[$j-1] = round(sqrt($sum),3);
			$j++;
		 	$sum = 0;

		}
		return $lengthVector;
	}

	private function correlationСheck(){ //проверка на трапецию
		$vector = $this->vektor()['vector1']; //вектор AB
		$vector2 = $this->vektor()['vector2']; //вектор BC
		$vector3 = $this->vektor()['vector3']; //вектор СD
		$vector4 = $this->vektor()['vector4']; //вектор DA
		$rezult = [
			$this->collinearity($vector,$vector3),
			$this->collinearity($vector2,$vector4)
		];
		if (($rezult[0] == 'коллинеарны') && ($rezult[1] == 'неколлинеарны')) {
			return true;
		}
		elseif (($rezult[0] == 'неколлинеарны') && ($rezult[1] == 'коллинеарны')) {
			return true;
		}
		else{
			return false;
		}
	}

	private function vektor(){ //формирование векторов на основе координат точек
		$vektorAB = [
			$this->pointDifference($this->getDot2_1(),$this->getDot1_1()),
			$this->pointDifference($this->getDot2_2(),$this->getDot1_2())
		];
		$vektorBC = [
			$this->pointDifference($this->getDot3_1(),$this->getDot2_1()),
			$this->pointDifference($this->getDot3_2(),$this->getDot2_2())
		];
		$vektorCD = [
			$this->pointDifference($this->getDot4_1(),$this->getDot3_1()),
			$this->pointDifference($this->getDot4_2(),$this->getDot3_2())
		];
		$vektorDA = [
			$this->pointDifference($this->getDot1_1(),$this->getDot4_1()),
			$this->pointDifference($this->getDot1_2(),$this->getDot4_2())
		];
		return [
			'vector1' => $vektorAB,
			'vector2' => $vektorBC,
			'vector3' => $vektorCD,
			'vector4' => $vektorDA
		];
	}

	private function collinearity($vector,$vector2){ // проверка на условие корреляции
		$i = 0;
		$j = 0;
		$nonZeroElement = [];
		// print_r($vector);
		// print_r($vector2);
		while ($i<count($vector)){
			if ($vector[$i]!=0) {
				if ($vector2[$i]!=0) {
					$status = true;
				}
				else{
					$status = false;
				}
			}
			else{
				$status = false;
			}
			if($status){
				array_push($nonZeroElement,$vector[$i],$vector2[$i]);
			}
			$i++;
		}
		if ((count($nonZeroElement) == 0) || (count($nonZeroElement) == 4)){
			if (($this->proportionality($vector)) == ($this->proportionality($vector2))) {
				return 'коллинеарны';		
			}
			else{
				return 'неколлинеарны';
			}
		}
		else{
			$number = $this->proportionality($nonZeroElement);
			$i = 0;
			$j = 0;
			while ($i<count($vector)){
				if ($vector[$i]!=0) {
					if ($vector2[$i]!=0) {
						if ($vector[$i] < $vector2[$i]) {
							while ($j<count($vector)){
								$vector[$j] = $vector[$j]*$number;
								$j++;
							}
							if (($vector[0] == $vector2[0]) && ($vector[1] == $vector2[1])){
								return 'коллинеарны';
							}
							else{
								return 'неколлинеарны';
							}
						}
						else{
							while ($j<count($vector)){
								$vector2[$j] = $vector2[$j]*$number;
								$j++;
							}
							if (($vector[0] == $vector2[0]) && ($vector[1] == $vector2[1])){
								return 'коллинеарны';
							}
							else{
								return 'неколлинеарны';
							}						}
					}
				}
				$i++;
			}
		}
	}

	public function __construct($dot1_1,$dot1_2,$dot2_1,$dot2_2,$dot3_1,$dot3_2,$dot4_1,$dot4_2){
		$this->dot1_1 = $dot1_1;
		$this->dot1_2 = $dot1_2;
		$this->dot2_1 = $dot2_1;
		$this->dot2_2 = $dot2_2;
		$this->dot3_1 = $dot3_1;
		$this->dot3_2 = $dot3_2;
		$this->dot4_1 = $dot4_1;
		$this->dot4_2 = $dot4_2;
		if ($this->correlationСheck()) {
			$this->examination();
		}
		else{
			echo "Набор точек не является трапецией";
		}
	}

	private function proportionality($vector){ //проверка вектора на пропорциональность
		return $vector[0]/$vector[1];
	}

	private function pointDifference($dot1,$dot2){ //поиск координат векторов
		return $dot1-$dot2;
	}

}

$trapezoid = new Trapezoid(-4,0,2,1,3,-1,-1.4,-5.2);
$trapezoid2 = new Trapezoid(2,4,0,2,0,7,2,5);
$trapezoid3 = new Trapezoid(-2,1,-6,5,-3,5,-3,1);
$trapezoid4 = new Trapezoid(-4,0,2,1,3,-1,-1.4,-5.2);
$trapezoid5 = new Trapezoid(0,5,-2,4,4,2,3,4);
$sum = $trapezoid->square()+$trapezoid2->square()+$trapezoid3->square()+$trapezoid4->square()+$trapezoid5->square();
;
$averageArea = $sum/5;
$check = 0;
$listTrapezoid = [$trapezoid,$trapezoid2,$trapezoid3,$trapezoid4,$trapezoid5];
foreach ($listTrapezoid as $trapez){
	if ($trapez->square()>$averageArea) {
		$check++;
	}
}
echo 'Количество трапеций, у которых площадь больше средней площади: '.$check;
?>
