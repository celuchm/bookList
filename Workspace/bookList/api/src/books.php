<?php
require_once __DIR__.'/../../config/init.php';

$allBooks = Book::loadAllBooks();
$allBooksString= "[";
for ($i=0; $i< count($allBooks); $i++){
    $allBooksString .= json_encode($allBooks[$i]);
    if($i < count($allBooks) -1){
        $allBooksString .= ",";
    }
}
$allBooksString .= "]";
print_r($allBooksString);