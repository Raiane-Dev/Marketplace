<?php
    namespace ControllerCorreios;

    class ControllerCorreios{
        public function calculateFrete($service_code, $zip_code, $zip_destination, $weight, $height, $width, $length, $declared_value = 0){
            $service_code = strtoupper($service_code);
            if($service_code == 40215){
                $service_code = 'SEDEX10';
            }else if($service_code == 40045){
                $service_code = 'SEDEXACOBRAR';
            }else if($service_code == 40010){
                $service_code = 'SEDEX';
            }else if($service_code == 41106){
                $service_code = 'PAC';
            }

            $correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$zip_code."&sCepDestino=".$zip_destination."&nVlPeso=".$weight."&nCdFormato=1&nVlComprimento=".$length."&nVlAltura=".$height."&nVlLargura=".$width."&sCdMaoPropria=n&nVlValorDeclarado=".$declared_value."&sCdAvisoRecebimento=n&nCdServico=".$service_code."&nVlDiametro=0&StrRetorno=xml";
        
            $file_xml = simplexml_load_file($correios);

            $code['codigo'] = $file_xml->cServico->Codigo;
            $value['valor'] = $file_xml->cServico->Valor;
            $deadline['prazo'] = $file_xml->cServico->PrazoEntrega.' Dias para a entrega';

            $return_value = implode(',', $value);
            $return_deadline = implode(',', $deadline);
            $return_code = implode(',', $code);

            // if(isset($_POST['cep'])){
            //     echo '<p class="description"><b>'.$service_code.'</b><br /> Cost of freight: '.$return_value.'.</p>';
            //     echo '<p class="description">Deadline: '.$return_deadline.' days.</p>';
            // }

            echo $return_value;
        }

    }
?>