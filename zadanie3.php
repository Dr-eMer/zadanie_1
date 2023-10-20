<?php

class Worker{
	private $name;
	private $age;
	private $salary;

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
		return $this;
	}

	public function getAge(){
		return ' '.$this->age;
	}

	public function setAge($newAge){
		$age = $this->getAge();
		if ($this->checkAge($newAge)) {
			$this->age = $newAge;
		}
		else{
			$this->age = $age;
		}
		return $this;
	}

	public function getSalary(){
		return ' '.$this->salary;
	}

	public function setSalary($salary){
		$this->salary = $salary;
	}

	private function checkAge($age){
		if($age>=1 && $age<=100){
			return true;
		}
	}


}

$worker = new Worker;
$worker->setName('Иван')->setAge(25)->setSalary(1000);
echo $worker->getName();
echo $worker->getAge();
echo $worker->getSalary();
echo '<br>';
$worker2 = new Worker;
$worker2->setName('Вася')->setAge(30)->setSalary(2000);
echo $worker2->getName();
echo $worker2->getAge();
echo $worker2->getSalary();
echo '<br>';
echo $worker->getSalary() + $worker2->getSalary().' - сумма зарплат<br>';
echo $worker->getAge() + $worker2->getAge().' - сумма возрастов';
?>