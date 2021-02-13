<?php

include_once "mpdf61/mpdf.php";

$border = "border-collapse: collapse; border: 1px solid black;";

define("REMETENTE", "REMETENTE");
define("DESTINATÁRIO", "DESTINATÁRIO");

$mpdf = new mPDF("", "A4", "", "", "5", "5", "12", "12");
$remetente = $_POST["remetente"];

$remetente["tipo"] = REMETENTE;
$remetente['endereco'] = $remetente['endereco'].', '.$remetente['numero'].' - '.$remetente['complemento'];
$remetente = informacaoPessoal($remetente, $border);

$destinatario = $_POST["destinatario"];
$destinatario['endereco'] = $destinatario['endereco'].', '.$destinatario['numero'].' - '.$destinatario['complemento'];
$destinatario["tipo"]     = DESTINATÁRIO;
$destinatario = informacaoPessoal($destinatario, $border);

$item = [
	"descricao" => $_POST['item'],
	"quantidade" => $_POST['quantidade'],
	"valor_unitario" => $_POST['valor_unitario'],
	"valor_total" => $_POST['valor_total'],
];

$body = cabecalho("", $border);
$body .= tableRemetenteDestinatario($remetente, $destinatario);
$body .= tableConteudo($item, $border);
$body .= tableDeclaracao($border);
$body .= tableObservacao($border);

$mpdf->setAutoTopMargin = 'stretch';
$mpdf->shrink_tables_to_fit = 1;
$mpdf->SetTitle("DECLARAÇÃO DE CONTEÚDO");
$mpdf->SetDisplayMode('fullpage');
$mpdf->AddPage('P');

// $body = utf8_encode($body);
$mpdf->WriteHTML($body);

$nome_arquivo = "declaracao_conteudo.pdf";
$mpdf->Output($nome_arquivo, "I");

function cabecalho($etiqueta, $style){
	$table = '<table id="table_cabecalho" style="'.$style.' width: 100%;">';
	$table .= '<thead style="">';
	$table .= '<tr>';
	$table .= '<th style="'.$style.' width: 100%;">DECLARAÇÃO DE CONTEÚDO</th>';
	$table .= '</tr>';
	$table .= '</thead>';
	$table .= '</table>';
	return $table;
}

function informacaoPessoal($dados, $style){
	$table = '<table id="table_'.$dados["tipo"].'" style="'.$style.' width: 100%;">';
	$table .= '<thead>';
	$table .= '<tr>';
	$table .= '<th colspan="2" style="'.$style.' text-align: center;">'.$dados["tipo"].'</th>';
	$table .= '</tr>';
	$table .= '<tr>';
	$table .= '<th colspan="2" style="'.$style.' text-align: left;">NOME: '.$dados["nome"].'</th>';
	$table .= '</tr>';
	$table .= '<tr>';
	$table .= '<th colspan="2" style="'.$style.' text-align: left;">ENDEREÇO: '.$dados["endereco"].'</th>';
	$table .= '</tr>';
	$table .= '<tr>';
	$table .= '<th style="'.$style.' text-align: left; width: 90%;">CIDADE: '.$dados["cidade"].'</th>';
	$table .= '<th style="'.$style.' text-align: left; width: 10%;">UF: '.$dados["estado"].'</th>';
	$table .= '</tr>';
	$table .= '<tr>';
	$table .= '<th style="'.$style.' text-align: left; width: 40%;">CEP: '.$dados["cep"].'</th>';
	$table .= '<th style="'.$style.' text-align: left; width: 60%;">CPF/CNPJ: '.$dados["cpf"].'</th>';
	$table .= '</tr>';
	$table .= '</thead>';
	$table .= '</table>';
	return $table;
}

function tableRemetenteDestinatario($remetente, $destinatario){
	$table = '<table id="table_segunda" style="width: 100%; margin-left: -0.2%; margin-top: 0.2%; padding: 0px;">';
	$table .= '<thead>';
	$table .= '<tr>';
	$table .= '<th style="margin-right: 2%; padding-left: 0%;">'.$remetente.'</th>';
	$table .= '<th style="padding-right: -0.1%;">'.$destinatario.'</th>';
	$table .= '</tr>';
	$table .= '</thead>';
	$table .= '</table>';
	return $table;
}

