function atualizarStatusDosRamais() {
  $.ajax({
      url: "http://localhost:3006/classes/RamaisStatus.php",
      type: "GET",
      success: function(data){                
          $('#cartoes').empty(); 

          for(let i in data){
              let statusClass = data[i].status === "" ? 'bg-custom-light-gray' : '';
              let iconClass = data[i].status === 'pausado' ? 'pausado' : (data[i].status === "" ? 'offiline' : data[i].status);

              $('#cartoes').append(`<div class="cartao mt-5 ${statusClass}">
                                      <div>${data[i].nome}</div>
                                      <span class="${iconClass} icone-posicao"></span>
                                    </div>`);
          }
      },
      error: function(){
          console.log("Erro!");
      }
  });
}

atualizarStatusDosRamais();
setInterval(atualizarStatusDosRamais, 10000); 
