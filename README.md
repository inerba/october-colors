# october-colors
Filtri twig per effettuare varie operazioni sui colori, estrarre i colori dalle immagini e percepirne la luminosità

## filtri a disposizione

#### color\_lighten
`color_lighten(string $color, int $percent = 20)`

Schiarisce il colore della percentuale selezionata

#### color\_darken
`color_darken(string $color, int $percent = 20)`

Scurisce il colore della percentuale selezionata

#### color\_isLight
`color_isLight(string $color)`

Restituisce *true* se il colore è chiaro

#### color\_isDark
`color_isDark(string $color)`

Restituisce *true* se il colore è scuro


| Filtro   |      Parametri      |  Descrizione |
|----------|:-------------:|------:|
| color_complementary | *string* hex color |  Restituisce il colore a tinta opposta a quello inserito  |
| color_greyscale | *string* hex color |  Restituisce il colore nella scala dei grigi  |
| color_desaturate |*string* hex color, *int* percentage |  Restituisce il colore desaturato rispetto alla percentuale inserita  |
| color_mix | *string* hex color 1, *string* hex color 2, *int* percentage |  Miscela i colori inseriti, la percentuale indica la quantità del secondo colore  |
| color_random | *string* custom string, *array* color values |  Restituisce un colore casuale, se inseriamo una stringa il colore sarà collegato a quest'ultima, possiamo anche inserire una soglia che ci permette di non avere colori troppo scuri o troppo chiari es: `color_random('quello che vuoi',[64,180])`  |
| color_gradient | *string* hex color, *int* steps, *bool* compatibility mode |  Restituisce gli stili css inline per un gradient background es: `style="{{ color_gradient('#990099') }}"`  |
| color_extract | *string* image path, *int* number of colors |  Restituisce un array con i colori più rappresentativi |
| color_imgLight | *string* image path, *int* samples, *int* luminance threshold |  Restituisce *true* se l'immagine è chiara, puoi definire il campionamento e la soglia di luminanza  |
| color_rgbToHex | *int* red, *int* green, *int* blue |  Restituisce l'esadecimale delle componenti rgb del colore  |
| color_hexToRgb | *string* hex color, alpha |  restituisce il css del colore rgb o rgba (se usiamo l'alpha channel)  |