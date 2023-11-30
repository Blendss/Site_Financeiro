<?php
include 'conexao.php';
include 'vendor/autoload.php';

session_start();
$id = $_SESSION['id'];
$nome = $_SESSION['nome'];

$PDFContent = '';
if(isset($_POST['submit'])){
   if(!empty($_FILES["pdf"]["name"])){
      $PDFfileName = basename($_FILES["pdf"]["name"]);
      $PDFfileType = pathinfo($PDFfileName, PATHINFO_EXTENSION);
      $allowTypes = array('pdf');
      if(in_array($PDFfileType, $allowTypes)){
         include 'vendor/autoload.php';
         $parser = new \Smalot\PdfParser\Parser();

         // Source file
         $PDFfile = $_FILES["pdf"]["tmp_name"];
         $PDF = $parser->parseFile($PDFfile);
         $fileText = $PDF->getText();

         // line break
         $PDFContent = nl2br($fileText);
      }
      else
      {
         $PDFContent = '<p>only PDF file is allowed to upload.</p>';
      }
   }
   else
   {
      $PDFContent = '<p>Please select a file.</p>';
   }
}
// Display content
$textoExtrato = $PDFContent;

//$bancoatual = $_POST['procure'];
$bancoatual = 001;
// Separa o texto por quebras de linha
$linhas = explode("\n", $textoExtrato);

$insertsSQL = [];

foreach ($linhas as $linha) {
    // Verifica se a linha contém a palavra "saldo" (case-insensitive)
    if (stripos($linha, 'saldo') !== false) {
        continue; // Pula para a próxima linha se encontrar "saldo"
    }elseif (stripos($linha, 's a l d o') !== false){
        continue;
    }

    // Expressões regulares para capturar a data e o valor com débito/crédito
    preg_match('/(\d{2}\/\d{2}\/\d{4})/', $linha, $dataMatches);
    preg_match('/([\d,.]+) \(([+\-])\)/', $linha, $valorDebitoCreditoMatches);

    // Verifica se houve correspondência para os padrões de data e valor
    if (!empty($dataMatches) && !empty($valorDebitoCreditoMatches)) {
        $data = DateTime::createFromFormat('d/m/Y', $dataMatches[0]);
        $valor = str_replace('.', '', $valorDebitoCreditoMatches[1]);
        $valor = str_replace(',', '.', $valor);
        $debitoCredito = ($valorDebitoCreditoMatches[2] === '+') ? 'credito' : 'debito';
        
        // Captura o texto após o horário até o final da linha
        preg_match('/\d{2}\/\d{2} \d{2}:\d{2} (.+)/', $linha, $nomeMatches);
        $nome = (isset($nomeMatches[1])) ? $nomeMatches[1] : '';
        
        $idTransacao = 0;
        // Verifica se a linha contém 'pix' ou 'cartao' (case-insensitive)
        if (stripos($linha, 'pix') !== false) {
            $idTransacao = 3;
        } elseif (stripos($linha, 'cartão') !== false) {
            $idTransacao = 6;
        }

        // Monta a instrução SQL para inserção
        $insertsSQL[] = "INSERT INTO extrato (id, data, valor, debitoCredito, id_transacao, descricao, nome, cod_banco) VALUES ($id ,'" . $data->format('Y-m-d') . "', $valor, '$debitoCredito',$idTransacao, '' , '$nome', 001)";
    }
}

// Imprime as instruções SQL
foreach ($insertsSQL as $sql) {

    $sql_query = $mysqli->query($sql) or die("Falha na execução do código SQL: " . $mysqli->error);
    header("Location: extrato.php");
}
?>
