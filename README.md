# askare
/ˈɑskɑreˣ/

1. A chore (daily routine task), normally used in plural (*askaret* or *askareet*).

Tietokantasovellus-kurssin harjoitustyö, syksy 2016.

* [Linkki sovellukseen](https://milo.users.cs.helsinki.fi/askare/)
* Linkki dokumentaatioon: [MD](https://github.com/lopossumi/askare-tsoha/blob/master/doc/askare_dokumentaatio.md) [PDF](https://github.com/lopossumi/askare-tsoha/blob/master/doc/askare_dokumentaatio.pdf)

## Työn aihe

[Aihekuvaus: Muistilista](http://advancedkittenry.github.io/suunnittelu_ja_tyoymparisto/aiheet/Muistilista.html)

# askare
/ˈɑskɑreˣ/
1. A chore (daily routine task), normally used in plural (askaret or askareet)

## 1. Johdanto
Askare on helppokäyttöinen usean käyttäjän muistilistaohjelma, johon voit lisätä ja luokitella erilaisia tehtäviä asioita (askareita). 
Olemassaolevia askareita voi uudelleenluokitella ja priorisoida, niille voi antaa deadlinen, kuitata aloitetuiksi/tehdyiksi ja lopulta
arkistoida. Myöhemmissä versioissa tehtävälistoja voi myös jakaa toisille käyttäjille.

Ohjelma soveltuu esimerkiksi yksityishenkilöiden muistikirjaksi, perheiden taloudenpitoon ja pienille projekteille.

Järjestelmä on toteutettu PHP:lla Apache-palvelimelle ja käyttää tietokantanaan PostgreSQL:ää. Askare vaatii selaimelta Javascript-tuen.

## 2. Yleiskuva järjestelmästä
Tavallinen käyttäjä voi luoda, katsella, muokata ja poistaa omia tehtäviään. Tehtävät, kategoriat ja listat ovat henkilökohtaisia.

Pääkäyttäjä* voi lisäksi selata muita käyttäjiä ja esimerkiksi palauttaa toisen käyttäjän salasanan. 

*Huom. Pääkäyttäjän erityisoikeuksia ei ole vielä toteutettu palautusversiossa*.

![Käyttötapaukset](kayttotapauskaavio.png)

*Kuva 1. Käyttötapaukset*

### Käyttötapausesimerkkejä

Lenni Latva-Laho, viherkasvien kauhu, kuulee järjestelmästä ensimmäistä kertaa sosiaalisessa mediassa ja arvelee sen soveltuvan mainiosti arkipäiväisten 
asioiden muistamiseen. Lenni surffaa aloitussivulle, luo uuden käyttäjätunnuksen ja saa vahvistuslinkin sähköpostitse. Hän luo ensimmäisen askareensa, 
”kastele kukat”, ja asettaa sen deadlineksi seuraavan keskiviikon prioriteetilla Erittäin Tärkeä. Nyt Lenni muistaa kerrankin kastella kukkasensa ja ne kukoistavat.

Ville Väärinkäyttäjä ei piittaa ohjelman tekijän tarkoitusperistä, vaan käyttää sitä autobiografista levykokoelmaansa varten. Ville pitää ohjelman luokittelu- 
ja järjestelyominaisuuksista, ja merkitsee jokaisen rakkaan vinyylilevynsä omaksi ”tehtäväkseen”, nimeää kategoriat genrejen mukaan ja käyttää deadlinea
hankkimispäivämäärän muistamiseen. Villeä ei haittaa, että ohjelmaa ei missään tapauksessa ole suunniteltu levykokoelman ylläpitoon.

### Järjestelmän tietosisältö

![Tietosisältö](askare_kasitekaavio.png)

*Kuva 2. Käsitekaavio*

#### Tietokohde: Human

| Attribuutti | Arvojoukko   | Kuvaus
| -------     | -----------  | ------------------------------------  |
| Username    | varchar(20)  | Käyttäjätunnus                        |
| Fullname    | varchar(100) | Koko nimi (näkyy muille käyttäjille)  |
| Password    | varchar(255) | Salasana                              |
| Email       | varchar(254) | Sähköpostiosoite aktivointia varten   |
| IsPrivate   | boolean      | Piilotetaanko käyttäjä ystävähausta   |
| IsAdmin     | boolean      | Pääkäyttäjä (voi muokata käyttäjiä)   |

Järjestelmän käyttäjä, joka kirjautuu käyttäjätunnuksella/sähköpostiosoitteella ja salasanalla. Salasana kryptataan tietokantaan.

#### Tietokohde: TaskList

| Attribuutti | Arvojoukko   | Kuvaus
| -------     | ------------ | ---------------  |
| Name        | varchar(50)  | Listan nimi      |
| Description | varchar(200) | Listan kuvaus    |

Tehtävälista. Käyttäjä voi luoda useita tehtävälistoja, joista jokainen voi sisältää useita tehtäviä. 

#### Tietokohde: Task

| Attribuutti   | Arvojoukko    | Kuvaus
| -------       | -----------   | ---------------
| Description   | varchar(50)   | Tehtävän nimi
| Description   | varchar(2000) | Tehtävän tarkempi kuvaus
| Duedate       | timestamp     | Tehtävän deadline
| Completed     | timestamp     | Milloin tehtävä on merkitty suoritetuksi
| Priority      | integer       | Tehtävän tärkeysaste (Low...Highest)
| Repeat        | integer       | Tehtävän toistuvuus
| Status        | integer       | Ei aloitettu / aloitettu / Suoritettu
| Archived      | boolean       | Tehtävä on arkistossa
| Deleted       | boolean       | Tehtävä on roskakorissa

Tehtävälistan alkio eli suoritettava tehtävä. Tehtävälle voi asettaa prioriteetin (Low, **Normal**, High, Highest) ja useita luokkia.
Deadline ilmaistaan jäljelläolevana aikana, mutta sen määrittäminen ei ole pakollista. Tehtävä voidaan merkitä aloitetuksi ja suoritetuksi,
sekä siirtää arkistoon. Deleted-bitti on tarkoitettu soft deleten (roskakorin) toteuttamista varten.

Completed ja repeat ovat valmiina tulevia ominaisuuksia varten: tehtäviä voi vastaisuudessa asettaa toistuviksi tiettyinä viikonpäivinä ja
arkistoa selata kuukausinäkymän avulla. 

#### Tietokohde: Category

| Attribuutti   | Arvojoukko   | Kuvaus
| -------       | -----------  | ---------------  |
| Name          | varchar(50)  | Kategorian nimi
| Description   | varchar(200) | Kategorian kuvaus
| Symbol        | varchar(20)  | Kategorian tunnus (glyphicon)
| Color         | varchar(20)  | Kategorian väri (bootstrap)

Tehtävälle annettava luokittelumääre, joita voi olla useita per tehtävä. Luokittelumääreet ovat käyttäjäkohtaisia. Kategoriaa ilmaiseva symboli ja väri valitaan annetusta kirjastosta.

![Tietokantakaavio](askare_database.png)

*Kuva 3. Tietokantakaavio*

### Järjestelmän yleisrakenne

Tietokantasovelluksessa on noudatettu MVC-mallia. Kontrollerit, näkymät ja mallit
sijaitsevat hakemistoissa /app/controllers, /app/views ja /app/models. GET ja POST -pyyntöjen ohjaamisesta kontrollereille vastaa /config -hakemistossa sijaitseva *routes.php*.

Ulkopuoliset kirjastot (esim. Bootstrap) sijaitsevat hakemistossa /vendor. Sovellus käyttää päivämäärän valintaan Jonathan Petersonin [Bootstrap Datetimepickeriä](https://github.com/Eonasdan/bootstrap-datetimepicker).

Kaikki tiedostonimet on kirjoitettu pienellä ja koodin luettavuuteen on pyritty kiinnittämään huomiota.

![Järjestelmän komponentit](components.png)

*Kuva 4. Järjestelmän komponentit*

### Asennusohje

Askare on luotu kurssin aikaan PHP:n versiolla 5.3.2 ja PostgreSQL:n versiolla 8.4.22 (ennen syyskuuta 2017). Nykyinen versio käyttää PHP 7.0.22 ja PSQL 9.5.8, mutta on todennäköisesti edelleen yhteensopiva vanhempien versioiden kanssa.

Luo PostgreSQL-tietokanta, asenna [Composer](https://getcomposer.org/download/), kloonaa repositorio ja konfiguroi tietokanta (config/database.php). Luo sitten tietokantataulut ajamalla sql/create_tables.php. 

Otettuasi järjestelmän käyttöön varmista, että tietokantayhteys on kytketty pois päältä kommentoimalla index.php:stä siihen liittyvä route-komento: muutoin osoitteesta {asennushakemisto}/tietokantayhteys pääsee selaamaan kaikkien käyttäjien tietoja.

### Järjestelmän käyttöohje

Surffaa aloitussivulle [http://milo.users.cs.helsinki.fi/askare] ja klikkaa "Sign Me up" -nappia, jolloin pääset täyttämään
käyttäjätietosi. Rekisteröidyttyäsi voit kirjautua joko käyttäjätunnuksella tai sähköpostiosoitteella ja salasanalla. 
Voit myös kokeilla testitunnuksia (käyttäjä "spede1", salasana "spede123").

Aloita luomalla uusi kategoria klikkaamalla ylävalikosta New->Category. Nimeä kategoria, kirjoita lyhyt kuvaus ja valitse sitä
kuvaava värin ja symbolin yhdistelmä; esimerkiksi "Opiskelu2016", "Syyslukukauden opinnot" ja sinisen kirjan kuva.

Luo seuraavaksi uusi tehtävälista klikkaamalla New->List, anna sillekin nimi ja lyhyt kuvaus.

Nyt voit lisätä listaan tehtäviä (jos yrität luoda tehtävän ilman ainuttakaan listaa, sinut ohjataan uuden listan luontiin). Valitse ylävalikosta
New->Task ja anna tehtävälle nimi. Kuvaukseen (Description) voit kirjoittaa pidemmän sepustuksen käyttäen muotoiluun MarkDown-syntaksia; lyhyt kuvaus
käytettävistä komennoista löydät osoitteesta [https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet]. MarkDownin avulla voit
liittää tehtäviin jopa linkkejä kuviin, jolloin ne näkyvät tehtävän tarkastelussa.

Aseta tehtävälle prioriteetti neliportaisella asteikolla sekä deadline-päivämäärä muodossa **YYYY-MM-DD hh:mm:ss** (päivämäärän saat asetettua helpoiten klikkaamalla
kalenterin kuvaa). Deadline-päivämäärän voi myös jättää tyhjäksi.

Valitse lopulta kaikki ne luomasi kategoriat joihin tehtävä kuuluu klikkaamalla kyseistä symbolia. Näet kategorian nimen siirtämällä kursorin symbolin päälle.

Luotuasi muutamia kategorioita, listoja ja tehtäviä voit selailla niitä navigoimalla päänäkymään klikkaamalla Askare-logoa. Voit järjestää listoja
nimen, prioriteetin ja deadline-päivämäärän perusteella. Klikkaamalla valkoista play-nappia voit merkitä tehtävän aloitetuksi, toinen klikkaus merkitsee sen
suoritetuksi ja kolmas siirtää tehtävän arkistoon. Päänäkymässä voit myös suoraan nostaa tai laskea tehtävän prioriteettia klikkaamalla tähtiä. Klikkaamalla tehtävän nimeä 
pääset tarkastelemaan tehtävän pidempää kuvausta sekä pääset joko muokkaamaan tehtävää tai poistamaan sen. Tehtävän muokkaaminen palauttaa sen statuksen takaisin aloittamattomaksi.

Pääset selaamaan kategorioita valitsemalla ylävalikosta "Categories". Voit selata kuhunkin kategoriaan liittyviä tehtäviä klikkaamalla tässä näkymässä valitsemasi kategorian 
symbolia. Klikkaamalla lyijykynää voit muokata kategorian tietoja, roskakori poistaa kategorian.

Archive-näkymästä näet kaikki arkistoidut tehtävät. Voit palauttaa arkistoituja tehtäviä samaan tapaan kuin merkitsit niitä suoritetuiksi. 

Kirjaudu lopuksi ulos järjestelmästä painamalla oikean yläkulman logout-nappia.

### Tunnettuja puutteita ja kehityskohteita

Järjestelmä on palautushetkellä käyttövalmis eikä tunnettuja kriittisiä bugeja ole tiedossa, mutta kehitettävää vielä riittää:
- Ohjelmaa on kurja käyttää mobiililaitteilla; joillain puhelimilla käyttö kuitenkin onnistuu joten kuten vaakatasossa.
- Kategorianäkymä poikkeaa jonkin verran päänäkymästä; tehtäviä ei esimerkiksi voi järjestää. Molemmat näkymät menevät uusiksi ja optimoidaan myös mobiililaitteille.
- Tunnuksia ei voi poistaa eikä salasanaa vaihtaa ilman suoraa pääsyä tietokantaan
- Bootstrapin nappuloiden CSS-muotoilua ei ole paranneltu, joten niistä ei tahdo nähdä ovatko ne valittuja. Tämä aiheuttaa käytettävyysongelmia erityisesti tehtävää muokatessa.
- View task -näytössä tulee klikattua päivämääränmuokkainta, mutta se ei vaikuta mihinkään ennekuin Edit taskia on painettu.
- Ohjelma ei juuri pitele kädestä rekisteröitymisen jälkeen; tutoriaali olisi hyvä toteuttaa.
