<?php
class Bytal
{
    public $domain = "https://webadminbytal.bhrmarketing.com.co/wp-json/wp/v2/";
    public $url = "https://webadminbytal.bhrmarketing.com.co/";
    public $generalInfo;
    public $gInterfaceWords;
    public $categories;
    public $cache;

    public function __construct()
    {
        $this->generalInfo = $this->gInfo();
        $this->categories = $this->gPosts("cat-procedimiento");
    }
    public function reindexCache(){
        $dirPath = "/home/uiumji3ay04q/public_html/web/cache";
       if (! is_dir($dirPath)) {
                    throw new InvalidArgumentException("$dirPath must be a directory");
                }
                if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
                    $dirPath .= '/';
                }
                $files = glob($dirPath . '*', GLOB_MARK);
                foreach ($files as $file) {
                    if (is_dir($file)) {
                        self::deleteDir($file);
                    } else {
                        unlink($file);
                    }
                }
                rmdir($dirPath);
        echo "Caché reiniciado";
    }
    public function query($endpoint,$cache=true)
    {
        $cacheAbsoluteRoute = "/home/uiumji3ay04q/public_html/web/cache";
        $url = $this->domain . $endpoint;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $filetitle = $this->get_alias($endpoint).".json";
        
        if($cache)
        {
            
            if (!file_exists($cacheAbsoluteRoute)) {
                mkdir($cacheAbsoluteRoute, 0777, true);
            }
            $path = $cacheAbsoluteRoute."/".$filetitle;

            if(file_exists($path)){
                //echo "exists";
                $data = file_get_contents($path);
                $ok =  json_decode($data);
                return $ok->response;
            }else{
                $output = curl_exec($ch);
                $request = json_decode($output);
                
                $finalstructure = '{"endpoint":"'.$endpoint.'","lastUpdate":"'.date("Y-m-d").'","response":'.$output.'}';
                $bwriting = file_put_contents($path, $finalstructure); 
                curl_close($ch);
                return $request;
            }
        }else
        {
                $output = curl_exec($ch);
                $request = json_decode($output);
                curl_close($ch);
                return $request;
        }
        
    }

    function gPosts($type, $id = ""){
        if($id == ""){
            if($type == "cat-procedimiento"){
                if(isset($_SESSION['catpro'])){
                    $result = $_SESSION['catpro'];
                }else{
                    $result = $this->query($type);
                    $_SESSION['catpro'] = $result;
                }
            }else{
                $result = $this->query($type);
            }
        }else{
            
            $result = $this->query($type."/".$id);
        }
        return $result;
    }


    function gInfo(){
		if(isset($_SESSION['ginfo'])){
			$gnrl = $_SESSION['ginfo'];
		}else{
			$result = $this->query("pages/6");
			$gnrl = $result;
			$_SESSION['ginfo'] = $gnrl;
		}
		return $gnrl;
	}
    function gPolitics(){
		if(isset($_SESSION['gpolitics'])){
			$gnrl = $_SESSION['gpolitics'];
		}else{
			$result = $this->query("pages/3");
			$gnrl = $result;
			$_SESSION['gpolitics'] = $gnrl;
		}
		return $gnrl;
	}
    function gAbout(){
		if(isset($_SESSION['gabout'])){
			$gnrl = $_SESSION['gabout'];
		}else{
			$result = $this->query("pages/93");
			$gnrl = $result;
			$_SESSION['gabout'] = $gnrl;
		}
		return $gnrl;
	}
    function shortenText($text, $limit) {
        if (strlen($text) > $limit) {
          return substr($text, 0, $limit) . "...";
        }
        return $text;
      }

    // UTILITY
	function get_alias($String){
        $String = html_entity_decode($String); // Traduce codificación

        $String = str_replace("¡", "", $String); //Signo de exclamación abierta.&iexcl;
        $String = str_replace("'", "", $String); //Signo de exclamación abierta.&iexcl;
        $String = str_replace("!", "", $String); //Signo de exclamación cerrada.&iexcl;
        $String = str_replace("¢", "-", $String); //Signo de centavo.&cent;
        $String = str_replace("£", "-", $String); //Signo de libra esterlina.&pound;
        $String = str_replace("¤", "-", $String); //Signo monetario.&curren;
        $String = str_replace("¥", "-", $String); //Signo del yen.&yen;
        $String = str_replace("¦", "-", $String); //Barra vertical partida.&brvbar;
        $String = str_replace("§", "-", $String); //Signo de sección.&sect;
        $String = str_replace("¨", "-", $String); //Diéresis.&uml;
        $String = str_replace("©", "-", $String); //Signo de derecho de copia.&copy;
        $String = str_replace("ª", "-", $String); //Indicador ordinal femenino.&ordf;
        $String = str_replace("«", "-", $String); //Signo de comillas francesas de apertura.&laquo;
        $String = str_replace("¬", "-", $String); //Signo de negación.&not;
        $String = str_replace("", "-", $String); //Guión separador de sílabas.&shy;
        $String = str_replace("®", "-", $String); //Signo de marca registrada.&reg;
        $String = str_replace("¯", "&-", $String); //Macrón.&macr;
        $String = str_replace("°", "-", $String); //Signo de grado.&deg;
        $String = str_replace("±", "-", $String); //Signo de más-menos.&plusmn;
        $String = str_replace("²", "-", $String); //Superíndice dos.&sup2;
        $String = str_replace("³", "-", $String); //Superíndice tres.&sup3;
        $String = str_replace("´", "-", $String); //Acento agudo.&acute;
        $String = str_replace("µ", "-", $String); //Signo de micro.&micro;
        $String = str_replace("¶", "-", $String); //Signo de calderón.&para;
        $String = str_replace("·", "-", $String); //Punto centrado.&middot;
        $String = str_replace("¸", "-", $String); //Cedilla.&cedil;
        $String = str_replace("¹", "-", $String); //Superíndice 1.&sup1;
        $String = str_replace("º", "-", $String); //Indicador ordinal masculino.&ordm;
        $String = str_replace("»", "-", $String); //Signo de comillas francesas de cierre.&raquo;
        $String = str_replace("¼", "-", $String); //Fracción vulgar de un cuarto.&frac14;
        $String = str_replace("½", "-", $String); //Fracción vulgar de un medio.&frac12;
        $String = str_replace("¾", "-", $String); //Fracción vulgar de tres cuartos.&frac34;
        $String = str_replace("¿", "-", $String); //Signo de interrogación abierta.&iquest;
        $String = str_replace("×", "-", $String); //Signo de multiplicación.&times;
        $String = str_replace("÷", "-", $String); //Signo de división.&divide;
        $String = str_replace("À", "a", $String); //A mayúscula con acento grave.&Agrave;
        $String = str_replace("Á", "a", $String); //A mayúscula con acento agudo.&Aacute;
        $String = str_replace("Â", "a", $String); //A mayúscula con circunflejo.&Acirc;
        $String = str_replace("Ã", "a", $String); //A mayúscula con tilde.&Atilde;
        $String = str_replace("Ä", "a", $String); //A mayúscula con diéresis.&Auml;
        $String = str_replace("Å", "a", $String); //A mayúscula con círculo encima.&Aring;
        $String = str_replace("Æ", "a", $String); //AE mayúscula.&AElig;
        $String = str_replace("Ç", "c", $String); //C mayúscula con cedilla.&Ccedil;
        $String = str_replace("È", "e", $String); //E mayúscula con acento grave.&Egrave;
        $String = str_replace("É", "e", $String); //E mayúscula con acento agudo.&Eacute;
        $String = str_replace("Ê", "e", $String); //E mayúscula con circunflejo.&Ecirc;
        $String = str_replace("Ë", "e", $String); //E mayúscula con diéresis.&Euml;
        $String = str_replace("Ì", "i", $String); //I mayúscula con acento grave.&Igrave;
        $String = str_replace("Í", "i", $String); //I mayúscula con acento agudo.&Iacute;
        $String = str_replace("Î", "i", $String); //I mayúscula con circunflejo.&Icirc;
        $String = str_replace("Ï", "i", $String); //I mayúscula con diéresis.&Iuml;
        $String = str_replace("Ð", "d", $String); //ETH mayúscula.&ETH;
        $String = str_replace("Ñ", "n", $String); //N mayúscula con tilde.&Ntilde;
        $String = str_replace("Ò", "o", $String); //O mayúscula con acento grave.&Ograve;
        $String = str_replace("Ó", "o", $String); //O mayúscula con acento agudo.&Oacute;
        $String = str_replace("Ô", "o", $String); //O mayúscula con circunflejo.&Ocirc;
        $String = str_replace("Õ", "o", $String); //O mayúscula con tilde.&Otilde;
        $String = str_replace("Ö", "o", $String); //O mayúscula con diéresis.&Ouml;
        $String = str_replace("Ø", "o", $String); //O mayúscula con barra inclinada.&Oslash;
        $String = str_replace("Ù", "u", $String); //U mayúscula con acento grave.&Ugrave;
        $String = str_replace("Ú", "u", $String); //U mayúscula con acento agudo.&Uacute;
        $String = str_replace("Û", "u", $String); //U mayúscula con circunflejo.&Ucirc;
        $String = str_replace("Ü", "u", $String); //U mayúscula con diéresis.&Uuml;
        $String = str_replace("Ý", "y", $String); //Y mayúscula con acento agudo.&Yacute;
        $String = str_replace("Þ", "b", $String); //Thorn mayúscula.&THORN;
        $String = str_replace("ß", "b", $String); //S aguda alemana.&szlig;
        $String = str_replace("à", "a", $String); //a minúscula con acento grave.&agrave;
        $String = str_replace("á", "a", $String); //a minúscula con acento agudo.&aacute;
        $String = str_replace("â", "a", $String); //a minúscula con circunflejo.&acirc;
        $String = str_replace("ã", "a", $String); //a minúscula con tilde.&atilde;
        $String = str_replace("ä", "a", $String); //a minúscula con diéresis.&auml;
        $String = str_replace("å", "a", $String); //a minúscula con círculo encima.&aring;
        $String = str_replace("æ", "a", $String); //ae minúscula.&aelig;
        $String = str_replace("ç", "a", $String); //c minúscula con cedilla.&ccedil;
        $String = str_replace("è", "e", $String); //e minúscula con acento grave.&egrave;
        $String = str_replace("é", "e", $String); //e minúscula con acento agudo.&eacute;
        $String = str_replace("ê", "e", $String); //e minúscula con circunflejo.&ecirc;
        $String = str_replace("ë", "e", $String); //e minúscula con diéresis.&euml;
        $String = str_replace("ì", "i", $String); //i minúscula con acento grave.&igrave;
        $String = str_replace("í", "i", $String); //i minúscula con acento agudo.&iacute;
        $String = str_replace("î", "i", $String); //i minúscula con circunflejo.&icirc;
        $String = str_replace("ï", "i", $String); //i minúscula con diéresis.&iuml;
        $String = str_replace("ð", "i", $String); //eth minúscula.&eth;
        $String = str_replace("ñ", "n", $String); //n minúscula con tilde.&ntilde;
        $String = str_replace("ò", "o", $String); //o minúscula con acento grave.&ograve;
        $String = str_replace("ó", "o", $String); //o minúscula con acento agudo.&oacute;
        $String = str_replace("ô", "o", $String); //o minúscula con circunflejo.&ocirc;
        $String = str_replace("õ", "o", $String); //o minúscula con tilde.&otilde;
        $String = str_replace("ö", "o", $String); //o minúscula con diéresis.&ouml;
        $String = str_replace("ø", "o", $String); //o minúscula con barra inclinada.&oslash;
        $String = str_replace("ù", "o", $String); //u minúscula con acento grave.&ugrave;
        $String = str_replace("ú", "u", $String); //u minúscula con acento agudo.&uacute;
        $String = str_replace("û", "u", $String); //u minúscula con circunflejo.&ucirc;
        $String = str_replace("ü", "u", $String); //u minúscula con diéresis.&uuml;
        $String = str_replace("ý", "y", $String); //y minúscula con acento agudo.&yacute;
        $String = str_replace("þ", "b", $String); //thorn minúscula.&thorn;
        $String = str_replace("ÿ", "y", $String); //y minúscula con diéresis.&yuml;
        $String = str_replace("Œ", "d", $String); //OE Mayúscula.&OElig;
        $String = str_replace("œ", "-", $String); //oe minúscula.&oelig;
        $String = str_replace("Ÿ", "-", $String); //Y mayúscula con diéresis.&Yuml;
        $String = str_replace("ˆ", "", $String); //Acento circunflejo.&circ;
        $String = str_replace("˜", "", $String); //Tilde.&tilde;
        $String = str_replace("%", "", $String); //Guiún corto.&ndash;
        $String = str_replace("-", "", $String); //Guiún corto.&ndash;
        $String = str_replace("–", "", $String); //Guiún corto.&ndash;
        $String = str_replace("—", "", $String); //Guiún largo.&mdash;
        $String = str_replace("'", "", $String); //Comilla simple izquierda.&lsquo;
        $String = str_replace("'", "", $String); //Comilla simple derecha.&rsquo;
        $String = str_replace("‚", "", $String); //Comilla simple inferior.&sbquo;
        $String = str_replace("\"", "", $String); //Comillas doble derecha.&rdquo;
        $String = str_replace("\"", "", $String); //Comillas doble inferior.&bdquo;
        $String = str_replace("†", "-", $String); //Daga.&dagger;
        $String = str_replace("‡", "-", $String); //Daga doble.&Dagger;
        $String = str_replace("…", "-", $String); //Elipsis horizontal.&hellip;
        $String = str_replace("‰", "-", $String); //Signo de por mil.&permil;
        $String = str_replace("‹", "-", $String); //Signo izquierdo de una cita.&lsaquo;
        $String = str_replace("›", "-", $String); //Signo derecho de una cita.&rsaquo;
        $String = str_replace("€", "-", $String); //Euro.&euro;
        $String = str_replace("™", "-", $String); //Marca registrada.&trade;
        $String = str_replace(":", "-", $String); //Marca registrada.&trade;
        $String = str_replace(" & ", "-", $String); //Marca registrada.&trade;
        $String = str_replace("(", "-", $String);
        $String = str_replace(")", "-", $String);
        $String = str_replace("?", "-", $String);
        $String = str_replace("¿", "-", $String);
        $String = str_replace(",", "-", $String);
        $String = str_replace(";", "-", $String);
        $String = str_replace("�", "-", $String);
        $String = str_replace("/", "-", $String);
        $String = str_replace(" ", "-", $String); //Espacios
        $String = str_replace(".", "", $String); //Punto
        $String = str_replace("&", "-", $String);

        //Mayusculas
        $String = strtolower($String);

        return ($String);
    }
