$('.owl-carousel').owlCarousel({
    loop:true,/*ATIVAR EFEITO DE LOOP*/
    margin:20,/*Margem entre as imagens*/
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{ /*Até 600px na tela exibe 3 itens do carrosel*/ 
            items:3
        },
        1000:{
            items:5
        }
    }
})