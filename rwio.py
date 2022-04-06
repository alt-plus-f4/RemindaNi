import mysql.connector

class DataBase:
    def __init__(self, servername, username, password, dbname):
        self.servername = servername
        self.username = username
        self.password = password
        self.databasename = dbname

    def connect(self):
        self.db = mysql.connector.connect(host=f"{self.servername}", user=f"{self.username}", passwd=f"{self.password}",database=f"{self.databasename}")
        self.cursor = self.db.cursor()

    def select(self, usrid, table):
        self.connect()
        self.cursor.execute(f"SELECT `UserId` FROM `ass` WHERE `Date` = '20.05.2022';")
        result = self.cursor.fetchall()
        print(result)
        return result

    def delete(self, usrid, title, table):
        try:
            self.connect()
            self.cursor.execute(f"DELETE FROM `{table}` WHERE Userid = '{usrid}' AND Title = '{title}'")
            self.db.commit()
            return True
        except Exception:
            return False

    def insert(self, usrid, title, date, description, table):
        self.connect()
        self.cursor.execute(f"INSERT INTO `{table}` (`id`, `UserId`, `Title`, `Date`, `Description`) VALUES (NULL, '{usrid}', '{title}', '{date}', '{description}'); ")
        self.db.commit()


db = DataBase("localhost", "root", "", "tuesfest")


class User:
    def __init__(self, usrid, username, email):
        self.usrid = usrid
        self.username = username
        self.email = email

    def createTask(self, title, date, description):
        self.title = title
        self.date = date
        self.description = description
        return db.insert(self.usrid, self.title, self.date, self.description, "ass")


    def deleteTask(self, title):
        self.title = title
        return db.delete(self.usrid, self.title, "ass")



user1 = User(1, "me", "me@gmail.com")

print(db.select(0, "ass"))
# print(delete("0"))
# print(user1.createTask("Hello", "20.05.2022", "yea"))
# print(user1.deleteTask("Hello"))