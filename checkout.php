<?php include 'includes/config.php';  include "includes/header.php"; ?>
<div class="spacer"></div>
<section class="container">
<h2 class="section-title1">Ya estás más cerca de vivir tu experiencia Bytal en Bogotá</h2>
</section>
<section class="container checkout flex">
    
    <form action="set/leads.php" method="POST" id="checkoutform">
        <h3>Déjanos tus datos para agendar tu valoración</h3>
        <fieldset>
            <label for="name">Tu Nombre</label>
            <p><input name="name" id="name" type="text" placeholder="Tu Nombre"/> </p>
            <label for="phone">Tu Teléfono</label>
            <p><input name="phone" id="phone" type="text" placeholder="Tu Teléfono"/> </p>
            <label for="email">Tu Correo electrónico</label>
            <p><input name="email" id="email" type="text" placeholder="Tu Correo electrónico"/> </p>
            <label for="country">País</label>
            <p><input name="country" id="country" type="text" placeholder="País"/> </p>
            <label for="date">¿En qué fecha planeas viajar a Bogotá, Colombia?</label>
            <p><input name="date" id="date" type="date" onfocus="this.showPicker()" placeholder="¿En qué fecha planeas viajar a Bogotá, Colombia?"/> </p>
            <p><input name="procedimientos" id="procedimientos" type="hidden"/> </p>
            <p><button class="button" type="submit" id="sendform">Agendar valoración y obtener un presupuesto</button></p>
        </fieldset>
    </form>
    <div class="card-list"><ul></ul></div>
</section>   
<section class="thanks">
<div class="card-list">
        <ul>
            <li class="flex">
                <img src="img/content/doctor.png"/>
                <div>
                    <h2 class="bold" style="margin-bottom:20px;">Nombre</h2>
                  
                    <a href="https://wa.link/ue3q6b" target="_BLANK" class="button whatsapp">Escribe por whatsapp</a>
                </div>
            </li>
        </ul>
    </div>
</section>      
<?php include "includes/footer.php"; ?>