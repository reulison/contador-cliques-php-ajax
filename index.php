<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />

<title>Contador de Clicks em PHP + AJAX sem Banco de dados</title>
<!-- http://blog.fofwebdesign.co.uk/23-click-counter-with-flat-file-storage-text-file-ajax-php -->

<style>
html, body { margin:0; padding:0; font:16px/1.75 Verdana, Arial, Helvetica, sans-serif }
.page-content { padding:1em; max-width:64em; margin:auto }

.click-count { color:green; font-weight:bold }
</style>

</head>
<body>

<div class="page-content">

<h2>Contador de Clicks em PHP + AJAX sem Banco de dados (salvaremos em um arquivo de texto)</h2>
<p>Registre e exiba cliques em qualquer elemento HTML. As contagens são salvas em um arquivo .txt com PHP, enquanto o AJAX exibe o número crescente em tempo real. Nenhuma atualização de página é necessária!</p>
<p>Necessário PHP5. Funciona em navegadores modernos e no IE8 +</p>
<br/>


<?php 

$clickcount = explode("\n", file_get_contents('contador.txt'));
foreach($clickcount as $line){
	$tmp = explode('||', $line);
	$count[trim($tmp[0])] = trim($tmp[1]);
	}

?>

<button class="click-trigger" data-click-id="click-001">Clique aqui</button> 
Clicked <span id="click-001" class="click-count"><?php echo $count['click-001'];?></span> vezes.
<br/><br/>

<button class="click-trigger" data-click-id="click-002">Clique aqui</button> 
Clicked <span id="click-002" class="click-count"><?php echo $count['click-002'];?></span> vezes.
<br/><br/>

<button class="click-trigger" data-click-id="click-003">Clique aqui</button> 
Clicked <span id="click-003" class="click-count"><?php echo $count['click-003'];?></span> vezes.
<br/><br/>


<h2>Mais informações:</h2>
<p>Did you find this useful? There are more <a href="http://fofwebdesign.co.uk/freebies-for-websites/demos-and-snippets.php">demos and code snippets</a> this way.</p>
&nbsp;
</div>


<script>
var clicks = document.querySelectorAll('.click-trigger'); // IE8
for(var i = 0; i < clicks.length; i++){
	clicks[i].onclick = function(){
		var id = this.getAttribute('data-click-id');
		var post = 'id='+id; // post string
		var req = new XMLHttpRequest();
		req.open('POST', 'contador.php', true);
		req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		req.onreadystatechange = function(){
			if (req.readyState != 4 || req.status != 200) return; 
			document.getElementById(id).innerHTML = req.responseText;
			};
		req.send(post);
		}
	}
</script>

</body>
</html>