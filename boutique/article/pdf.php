<?php
	function fetch_data(){
		if(isset($_GET['id']) and !empty($_GET['id'])){
			$id_produit = $_GET['id'];
			$output = '';
			$con = mysqli_connect("localhost","root","","projet");
			$query = "SELECT * FROM produits WHERE id_produit='$id_produit'";
			$res = mysqli_query($con, $query);
			while($row = mysqli_fetch_array($res)){
				$output .= '				
					<table>
						<tr>
							<th></th>
							<td></td>
						</tr>
						
						<tr>
							<th>ID :</th>
							<td>'.$row["id_produit"].'</td>
						</tr>
						
						<tr>
							<th>Nom du produit :</th>
							<td>'.$row["nom_produit"].'</td>
						</tr>
						
						<tr>
							<th>Prix :</th>
							<td>'.$row["prix_produit"].' €</td>
						</tr>
						
						<tr>
							<th>Catégorie :</th>
							<td>'.$row["categorie_produit"].'</td>
						</tr>
						
						<tr>
							<th>Description :</th>
							<td>'.$row["description_produit"].'</td>
						</tr>
						
						<tr>
							<th>Note :</th>
							<td>'.$row["moyenne_note"].'</td>
						</tr>
						
						<tr>
							<th>Date ajout</th>
							<td>'.$row["date_ajout"].'</td>
						</tr>
					</table>
				';
			}
			return $output;
		}else echo "L'id n'a pas été récupérée";
	}

if(isset($_POST["create_pdf"])){
	include('tcpdf/tcpdf.php');
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, "UTF-8", false);
	$obj_pdf->setPrintHeader(false);
	$obj_pdf->setPrintFooter(false);
	$obj_pdf->AddPage();
	$obj_pdf->SetCreator(PDF_CREATOR);
	$obj_pdf->SetTitle("Fiche technique du produit");
	$obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
	$obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$obj_pdf->SetDefaultMonospacedFont('helvetica');
	
	$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
	$obj_pdf->setPrintHeader(false);
	$obj_pdf->setPrintFooter(false);
	$obj_pdf->SetAutoPageBreak(true, 10);
	$obj_pdf->SetFont('helvetica', '', 12);
	
	date_default_timezone_set('Europe/Paris');
	$date = date("d F, Y à H:i");
	
	$content = "<p align=\"right\">$date</p>";
	
	$content .= '<img width="100px" height="100px" src="../../lmc.png"><h3 align="center">Fiche technique du produit</h3>';
	$content .= '<table>'.fetch_data().'</table>';

	$obj_pdf->writeHTML($content);
	ob_end_clean();
	$obj_pdf->Output("Fiche_Produit.pdf", "I");
	
}
	
?>