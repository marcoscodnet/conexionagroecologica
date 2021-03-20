<?php
if (!isset($conn)) include('../bootstrap.php');
if (!defined('RUTA')) include('../includes/defined.php');
$sponsors = Doctrine_Query::create()
        ->select('s.*, c.value as cat, i.ruta as imagen')
        ->from('Sponsor s')
        ->innerJoin('s.categoria c')
        ->innerJoin('s.imagen i')
        ->orderBy('c.id, s.size desc, s.nombre')
        ->execute(array(), Doctrine::HYDRATE_ARRAY)
;
$html='';
$href='';
$categoria = 0;
$size = array(
    'current' => 0,
    1 => array(
        'classGrilla' => 'grilla-logos',
        'classLogo' => 'logo',
        'divStyle' => 'width: 172px; height: 176px;border-right: 1px solid green; border-bottom: 1px solid green;margin: 5px 10px 10px 0;',
        'imageWidth' => '150px'
        
    ),
    2 => array(
        'classGrilla' => 'grilla-logos-destacados',
        'classLogo' => 'logoLargo',
        'divStyle' => 'width: 345px; border-right: 1px solid green; border-bottom: 1px solid green;',
        'imageWidth' => '300px'
        
    )
);
foreach ($sponsors as $sponsor) {
    $href = ($sponsor['link']=='http://')?'javascript:void(0);':$sponsor['link'];
    if ($categoria && $categoria != $sponsor['id_categoria']) {
        $html .= '
            </div>
            <!-- /grilla -->
            <div class="clear"></div>
        ';
    }
    if ($categoria != $sponsor['id_categoria']) {
        $html .= '
            <!-- grilla -->
            <div class="'.$size[$sponsor['size']]['classGrilla'].'">
                <h1 style="color: grey; font-family: calibri; font-size: 22px; text-align: left; margin-left: 32px;">'.$sponsor['cat'].'</h1>
        ';
        $categoria = $sponsor['id_categoria'];
    }
    $html .= '
        <div class="'.$size[$sponsor['size']]['classLogo'].'" style="'.$size[$sponsor['size']]['divStyle'].'">
            <a style="display: inline-block" href="'.$href.'" target="_blank">
                <img style="width:'.$size[$sponsor['size']]['imageWidth'].'" src="images/apoyan/'.$sponsor['imagen'].'" alt="'.($sponsor['nombre']).'" title="'.($sponsor['nombre']).'" />
            </a>
        </div>
    ';
}
echo($html.'</div><div class="clear"></div>');
?>
