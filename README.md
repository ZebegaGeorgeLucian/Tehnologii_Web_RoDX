# Tehnologii_Web_RoDX

### Cuprins

1. [Autori](#autori)
2. [Introducere](#introducere)
   1. [Scop](#scop)
   2. [Convenție de scriere](#convenție-de-scriere)
   3. [Publicul țintă](#publicul-țintă)
   4. [Scopul produsului](#scopul-produsului)
3. [Descriere Generală](#descriere-generală)
   1. [Perspectiva produsului](#perspectiva-produsului)
   2. [Funcțiile produsului](#funcțiile-produsului)
   3. [Mediul de operare](#mediul-de-operare)
   4. [Documentația pentru utilizator](#documentația-pentru-utilizator)
4. [Interfețele aplicației](#interfețele-aplicației)
   1. [Interfața utilizatorului](#interfața-utilizatorului)
      - [Bara de navigație](#bara-de-navigație)
      - [Pagina de înregistrare](#pagina-de-înregistrare)
      - [Pagina de acasă](#pagina-de-acasă)
      - [Pagina de cautare](#pagina-de-cautare)
      - [Pagina Despre](#pagina-Despre)
   2. [Interfața Hardware](#interfața-hardware)
   3. [Interfața Software](#interfața-software)
   4. [Interfața de comunicare](#interfața-de-comunicare)
5. [Caracteristici ale sistemului](#caracteristici-ale-sistemului)
   1. [Gestionarea contului](#gestionarea-contului)
      - [Descriere și generalități](#descriere-și-generalități)
      - [Actualizarea informațiilor](#actualizarea-informațiilor)
   2. [Secțiunea Utilizatori](#secțiunea-utilizatori)
      - [Descriere și generalități](#descriere-și-generalități-1)
      - [Actualizarea informațiilor](#actualizarea-informațiilor-1)


### Autori
  #### Anitei Eusebio
  #### Zebega George-Lucian
### 1.Introducere
#### 1.1 Scop
RoDX este un instrument Web de analiza si vizualizare la consumul de droguri in ultimii 3 ani, in corelatie cu infractiunile si confiscarile efectuate, plus urgentele medicale si campaniile de prevenire a consului de stupefiante.
#### 1.2 Convenție de scriere
Acest document urmează șablonul de documentație a cerințelor software conform IEEE Software Requirements Specification.
#### 1.3 Publicul țintă
### 1.3 Publicul țintă
Acest instrument este destinat cercetătorilor, analiștilor, personalului medical și altor profesioniști interesați de analiza și vizualizarea consumului de droguri în ultimii 3 ani, în contextul infracțiunilor și confiscărilor asociate, precum și în legătură cu situațiile de urgență medicală și campaniile de prevenire a consumului de stupefiante.
#### 1.4 Scopul produsului
Scopul aplicației "RoDX" este acela de a furniza utilizatorilor un instrument web pentru analiza și vizualizarea consumului de droguri în România în ultimii 3 ani. Acest instrument permite utilizatorilor să exploreze datele referitoare la consumul de droguri în contextul infracțiunilor și confiscărilor asociate, precum și în legătură cu situațiile de urgență medicală și campaniile de prevenire a consumului de stupefiante. 
#### Referințe

### 2.Descriere Generală
#### 2.1 Perspectiva produsului
RoDX (Romanian Drug Explorer) este o aplicație dezvoltată în cadrul cursului de Tehnologii Web pentru a oferi o perspectivă detaliată și interactivă asupra consumului de droguri în România în ultimii 3 ani. Proiectul RoDX este dezvoltat pentru a servi ca un instrument util
#### 2.2 Funcțiile produsului
Fiecare utilizator va avea acces la urmatoarele funcționălități:
să se înregistreze pe site.
să se autentifice pe site.
să își reseteze parola in cazul in care a uitat-o.
să consulte pagină "Home" și noutățile disponibile
să acceseze pagina "Search" pentru a accesa diagramele statistice legate de consumul de droguri
să acceseze pagina "About" pentru a accesa scurtă descriere a paginii web
dacă este autentificat, să acceseze profilul
#### 2.3 Mediul de operare
Produsul dezvoltat poate fi utilizat pe orice dispozitiv cu un browser web care suportă HTML5, CSS și JavaScript.
#### 2.4 Documentația pentru utilizator
Utilizatorii pot consulta acest document pentru explicații detaliate despre funcționalitățile aplicației web.
### 3.Interfețele aplicației
#### 3.1 Interfața utilizatorului
Mai jos, puteți vedea o prezentare generală a fiecărei pagini a aplicației și funcționalităților pe care le oferă:
##### -Bara de navigație
 Aceasta reprezintă meniul de navigare către fiecare pagina a aplicației
##### -Pagina de inregistrare
 Pagina de înregistrare (registration.html) este parte a aplicației "RoDX" și oferă utilizatorilor posibilitatea de a crea un cont nou în sistem. Interfața este simplă și intuitivă, concepută pentru a facilita procesul de înregistrare. Pagina conține două secțiuni principale: o secțiune pentru logare și o secțiune pentru înregistrare.

În secțiunea de logare, utilizatorii pot introduce username-ul și parola pentru a accesa contul lor existent, iar opțiunea "Remember me" permite reținerea datelor de autentificare pentru acces rapid ulterior.

În secțiunea de înregistrare, utilizatorii trebuie să completeze un formular cu informațiile necesare pentru crearea unui cont nou. Formularul solicită nume, prenume, username, email și parolă, precum și confirmarea parolei. După completarea și trimiterea formularului, utilizatorii vor fi înregistrați în sistem și vor putea accesa toate funcționalitățile oferite de aplicația "RoDX".
##### Pagina acasa
##### Pagina de cautare
În partea centrală a paginii, utilizatorii sunt întâmpinați cu un titlu sugestiv, care îi îndeamnă să selecteze filtrele dorite și să apeleze funcția de căutare pentru a genera harta cu datele relevante.

Interfața de căutare este completată de două dropdown-uri (listele derulante) care permit utilizatorilor să selecteze anul și tipul de date pe care doresc să le vizualizeze. Anul poate fi ales din opțiunile disponibile, iar tipurile de date includ infracțiuni, capturi de droguri, urgențe medicale și campanii de prevenire a consumului de stupefiante.

După ce utilizatorii selectează filtrele dorite, ei pot apăsa butonul "Search" pentru a iniția căutarea și a genera harta cu datele relevante.
##### Pagina Despre
#### 3.2 Interfata Hardware
Acest produs nu necesită interfețe hardware specifice și poate fi utilizat pe orice platformă, cum ar fi calculatoare, laptopuri, telefoane mobile etc., care are instalat un browser web.
#### 3.3 Interfata Software
Cerințele minime de software includ un browser funcțional, compatibil cu HTML5 și cu PHP.

#### 3.4 Interfata de comunicare 
Aplicația necesită o conexiune la internet. Standardul de comunicare care va fi utilizat este HTTP.

### 4.Caracteristici ale sistemului 
#### 4.1 Gestionarea contului
##### 4.1.1 Descriere și generalități
Utilizatorii pot crea un cont alegând un nume de utilizator, o adresă de email, o parolă, precum și numele și prenumele. Pentru autentificare, sunt necesare doar numele de utilizator și parola.

##### 4.1.2 Actualizarea informațiilor
Când un utilizator nou este creat, detaliile acestuia sunt stocate în baza de date. Atunci când un utilizator decide să-și actualizeze informațiile, noile valori sunt actualizate în baza de date.

#### 4.2 Secțiunea de utilizatori
##### 4.2.1 Descriere și generalități
Secțiunea Utilizatori este dedicată administratorului și îi permite să vizualizeze o listă cu toți utilizatorii din baza de date. De asemenea, administratorul are posibilitatea să elimine utilizatori din baza de date, la cerere.

##### 4.2.2 Actualizarea informațiilor
Prin apăsarea butonului de ștergere asociat fiecărui utilizator, detaliile respective sunt eliminate din baza de date.
