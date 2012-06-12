<?php
require_once 'mustache/Mustache.php';
require_once 'phpword/PHPWord.php';

class OrderData extends Mustache{
    public $client = array(
        'fio' => 'FIO'
        , 'pet' => array(
            'alias' => 'A DOG'
        )
    );
    
    public $invoice = array(
        'id' => 1
        , 'amount' => 100
        , 'paid_amount' => 20
        , 'invoice_docs' => array(
            array('title' => 'Avakoks1', 'qty' => 1, 'price' => 100),
            array('title' => 'Avakoks2', 'qty' => 1, 'price' => 100),
            array('title' => 'Avakoks3', 'qty' => 1, 'price' => 100),
            array('title' => 'Avakoks4', 'qty' => 1, 'price' => 100),
            array('title' => 'Avakoks5', 'qty' => 1, 'price' => 100)
        )
    );
    
    public function render($template = null, $view = null, $partials = null) {
        parent::render($template, $view, $partials);
    }
}

$word = new PHPWord_TemplateMustache("order.docx", new OrderData());
$word->render();

$word->save('order2.docx');
?>