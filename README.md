Colors
===================
Filtri twig per effettuare varie operazioni sui colori, estrarre i colori dalle immagini e percepirne la luminosità

--------------------

Installazione
-------------

Questo plugin è ancora in fase sperimantale, pertanto non è ancora possibile installarlo tramite il normale processo di installazione di October CMS.

 - per installare il pacchetto, vai nella cartella `plugins` dell'installazione di october e clona questo repository nella cartella `inerba/colors`.
	 `git clone https://github.com/inerba/october-colors.git inerba/colors`

 - vai nella cartella appena creata: `inerba/colors` e installa tutte le dipendenze con `composer install`

----------

## Filtri a disposizione

#### color\_lighten
`{{ color_lighten(string $color, int $percent = 20) }}`

Schiarisce il colore della percentuale selezionata

#### color\_darken
`{{ color_darken(string $color, int $percent = 20) }}`

Scurisce il colore della percentuale selezionata

#### color\_isLight
`{{ color_isLight(string $color) }}`

Restituisce *true* se il colore è chiaro

#### color\_isDark
`{{ color_isDark(string $color) }}`

Restituisce *true* se il colore è scuro

#### color\_complementary
`{{ color_complementary(string $color) }}`

Restituisce il colore a tinta opposta a quello inserito

#### color\_greyscale
`{{ color_greyscale(string $color) }}`

Restituisce il colore nella scala dei grigi

#### color\_desaturate
`{{ color_desaturate(string $color, int $saturation=20) }}`

Restituisce il colore desaturato rispetto alla percentuale inserita

#### color\_mix
`{{ color_mix(string $color1, string $color2, int $percent = 50) }}`

Miscela i colori inseriti, la percentuale indica la quantità del secondo

#### color\_random
`{{ color_random(string $string=false, array $normalize=false) }}`

Genera colori unici a partire da una stringa, se la stringa non viene fornita, verrà generato un colore casuale. È possibile inoltre applicare i valori RGB entro un certo intervallo per evitare che i colori siano troppo luminosi o scuri, passando i valori di normalizzazione minimo e massimo (0-255).

#### color\_gradient
`{{ color_gradient(string $color, int $steps=25, bool $old_browsers = true) }}`

Restituisce gli stili css inline per un gradient background

##### Esempio
```twig
style="{{ color_gradient('#990099') }}"
```

#### color\_extract
`{{ color_extract(string $path, int $palette=5) }}`

Restituisce un array con i colori più rappresentativi dell'immagine inserita

#### color\_imgLight
`{{ color_imgLight(string $path, int $samples=10, int $threshold=170) }}`

Restituisce *true* se l'immagine è chiara, puoi definire il campionamento *$samples* e la soglia di luminanza *$threshold*

#### color\_complementary
`{{ color_rgbToHex(int $red, int $green, int $blue) }}`

Restituisce l'esadecimale delle componenti rgb del colore

#### color\_complementary
`{{ color_hexToRgb(string $color, float $alpha) }}`

restituisce il css del colore rgb o rgba (se usiamo l'alpha channel)

## Uso dei metodi statici

Puoi usare tutte le funzioni, basta che non usi il prefisso *color_*

```php
use Inerba\Colors\Classes\ColorBase as Colors;

$dark_color = '990099';
$color = Colors::lighten($dark_color, 50); // return '#9CA759'
```