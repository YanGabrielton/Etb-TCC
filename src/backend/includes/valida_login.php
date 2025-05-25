<?php
if(isset($_SESSION["nome"])){
	
	
	echo $_SESSION["nome"];
}else{
	
	echo "<script>
		alert('você não está logado!!!')
	</script>";
	echo "<script>
	location.href=('index.php')
	</script>";
}


?>