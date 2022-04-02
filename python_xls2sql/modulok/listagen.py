import glob


class ListaGen(object):

    def __init__(self, filenev):
        self.filenev = str(filenev)

    def gen(self):
        dirz = './xlsek'
        fajl = open(self.filenev, 'w')
        for file in glob.glob(dirz + "/*.xls"):
            fajl.write(file)
            fajl.write('\n')
        fajl.close()
        print('kész.')


if __name__ == "__main__":
    print('listageneráló modul, ami létrehozza a lista.txt fájlt.')
