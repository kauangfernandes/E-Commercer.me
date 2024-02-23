//function modalAlert(){
  //alert("Admin: admin@ecommercer.com.br \nSenha: senha1234");

  /*
  var bady = document.getElementById("web-site");
  console.log(bady);

  div_modal = document.createElement("div");

  div_modal.setAttribute("id", "div_modal");
  div_modal.setAttribute("class", "w-100 vh-100 z-3 fixed-top");

  div_conatiner = document.createElement("div");
  div_conatiner.setAttribute("class", "container");

  btn = document.createElement("button");
  btn.setAttribute("type", "button");
  btn.setAttribute("value", "Fechar");
  btn.setAttribute("class", "btn btn-secondary");

  btn_txt = document.createTextNode("OLA");
  btn.appendChild(btn_txt);

  div_conatiner.appendChild(btn);
  div_modal.appendChild(div_conatiner);
  //bady.appendChild(div_modal);
  */
//}



function PaginacaoProdutos(elementos) {
  var elemento = elementos;
  var elementoAtivo = document.getElementsByClassName("active");
  var elementoPageLink = document.getElementsByClassName("page-link");
  console.log(elementos);
  console.log(elementoAtivo);
  console.log(elementoPageLink);

}

function screenSize() {
    let dadosTelaWidth = window.innerWidth;
    let dadosTelaheight = window.innerHeight;

    //console.log(`LAGURA: ${dadosTelaWidth}\nALTURA: ${dadosTelaheight}`);

    //Breakpoint
    if(dadosTelaWidth>0 && dadosTelaWidth <= 576){
      //console.log("4 - Colunas");
      //console.log(document.getElementById("cont-header"));

    }else if(dadosTelaWidth>576 &&  dadosTelaWidth < 720){
      //console.log("4 - Colunas");

    }else if(dadosTelaWidth>720 &&  dadosTelaWidth < 768){
      //console.log("6 - Colunas");

    }else if(dadosTelaWidth>768 &&  dadosTelaWidth < 992){
      //console.log("8 - Colunas");

    }else if(dadosTelaWidth>992 &&  dadosTelaWidth < 1200){
      //console.log("8 - Colunas");

    }else if(dadosTelaWidth => 1200){
      //console.log("12 - Colunas");

    }else{
      //console.error("Um erro ocorreu!")
    }
}



//Breakpoint
//@media (min-width: 0px) and (max-width: 576px){}
//@media (min-width: 576px){}
//@media (min-width: 720px){}
//@media (min-width: 768px){}
//@media (min-width: 992px){}
//@media (min-width: 1200px){}


/*
//import screenSize from "./screen/screen-size.js";
function screenSize() {
    let dadosTelaWidth = window.innerWidth;
    let dadosTelaheight = window.innerHeight;

    //console.log(`LAGURA: ${dadosTelaWidth}\nALTURA: ${dadosTelaheight}`);
    removerItemGrig();
}

const myDiv = document.getElementById("cont");

// Obtém a distância do elemento ao topo do seu pai
const topPos = myDiv.offsetTop;

// Imprime a distância
console.log(topPos);

function removerItemGrig() {
    
}
*/
/*
const cookingClient = new Request("https://cooking.googleapis.com/v1/cookingClients", {
  method: "GET",
});

const response = await fetch(cookingClient);

if (response.ok) {
  const cookingClientData = await response.json();
  const cookingClientId = cookingClientData.id;

  // Use o cooking cliente para fazer uma solicitação à API
  const recipes = new Request(`https://cooking.googleapis.com/v1/recipes?cookingClientId=${cookingClientId}`, {
    method: "GET",
  });

  const responseRecipes = await fetch(recipes);

  if (responseRecipes.ok) {
    const recipesData = await responseRecipes.json();
    console.log(recipesData);
  } else {
    console.log("Erro ao obter as receitas");
  }
} else {
  console.log("Erro ao obter o cooking cliente");
}


const xhr = new XMLHttpRequest();
xhr.open("GET", "https://cooking.googleapis.com/v1/cookingClients");
xhr.send();

if (xhr.status === 200) {
  const cookingClientData = JSON.parse(xhr.responseText);
  console.log(cookingClientData);
} else {
  console.log("Erro ao obter o cooking cliente");
}
*/

