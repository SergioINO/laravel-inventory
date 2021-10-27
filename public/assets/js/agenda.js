    
    document.addEventListener('DOMContentLoaded', function() {

            let form = document.querySelector("form");

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {

            initialView: 'dayGridMonth',

            locale: "es",

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },

            dateClick:function(info){

                $("#event").modal("show");
            }

        });

        calendar.render();

        document.getElementById("btnGuardar").addEventListener("click",function(){

            const datos= new FormData(form);
            console.log(datos);
            console.log(form.title.value);

        });

    });