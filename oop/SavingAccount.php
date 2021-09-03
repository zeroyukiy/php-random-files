<?php

class SavingAccount extends BankAccount
{
    private float $interestRate;

    public function __construct(private string $accountNumber, private float $balance)
    {
        parent::__construct($this->accountNumber, $this->balance);
    }

    public function setInterestRate(float $interestRate): void
    {
        $this->interestRate = $interestRate / 100;
        $this->echoFriendly('Set interest of ' . $interestRate . '%');
    }

    public function addInterest(): void
    {
        $interest = $this->interestRate * $this->balance;
        $this->deposit($interest);
    }
}