<?php

class Db
{
    private static PDO $connection;

    private static array $settings  = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false,
    );

        /**
     * vytvoří nové připojení k databázi
     * @param string $host URL adresa k databázi
     * @param string $user Uživatelské jméno pro přístup do databáze
     * @param string $passwd Heslo k databázi
     * @param string $database Název databáze
     */

    public static function connect(string $host, string $user, string $passwd, string $database) : void
    {
        if(!isset(self::$connection))
        {
            self::$connection = @new PDO(
                "mysql:host=$host;dbname=$database",
                $user,
                $passwd,
                self::$settings
            );
        }
    }

    /**
    *   Vrátí jeden řádek z databáze
    */

    public static function queryOne(string $query, array $param = Array()) : array|bool
    {
        $result=self::$connection->prepare($query);
        $result->execute($param);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function queryAll(string $query, array $param = Array()) : array|bool
    {
        $result=self::$connection->prepare($query);
        $result->execute($param);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Spustí dotaz a vrátí počet ovlivněných řádků
     * @param string $dotaz SQL dotaz s parametry nahrazenými otazníky
     * @param array $parametry Parametry pro doplnění do připraveného SQL dotazu
     * @return int Počet ovlivněných řádků
     */
	public static function query(string $dotaz, array $parametry = array()) : int
    {
		$navrat = self::$connection->prepare($dotaz);
		$navrat->execute($parametry);
		return $navrat->rowCount();
	}

    /**
     *   Vrátí 1. hodnotu v 1. řádku
     */

     public static function querySingle(string $query, array $param = array()) : string
     {
        $result = self::queryOne($query,$param);
        return $result[0];
     }

	/**
	 * Vloží do tabulky nový řádek jako data z asociativního pole
	 * @param string $tabulka Název databázové tabulky
	 * @param array $param Asociativní pole parametrů pro vložení
	 * @return bool TRUE v případě úspěšného provedení dotazu
	 */
	public static function insert(string $tabulka, array $param = array()) : bool
	{
		return self::query("INSERT INTO `$tabulka` (`".
		implode('`, `', array_keys($param)).
		"`) VALUES (".str_repeat('?,', sizeOf($param)-1)."?)",
			array_values($param));
	}

	/**
	 * Změní řádek v tabulce tak, aby obsahoval data z asociativního pole
	 * @param string $table Název databázové tabulky
	 * @param array $values Asociativní pole hodnot ke změně
	 * @param $condition Podmínka pro ovlivňované záznamy ("WHERE ...")
	 * @param array $param Asociativní pole dalších parametrů
	 * @return bool TRUE v případě úspěšného provedení dotazu
	 */

      public static function update(string $table, array $values = array(), string $condition, array $param = array()) :bool
      {
        return self::query("UPDATE `$table` SET `".
        implode('` = ?, `', array_keys($values)).
        "` = ? " . $condition,
        array_merge(array_values($values), $param));
      }

      /**
       * Vrátí poslední ID
       */

       public static function getLastId() : int
       {
        return self::$connection->lastInsertId();
       }

 
  
}