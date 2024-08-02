<?php
class DB_Connect
{
   private const _servername = "localhost";
   private const _username = "root";
   private const _password = "";
   private const _databasename = "ltw_db_car";

   # Connect tới database
   public function connect()
   {
      try {
         $connection =
            new PDO(
               "mysql:host=" . self::_servername . ";dbname=" . self::_databasename,
               self::_username,
               self::_password
            );
         $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (Exception $exception) {
         die("Connection failed: " . $exception->getMessage());
      }
      return $connection;
   }

   # hàm tổng quát của (CREATE / UPDATE / DELETE)
   public function query($query, $params)
   {
      try {
         $connection = $this->connect();
         $statement = $connection->prepare($query);
         return $statement->execute($params);
      } catch (Exception $exception) {
         echo $exception->getMessage() . "<br/>";
         echo "line " . $exception->getLine();
      }
   }

   # lấy tất dữ liệu ra
   public function get($query, $params = null)
   {
      try {
         $connection = $this->connect();
         $statement = $connection->prepare($query);
         if ($params === null) {
            $statement->execute();
         } else {
            $statement->execute($params);
         }
         $data = $statement->fetchAll(PDO::FETCH_ASSOC);
         return $data;
      } catch (Exception $exception) {
         echo $exception->getMessage() . "<br/>";
         echo "line " . $exception->getLine();
         return null;
      }
   }

   # lấy 1 dữ liệu ra
   public function get_1($query, $params = null)
   {
      try {
         $connection = $this->connect();
         $statement = $connection->prepare($query);
         if ($params === null) {
            $statement->execute();
         } else {
            $statement->execute($params);
         }
         $data = $statement->fetch(PDO::FETCH_ASSOC);
         return $data;
      } catch (Exception $exception) {
         echo $exception->getMessage() . "<br/>";
         echo "line " . $exception->getLine();
         return null;
      }
   }
}
