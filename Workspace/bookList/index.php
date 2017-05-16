<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 10.05.17
 * Time: 19:52
 */

require_once(__DIR__."/config/init.php");

//var_dump( Book::loadAllBooks() );
//$newBook = new Book(1);
//$jsonData = json_encode($newBook);
//var_dump($jsonData);
//$sql = "select id, login from test where id=1 and mail='mama' order by id desc";

//$result = $db->pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);
//var_dump($result);


//$db->query("select","test", array( "columns" => array("id", "book"),
 //   "where" => array("id" => 2, "book" => "potop")), null);
//var_dump($db);
/*
$db->query("update","test", array( "set" => array("book" => "potop3") ,
    "where" => array("id" => 2)), null);
var_dump($db);

$db->query("insert", "test", array( "into" => array("all" => array(16, "harry potter"))), null);
var_dump($db);

$db->query("insert", "test", array( "into" => array( "id" => 7, "book" => "krzyzacy")), null);
var_dump($db);
*/
//$db->query("delete", "test", array("where" => array("id"=>7)), null);
//$db->query("insert", "test2", array( "into" => array( "title" => "krzyzacy", "author"=> "sienkiewicz", "year"=> 1898)), null);
//var_dump($db);
//$db->query("insert", "test2", array( "into" => array( "title" => "pan wolodyjowski", "author"=> "sienkiewicz", "year"=> 1901)), null);
//var_dump($db);
//$db->query("insert", "test", array( "into" => array( "id" =>1, "book" => "nowa")), null);
//$db->query("insert", "test", array( "into" => array( "id" =>2, "book" => "jakas")), null);
//$db->query("insert", "test", array( "into" => array( "id" =>3, "book" => "ksiazka")), null);

//$db->query("delete","test", array("where" => array(array("id", "<", 5))), null);
//var_dump($db);
//var_dump(array(array("id", "=", 5 ), array("id", ">", "test")));
/*
$db->query("select","users", array( "columns" => array("id", "login", "year", "adress"),
    "where" => array("id" => 1, "mail" => "'mail'"),"order" => array("id, adress" => "desc", "name" => "asc")), null);

$db->query("select","users", array( "columns" => array("id", "login"),
    null,"order" => array("id" => "desc")), null);


$db->query("update","users", array( "set" => array("id" => 5, "login"=>"nowy_login"),
    "where" => array("id" => 6)), null);

$db->query("insert","users", array( "into" => array("username" => 5, "login"=>"nowy_login")), null);

$db->query("insert","users", array( "into" => array("all" => array("id", "login", "password", "email")),
    ), null);


$db->query("delete","users", array("where" => array("id" => 6)), null);



        public function query($queryType, $table, $queryParam, $limit = null){

       $queryParam = array(
           "columns" => array("id", "login", ""),

           "where" => array(
               "id" => array(
                   ">" => "value")
               )
               "username" => array(
                   "=" => "value")
           ),
           "set" => array(
               "columnname" => "value"
           ),
           "into" => array(
               "columnName" => "value",
               "columnName2" => "value2",
           ),
           "into" => array(
                "all" => array("val1", "val2")
           ),
           "order" => array(
               "asc" => "columnName"
           )
       );

*/


?>


<html>
    <head>
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://unpkg.com/vue"></script>
        <script src="js/booksApi.js" type="text/javascript"></script>


    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <ul id="app">
                    <li v-for="book in allBooks">
                        tytuł: {{ book.title }}, autor: {{ book.author }}
                    </li>
                </ul>

            </div>
        </div>
    </div>


    </body>
</html>
