CREATE TABLE Kierunek (
    IdKierunku integer(2)  NOT NULL AUTO_INCREMENT,
    LiczbaMiejsc integer(3)  NOT NULL,
    LiczbaRezerwowych integer(2)  NULL,
    Nazwa varchar(40)  NOT NULL,
	IdWydzialu integer(2)  NOT NULL,
    ProgPunktowy integer(3)  NULL,
	Opis varchar(2000)  NULL,
    CONSTRAINT Kierunek_pk PRIMARY KEY (IdKierunku)
) ;

-- Table: Kierunek_Przedmiot
CREATE TABLE Kierunek_Przedmiot (
	IdPrzedmiotu integer(3)  NOT NULL,
    IdKierunku integer(2)  NOT NULL,
    Waga float(4,2)  NOT NULL, -- 2.0, 1.5...
	CONSTRAINT Kierunek_Przedmiot_pk PRIMARY KEY (IdPrzedmiotu,IdKierunku)
) ;

-- Table: Matura
CREATE TABLE Matura (
    IdStudenta integer(8)  NOT NULL,
    Numer varchar(15)  NOT NULL,
    CONSTRAINT Matura_pk PRIMARY KEY (Numer)
) ;

-- Table: Matura_Przedmiot
CREATE TABLE Matura_Przedmiot (
	Numer varchar(15)  NOT NULL,
    IdPrzedmiotu integer(3)  NOT NULL,
    Wynik integer(3)  NOT NULL, -- %
   CONSTRAINT Matura_Przedmiot_pk PRIMARY KEY (Numer,IdPrzedmiotu)
) ;

-- Table: Pracownik
CREATE TABLE Pracownik (
	IdPracownika integer(3) NOT NULL AUTO_INCREMENT,
	Imie varchar(20)  NOT NULL,
    Nazwisko varchar(40)  NOT NULL,
	IdUprawnienia integer(2) NOT NULL,
    Haslo varchar(40)  NOT NULL,
    Email varchar(30)  NULL,
	IdWydzialu integer(2)  NOT NULL, -- 0 - brak wydzialu
    CONSTRAINT Pracownik_pk PRIMARY KEY (IdPracownika)
) ;

-- Table: Przedmiot
CREATE TABLE Przedmiot (
    IdPrzedmiotu integer(3)  NOT NULL AUTO_INCREMENT,
    Nazwa varchar(30)  NOT NULL,
    Rozszerzenie integer(1)  NOT NULL, -- booleanish (0 - podstawa, 1 - rozszerzenie)
    CONSTRAINT Przedmiot_pk PRIMARY KEY (IdPrzedmiotu)
) ;

-- Table: Przelew
CREATE TABLE Przelew (
    NrKonta varchar(20)  NOT NULL,
    Weryfikacja integer(1)  NOT NULL, -- booleanish (1 = y, 0 = n)
    IdStudenta integer(8)  NOT NULL,
    IdKierunku integer(2)  NOT NULL,
    IdKierunkuAlt integer(2)  NULL,
    CONSTRAINT Przelew_pk PRIMARY KEY (NrKonta)
) ;

-- Table: Rekrutacja
CREATE TABLE Rekrutacja (
    IdRekrutacji integer(8)  NOT NULL AUTO_INCREMENT,
    Status varchar(20)  NULL,
    IdPrzedmiotu integer(3)  NULL,
    IdStudenta integer(8)  NOT NULL,
    IdKierunku integer(2)  NOT NULL,
    IdKierunkuAlt integer(2) NULL,
    CONSTRAINT Rekrutacja_pk PRIMARY KEY (IdRekrutacji)
) ;

-- Table: Student
CREATE TABLE Student (
    IdStudenta integer(8)  NOT NULL AUTO_INCREMENT,
    Imie varchar(20)  NOT NULL,
    Nazwisko varchar(40)  NOT NULL,
	Plec char(1) NOT NULL,
    DataUrodzenia date NULL,
    Adres varchar(50) NULL,
    Pesel bigint(11)  NOT NULL,
    Haslo varchar(40)  NOT NULL,
    Zdjecie blob  NULL,
    Email varchar(40)  NOT NULL,
	nrTelefonu integer(9) NULL,
    CONSTRAINT Student_pk PRIMARY KEY (IdStudenta)
) ;

-- Table: Wydzial
CREATE TABLE Wydzial (
    IdWydzialu integer(2)  NOT NULL AUTO_INCREMENT,
    Nazwa varchar(60)  NOT NULL,
	NrKonta varchar(20)  NOT NULL,
	Zdjecie blob  NULL,
    CONSTRAINT Wydzial_pk PRIMARY KEY (IdWydzialu)
) ;

