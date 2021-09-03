<?php declare(strict_types=1);

class BankAccount
{
    public function __construct(private string $accountNumber, private float $balance)
    {
    }

    public function __toString(): string
    {
        return 'Bank Account: ' . $this->accountNumber . '. Balance: $' . $this->balance;
    }
}

$account = new BankAccount('ABC 123', 145.54);
echo $account;