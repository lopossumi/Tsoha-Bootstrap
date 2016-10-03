# askare
/ˈɑskɑreˣ/

1. A chore (daily routine task), normally used in plural (*askaret* or *askareet*).

Tietokantasovellus-kurssin harjoitustyö, syksy 2016.

* [Linkki sovellukseen](https://milo.users.cs.helsinki.fi/askare/)
* Linkki dokumentaatioon: [MD](https://github.com/lopossumi/askare-tsoha/blob/master/doc/askare_dokumentaatio.md) [PDF](https://github.com/lopossumi/askare-tsoha/blob/master/doc/askare_dokumentaatio.md.pdf)
* Kirjautuminen: spede@spe.de / spede123

## Työn aihe

[Aihekuvaus: Muistilista](http://advancedkittenry.github.io/suunnittelu_ja_tyoymparisto/aiheet/Muistilista.html)

## Käyttöohje

Kirjaudu sisään ylläolevilla tunnuksilla. Voit lisätä tehtäviä klikkaamalla New Task -nappia, poistaa olemassaolevia tehtäviä punaisesta ruksista ja muokata niitä sinisestä lyijykynästä. Muokkaus- ja lisäysnäkymässä voit valita tehtävälle prioriteetin, deadline-ajankohdan (kalenterinäkymä) ja kirjoittaa vapaamuotoisen kuvauksen.

Toistaiseksi toteuttamatta:
- Kategorioiden lisäys ja poisto
- Listojen lisäys ja poisto
- Syötteiden validoinnit

## TODO: Viikko 3

- [x] Toteuta sovellukseesi vähintään yksi malliluokka, jossa on (1,5p)
- [x] kaikki tietokohteen oliot tietokannasta hakeva metodi (esim. all)
- [x] tietyllä id:llä varustetun tietokohteen olion tietokannasta hakeva metodi (esim. find)
- [x] tietokohteen olion tietokantaan lisäävä metodi (esim. save).
- [x] Toteuta malliasi käyttämään kontrolleriin metodit, jotka esittävät tietokohteen listaus-, esittely- ja lisäysnäkymän. Toteuta myös kontrolleriisi metodi, joka mahdollistaa tietokohteen olion lisäämisen tietokantaan käyttäjän lähettämän lomakkeen tiedoilla. (1,5p)
- [x] Kirjoita koodikatselmointi (vapaaehtoinen). (0-2p)
- [x] Pushaa kaikki tekämäsi muutokset repoosi!

## TODO: Viikko 4

- [x] Lisää malliluokkaasi metodi tietokohteen olion muokkaamiselle (esim. update)- ja poistolle (esim. destroy). (1p)
- [x] Lisää käyttäjälle mahdollisuus muokkaukseen ja poistoon lisäämällä kontrolleriin tarvittavat medotit ja toteuttamalla tarvittavat näkymät. Muokkausnäkymä on luultavasti lisäysnäkymää muistuttava lomake ja poisto voi tapahtua painiketta painamalla esimerkiksi tietokohteen esittely- tai listaussivulla. (0,5p)
- [ ] Lisää malliisi tarvittavat validaattorit ja estä kontrollereissa virheellisten syötteiden lisääminen tietokantaan. Muista näyttää lomakkeissa virhetilanteissa virheilmoitukset ja täyttää kentät käyttäjän antamilla syötteillä. (0,5p)
- [x] Toteuta malliluokka sovelluksen käyttäjälle ja toteuta käyttäjän kirjautuminen. Toteuta get_user_logged_in-metodi ja käytä tarvittaessa kirjautuneen käyttäjän tietoa hyväksi näkymissä ja malleissa. (0,5p)
- [x] Kirjoita alustava käynnistys- / käyttöohje dokumentaatioosi. Lisää myös reposi README.md tiedostoon käyttäjätunnus ja salasana, jolla ohjaaja voi kirjautua sisään sovellukseesi. (0.5p)
- [x] Pushaa kaikki tekämäsi muutokset repoosi!

## TODO: Muut

- [ ] Vie omat skriptit site.js -tiedostoon
- [ ] Datetimepickerin output käyttöön
