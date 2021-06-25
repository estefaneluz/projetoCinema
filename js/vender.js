function sumirContainer(){
    const containerVenda = document.getElementById('realizar-vendas');
    const containerRelatorio = document.getElementById('relatorio-vendas');

    if(containerVenda.style.display==='none'){
        containerVenda.style.display='flex';
        containerRelatorio.style.display='none';
    } else {
        containerVenda.style.display='none';
        containerRelatorio.style.display='flex';
    }
}
