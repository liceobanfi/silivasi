<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>open day</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script async type="text/javascript" src="./js/main.js" ></script>
    <link rel="stylesheet" href="./css/styl.css" >
  </head>
  <body>
    <div id="form_scuola" class="fl div_testo1">
	<h2>Inserire i tuoi dati:</h2>
	<form id="registration-form">
	<div>
	<span style="color:red">(*)</span> Scuola:<br/><input name="scuola" />
	</div>
	<div>
	<span style="color:red">(*)</span> Citt�:<br/><input name="citta" />
	</div>
	<div>
	<span style="color:red">(*)</span> Docente<br/><input name="docente" />
	</div>
	<div>
	<span style="color:red">(*)</span> e-mail:<br/><input name="mail" />
	</div>
	<div>
	<span style="color:red">(*)</span> Recapito telefonico:<br/><input name="telefono" />
	</div>

<!--
        <div>
	<span style="color:red">(*)</span> Informazioni aggiuntive:<br/>
        <textarea name="info" rows="4" cols="50"> </textarea>
	</div>
-->
	<div><i><span style="color:red">(*)</span> = campi obbligatori</i></div>
	<div><br />
	</div>
	</form>
  <button name="registrati" id="registrati">registrati!</button>
</div>
  <div id="area-prenotazioni">
  <h1>le tue prenotazioni</h1>
  <div id="display-prenotazioni" ></div>
  </div>

  </body>
</html>