// SEO
function create_metas($seo = "") {
    global $metas, $urlMap;

    if($seo == ""){
        $seo = $this->generalInfo;
    }

    $metas['title'] = $seo->acf->seo->titulo;
    $metas['desc'] = $seo->acf->seo->descripcion;
    $metas['words'] = $seo->acf->seo->palabras_clave;
    $metas['img'] = $seo->acf->seo->imagen;

    if($metas['img'] != ""){
        $image = new Imagick($seo->acf->seo->imagen);
        $dataImg = $image->getImageGeometry();
        $width = $dataImg['width'];
        $height =  $dataImg['height'];
    }
    

    return <<<HTML
<meta charset="utf-8">
<link rel="canonical" href="{$_GET['canon']}">
<meta name="keywords" content="{$metas['words']}">
<meta name="description" content="{$metas['desc']}">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1.5">
<title>{$metas['title']}</title>
<meta name="thumbnail" content="{$metas['img']}">
<meta name="language" content="spanish">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@CareBilingual">
<meta name="twitter:title" content="{$metas['title']}">
<meta name="twitter:description" content="{$metas['desc']}">
<meta name="twitter:image" content="{$metas['img']}">
<meta property="og:url" content="https://www.bilingualchildcaretraining.com/{$_GET['canon']}">
<meta property="og:type" content="website">
<meta property="og:title" content="{$metas['title']}">
<meta property="og:site_name" content="{$metas['title']}">
<meta property="og:description" content="{$metas['desc']}">
<meta property="og:image" content="{$metas['img']}">
<meta property="og:image:width" content="{$width}">
<meta property="og:image:height" content="{$height}">
<meta property="og:image:alt" content="{$metas['title']}"/>
<!--[if IE]>
<script>
    document.createElement('header');
    document.createElement('footer');
    document.createElement('section');
    document.createElement('figure');
    document.createElement('aside');
    document.createElement('nav');
    document.createElement('article');
</script>
<![endif]-->
HTML;
}

}

?>