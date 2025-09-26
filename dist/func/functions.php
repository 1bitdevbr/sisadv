<?php
    if( !isset( $_SESSION ) ) session_start();
	$required_level = 1;
	require_once(__DIR__ . '/../../access/level.php');

    /**
     * SYSTEM FUNCTIONS
     */

	// ======================================================================================= //
	// TIMEZONE
	// ======================================================================================= //
	setlocale( LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese" );
	date_default_timezone_set("America/Sao_Paulo");

    // ======================================================================================= //
	// UCFIRST
	// ======================================================================================= //
    function safe_ucfirst($string, $encoding = 'UTF-8') {
        if (empty($string) || !is_string($string)) {
            return $string;
        }

        // Remove espaços em branco no início e fim
        $string = trim($string);

        // Verifica se a string está vazia após o trim
        if (empty($string)) {
            return $string;
        }

        // Verifica se a extensão mbstring está carregada
        if (!extension_loaded('mbstring')) {
            return ucfirst($string);
        }

        // Converte para minúsculas primeiro para garantir consistência
        $string = mb_strtolower($string, $encoding);

        // Capitaliza a primeira letra
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, null, $encoding);

        return mb_strtoupper($firstChar, $encoding) . $then;
    }

    // ======================================================================================= //
	// UCWORDS
	// ======================================================================================= //
    function safe_ucwords($string, $encoding = 'UTF-8') {
        if (empty($string) || !is_string($string)) {
            return $string;
        }

        // Remove espaços em branco no início e fim
        $string = trim($string);

        // Verifica se a string está vazia após o trim
        if (empty($string)) {
            return $string;
        }

        // Verifica se a extensão mbstring está carregada
        if (!extension_loaded('mbstring')) {
            return ucwords(strtolower($string));
        }

        // Converte toda a string para minúsculas primeiro para consistência
        $string = mb_strtolower($string, $encoding);

        // Divide a string em palavras
        $words = preg_split('/\s+/', $string);

        // Capitaliza a primeira letra de cada palavra
        $result = array();
        foreach ($words as $word) {
            if (!empty($word)) {
                $firstChar = mb_substr($word, 0, 1, $encoding);
                $rest = mb_substr($word, 1, null, $encoding);
                $result[] = mb_strtoupper($firstChar, $encoding) . $rest;
            }
        }

        return implode(' ', $result);
    }

    // ======================================================================================= //
	// GENERATE COLORS
	// ======================================================================================= //
    function colorItem($item) {
        // Array de cores disponíveis
        $colors = array(
            1 => "rgb( 112,128,144 )",
            2 => "rgb( 44, 158, 149 )",
            3 => "rgb( 100,149,237 )",
            4 => "rgb( 95,158,160 )",
            5 => "rgb( 0,139,139 )",
            6 => "rgb( 70,130,180 )",
            7 => "rgb( 255, 199, 240 )",
            8 => "rgb( 86, 239, 141 )",
            9 => "rgb( 72,61,139 )",
            10 => "rgb( 170, 211, 251 )",
            11 => "rgb( 135,206,235 )",
            12 => "rgb( 173,216,230 )",
            13 => "rgb( 65,105,225 )",
            14 => "rgb( 195, 255, 218 )",
            15 => "rgb( 252, 207, 73 )",
            16 => "rgb( 135,206,250 )",
            17 => "rgb( 72,209,204 )",
            18 => "rgb( 176,196,222 )",
            19 => "rgb( 242, 182, 38 )",
            20 => "rgb( 250, 193, 190 )",
            21 => "rgb( 255, 229, 192 )",
            22 => "rgb( 191, 153, 218 )",
            23 => "rgb( 30,144,255 )",
            24 => "rgb( 245, 193, 189 )",
            25 => "rgb( 246, 173, 167 )",
            26 => "rgb( 255, 149, 35 )"
        );

        // Array para armazenar as cores atribuídas a cada item
        static $colorItem = array();

        // Se o item já tiver uma cor atribuída, retorna essa cor
        if (isset($colorItem[$item])) {
            return $colorItem[$item];
        }

        // Contador para a próxima cor disponível
        static $next = 1;

        // Atribui a próxima cor disponível ao item
        $colorItem[$item] = $colors[$next];

        // Avança para a próxima cor disponível
        $next++;

        // Se passou da quantidade de cores disponíveis, começa novamente da primeira cor
        if ($next > count($colors)) {
            $next = 1;
        }

        // Retorna a cor atribuída ao item
        return $colorItem[$item];
    }

    //********************************************************************************
    //************* [ PASSAR VALOR NUMERICO PARA EXTENSO ] ************
    //********************************************************************************
    function extenso($valor = 0, $maiusculas = false) {

        $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
        $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões");

        $c = array("", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
        $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa");
        $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove");
        $u = array("", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");

        $z = 0;
        $rt = "";

        $valor = number_format($valor, 2, ".", ".");
        $inteiro = explode(".", $valor);
        for($i=0;$i<count($inteiro);$i++)
        for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
        $inteiro[$i] = "0".$inteiro[$i];

        $fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
        for ($i=0;$i<count($inteiro);$i++) {
            $valor = $inteiro[$i];
            $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
            $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
            $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

            $r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd &&
            $ru) ? " e " : "").$ru;
            $t = count($inteiro)-1-$i;
            $r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
            if ($valor == "000")$z++; elseif ($z > 0) $z--;
            if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
            if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
        }

        if(!$maiusculas){
            return($rt ? $rt : "zero");
        } else {

        if ($rt) $rt=preg_replace(" /E/ "," e ",ucwords($rt));
            return (($rt) ? ($rt) : "Zero");
        }
    }

    //********************************************************************************
    //**************** [ PALETA ALEATORIA DE CORES ] ****************
    //********************************************************************************
    /*
    function random_color( $start = 0x000000, $end = 0xFFFFFF ) {
        return sprintf( '#%06x', random_int( $start, $end ) );
    }

    // PARA USAR: echo random_color(); // #add555

    /* Explicação e font
        https://wallacemaxters.com.br/blog/40/como-gerar-cores-aleatorias-com-php

        Explicando a função:
        A função sprintf tem como finalidade formatar uma string. O caractere % atua como o formatador da string.
        O caractere # é utilizado para cores em hexadecimal em HTML ou CSS.
        O trecho %06 significa que os valores aleatórios serão preenchidos com 0 até 6 vezes caso não chegue a 6 caracteres nossa cor hexadecimal.
        Fazemos isso porque no CSS é permitido apenas 3 caracteres ou 6 após o #.
        O x converte o valor para a notação hexadecimal. O x converte os caracteres alfabéticos para minúsculo.
        Se utilizasse X, seria maísculo, mas isso não interfece em nada para o CSS, que utiliza as duas formas.
        A função mt_rand se encarregará de gerar um número aleatório desde 0 até 16777215.
        O número 16777215 é proveniente da expressão hexadecimal 0xFFFFFF. Sabemos que no CSS, o valor para uma cor vai de #000000 (preto) até #FFFFFF (branco).
        Por essa razão, utilizamos o valor 0xFFFFFF. Uma expressão hexadecimal em PHP pode ser representada através de 0x[0-9a-fA-F].

        Limitando as cores geradas:
        Nossa função possui o parâmetro $start e $end para o caso de você querer limitar a aleatoriedade das cores geradas.
        Por exemplo, se quisermos que gerar cores entre #DDDDDD e #FFFFFF, podemos fazer assim:
        echo random_color(0xDDDDDD, 0xFFFFFF); // #e8bc3d

        Usando no HTML:
        Você poderia tranquilamente inserir esse valor em um elemento HTML. Basta apenas fazer isso:
        <div style="color: <?= random_color()?>;">Texto colorido aleatóriamente</div>
     */

   //********************************************************************************
    //**************** [ DEBUG PRINT_R AND VAR_DUMP ] ****************
    //********************************************************************************
    function error( $ARRAY ) {
      echo '<div class="" style="margin-left: 250px;">';
      echo '<pre style="color: #FFF;">';
      echo '$VAR: ' . $ARRAY . '<br />';
      echo '</pre>';
      echo '</div>';
    }

    function echoD( $ARRAY ) {
        echo '<div style="margin: 5px 5px 5px 5px; padding: 5px 5px 5px 5px;">';
        echo '<small class="badge badge-warning" style="color: rgb( 52, 58, 64 ); font-size: .8em; font-weight: 400;">Depuração: echoD</small>';
        echo '<pre style="background: rgb( 63, 71, 78 ); color: rgb( 255, 255, 255 ); font-size: 1.0em; font-weight: 600; border: 1px solid rgb( 96, 104, 111 );">';
        echo $ARRAY;
        echo "</pre>";
        echo '</div>';
    }

    function echoDW( $ARRAY ) { //wrapper
        echo '<div class="content-wrapper">';
        echo '<div style="margin: 5px 5px 5px 5px; padding: 5px 5px 5px 5px;">';
        echo '<small class="badge badge-warning" style="color: rgb( 52, 58, 64 ); font-size: .8em; font-weight: 400;">Depuração: echoW</small>';
        echo '<pre style="background: rgb( 63, 71, 78 ); color: rgb( 255, 255, 255 ); font-size: 1.0em; font-weight: 600; border: 1px solid rgb( 96, 104, 111 );">';
        echo $ARRAY;
        echo "</pre>";
        echo '</div>';
        echo '</div>';
    }

    function debugP( $ARRAY ) {
        echo '<div style="margin: 5px 5px 5px 5px; padding: 5px 5px 5px 5px;">';
        echo '<small class="badge badge-warning" style="color: rgb( 52, 58, 64 ); font-size: .8em; font-weight: 400;">Depuração: print_rP</small>';
        echo '<pre style="background: rgb( 63, 71, 78 ); color: rgb( 255, 255, 255 ); font-size: 1.0em; font-weight: 600; border: 1px solid rgb( 96, 104, 111 );">';
        print_r( $ARRAY );
        echo "</pre>";
        echo '</div>';
    }

    function debugPW( $ARRAY ) {
        echo '<div class="content-wrapper">';
        echo '<div style="margin: 5px 5px 5px 5px; padding: 5px 5px 5px 5px;">';
        echo '<small class="badge badge-warning" style="color: rgb( 52, 58, 64 ); font-size: .8em; font-weight: 400;">Depuração: print_rW</small>';
        echo '<pre style="background: rgb( 63, 71, 78 ); color: rgb( 255, 255, 255 ); font-size: 1.0em; font-weight: 600; border: 1px solid rgb( 96, 104, 111 );">';
        print_r( $ARRAY );
        echo "</pre>";
        echo '</div>';
        echo '</div>';
    }

    function debugV( $ARRAY ) {
        echo '<div style="margin: 5px 5px 5px 5px; padding: 5px 5px 5px 5px;">';
        echo '<small class="badge badge-warning" style="color: rgb( 52, 58, 64 ); font-size: .8em; font-weight: 400;">Depuração: var_dumpV</small>';
        echo '<pre style="background: rgb( 63, 71, 78 ); color: rgb( 255, 255, 255 ); font-size: 1.0em; font-weight: 600; border: 1px solid rgb( 96, 104, 111 );">';
        var_dump( $ARRAY );
        echo "</pre>";
        echo '</div>';
    }

    function debugVW( $ARRAY ) {
        echo '<div class="content-wrapper mt-0 mb-0">';
        echo '<div style="margin: 0px 5px 0px 5px; padding: 2px 2px 2px 2px;">';
        echo '<small class="badge badge-warning" style="color: rgb( 52, 58, 64 ); font-size: .8em; font-weight: 400;">Depuração: var_dumpVW</small>';
        echo '<pre style="background: rgb( 63, 71, 78 ); color: rgb( 255, 255, 255 ); font-size: 1.0em; font-weight: 600; border: 1px solid rgb( 96, 104, 111 );">';
        var_dump( $ARRAY );
        echo "</pre>";
        echo '</div>';
        echo '</div>';
    }

    //********************************************************************************
    //**************** [ PASSANDO NÚMERO PARA NEGATIVO ]
    //********************************************************************************
    // A função abs retorna sempre o valor sem o sinal, então independente do número passado como parâmetro para a função retornaNegativo, o retorno sempre será negativo.
    function retornaNegativo( $valor ) {
        return -abs( $valor );
    }
    //Para usar: $x = retornaNegativo(2);

    //********************************************************************************
    //**************** [ PROJEÇÃO DE VENCIMENTO ]
    //********************************************************************************
    // Utilizado no arquivo simulação e ressimulação de emprestimo e contratos processuais
    function dt_fim_pgto( $DATA, $NUMERO = 12 ) {
        $PARC = array();
        $PARC[] = $DATA;
        list( $ANO, $MES, $DIA ) = explode( "-", $DATA );
        for( $I = 1; $I < $NUMERO; $I++ ) {
            $MES++;
            if( ( int ) $MES == 13 ) {
                $ANO++;
                $MES = 1;
            }
            $TIRA = $DIA;
            while( !checkdate( $MES, $TIRA, $ANO ) ) {
                $TIRA--;
            }
            $PARC[] = sprintf( "%02d-%02d-%02d", $ANO, $MES, $TIRA );
        }
        $DT_FINAL = array_pop( $PARC );
        return $DT_FINAL;
    }
    //********************************************************************************
    //**************** [ BOM DIA, BOA TARDE, BOA NOITE ]
    //********************************************************************************
    function saudacao() {
		$hora = date("H");

		if ($hora >= 0 and $hora < 6) {
			echo "<font face=\"Tahoma\" size=\"2\" color=\"#CCCCCD\">&raquo;&nbsp;Boa noite,</font>";
		 }elseif ($hora >=6 and $hora <12) {
			echo "<font face=\"Tahoma\" size=\"2\" color=\"#CCCCCD\">&raquo;&nbsp;Bom dia,</font>";
		 } elseif ($hora >=12 and $hora <18) {
			echo "<font face=\"Tahoma\" size=\"2\" color=\"#CCCCCD\">&raquo;&nbsp;Boa tarde,</font>";
		 }else {
			echo "<font face=\"Tahoma\" size=\"2\" color=\"#CCCCCD\">&raquo;&nbsp;Boa noite,</font>";
		}
	}
    //********************************************************************************
    //**************** [ MOSTRA MES ]
    //********************************************************************************
    function mostraMes( $m ) {
        switch( $m ) {
            case '01': case 1: $mes = "Janeiro";
                break;
            case '02': case 2: $mes = "Fevereiro";
                break;
            case '03': case 3: $mes = "Mar&ccedil;o";
                break;
            case '04': case 4: $mes = "Abril";
                break;
            case '05': case 5: $mes = "Maio";
                break;
            case '06': case 6: $mes = "Junho";
                break;
            case '07': case 7: $mes = "Julho";
                break;
            case '08': case 8: $mes = "Agosto";
                break;
            case '09': case 9: $mes = "Setembro";
                break;
            case '10': $mes = "Outubro";
                break;
            case '11': $mes = "Novembro";
                break;
            case '12': $mes = "Dezembro";
                break;
        }
        return $mes;
    }
    //********************************************************************************
    //**************** [ TEST INPUT ]
    //********************************************************************************
    function test_input( $data ) {
        $data = trim( $data );
        $data = stripslashes( $data );
        $data = htmlspecialchars( $data );
        return $data;
    }
    //********************************************************************************
    //**************** [ NUMEROS DE PROCESSOS ]
    //********************************************************************************
    function processNumber( $mask, $str ) {
        $str = str_replace(" ","",$str);
        for( $i = 0; $i < strlen( $str ); $i++ ) {
            $mask[ strpos( $mask,"#" ) ] = $str[ $i ];
        }
        return $mask;
        ## PARA USAR A FUNÇÃO ##
        // <?php echo processNumber( "#######-##.####.#.##.####" , $dados[ 'process' ] );
    }
    //********************************************************************************
    //**************** [ FORMATA DINHEIRO ]
    //********************************************************************************
    function formata_dinheiro( $VALOR ) { // FUNCTION FOR CLIENTSIDE
        $PADRAO = numfmt_create( "pt_BR", NumberFormatter::CURRENCY );
        return numfmt_format_currency( $PADRAO, $VALOR, "BRL" );
    }
    // function formata_dinheiro( $valor ) {
    //     $valor = number_format( $valor, 2, ',', '.' );
    //     return "R$ " . $valor;
    // }
    //********************************************************************************
    //**************** [ FORMATA MOEDA ]
    //********************************************************************************
    function moeda($vr)
    {
        // Remove o símbolo de moeda (R$) e os espaços
        $vr = str_replace(['R$', ' '], '', $vr);
        // Remove os pontos usados como separadores de milhar, mas mantém as vírgulas
        $vr = preg_replace('/\.(?=\d{3})/', '', $vr);
        // Substitui a vírgula decimal por um ponto
        $vr = str_replace(',', '.', $vr);
        // Converte o valor para float e formata para 2 casas decimais
        return number_format((float)$vr, 2, '.', '');
    }
    /**
     * Utilizado em:
     * finances/fin_main
     */
    // function moeda( $vr ) { // FUNCTION FOR SERVERSIDE
    //     $a = "R$";
    //     $b = "R$ ";
    //     $c = " R$";
    //     $d = " R$ ";
    //     $e = ".";
    //     $f = ",";
    //     $g = " ";
    //     $h = "  ";
    //     if(
    //         strpos( "[".$vr."]", "$a" ) ||
    //         strpos( "[".$vr."]", "$b" ) ||
    //         strpos( "[".$vr."]", "$c" ) ||
    //         strpos( "[".$vr."]", "$d" ) ||
    //         strpos( "[".$vr."]", "$e" ) ||
    //         strpos( "[".$vr."]", "$f" ) ||
    //         strpos( "[".$vr."]", "$g" ) ||
    //         strpos( "[".$vr."]", "$h" )
    //       ):
    //         $vr = str_replace( "R$" , "" , $vr );
    //         $vr = str_replace( "R$ " , "" , $vr );
    //         $vr = str_replace( " R$" , "" , $vr );
    //         $vr = str_replace( " R$ " , "" , $vr );
    //         $vr = str_replace( "." , "" , $vr );
    //         $vr = str_replace( "," , "." , $vr );
    //         $vr = str_replace( " " , "" , $vr ); // tira o espaço simples
    //         $vr = str_replace( "  " , "" , $vr ); // tira o espaço duplo
    //     else:
    //         trim( $vr = str_replace( "," , "." , $vr ) );
    //     endif;
    //     return $vr;
    // }
    //********************************************************************************
    //**************** [ FORMATA NUMEROS ]
    //********************************************************************************
    function number( $vr ) {
        $p = ".";
        $v = ",";
        $t = "-";
        $e = " ";
        if(
            strpos( "[".$vr."]", "$p" ) ||
            strpos( "[".$vr."]", "$v" ) ||
            strpos( "[".$vr."]", "$t" ) ||
            strpos( "[".$vr."]", "$e" )
          ):
            $vr = str_replace( "." , "" , $vr ); // tira os pontos
            $vr = str_replace( "," , "" , $vr ); // tira a vírgula
            $vr = str_replace( "-" , "" , $vr ); // tira o traço
            $vr = str_replace( " " , "" , $vr ); // tira o espaço simples
            $vr = str_replace( "  " , "" , $vr ); // tira o espaço duplo
        else: $vr;
        endif;
        return $vr;
    }
    //********************************************************************************
    //**************** [ FORMATA TEXTO ]
    //********************************************************************************
    function corrigir( $texto ) { //Função para formatar o texto.
        $texto = trim( $texto ); //Comando Trim, varre o texto em busca de espaços antes e depois da frase/palavra.
        setlocale( LC_CTYPE, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese', 'ptb', 'portuguese-brasil', 'bra', 'brasil', 'br' ); //Pede para que o servidor localize o pacote de linguagem localmente.
        $texto = strtoupper( $texto ); //Comando "strtoupper" torna o texto em Caixa ALTA.
        return $texto;
        while( strpos( $texto,'  ' ) !== false ) { //Varre o texto em busca de 2 espaços em brancos.
            $texto = str_replace( '  ',' ', $texto ); } //Se encontrar substitui por apenas 1.
        return $texto; //Retorna o texto formatado.
    }
    //********************************************************************************
    //**************** [ PARAR ]
    //********************************************************************************
    function parar( $mensagem ) { //Função para abortar o processamento.
        global $conn, $ha_foto, $foto; //Utilizando a global "global" dentro do bloco para echoar na tela.
        if( isset( $conn ) ) { //está setada a variável $conexao?
            mysqli_close( $conn );
        } //então feche a conexao com o banco de dados.
        if( $ha_foto ) {//Existe a variável $ha_foto dentro do diretório ['tmp_name']?
            unlink($foto['tmp_name']); //Se existir, então apague-a!
        }
    }
    //********************************************************************************
    //**************** [ APRESENTAR VIEWS COM DADOS FORMATADOS: CPF, CNPJ ]
    //********************************************************************************
    function mask( $val, $mask )
    {
        $maskared = '';
        $k = 0;
        for( $i = 0; $i <= strlen( $mask ) -1; $i++ )
        {
            if( $mask[ $i ] == '#' )
            {
                if( isset( $val[ $k ] ) )
                $maskared .= $val[ $k++ ];
            }
            else
            {
                if( isset( $mask[$i] ) )
                $maskared .= $mask[ $i ];
            }
        }
        return $maskared;
    }
    //********************************************************************************
    //**************** [ FORMATAR CNPJ ]
    //********************************************************************************
    function formataCNPJ( $cnpj )
    {
        if( isset( $_GET[ 'cnpj' ] ) )
        {
            $cnpj = $_GET[ 'cnpj' ];  // Pega o que foi digitado, se o method = POST
            $cnpj = preg_replace( "/[^0-9]/", "", $cnpj ); // Deixa somente números
            //$cnpj = substr($cnpj, 0, 5); // Copia os 5 primeiros caracteres
            echo $cnpj;
        }
    }
    //********************************************************************************
    //**************** [ VALIDAR CPF ]
    //********************************************************************************
    function validaCPF($cpf) {

        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;

    }
    //********************************************************************************
    //**************** [ SELECIONADO ]
    //********************************************************************************
    function selected( $value, $selected ) {
        return $value==$selected ? ' selected="selected" ' : '';
    }
?>