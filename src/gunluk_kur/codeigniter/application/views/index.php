<?php
/*class Currency{
    public $url="https://finans.truncgil.com/today.json";
    public function fgc(){
        $data=file_get_contents($this->url);
        $this->data=json_decode($data,true);
        return $this;
    }
    public function get($int){
        return $this->data[$int];
    }
}
$currency=new Currency();
$usd=$currency->fgc()->get("USD");
$eur=$currency->fgc()->get("EUR");
$ster=$currency->fgc()->get("GBP");
$gram=$currency->fgc()->get("gram-altin");
$ceyrek=$currency->fgc()->get("ceyrek-altin");
$yarim=$currency->fgc()->get("yarim-altin");
$ata=$currency->fgc()->get("ata-altin");
$gumus=$currency->fgc()->get("gumus");
$b18=$currency->fgc()->get("18-ayar-altin");
$b24=$currency->fgc()->get("22-ayar-bilezik");
echo $currency->fgc()->get("22-ayar-bilezik")["Değişim"];*/
$data=file_get_contents("https://finans.truncgil.com/today.json");
$veri=json_decode($data,1);
echo $veri["EUR"]["Değişim"];