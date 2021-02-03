<?php
declare(strict_types=1);

namespace App\Project\WidgetBundle\Utility;

class Calculator
{
    private const PACKS = [250, 500, 1000, 2000, 5000];

    /** @var array */
    private $crates;

    public function calculate(int $amount): array
    {
        $this->getPacks($amount, self::PACKS);

        return $this->crates;
    }

    private function getPacks(int $amount, array $packs): void
    {
        if (in_array($amount, $packs, true)) {
            $this->crates[] = $amount;
            return;
        }

        if ($amount < $packs[0]) {
            $this->crates[] = $packs[0];
            return;
        }

        foreach ($packs as $key => $pack) {
            if ($pack > $amount) {
                if ($pack - $amount < $packs[0]) {
                    $this->crates[] = $pack;
                    return;
                }

                $this->crates[] = $packs[$key-1];
                $this->getPacks($amount-$packs[$key-1], $packs);
                return;
            }
        }

        //extreme
        $this->crates[] = end($packs);
        $this->getPacks($amount - end($packs), $packs);

        return;

    }
}
