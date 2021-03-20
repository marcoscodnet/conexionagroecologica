<?php
if (!defined('RUTA_LOCAL')) include('php/includes/defined.php');
if (!class_exists('Texto')) include(RUTA_LOCAL.'php/clases/Texto.php');
//subcategorias
/*$subcategorias = Doctrine_Query::create()
        ->select('s.*')
        ->from('Subcategoria s')
        ->innerJoin('s.categoria c WITH c.id = ?', 1)
        ->execute(array(), Doctrine::HYDRATE_ARRAY)
;
$tmp = '<select class="form-control"  id="selectSubcategoria" name="subcategoria">';
$tmp .= '<option value="" selected="selected">Cualquier Subcategor&iacute;a</option>';
foreach ($subcategorias as $subcategoria) {
    $tmp .= '<option value="' . $subcategoria['id'] . '">' . $subcategoria['contenido'] . '</option>';
}
$tmp .= '</select>';*/
//fin subcategorias

//slider casos
$slider = '';
$htmlcaption = '';
$i=0;
$casos = Doctrine_Query::create()
        ->select('c.slug, c.titulo, c.descripcion, i.ruta as imagen')
        ->from('Caso c')
        ->innerJoin('c.imagenes i')
        ->where('c.destacado = 1')
        ->orderBy('c.id, i.orden')
        ->execute(array(), Doctrine::HYDRATE_ARRAY)
;
foreach ($casos as $caso) {
    $slider .= '
        <a href="caso-exitoso/'.$caso['slug'].'">
            <img src="content/casos-exitosos/home/'.$caso['imagen'].'" alt="'.Texto::cortar($caso['titulo'], 21, '...').'" title="#htmlcaption'.++$i.'"/>
        </a>
    ';
    $htmlcaption .= '
        <div id="htmlcaption'.$i.'" class="nivo-html-caption">
            <p class="tituloCasoSlider">'.utf8_decode($caso['titulo']).'</p>
            <p>'.Texto::cortar(utf8_decode($caso['descripcion']), 89, '...').'</p>
        </div>
    ';
}
//fin slider casos

//slider jornadas
$sliderJ = '';
$htmlcaptionJ = '';
$i=0;
$jornadas = Doctrine_Query::create()
        ->select('j.slug, j.titulo, j.descripcion, j.blog, i.ruta as imagen')
        ->from('Jornada j')
        ->innerJoin('j.imagenes i')
        ->orderBy('j.id, i.orden')
        ->execute(array(), Doctrine::HYDRATE_ARRAY)
;
foreach ($jornadas as $jornada) {
    $sliderJ .= '
        <a href="'.$jornada['blog'].'">
            <img src="content/jornadas-exitosas/home/'.$jornada['imagen'].'" alt="'.Texto::cortar($jornada['titulo'], 21, '...').'" title="'.utf8_decode($jornada['titulo']).'"/>
        </a>
    ';
    $htmlcaptionJ .= '
        <div id="htmlcaption'.$i.'" class="nivo-html-caption">
            <p class="tituloCasoSlider">'.utf8_decode($jornada['titulo']).'</p>
            <p>'.Texto::cortar(utf8_decode($jornada['descripcion']), 89, '...').'</p>
        </div> 
    ';
}
//fin slider casos

/*$html = str_replace('<!--{categoriasToSelect}-->', utf8_decode(Categoria::toSmartSelect()), $html);
$html = str_replace('<!--{subcategoriasToSelect}-->', $tmp, $html);*/
$html = str_replace('<!--{sliderCasos}-->', '<div id="slider" class="nivoSlider">'.$slider.'</div>'.$htmlcaption, $html);
$html = str_replace('<!--{sliderJornadas}-->', '<div id="sliderJ" class="nivoSlider">'.$sliderJ.'</div>'.$htmlcaptionJ, $html);
?>