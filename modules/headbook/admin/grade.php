<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2022 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');

if ($nv_Request->isset_request('delete_grade_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
    $grade_id = $nv_Request->get_int('delete_grade_id', 'get');
    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
    if ($grade_id > 0 and $delete_checkss == md5($grade_id . NV_CACHE_PREFIX . $client_info['session_id'])) {
        $db->query('DELETE FROM ' . $db_config['prefix'] . '_' . $module_data . '_grade  WHERE grade_id = ' . $db->quote($grade_id));
        $nv_Cache->delMod($module_name);
        nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete Grade', 'ID: ' . $grade_id, $admin_info['userid']);
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    }
}

$row = array();
$error = array();
$row['grade_id'] = $nv_Request->get_int('grade_id', 'post,get', 0);
if ($nv_Request->isset_request('submit', 'post')) {
    $row['grade_name'] = $nv_Request->get_title('grade_name', 'post', '');
    $row['school_id'] = $nv_Request->get_int('school_id', 'post', 0);
    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('add_time', 'post'), $m))     {
        $_hour = 0;
        $_min = 0;
        $row['add_time'] = mktime($_hour, $_min, 0, $m[2], $m[1], $m[3]);
    }
    else
    {
        $row['add_time'] = 0;
    }
    if (preg_match('/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string('update_time', 'post'), $m))     {
        $_hour = 0;
        $_min = 0;
        $row['update_time'] = mktime($_hour, $_min, 0, $m[2], $m[1], $m[3]);
    }
    else
    {
        $row['update_time'] = 0;
    }

    if (empty($row['grade_name'])) {
        $error[] = $lang_module['error_required_grade_name'];
    } elseif (empty($row['school_id'])) {
        $error[] = $lang_module['error_required_school_id'];
    } elseif (empty($row['add_time'])) {
        $error[] = $lang_module['error_required_add_time'];
    } elseif (empty($row['update_time'])) {
        $error[] = $lang_module['error_required_update_time'];
    }

    if (empty($error)) {
        try {
            if (empty($row['grade_id'])) {
                $stmt = $db->prepare('INSERT INTO ' . $db_config['prefix'] . '_' . $module_data . '_grade (grade_name, school_id, add_time, update_time) VALUES (:grade_name, :school_id, :add_time, :update_time)');
            } else {
                $stmt = $db->prepare('UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_grade SET grade_name = :grade_name, school_id = :school_id, add_time = :add_time, update_time = :update_time WHERE grade_id=' . $row['grade_id']);
            }
            $stmt->bindParam(':grade_name', $row['grade_name'], PDO::PARAM_STR);
            $stmt->bindParam(':school_id', $row['school_id'], PDO::PARAM_INT);
            $stmt->bindParam(':add_time', $row['add_time'], PDO::PARAM_INT);
            $stmt->bindParam(':update_time', $row['update_time'], PDO::PARAM_INT);

            $exc = $stmt->execute();
            if ($exc) {
                $nv_Cache->delMod($module_name);
                if (empty($row['grade_id'])) {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Add Grade', ' ', $admin_info['userid']);
                } else {
                    nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit Grade', 'ID: ' . $row['grade_id'], $admin_info['userid']);
                }
                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
            }
        } catch(PDOException $e) {
            trigger_error($e->getMessage());
            die($e->getMessage()); //Remove this line after checks finished
        }
    }
} elseif ($row['grade_id'] > 0) {
    $row = $db->query('SELECT * FROM ' . $db_config['prefix'] . '_' . $module_data . '_grade WHERE grade_id=' . $row['grade_id'])->fetch();
    if (empty($row)) {
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
    }
} else {
    $row['grade_id'] = 0;
    $row['grade_name'] = '';
    $row['school_id'] = 0;
    $row['add_time'] = 0;
    $row['update_time'] = 0;
}

if (empty($row['add_time'])) {
    $row['add_time'] = '';
}
else
{
    $row['add_time'] = date('d/m/Y', $row['add_time']);
}

if (empty($row['update_time'])) {
    $row['update_time'] = '';
}
else
{
    $row['update_time'] = date('d/m/Y', $row['update_time']);
}
$array_school_id_headbook = array();
$_sql = 'SELECT school_id,school_name FROM nv4_headbook_schools';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_school_id_headbook[$_row['school_id']] = $_row;
}


$q = $nv_Request->get_title('q', 'post,get');

// Fetch Limit
$show_view = false;
if (!$nv_Request->isset_request('id', 'post,get')) {
    $show_view = true;
    $per_page = 20;
    $page = $nv_Request->get_int('page', 'post,get', 1);
    $db->sqlreset()
        ->select('COUNT(*)')
        ->from('' . $db_config['prefix'] . '_' . $module_data . '_grade');

    if (!empty($q)) {
        $db->where('grade_name LIKE :q_grade_name OR school_id LIKE :q_school_id OR add_time LIKE :q_add_time OR update_time LIKE :q_update_time');
    }
    $sth = $db->prepare($db->sql());

    if (!empty($q)) {
        $sth->bindValue(':q_grade_name', '%' . $q . '%');
        $sth->bindValue(':q_school_id', '%' . $q . '%');
        $sth->bindValue(':q_add_time', '%' . $q . '%');
        $sth->bindValue(':q_update_time', '%' . $q . '%');
    }
    $sth->execute();
    $num_items = $sth->fetchColumn();

    $db->select('*')
        ->order('grade_id DESC')
        ->limit($per_page)
        ->offset(($page - 1) * $per_page);
    $sth = $db->prepare($db->sql());

    if (!empty($q)) {
        $sth->bindValue(':q_grade_name', '%' . $q . '%');
        $sth->bindValue(':q_school_id', '%' . $q . '%');
        $sth->bindValue(':q_add_time', '%' . $q . '%');
        $sth->bindValue(':q_update_time', '%' . $q . '%');
    }
    $sth->execute();
}

$xtpl = new XTemplate('grade.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('NV_ASSETS_DIR', NV_ASSETS_DIR);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

foreach ($array_school_id_headbook as $value) {
    $xtpl->assign('OPTION', array(
        'key' => $value['school_id'],
        'title' => $value['school_name'],
        'selected' => ($value['school_id'] == $row['school_id']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_school_id');
}
$xtpl->assign('Q', $q);

if ($show_view) {
    $base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
    if (!empty($q)) {
        $base_url .= '&q=' . $q;
    }
    $generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
    if (!empty($generate_page)) {
        $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
        $xtpl->parse('main.view.generate_page');
    }
    $number = $page > 1 ? ($per_page * ($page - 1)) + 1 : 1;
    while ($view = $sth->fetch()) {
        $view['number'] = $number++;
        $view['add_time'] = (empty($view['add_time'])) ? '' : nv_date('d/m/Y', $view['add_time']);
        $view['update_time'] = (empty($view['update_time'])) ? '' : nv_date('d/m/Y', $view['update_time']);
        $view['school_id'] = $array_school_id_headbook[$view['school_id']]['school_name'];
        $view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;grade_id=' . $view['grade_id'];
        $view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_grade_id=' . $view['grade_id'] . '&amp;delete_checkss=' . md5($view['grade_id'] . NV_CACHE_PREFIX . $client_info['session_id']);
        $xtpl->assign('VIEW', $view);
        $xtpl->parse('main.view.loop');
    }
    $xtpl->parse('main.view');
}


if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['grade'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
