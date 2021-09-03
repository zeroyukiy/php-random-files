<?php

require_once 'BankAccount.php';
require_once 'SavingAccount.php';

function echo_friendly(string $str)
{
    echo '<pre>';
    echo $str;
    echo '</pre>';
}

$account = new BankAccount('ABC123', 87.23);
$account->deposit(13.45);
$account->withdraw(10.12);

// This technique is called method chaining.
$account->deposit(10)->deposit(11.23)->deposit(54.32)->withdraw(100.22);
$account->withdraw(64.22);


$account = new SavingAccount('ABC123', 110.55);
$account->deposit(100);
// set interest
$account->setInterestRate(5);
$account->addInterest();

