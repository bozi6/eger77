import pymysql.cursors


def connect():
    """
    Csatlakozás a db-hez
    """
    try:
        connection = pymysql.connect(
            host="ds718",
            port=3307,
            user="root",
            password="qwe",
            db="tanchaz19",
            charset='utf8mb4',
            cursorclass=pymysql.cursors.DictCursor
        )
        return connection
    except pymysql.err.OperationalError as e:
        print('Hú de hiba történt:\n{}, hibakód: {}'.format(e, e.args[0]))
        exit()


def ceglista(cegnev):
    """
    cegnev lekérdezése a kapcsolatból.
    :param cegnev: a lekérdezendő cég neve
    :return: ha létezik akkor a cégnevet adja vissza, ha nem akkor semmit.
    """
    con = connect()
    try:
        with con.cursor() as cursor:
            sql = "SELECT * FROM ceglista WHERE cegnev =%s"
            cursor.execute(sql, (cegnev,))
            result = cursor.fetchone()
            if cursor.rowcount > 0:
                print('-- Cég létezik. Sorszáma: {} Neve: {}'.format(result['sorsz'], result['cegnev']))
                return result
    finally:
        con.close()


def beszur(sql):
    con = connect()
    cursor = con.cursor()
    try:
        cursor.execute(sql)
        con.commit()
        return cursor.lastrowid
    except pymysql.err.DataError as e:
        con.rollback()
        print(e)
    finally:
        con.close()


if __name__ == "__main__":
    print('mysql kapcsolat létesítése a szerverrel, már ha van :-)')
