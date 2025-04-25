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

if (!nv_function_exists('nv_block_thoi_tiet')) {
    /**
     * nv_block_config_thoi_tiet()
     *
     * @param string $module
     * @param array  $data_block
     * @param array  $lang_block
     * @return string
     */
    function nv_block_config_thoi_tiet($module, $data_block, $lang_block)
    {
        global $site_mods, $nv_Cache;

        $html = '';
        return $html;
    }

    /**
     * nv_block_config_thoi_tiet_submit()
     *
     * @param string $module
     * @param array  $lang_block
     * @return array
     */
    function nv_block_config_thoi_tiet_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = [];
        $return['error'] = [];
        $return['config'] = [];
        $return['config']['blockid'] = $nv_Request->get_int('config_blockid', 'post', 0);
        $return['config']['numrows'] = $nv_Request->get_int('config_numrows', 'post', 2);

        return $return;
    }

    /**
     * nv_block_thoi_tiet()
     *
     * @param array $block_config
     * @return string
     * @throws PDOException
     */
    function nv_block_thoi_tiet($block_config)
    {
        global $global_config, $site_mods, $module_config, $nv_Cache, $db,$db_config;

        $module = $block_config['module'];

        // Set content status
        function getConfig( $module )
        {
            global $nv_Cache, $site_mods,$db_config,$module_data,$db;

            $list = $nv_Cache->db( 'SELECT config_name, config_value FROM ' . $db_config['prefix'] . '_' . $module . '_config', '', $module );
            $Config = array();
            foreach( $list as $values )
            {
                $Config[$values['config_name']] = $values['config_value'];
            }
            unset( $list ); 

            return $Config;
        }
        $config_setting = getConfig($module);



        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $site_mods[$module]['module_file'] . '/block.thoi_tiet.tpl')) {
            $block_theme = $global_config['module_theme'];
        } elseif (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/' . $site_mods[$module]['module_file'] . '/block.thoi_tiet.tpl')) {
            $block_theme = $global_config['site_theme'];
        } else {
            $block_theme = 'default';
        }

        $xtpl = new XTemplate('block.thoi_tiet.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $site_mods[$module]['module_file']);
        
        $info_tinh = $db->query('SELECT * FROM ' . $db_config['prefix'] . '_location_province WHERE provinceid = ' . $config_setting['tinh'])->fetch();

        $url = 'https://api.openweathermap.org/data/2.5/weather?q=' . urlencode($info_tinh['title']) . '&appid=' . $config_setting['appid'] . '&units=metric&lang=vi';

        $response = file_get_contents($url);
        $response = json_decode($response, true);
  
        $xtpl->assign('NV_CURRENTTIME', nv_date($global_config['date_pattern'] . ', ' . $global_config['time_pattern'], NV_CURRENTTIME));
        $xtpl->assign('TINH', $info_tinh);

        $xtpl->assign('ICON', $response['weather'][0]);
        $xtpl->assign('INFO', $response);










        $xtpl->parse('main');

        return $xtpl->text('main');

    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_block_thoi_tiet($block_config);
}
