 
 <div class="container">
 <!-- Formulario de eventos-->
    <div>
    &nbsp;
    <form wire:submit.prevent="addEvent">
        <input type="text" wire:model="title" placeholder="Nombre del evento" required>
        <input type="date" wire:model="start" required>
        <input type="date" wire:model="end" required>
        <!--input type="datetime-local" wire:model="end" required-->
        <button type="submit">Agregar evento</button>
    </form>
    </div>
     
    <div id="agenda"></div>
</div>