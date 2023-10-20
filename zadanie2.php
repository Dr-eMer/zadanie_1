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

	public function setAge($age){
		$this->age = $age;
		return $this;
	}

	public function getSalary(){
		return ' '.$this->salary;
	}

	public function setSalary($salary){
		$this->salary = $salary;
	}


}

$worker = new Worker;
$worker->setName('Иван')->setAge(25)->setSalary(1000);
echo $worker->getName();
echo $worker->getAge();
echo $worker->getSalary();
echo '<br>';
$worker2 = new Worker;
$worker2->setName('Вася')->setAge(26)->setSalary(2000);
echo $worker2->getName();
echo $worker2->getAge();
echo $worker2->getSalary();
echo '<br>';
echo $worker->getSalary() + $worker2->getSalary().' - сумма зарплат<br>';
echo $worker->getAge() + $worker2->getAge().' - сумма возрастов';
?>