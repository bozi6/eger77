#!/usr/bin/python3
from termcolor import colored as cd
import xlrd
import argparse
import os
import sys
import modulok.listagen as listagen
import modulok.tht_mysql as conn
import datetime

__author__ = 'Konta Boáz - kontab6@gmail.com - 2019'

if os.name == 'nt':
    import colorama

    colorama.init()

kezdosor = 7  # Honnan kezdjük olvasni a táblázatokat.
listaname = 'lista.txt'
most = datetime.datetime.now().strftime("%Y-%m-%d_%H:%M:%S")
print(most)

db_back_file = open('dbback.sql', 'w')
db_back_file.write('-- Készült: {}\n'.format(datetime.datetime.now()))
db_back_file.write('-- Készítette: kontab6@gmail.com\n')
sqlfile = open('sqlinsert.sql', 'w')
sqlfile.write('-- Készült: {}\n'.format(datetime.datetime.now()))
filenames = ''

parser = argparse.ArgumentParser(description="THT22 névsorok átalakítása SQl be.\r"
                                             " Csak xls kiterjesztésű fájlokkal működik.")
parser.add_argument('-f', '--filename', nargs='+', help='A visszakapott fájlok (THT_NEVSOR.xls)', type=str)
parser.add_argument('-l', '--list', nargs='+', help='Elemek beolvasása fileból (txt)', type=str)
parser.add_argument('-g', '--generate', help='Lista generálása', action='store_const', const='gen')
if len(sys.argv[1:]) == 0:  # Ha nincs semmi megadva akkor a helpet kiírjuk
    parser.print_help()
    parser.exit()
args = parser.parse_args()  # Feldolgozzuk az argumentumokat

if args.generate:  # ha -g vagy --generate a kapcsoló akkor megcsináljuk a lista.txt filet.
    print('{} generálása a mappában lévő xls fájlokból...'.format(cd(listaname, 'green')))
    a = listagen.ListaGen(listaname)
    a.gen()
    exit()
if args.filename:  # ha -f vagy --filename akkor azegy fájlt csináljuk meg.
    filenames = args.filename
if args.list:  # ha -l vagy --list akkor feldolgozzuk a lista.txt filet.
    file = open(args.list[0], 'rt')
    filenames = file.read().splitlines()
    file.close()

try:
    logfile = open(most + '.log', 'w')
    logfile.write('Készült: {}\n'.format(datetime.datetime.now()))
    logfile.write(__author__)
    logfile.write('\n')
    for file in filenames:  # Kezdődik a lényeg.
        print(file)  # a lista.txt megnyitása és nevének kiíratása
        book = xlrd.open_workbook(file, logfile)
        # a lista.txt-ben egy sor ami egy fájlnévre mutat, azt megnyitjuk mint xls.
        sheet = book.sheet_by_index(0)  # munkalap beállítása az elsőre
        maxsor: str = sheet.nrows  # a max sorok megállapítása
        maxcol: str = sheet.ncols  # a max oszlopok megállapítása.
        print('-- Beolvasott filenév: {} - Sorok száma: {} - Oszlopok száma: {}'
              .format(cd(file, 'green'), cd(maxsor, 'green'), cd(maxcol, 'green')))
        logfile.write('\nAktuális filenév: {}\n'.format(file))
        print('-- ', '-' * 72)  # sok szép - kiíratása.
        j = 1
        if sheet.cell_type(1, 2) == 1:  # megnézzük szöveg van e a társulat nevében 1 sor második oszlop.
            cegnev = sheet.cell_value(1, 2)
            sqlceg = conn.ceglista(cegnev)  # kapcsolat az SQL szerverrel és megkérdezzük a cegnevet, hogy van e már.
            azonosito: int = 0
            if sqlceg is None:  # ha nincs akkor beírjuk mint új cég.
                sql: str = 'INSERT IGNORE INTO ceglista (sorsz,cegnev)'
                sql += " VALUES (NULL, '{}');".format(cegnev)
                print('Új cégnév {}'.format(cd(cegnev, 'yellow')))  # logot írunk
                sqlfile.write(sql)  # sql filet írunk
                sqlfile.write('\n')
                azonosito = conn.beszur(sql)
                db_back_file.write(
                    'DELETE FROM ceglista WHERE sorsz = {};\n'.format(azonosito))  # a backuphoz írjuk a ceg sorszámot.
            else:
                azonosito = sqlceg['sorsz']
                # Cégnév beszúrása, ha még nincs a listában.
            for i in range(kezdosor, maxsor):  # végigszaladunk a táblázaton.
                '''
                    Változó mezők leírása:
                    c1 = sorszám
                    c2 = másolt cellatartaom
                    c3 = név
                    c4 = születési dátum excel date-ban
                    c5 = Besorolás
                    c6 = Programrész
                    c7 = megjegyzés
                '''
                c1, c2, c3, c4, c5, c6, c7 = sheet.row_values(i)  # betöltjük a táblázatból az oszlopokat.
                if c3 != '':
                    if sheet.cell_type(i, 3) == 3:  # ha a születési dátum ki van töltve akkor jó
                        y, m, d, h, perc, sec = xlrd.xldate_as_tuple(c4, book.datemode)
                    if sheet.cell_type(i, 3) != 3:  # ha nincs akkor ilyenkor született a pavaszt.
                        y, m, d, h, perc, sec = 1970, 1, 1, 0, 0, 0
                    sql: str = "INSERT INTO karszalagok " \
                               "(sorsz,cegnev,nev,szul_datum,besorolas,programresz," \
                               "megjegyzes,belepett,szdarab,gyszdarab)" \
                               " VALUES "
                    sql += "(NULL,{},'{}','{}-{}-{}','{}','{}','{}',0, 0, 0)".format(azonosito, c3, y, m, d, c5, c6, c7)
                    sqlfile.write(sql)
                    sqlfile.write('\n')
                    insert_id = conn.beszur(sql)
                    print('{}. Sor beszúrva a következő azonosítóval: {}'.format(j, insert_id))
                    db_back_file.write(
                        'DELETE FROM karszalagok WHERE sorsz = {};\n'.format(insert_id))  # backupba a beszúrt sor.
                    j += 1
            print()
            logfile.write('{}. Sor feldolgozva\n'.format(j - 1))
except OSError:  # hibakezelések
    print('Nem találom a file-t:', cd(file, 'red'))
    print('Érdemes újabb listát generálni a -g kapcsolóval...')
except TypeError as e:
    print('Típushiba:', e)
finally:
    logfile.close()  # logfile lezárva
    db_back_file.close()  # backup file bezárás
    sqlfile.close()  # sqlfile bezárás
