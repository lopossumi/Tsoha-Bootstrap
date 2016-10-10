# askare
/ˈɑskɑreˣ/
1. A chore (daily routine task), normally used in plural (askaret or askareet)

## 1. Johdanto
Askare on helppokäyttöinen usean käyttäjän muistilistaohjelma, johon voit lisätä ja luokitella erilaisia tehtäviä asioita (askareita). Vanhoja askareita voi uudelleenluokitella ja priorisoida, valmiit askareet voi kuitata tehdyiksi ja tehtävälistoja voi jakaa toisille käyttäjille. Voit myös luoda toistuvia askareita.

Ohjelma soveltuu esimerkiksi yksityishenkilöiden muistikirjaksi, perheiden taloudenpitoon ja pienille projekteille.

Järjestelmä käyttää Apache-, PostgreSQL- ja PHP-teknologioita ja vaatii selaimelta Javascript-tuen.

## 2. Yleiskuva järjestelmästä
Käyttäjät ovat järjestelmän sisällä tasa-arvoisia: kuka tahansa voi luoda, muokata, poistaa ja jakaa askareita.

### Käyttötapausesimerkkejä

Lenni Latva-Laho, viherkasvien kauhu, kuulee järjestelmästä ensimmäistä kertaa sosiaalisessa mediassa ja arvelee sen soveltuvan mainiosti arkipäiväisten asioiden muistamiseen. Lenni surffaa aloitussivulle, luo uuden käyttäjätunnuksen ja saa vahvistuslinkin sähköpostitse. Hän luo ensimmäisen askareensa, ”kastele kukat”, ja asettaa sen toistuvaksi tehtäväksi prioriteetilla Erittäin Tärkeä.

Ville Väärinkäyttäjä ei piittaa ohjelman tekijän tarkoitusperistä, vaan käyttää sitä autobiografista levykokoelmaansa varten. Ville pitää ohjelman luokittelu- ja järjestelyominaisuuksista, ja merkitsee jokaisen rakkaan vinyylilevynsä omaksi ”tehtäväkseen” luokitellen ne genren ja hankkimispäivämäärän mukaan. Villeä ei haittaa, että ohjelman tietokantaa ei missään tapauksessa ole suunniteltu levykokoelman ylläpitoon.

### Järjestelmän tietosisältö

![Tietosisältö](askare_kasitekaavio.png)

#### Tietokohde: Human

| Attribuutti | Arvojoukko   | Kuvaus
| -------     | -----------  | ------------------------------------  |
| Username    | varchar(20)  | Käyttäjätunnus                        |
| Password    | varchar(50)  | Salasana                              |
| Fullname    | varchar(100) | Koko nimi (näkyy muille käyttäjille)  |
| Email       | varchar(100) | Sähköpostiosoite aktivointia varten   |
| IsPrivate   | boolean      | Piilotetaanko käyttäjä ystävähausta   |
| IsAdmin     | boolean      | Pääkäyttäjä (voi muokata käyttäjiä)   |

Järjestelmän käyttäjä, joka kirjautuu käyttäjätunnuksella/sähköpostiosoitteella ja salasanalla.

#### Tietokohde: TaskList

| Attribuutti | Arvojoukko  | Kuvaus
| -------     | ----------- | ---------------  |
| Listname    | varchar(50) | Listan nimi      |

Tehtävälista. Käyttäjä voi luoda useita tehtävälistoja, joista jokainen voi sisältää useita tehtäviä. 

#### Tietokohde: Task

| Attribuutti   | Arvojoukko   | Kuvaus
| -------       | -----------  | ---------------  |
| Description   | varchar(100) | Tehtävän kuvaus
| Duedate       | timestamp    | Tehtävän deadline
| Priority      | integer      | Tehtävän tärkeysaste (Low...Highest)
| Status        | integer      | Ei aloitettu / aloitettu / Suoritettu

Tehtävälistan alkio eli suoritettava tehtävä. Tehtävälle voi asettaa prioriteetin (Low, **Normal**, High, Highest) ja useita luokkia. Deadline ilmaistaan jäljelläolevana aikana, mutta sen määrittäminen ei ole pakollista.

#### Tietokohde: Category

| Attribuutti   | Arvojoukko   | Kuvaus
| -------       | -----------  | ---------------  |
| Description   | varchar(50)  | Kategorian kuvaus
| Symbol        | integer      | Kategorian tunnus

Tehtävälle annettava luokittelumääre, joita voi olla useita per tehtävä. Luokittelumääreet ovat käyttäjäkohtaisia. Kategoriaa ilmaiseva symboli valitaan annetusta kirjastosta.

![Tietokantakaavio](askare_database.png)

![Järjestelmän komponentit](components.png)

### Järjestelmän käyttöohje

#### Staattiset sivut

Järjestelmän etusivu sijaitsee osoitteessa [http://milo.users.cs.helsinki.fi/askare]. Painamalla login-nappia pääset etusivunäkymään, josta näkee todo-listat ja niiden sisältämät tehtävät. Voit avata uuden tehtävän luomiseen käytettävän näkymän painamalla "New task" -nappia jommankumman listan kohdalla.

Tehtävälistojen jakaminen käyttäjien kesken toteutetaan mikäli aikaa riittää.
