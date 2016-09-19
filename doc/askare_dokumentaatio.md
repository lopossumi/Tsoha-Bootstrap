# askare
/ˈɑskɑreˣ/
1. A chore (daily routine task), normally used in plural (askaret or askareet)

## 1. Johdanto
Askare on helppokäyttöinen usean käyttäjän muistilistaohjelma, johon voit lisätä ja luokitella erilaisia tehtäviä asioita (askareita). Vanhoja askareita voi uudelleenluokitella ja priorisoida, valmiit askareet voi kuitata tehdyiksi ja tehtävälistoja voi jakaa toisille käyttäjille. Voit myös luoda toistuvia askareita.

Ohjelma soveltuu esimerkiksi yksityishenkilöiden muistikirjaksi, perheiden taloudenpitoon ja pienille projekteille.

Järjestelmä käyttää Apache-, PostgreSQL- ja PHP-teknologioita.

## 2. Yleiskuva järjestelmästä
Käyttäjät ovat järjestelmän sisällä tasa-arvoisia: kuka tahansa voi luoda, muokata, poistaa ja jakaa askareita.

### Käyttötapausesimerkkejä

Lenni Latva-Laho, viherkasvien kauhu, kuulee järjestelmästä ensimmäistä kertaa sosiaalisessa mediassa ja arvelee sen soveltuvan mainiosti arkipäiväisten asioiden muistamiseen. Lenni surffaa aloitussivulle, luo uuden käyttäjätunnuksen ja saa vahvistuslinkin sähköpostitse. Hän luo ensimmäisen askareensa, ”kastele kukat”, ja asettaa sen toistuvaksi tehtäväksi prioriteetilla Erittäin Tärkeä.

Ruuhkavuosia elävä pariskunta Unto Unelma-Vävy ja Vieno Vainoke käyttävät järjestelmää yhteiseen taloudenpitoon. Vieno luo kauppalistan ja jakaa sen Untolle, joka kuittaa kauppareissun tehdyksi palatessaan toimistolta.

Ville Väärinkäyttäjä ei piittaa ohjelman tekijän tarkoitusperistä, vaan käyttää sitä autobiografista levykokoelmaansa varten. Ville pitää ohjelman luokittelu- ja järjestelyominaisuuksista, ja merkitsee jokaisen rakkaan vinyylilevynsä omaksi ”tehtäväkseen” luokitellen ne genren ja hankkimispäivämäärän mukaan. Villeä ei haittaa, että ohjelman tietokantaa ei missään tapauksessa ole suunniteltu levykokoelman ylläpitoon.

### Järjestelmän tietosisältö

**Human**

| Attribuutti | Arvojoukko   | Kuvaus
| -------     | -----------  | ------------------------------------  |
| Username    | varchar(20)  | Käyttäjätunnus                        |
| Password    | varchar(50)  | Salasana                              |
| Fullname    | varchar(100) | Koko nimi (näkyy muille käyttäjille)  |
| Email       | varchar(100) | Sähköpostiosoite aktivointia varten   |
| Private     | boolean      | Piilotetaanko käyttäjä ystävähausta   |
| CreatedAt   | datetime     |                                       |

Järjestelmän käyttäjä, joka kirjautuu käyttäjätunnuksella/sähköpostiosoitteella ja salasanalla.

**TaskList**

| Attribuutti | Arvojoukko  | Kuvaus
| -------     | ----------- | ---------------  |
| Listname    | varchar(50) | Listan nimi      |

Tehtävälista. Voidaan jakaa muiden käyttäjien kanssa, mutta alkuperäinen luoja säilyy listan omistajana.

**Task**

| Attribuutti   | Arvojoukko   | Kuvaus
| -------       | -----------  | ---------------  |
| Description   | varchar(100) | Tehtävän kuvaus
| Status        | integer      | Ei aloitettu / aloitettu / Suoritettu
| Duedate       | datetime     | Tehtävän deadline
| Priority      | integer      | Tehtävän tärkeysaste (1...4)

Todo-listan alkio, suoritettava tehtävä.

**Category**

| Attribuutti   | Arvojoukko   | Kuvaus
| -------       | -----------  | ---------------  |
| Description   | varchar(50)  | Kategorian kuvaus

Tehtävälle annettava luokittelumääre.
