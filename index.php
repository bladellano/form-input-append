<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

	<style>
		body,html{
			margin-top: 10px;
			padding: 0;
			
		}
	</style>
</head>
<body>

	<?php 

	// $('.remove_details_desp').parents('div')

	if(!empty($_POST['input_desc_despesa_1'])){

		$newRequest = [];
		$aDespesas = [];
		$gFilesDivided = [];

		foreach ($_REQUEST as $key => $value) 
		{			
			if( ( strlen($key) == 21 || strlen($key) == 20 ) && is_string($key) ){
			$newRequest[] = $value;		
		    }

		}
	 
		$aDivided = array_chunk($newRequest, 2);		

		for ($i=0; $i < count($_FILES['input_file_despesa']['name']); $i++) { 

			$gFilesDivided[] = [
				"name"=>$_FILES['input_file_despesa']['name'][$i],
				"type"=>$_FILES['input_file_despesa']['type'][$i],
				"tmp_name"=>$_FILES['input_file_despesa']['tmp_name'][$i],
				"error"=>$_FILES['input_file_despesa']['error'][$i],
				"size"=>$_FILES['input_file_despesa']['size'][$i]
			];			
		}

		foreach ($gFilesDivided as $aFile) 
		{
			$aDespesas[] = $aFile; 	 	 
		}

		$i = 0;
		$resultGeneral = [];
		foreach ($aDespesas as $despesa) 
		{
			$despesa['cd_doc'] = $aDivided[$i][1];
			$despesa['desc_desp'] = $aDivided[$i][0];
			$resultGeneral[] = $despesa;
			$i++;
		}
		echo "<pre>";
		// print_r($resultGeneral);	


		//etapa1
		//insereAnexos()

		if(is_array($resultGeneral) && count($resultGeneral) > 0 )
		{
			foreach ($resultGeneral as $desp) {

				echo($desp['name'])." <b>GRAVADO!</b><br>";
			// retornado ultimo insert
			// singleton();

		//etapa2
	    //pegar: ultimo id | desc_desp | cd_doc(array) 
				if(is_array( $desp['cd_doc'] )){
				// insereDocs()
					print_r( $desp['cd_doc'] );
					echo $desp['desc_desp'];
					echo "<br>Gravado...<hr>";
				// singleton();	

				}


			}
		} //Fim - if




	}

	?>

		<div class="teste-div">
	<div class="container">




		<p><a class="btn-sm btn-warning" href="./">Principal</a></p>
		<form action="#" enctype="multipart/form-data" method="POST">

			<input type="hidden" name="categoria" value='as6dtoas7'>
			<input type="hidden" name="especie" value='983y4k2j3'>

			<div class="input_fields_wrap">
				<!--copiar-->
				<table class="table table-bordered">
					<thead class="bg-light">
						<tr>
							<th align="left">
								<div class="row">									
									<!-- <div class="col-md-1 text-center">ITEM</div>	 -->
									<div class="col-md-4"><input required type="text" class="form-control form-control-sm" placeholder="Descrição da despesa" aria-describedby="sizing-addon3" name="input_desc_despesa_1"></div>	
									<div class="col-md-8 text-right">
										<a class="add_detail_desp btn-sm btn-success text-white"><i class="fa fa-plus" aria-hidden="true"></i></a>
									</div>
								</div>						

							</th>      
							<th>SIM</th>      
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Cheque (somente nominal) - Um cheque para cada despesa - ou comprovante de transferência bancária - APÓS O RECIBO.</td>      
							<td><input type="checkbox" name="input_check_despesa_1[]" value=250></td>      
						</tr><tr>
							<td>Pesquisas de preços (no mínimo três) - devem conter todas as características dos bens/ou serviços pretendidos - após a consolidação das pesquisas de preços.</td>      
							<td><input type="checkbox" name="input_check_despesa_1[]" value=455></td>      
						</tr><tr>
							<td>Nota fiscal (somente eletrônica e com ATESTO (verso)). Obs. Identificação de "Pago com recursos do PDDE/Ações", nas notas fiscais; Obs. Comprovantes de pagamentos de impostos em serviços de pessoa física(ISS,INSS e IR).</td>      
							<td><input type="checkbox" name="input_check_despesa_1[]" value=54></td>      
						</tr><tr>teste-div
							<td>Planilha de consolidação das pesquisas de preços - após a cópia do cheque/transf.</td>      
							<td><input type="checkbox" name="input_check_despesa_1[]" value=510></td>      
						</tr><tr>
							<td>Recibos (acompanham respectivas nfs) - APÓS A NF.</td>      
							<td><input type="checkbox" name="input_check_despesa_1[]" value=262></td>      
						</tr>

					</tbody>
				</table>
				<div class="row">
					<div class="col-md-6">
						<div class="custom-file mb-3">
							<input type="file" class="custom-file-input" name="input_file_despesa[]" required>
							<label class="custom-file-label" for="customFile">Anexar Comprovante</label>
						</div>		 
					</div>
					<div class="col-md-6"></div>
				</div>
				<!--copiar-->


			</div><!--input_fields_wrap-->
			<div class="row">
				<div class="col text-center">					
					<button class="btn btn-primary" type="submit">Enviar</button>	
				</div>		
			</div>

		</form>

	</div><!--container-->
