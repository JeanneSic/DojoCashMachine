<?php

class CashMachine
{
    const ACCEPTED_BILL = [500, 200, 100, 50, 20, 10, 5];

    private $bills = [500 => 0, 200 => 0, 100 => 0, 50 => 0, 20 => 0, 10 => 0, 5 => 0];

    public function addCash(int $billValue, int $billNb): bool
    {
        if (($billNb < 0) || (!in_array($billValue, self::ACCEPTED_BILL))) {
            return false;
        }
        $this->bills[$billValue] += $billNb;
        return true;
    }

    public function getRemainingCash(): array
    {
        return $this->bills;
    }

    public function withdraw(int $cashAmount): array
    {
        $withdraw = [500 => 0, 200 => 0, 100 => 0, 50 => 0, 20 => 0, 10 => 0, 5 => 0];
        foreach ($this->bills as $value => $nbBill) {
            while ($this->bills[$value] > 0 && $cashAmount >= $value) {
                $this->bills[$value]--;
                $cashAmount = $cashAmount-$value;
                $withdraw[$value] ++;
            }
            if ($withdraw[$value] === 0) {
                unset($withdraw[$value]);
            }
        }
        return $withdraw;
    }
}