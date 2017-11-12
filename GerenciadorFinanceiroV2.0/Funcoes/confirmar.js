function excluir(id, pagina){
	if(confirm("Deseja mesmo excluir esse lançamento?")){
		window.location.replace("Funcoes/excluir.php?conf=1&id="+id+"&pagina="+pagina);
	}
}
function pagar(id, pagina){
	if(confirm("Deseja pagar esta despesa?")){
		window.location.replace("Funcoes/pagar.php?conf=1&id="+id+"&pagina="+pagina);
	}
}
function editar(id, pagina){
	window.location.href = "editar.php?conf=1&id="+id+"&pagina="+pagina;
}
function editarCategoria(id){
	window.location.href = "editarCategoria.php?conf=1&id="+id;
}
function excluirCategoria(id){
	if(confirm("Deseja mesmo excluir essa categoria?")){
		window.location.replace("Funcoes/excluirCategoria.php?conf=1&id="+id);
	}
}