</div>
	<script>
		$(document).ready(function() {

		  var max_fields = 10; //maximum input boxes allowed
		  var wrapper = $(".input_fields_wrap"); //Fields wrapper
		  var add_detail = $(".add_detail_desp"); //Add button ID

  var x = 1; //initlal text box count
  $(add_detail).click(function(e) { //on add input button click
  	e.preventDefault();

    if (x < max_fields) { //max input box allowed
      x++; //text box increment
      $(wrapper).append('<div><hr> <table class="table table-bordered"><thead class="bg-light"><tr><th align="left"> <div class="row"><div class="col-md-4"><input required type="text" class="form-control form-control-sm" placeholder="Descrição da despesa" aria-describedby="sizing-addon3" name="input_desc_despesa_1"></div><div class="col-md-8 text-right"><a href="#" class="remove_details_desp btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div></div></th> <th>SIM</th> </tr></thead><tbody><tr><td>Cheque (somente nominal) - Um cheque para cada despesa - ou comprovante de transferência bancária - APÓS O RECIBO.</td><td><input type="checkbox" name="input_check_despesa_1[]" value=250></td></tr><tr><td>Pesquisas de preços (no mínimo três) - devem conter todas as características dos bens/ou serviços pretendidos - após a consolidação das pesquisas de preços.</td><td><input type="checkbox" name="input_check_despesa_1[]" value=455></td></tr><tr><td>Nota fiscal (somente eletrônica e com ATESTO (verso)). Obs. Identificação de "Pago com recursos do PDDE/Ações", nas notas fiscais; Obs. Comprovantes de pagamentos de impostos em serviços de pessoa física(ISS,INSS e IR).</td><td><input type="checkbox" name="input_check_despesa_1[]" value=54></td></tr><tr><td>Planilha de consolidação das pesquisas de preços - após a cópia do cheque/transf.</td><td><input type="checkbox" name="input_check_despesa_1[]" value=510></td></tr><tr><td>Recibos (acompanham respectivas nfs) - APÓS A NF.</td><td><input type="checkbox" name="input_check_despesa_1[]" value=262></td></tr></tbody></table><div class="row"><div class="col-md-6"><div class="custom-file mb-3"><input type="file" class="custom-file-input" name="input_file_despesa[]" required><label class="custom-file-label" for="customFile">Anexar Comprovante</label></div></div><div class="col-md-6"></div></div>  </div>'); //add input box
  }
  replaceName();
});

  $(wrapper).on("click", ".remove_details_desp", function(e) { 
  	e.preventDefault();
  	$(this).parents('div:not(.row,.col-md-8.text-right,.input_fields_wrap,.container,.teste-div)').remove();
  	x--;  	
  	// replaceName();
  })

  function replaceName() {
  	wrapper.find("input:text").each(function() {
  		$(this).attr('name', "input_desc_despesa_" + (+$(this).index("input:text") + 1));
  	});
  	wrapper.find("input:file").each(function() {
  		// $(this).attr('name', "input_file_despesa_" + (+$(this).index("input:file") + 1+"[]"));
  		// $(this).attr('id', "input_file_despesa_" + (+$(this).index("input:file") + 1));
  	});
  	var i = wrapper.find("table").length;
  	wrapper.find("table:last").each(function() {
  		$(this).find("input:checkbox").attr('name', "input_check_despesa_" + i +"[]");
  	});
  }

  //jQuery do custum file.
  $(document).on('change', ':file', function() {
  	console.log($(this));
  	var fileName = $(this).val().split("\\").pop();
  	$(this).siblings(".custom-file-label").addClass("selected").html(fileName).css('color','#2980b9');
  });


});
</script>

</body>
</html>