-- Table: Uprawnienie
CREATE TABLE Uprawnienie (
	IdUprawnienia integer(2)  NOT NULL,
    OpisUprawnienia varchar(40)  NOT NULL,
	CONSTRAINT Uprawnienie_pk PRIMARY KEY (IdUprawnienia)
) ;

-- foreign keys
-- Reference: Kierunek_Przedmiot_Kierunek (table: Kierunek_Przedmiot)
ALTER TABLE Kierunek_Przedmiot ADD CONSTRAINT Kierunek_Przedmiot_Kierunek
    FOREIGN KEY (IdKierunku)
    REFERENCES Kierunek (IdKierunku) ON DELETE CASCADE;

-- Reference: Kierunek_Przedmiot_Przedmiot (table: Kierunek_Przedmiot)
ALTER TABLE Kierunek_Przedmiot ADD CONSTRAINT Kierunek_Przedmiot_Przedmiot
    FOREIGN KEY (IdPrzedmiotu)
    REFERENCES Przedmiot (IdPrzedmiotu) ON DELETE CASCADE;

-- Reference: Matura_Przedmiot_Matura (table: Matura_Przedmiot)
ALTER TABLE Matura_Przedmiot ADD CONSTRAINT Matura_Przedmiot_Matura
    FOREIGN KEY (Numer)
    REFERENCES Matura (Numer) ON DELETE CASCADE;

-- Reference: Matura_Przedmiot_Przedmiot (table: Matura_Przedmiot)
ALTER TABLE Matura_Przedmiot ADD CONSTRAINT Matura_Przedmiot_Przedmiot
    FOREIGN KEY (IdPrzedmiotu)
    REFERENCES Przedmiot (IdPrzedmiotu) ON DELETE CASCADE;

-- Reference: Pracownik_Wydzial (table: Pracownik)
ALTER TABLE Pracownik ADD CONSTRAINT Pracownik_Wydzial
    FOREIGN KEY (IdWydzialu)
    REFERENCES Wydzial (IdWydzialu) ON DELETE CASCADE;
	
-- Reference: Pracownik_Wydzial (table: Pracownik)
ALTER TABLE Pracownik ADD CONSTRAINT Pracownik_Uprawnienie
    FOREIGN KEY (IdUprawnienia)
    REFERENCES Uprawnienie (IdUprawnienia) ON DELETE CASCADE;

-- Reference: Przelew_Kierunek (table: Przelew)
ALTER TABLE Przelew ADD CONSTRAINT Przelew_Kierunek
    FOREIGN KEY (IdKierunku)
    REFERENCES Kierunek (IdKierunku) ON DELETE CASCADE;
	
-- Reference: Przelew_KierunekAlt (table: Przelew)
ALTER TABLE Przelew ADD CONSTRAINT Przelew_KierunekAlt
    FOREIGN KEY (IdKierunkuAlt)
    REFERENCES Kierunek (IdKierunku) ON DELETE CASCADE;

-- Reference: Przelew_Student (table: Przelew)
ALTER TABLE Przelew ADD CONSTRAINT Przelew_Student
    FOREIGN KEY (IdStudenta)
    REFERENCES Student (IdStudenta) ON DELETE CASCADE;

-- Reference: Rekrutacja_Przedmiot (table: Rekrutacja)
ALTER TABLE Rekrutacja ADD CONSTRAINT Rekrutacja_Przedmiot
    FOREIGN KEY (IdPrzedmiotu)
    REFERENCES Przedmiot (IdPrzedmiotu) ON DELETE CASCADE;

-- Reference: Rekrutacja_Kierunek (table: Rekrutacja)
ALTER TABLE Rekrutacja ADD CONSTRAINT Rekrutacja_Kierunek
    FOREIGN KEY (IdKierunku)
    REFERENCES Kierunek (IdKierunku) ON DELETE CASCADE;

-- Reference: Rekrutacja_KierunekAlt (table: Rekrutacja)
ALTER TABLE Rekrutacja ADD CONSTRAINT Rekrutacja_KierunekAlt
    FOREIGN KEY (IdKierunkuAlt)
    REFERENCES Kierunek (IdKierunku) ON DELETE CASCADE;	
	
-- Reference: Rekrutacja_Student (table: Rekrutacja)
ALTER TABLE Rekrutacja ADD CONSTRAINT Rekrutacja_Student
    FOREIGN KEY (IdStudenta)
    REFERENCES Student (IdStudenta) ON DELETE CASCADE;

-- Reference: Wydzial_Przelew (table: Wydzial)
ALTER TABLE Wydzial ADD CONSTRAINT Wydzial_Przelew
    FOREIGN KEY (NrKonta)
    REFERENCES Przelew (NrKonta) ON DELETE CASCADE;