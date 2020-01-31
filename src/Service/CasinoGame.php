<?php


namespace App\Service;


class CasinoGame
{
    const COLORS = [
        'Rouge',
        'Noir'
    ];

    /**
     * @var int
     */
    private $totalAmount;

    /**
     * @var int
     */
    private $gambleAmount;

    /**
     * @var int
     */
    private $gain;

    /**
     * @var string
     */
    private $color;

    /**
     * @var bool
     */
    private $isWinner;


    private function calculateTotal(): void
    {
        if ($this->isWinner()) {
            $this->setTotalAmount($this->getTotalAmount() + $this->getGambleAmount());
        } else {
            $this->setTotalAmount($this->getTotalAmount()  - $this->getGambleAmount());
        }
    }

    public function playGame($choicesFromClient)
    {
        $this->setGambleAmount($choicesFromClient['gamble']);
        $this->setTotalAmount($choicesFromClient['totalAmount']);


        $colorKey = array_rand(self::COLORS);
        $randomColor = self::COLORS[$colorKey];

        if ($choicesFromClient['color'] === $randomColor && $this->getTotalAmount() > 0) {
            $this->setIsWinner(true);
            $this->calculateTotal();

        } elseif ($choicesFromClient['color'] !== $randomColor && $this->getTotalAmount() > 0
            && $this->getTotalAmount() > $this->getGambleAmount()) {
            $this->setIsWinner(false);
            $this->calculateTotal();
        } else {
            $this->setTotalAmount(0);
        }

        return $this->getTotalAmount();
    }

    /**
     * @return int|null
     */
    public function getTotalAmount(): ?int
    {
        return $this->totalAmount;
    }

    /**
     * @param int $totalAmount
     */
    public function setTotalAmount(int $totalAmount): void
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return int
     */
    public function getGambleAmount(): int
    {
        return $this->gambleAmount;
    }

    /**
     * @param int $gambleAmount
     */
    public function setGambleAmount(int $gambleAmount): void
    {
        $this->gambleAmount = $gambleAmount;
    }

    /**
     * @return int
     */
    public function getGain(): int
    {
        return $this->gain;
    }

    /**
     * @param int $gain
     */
    public function setGain(int $gain): void
    {
        $this->gain = $gain;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return bool
     */
    public function isWinner(): bool
    {
        return $this->isWinner;
    }

    /**
     * @param bool $isWinner
     */
    public function setIsWinner(bool $isWinner): void
    {
        $this->isWinner = $isWinner;
    }

}
