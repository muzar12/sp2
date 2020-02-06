# sp2
Spletno programiranje 2,
Projektna naloga, 
Vpisna št.: 35180128

.htaccess datoteka je prikazana kot htaccess.txt

Uporaba z priloženo bazo customers.sql je sledeča:

Za prikaz vseh podatkov iz baze vpišemo v ukazno vrstico ukaz: 
`curl -i -X GET http://127.0.0.1/vrni/` - 127.0.0.1 je ip naslov strežnika baze podatkov.

Za prikaz po določenem ID ju osebe vpišemo ukaz: 
`curl -i -X GET http://127.0.0.1/vrni/1` - /1 predstavlja osebo z ID = 1

Za posodobitev podatkov določene osebe potrebujemo njegov ID.
Posodobitev se izvede z ukazom:
`curl -i -d "ime=Boris&priimek=Finc&rating=4&starost=21" -X PUT http://127.0.0.1/vrni/1`
V tem primeru se izvede posodobitev osebe z ID = 1, spremenimo ga v ime Boris, priimek Finc, z ratingom 4 in starostjo 21.

Za izbris določene osebe iz baze potrebujemo njegov ID.
Izbris se izvede z ukazom: 
`curl -i -X DELETE http://127.0.0.1/brisi/1` - /1 predstavlja osebo z ID = 1

Za dodajanje nove osebe v bazo uporabimo ukaz:
`curl -i -d "ime=Mirko&priimek=Pucibabic&rating=6&starost=46" -X POST http://127.0.0.1/dodaj/`
V tem primeru v bazo dodamo osebo z imenom Mirko, priimkom Pucibabic, z ratingom 6 in starostjo 46.
