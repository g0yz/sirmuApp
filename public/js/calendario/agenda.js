

      document.addEventListener('DOMContentLoaded', function() {

        
        let formulario = document.querySelector("#formEvento");

        var calendarEl = document.getElementById('agenda');
        var calendar = new FullCalendar.Calendar(calendarEl, {

            initialView: 'dayGridMonth',

            locale: 'es',

            displayEventTime: false,

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listWeek',
            },

            //events: "http://127.0.0.1:8000/encargado/calendario/mostrar",
            eventSources:{
                url: baseURL+"/encargado/calendario/mostrar",
                method:"POST",
                extraParams:{
                    _token: formulario._token.value,
                }
            },



            dateClick: function(info) {
                formulario.reset();

                formulario.start.value = info.dateStr;
                formulario.end.value = info.dateStr;

                $("#evento").modal("show");


            },
            eventClick: function(info) {
                var evento = info.event;
                console.log(evento);

                
            axios.post(baseURL+"/encargado/calendario/editar-evento/"+info.event.id).
                then(
                (respuesta) =>{


                    formulario.id.value = respuesta.data.id;
                    formulario.title.value = respuesta.data.title;
                    formulario.descripcion.value = respuesta.data.descripcion;
                    formulario.start.value = respuesta.data.start;
                    formulario.end.value = respuesta.data.end;
                    
                    $("#evento").modal("show");

            }
            ).catch(
                error=>{
                    if(error.response){
                        console.log(error.response.data);

                }
                }
            )

            }
            
        });

        calendar.render();

        document.getElementById('btnGuardar').addEventListener("click", function() {
         
            enviarDatos("/encargado/calendario/agregar-evento");

        });
        document.getElementById('btnEliminar').addEventListener("click", function() {
            
            enviarDatos("/encargado/calendario/eliminar-evento/"+formulario.id.value);

        });
        document.getElementById('btnModificar').addEventListener("click", function() {
            
            enviarDatos("/encargado/calendario/actualizar-evento/"+formulario.id.value);

        });

        
            function enviarDatos(url){

                const datos = new FormData(formulario);

                const nuevaURL= baseURL + url ;


                axios.post(nuevaURL, datos, {
                 headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            
            .then(
                (respuesta) =>{
                    calendar.refetchEvents();
                    $("#evento").modal("hide");
            }
            ).catch(
                error=>{
                    if(error.response){
                        console.log(error.response.data);}
                }
            )
            }

      });

