<?php

class CashMasine
{

    protected $amount;
    protected $issue = 0;
    protected $issueAmount = 0;
    protected $onOff = false;
    protected $cond;

    public function __construct($amount = 0)
    {
        $this->amount = $amount;
    }

    public function setTurnOn()
    {
        $this->onOff = true;
    }

    public function setTurnOff()
    {
        $this->onOff = false;
        $this->issueAmount = 0;
        $this->issue = 0;
    }

    public function setAddCash($sum)
    {
        $this->amount = $this->amount + $sum;

        if($this->amount < 0) $this->amount = 0;

        $this->cond = true;
    }

    public function setWithDraw($sum = null)
    {   if($sum == null) return;
        if(($this->amount >= 0) && ($sum <= $this->amount)){

            $this->issue = $sum;
    
            $this->amount = $this->amount - $this->issue;
    
            $this->issueAmount += $this->issue;

            $this->cond = true;

        } elseif (($this->amount >= 0) && ($sum > $this->amount)){
            $this->issue = $sum;
            
            $this->cond = false;

        }
 
    }

    public function getInfo()
    {
        if($this->onOff) {
            if($this->cond){
                echo "<div>Банкомат включен. В банкомате находится $this->amount рублей.</div><div>Банкомат выдал $this->issue рублей.</div><div>Всего выдано $this->issueAmount рублей.</div>";

            } else {

                echo "<div>Банкомат включен. В банкомате находится $this->amount рублей.</div><div>Запрошено к выдаче $this->issue рублей.</div><div>В банкомате недостаточно средств.</div><div>Всего выдано $this->issueAmount рублей.</div>";
            }
             
        } else {
            echo "<div>Банкомат выключен.</div>";
        }
       
    }

}

$cashMasine = new CashMasine(100);
$cashMasine->setTurnOn();
// $cashMasine->setTurnOff();
$cashMasine->setAddCash(50);
// $cashMasine->setAddCash(50);
// echo $cashMasine->issue;
$cashMasine->setWithDraw(50);
// $cashMasine->setWithDraw(100);
// $cashMasine->setWithDraw(20);

$cashMasine->getInfo();


