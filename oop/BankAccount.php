<?php

class BankAccount
{
    private float $lastWithdraw;

    public function __construct(private string $accountNumber, private float $balance)
    {
    }

    public function deposit(float $amount): static
    {
        if ($amount > 0) {
            $this->balance += $amount;
            $this->echoFriendly($this->printCurrentBalance());
        }
        return $this;
    }

    public function withdraw(float $amount): bool
    {
        if ($amount <= $this->balance) {
            $this->balance -= $amount;
            $this->lastWithdraw = $amount;
            $this->echoFriendly($this->printOperationAfterWithdraw());
            return true;
        }
        return false;
    }

    public function printOperationAfterWithdraw(): string
    {
        return $this->accountNumber . ' request a withdraw operation of $' . $this->lastWithdraw . '<br/>' . $this->printCurrentBalance();
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function printCurrentBalance(): string
    {
        return 'Current balance is $' . $this->getBalance();
    }

    protected function echoFriendly(string $str): void
    {
        echo '<pre>';
        echo $str;
        echo '</pre>';
    }

    public function __destruct()
    {
        $this->echoFriendly(self::class . ' __destruct() invoked');
    }
}