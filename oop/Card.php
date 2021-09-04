<?php

use JetBrains\PhpStorm\ArrayShape;

function print_(mixed $str): void
{
    echo '<pre>';
    print_r($str);
    echo '</pre>';
}

abstract class Card
{
    private array $enabledFactions = [
        'forest',
        'shadow',
        'fortress',
    ];

    protected string $faction;

    protected array $debugInfo = [];

    /**
     * @throws Exception
     */
    public function __construct(protected string $name, protected string $type, string $faction)
    {
        if (!in_array($faction, $this->enabledFactions)) {
            throw new Exception('selected faction (' . $faction . ') not available yet.');
        }
        $this->faction = $faction;
        $this->debugInfo = [
            'name' => $this->name,
            'type' => $this->type,
            'faction' => $this->faction,
        ];
    }

    #[ArrayShape(['name' => "string", 'type' => "string", 'faction' => "string"])] public function __debugInfo(): ?array
    {
        return $this->debugInfo;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getFaction(): string
    {
        return $this->faction;
    }

}

class Creature extends Card
{
    public function __construct(string $name, private array $abilities, protected string $faction)
    {
        try {
            parent::__construct($name, 'creature', $faction);
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    #[ArrayShape(['name' => "string", 'type' => "string", 'faction' => "string", "abilities" => "array"])]
    public function __debugInfo(): ?array
    {
        return [
            $this->debugInfo,
            'abilities' => $this->abilities,
        ];
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getAbilities(): array
    {
        return $this->abilities;
    }
}

class Spell extends Card
{
    public function __construct(string $name, protected string $faction)
    {
        try {
            parent::__construct($name, 'spell', $faction);
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    public function __debugInfo(): ?array
    {
        return [
            $this->debugInfo,
        ];
    }
}

$card1 = new Creature('Coccodrillo delle lande desolate', ['volare', 'rapidità'], 'forest');
print_($card1);

$card2 = new Spell('Pugnale avvelenato delle foschie', 'shadow');
print_($card2);

$cards = [$card1, $card2];
print_($cards);

print_(array_filter($cards, fn($card) => $card->getType() !== 'spell'));