function tableConteudo($item, $style){
	$table = '<table id="table_conteudo" style="'.$style.' width: 100%; margin-top: 0.2%;">';
	$table .= '<thead>';
	$table .= '<tr>';
	$table .= '<th colspan="4" style="text-align: center;">IDENTIFICAÇÃO DOS BENS</th>';
	$table .= '</tr>';
	$table .= '<tr>';
	$table .= '<th colspan="1" style="'.$style.' text-align: center; width: 9%;">ITEM</th>';
	$table .= '<th colspan="1" style="'.$style.' text-align: center; width: 60%;">CONTEÚDO</th>';
	$table .= '<th colspan="1" style="'.$style.' text-align: center; width: 15%;">QUANT.</th>';
	$table .= '<th colspan="1" style="'.$style.' text-align: center; width: 15%;">VALOR</th>';
	$table .= '</tr>';
	$table .= '</thead>';

	$table       .= '<tbody>';
	$i           = 1;
	$total_qtde  = 0;
	$total_preco = 0;

	// foreach ($dados_item as $key => $dados) {
		$table .= '<tr>';
		$table .= '<td style=" text-align: center;'.$style.'">'.$i.'</td>';
		$table .= '<td style=" text-align: center;'.$style.'">'.$item['descricao'].'</td>';
		$table .= '<td style=" text-align: center;'.$style.'">'.$item['quantidade'].'</td>';
		$table .= '<td style=" text-align: center;'.$style.'">R$ '.number_format($item['valor_total'], 2, ',','.').'</td>';
		$table .= '</tr>';
		$i++;

		$total_qtde  += $item['quantidade'];
		$total_preco += $item['valor_total'];
	// }

	$table .= '</tbody>';

	$table .= '<tr>';
	$table .= '<td colspan="2" style="text-align: right;'.$style.' background-color: #CDC9C9;"><b>TOTAL </b></td>';
	$table .= '<td style="text-align: center;'.$style.'">'.$total_qtde.'</td>';
	$table .= '<td style="text-align: center;'.$style.'">R$ '.number_format($total_preco, 2, ',','.').'</td>';
	$table .= '</tr>';

	$table .= '<tr>';
	// $table .= '<td colspan="2" style="text-align: right;'.$style.' background-color: #CDC9C9;"><b>PESO TOTAL (kg) </b></td>';
	// $table .= '<td colspan="2" style="text-align: center;'.$style.'">'.number_format($dados_item[0]["peso"], 3, ',','.').'</td>';
	$table .= '</tr>';
	$table .= '</tbody>';

	$table .= '</table>';
	return $table;
}


function tableDeclaracao($style){
	$declaracao = '<div style="'.$style.' text-align: center; margin-top: 1%;">DECLARAÇÃO</div>';
	$declaracao .= '<div style="'.$style.' padding-left: 1%">';
	$declaracao .= '<div style="text-indent: 10%; text-align: justify;">';
	$declaracao .= '<p style="padding-right: 1%; ">Declaro que não me enquadro no conceito de contribuinte previsto no art. 4ª da Lei Complementar nº 87/1996, 
		uma vez que não realizo, com habitualidade ou em volume que caracterize intuito comercial, operações de circulação de mercadoria, ainda que se iniciem
		 no exterior, ou estou dispensado da emissão da nota fiscal por força da legislação tributária vigente, responsabilizando-me, nos termos da lei e a 
		 quem de direito, por informações inverídicas.</p>';
	$declaracao .= '<p style="padding-bottom: 1%; padding-right: 1%; ">Declaro ainda que não estou postando conteúdo inflamável, explosivo, causador de combustão
	 espontánea, tôxico, corrosivo, gás ou qualquer outro conteúdo que constitua perigo, conforme o art. 13 da Lei Postal nº 6.538/78.</p>';
	$declaracao .= '</div>';
	$declaracao .= '<div>_Marília_, ______ de ______________________ de __'.date("Y").'__  ________________________________________________________</div>';
	$declaracao .= '<div style="text-align: right; font-size: 70%; padding-right: 8%">Assinatura do Declarante/Remetente</div>';
	$declaracao .= '</div>';
	return $declaracao;
}

function tableObservacao($style){
	$table = '<table id="table_declaracao" style="'.$style.' width: 100%; margin-top: 0.5%;">';
	$table .= '<thead>';
	$table .= '<tr>';
	$table .= '<th style="text-align: left; padding-left: 1%; padding-top: 1%;"><b>OBSERVAÇÃO:</b></th>';
	$table .= '</tr>';
	$table .= '</thead>';
	$table .= '<tbody>';
	$table .= '<tr>';
	$table .= '<td style="text-align: left; padding: 1%; padding-bottom: 1%; padding-right: 1%;">Constitui crime contra a ordem tributária suprimir ou reduzir tributo,
	 ou contribuição social e qualquer acessório (Lei 8.137/90 Art. 1º, V).</td>';
	$table .= '</tr>';
	$table .= '</tbody>';
	$table .= '</table>';

	return $table;
}
?>