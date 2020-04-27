<?php 

/* Nota - adicione itens manualmente ao 'contador.txt'
           um item por linha, neste formato;
           id||0
           ex. click-005||0
           ex. my-id||0
           ex. download-01||0
*/

$file = 'contador.txt'; // caminho para o arquivo de texto que armazena contagens
$fh = fopen($file, 'r+');
$id = $_REQUEST['id']; // publicado a partir da página
$lines = '';
while(!feof($fh)){
	$line = explode('||', fgets($fh));
	$item = trim($line[0]);
	$num = trim($line[1]);
	if(!empty($item)){
		if($item == $id){
			$num++; // contagem de incremento em 1
			echo $num;
			}
		$lines .= "$item||$num\r\n";
		}
	} 
file_put_contents($file, $lines);
fclose($fh);

?>	