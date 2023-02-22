<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2021 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_MAINFILE')) {
    exit('Stop!!!');
}

if (!nv_function_exists('nv_weather')) {
    /**
     * nv_block_config_weather()
     *
     * @param string $module
     * @param array  $data_block
     * @param array  $lang_block
     * @return string
     */
    function nv_block_config_weather($module, $data_block, $lang_block)
    {
        global $nv_Cache, $site_mods;

        $html_input = '';
        $html = '';
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">Title default:</label>';
        $html .= '<div class="col-sm-18">';
        $html .= '<div class="row">';
        $html .= '<div class="col-sm-3">';
        $html .= '<input type="color" name="titledcolor" value="' . $data_block['titledcolor'] . '" title="text shadow color" oninput="config_titledcolor.value=titledcolor.value" style="width: 100%;"/>';
        $html .= '</div>';
        $html .= '<div class="col-sm-21">';
        $html .= '<input type="text" name="config_titledcolor" value="'.$data_block['titledcolor'].'" />';
        $html .= '</div>';
        $html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">Font Size:</label>';
        $html .= '<div class="col-sm-18"><input type="text" class="form-control" name="config_fontsize" size="5" value="' . $data_block['fontsize'] . '"/></div>';
        $html .= '</div>'; 
        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-sm-6">Fonts:</label>';
        $html .= '<div class="col-sm-18">';
        $html .= '<div class="row">';
        $html .= '<div class="col-sm-8">';
        $html .= '<div class="input-group margin-bottom-sm">';
        $html .= '<div class="input-group-addon">Font Style</div>';
        $html .= '<select name="config_fontstyle" class="form-control">';
        $fontstyle1 = ( $data_block['fontstyle'] == 'inherit' ) ? 'selected="selected"' : '';
		$fontstyle2 = ( $data_block['fontstyle'] == 'italic' ) ? 'selected="selected"' : '';
		$fontstyle3 = ( $data_block['fontstyle'] == 'normal' ) ? 'selected="selected"' : '';
		$fontstyle4 = ( $data_block['fontstyle'] == 'oblique' ) ? 'selected="selected"' : '';
		$html .= '<option value="inherit" ' . $fontstyle1 . '> inherit </option>';
		$html .=' <option value="italic"' . $fontstyle2 . ' > italic </option>';
		$html .=' <option value="normal"' . $fontstyle3 . ' > normal </option>';
		$html .=' <option value="oblique"' . $fontstyle4 . ' > oblique </option>';
        $html .= '</select>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="col-sm-8">';
        $html .= '<div class="input-group margin-bottom-sm">';
        $html .= '<div class="input-group-addon">Underline</div>';
        $html .= '<select name="config_textunderline" class="form-control">';
        $textunderline2 = ( $data_block['textunderline'] == 'underline' ) ? 'selected="selected"' : '';
		$textunderline3 = ( $data_block['textunderline'] == 'initial' ) ? 'selected="selected"' : '';
		$textunderline4 = ( $data_block['textunderline'] == 'overline' ) ? 'selected="selected"' : '';
		$html .= ' <option value="none"> none </option>';
		$html .= ' <option value="underline"' . $textunderline2 . ' > underline </option>';
		$html .= ' <option value="initial"' . $textunderline3 . ' > initial </option>';
		$html .= ' <option value="overline"' . $textunderline4 . ' > overline </option>';
        $html .= '</select>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="col-sm-8">';
        $html .= '<div class="input-group margin-bottom-sm">';
        $html .= '<div class="input-group-addon">Transform</div>';
        $html .= '<select name="config_texttransform" class="form-control">';
        $texttransform1 = ( $data_block['texttransform'] == 'none' ) ? 'selected="selected"' : '';
		$texttransform2 = ( $data_block['texttransform'] == 'capitalize' ) ? 'selected="selected"' : '';
		$texttransform3 = ( $data_block['texttransform'] == 'uppercase' ) ? 'selected="selected"' : '';
		$texttransform4 = ( $data_block['texttransform'] == 'lowercase' ) ? 'selected="selected"' : '';
		$html .= '<option value="none" ' . $texttransform1 . '> none </option>';
		$html .=' <option value="capitalize"' . $texttransform2 . ' > capitalize </option>';
		$html .=' <option value="uppercase"' . $texttransform3 . ' > uppercase </option>';
		$html .=' <option value="lowercase"' . $texttransform4 . ' > lowercase </option>';
        $html .= '</select>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    /**
     * nv_block_config_weather_submit()
     *
     * @param string $module
     * @param array  $lang_block
     * @return array
     */
    function nv_block_config_weather_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = [];
        $return['error'] = [];
        $return['config'] = [];
        $return['config']['titledcolor'] = $nv_Request->get_string( 'config_titledcolor', 'post', 0 );
        $return['config']['fontsize']  = $nv_Request->get_int('config_fontsize', 'post', 0);
		$return['config']['fontstyle'] = $nv_Request->get_string( 'config_fontstyle', 'post', 0 );
		$return['config']['textunderline'] = $nv_Request->get_string( 'config_textunderline', 'post', 0 );
		$return['config']['texttransform'] = $nv_Request->get_string( 'config_texttransform', 'post', 0 );
        return $return;
    }

    /**
     * nv_weather()
     *
     * @param array $block_config
     * @return string|void
     */
    function nv_weather($block_config)
    {
        global $db, $module_name, $module_info, $module_file, $lang_module, $global_config, $nv_Cache;
        $module = $block_config['module'];
        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/weather/block_category.tpl')) {
            $block_theme = $global_config['module_theme'];
        } else {
            $block_theme = 'default';
        }
        
        $array_config['viewcity'] = 1;
        $array_config['token'] = '';
        $array_config['per_page'] = '5';
        $array_config['copy_page'] = 0;
        $array_config['alias_lower'] = 1;

       

        $sql = 'SELECT config_name, config_value FROM ' . NV_PREFIXLANG . '_' . $module . '_config';
        $result = $db->query($sql);
        while (list($c_config_name, $c_config_value) = $result->fetch(3)) {
            $array_config[$c_config_name] = $c_config_value;
        }

        
	    $sql_city = 'SELECT  title FROM ' . NV_PREFIXLANG . '_' . $module . '_city WHERE city_id='.$array_config['viewcity'].' ORDER BY weight ASC';
	
	    $city = $db->query($sql_city)->fetch();

        $xtpl = new XTemplate('block_weather.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/weather');
        $xtpl->assign('TEMPLATE', $block_theme);
        $xtpl->assign('CONFIG', $array_config);
        $xtpl->assign('CITY', $city['title']);
        $xtpl->assign( 'BLOCK_TITLE', $block_config['title'] );
        $xtpl->assign( 'FONTSIZE', $block_config['fontsize'] );
        $xtpl->assign( 'FONTSTYLE', $block_config['fontstyle'] );
        $xtpl->assign( 'TEXTUNDERLINE', $block_config['textunderline'] );
        $xtpl->assign( 'TITLEDCOLOR', $block_config['titledcolor'] );
        $xtpl->assign( 'TEXTTRANSFORM', $block_config['texttransform'] );

        

        $xtpl->parse('main');
        return $xtpl->text('main');
    }

}

if (defined('NV_SYSTEM')) {
    global $site_mods, $module_name, $nv_Cache;
    $module = $block_config['module'];
    $content = nv_weather($block_config);
}
