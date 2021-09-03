<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="it-IT">
<head>
    <title>Hello</title>
    <style>
        .title {
            color: #0a53be;
            font-size: 3em;
        }
    </style>
</head>
<body>

<?php

/**
 * @property string id
 * @property string class
 * @property string|array style
 */
class HtmlElement
{
    private array $attributes = [];

    public function __construct(public string $tag)
    {
    }

    public function __set(string $name, string|array $value): void
    {
        $this->attributes[$name] = $value;
    }

    public function __get(string $name): string
    {
        if (array_key_exists($name, $this->attributes)) {
            if (is_array($this->attributes[$name])) {
                return implode("<br/>", array_map(fn($style) => $style, $this->attributes[$name]));
            } else {
                return $this->attributes[$name];
            }
        }
        return 'property selected does not exist in the list';
    }

    public function html(string $content): string
    {
        $html = "<$this->tag";
        foreach ($this->attributes as $key => $value) {
            if ($key === 'style' && is_array($value)) {
                $html .= ' ' . $key . '="';
                $style = implode(' ', array_map(fn($style) => $style . ';', $value));
                $html .= $style . '"';
            } else {
                $html .= " $key=" . '"' . $value . '"';
            }
        }
        $html .= '>' . $content . '</' . $this->tag . '>';

        return $html;
    }
}

$p = new HtmlElement('p');
$p->id = 'title';
$p->class = 'title';
$p->style = [
    'text-decoration: underline',
    'text-decoration-color: green',
    'font-weight: bolder',
    'font-size: 2.6em',
    'text-shadow: 1px 1px 2px rgba(0,0,0,.22)',
    'cursor: pointer',
];

echo $p->html('Hello World');
echo $p->style;

?>

<p class="title">Hey</p>

<script>
    let title = document.querySelector('#title');
    let originalText = title.textContent;
    let randomTitles = [
        'From the Universe',
        'Power to the Trees',
        'For a better Future',
        'Adrenaline of the Madman',
        'Fire to the Powders',
    ];
    title.addEventListener('click', () => {
        if (title.textContent === originalText) {
            let shuffleTitles = shuffle(randomTitles);
            title.textContent = shuffleTitles[Math.floor(Math.random() * 4)];
        } else {
            title.textContent = originalText;
        }
    });

    function shuffle(a) {
        const j = Math.floor(Math.random() * (a.length - 1))
        for (let i = 0; i < a.length; i++) {
            [a[i], a[j]] = [a[j], a[i]];
        }
        return a;
    }
</script>

</body>
</html>

