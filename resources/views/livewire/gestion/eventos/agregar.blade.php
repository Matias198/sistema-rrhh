

<div class="container">
        <div id="agenda"></div>        
   

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#evento">
    Launch
    </button>

    <div class="modal fade" id="evento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                
        <form action="">

    <div class="form-group">
        <label for="title">Titulo</label>
        <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Escribe el titulo del evento">
        <small id="helpId" class="form-text text-muted">Help text</small>
    </div> 
    
    <div class="form-group">
        <label for="descripcion">Descripcion</label>
        <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
    </div>

    <div class="form-group">
    <label for="start">start</label>
    <input type="text" class="form-control" name="start" id="start" aria-describedby="helpId" placeholder="">
    <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    <div class="form-group">
    <label for="end">end</label>
    <input type="text" class="form-control" name="end" id="end" aria-describedby="helpId" placeholder="">
    <small id="helpId" class="form-text text-muted">Help text</small>
    </div>

    </form>

    </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save</button>
        </div>
            </div>
        </div>
    </div>


</div>
<script> 
    document.addEventListener('DOMContentLoaded', function() {
     var calendarEl = document.getElementById('agenda');
     var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'es',
      headerToolbar:{
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,listWeek'
      },

     dateClick:function(info){
        $("#evento").modal("show");
     }

    });
    calendar.render();
  });
 
</script>