<?php
class Person {
  private $_fName;
  private $_lName;
  private $_age;

  public function setFName($fName)
  {
    $this->_fName = $fName;
  }

  public function getFName()
  {
    return $this->_fName;
  }
  public function setLName($lName)
  {
    $this->_lName = $lName;
  }

  public function getLName()
  {
    return $this->_lName;
  }
  public function setAge($age)
  {
    $this->_age = $age;
  }

  public function getAge()
  {
    return $this->_age;
  }

  public function getPerson()
  {
    return $this->getFName().' '.$this->getLName();
  }
}

$p = new Person();
$p->setFName('Jimmy');
$p->setLName('Brown');
echo $p->getPerson();
?>
