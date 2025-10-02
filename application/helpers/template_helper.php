<?php
function render_template($view, $data = []) {
    $CI =& get_instance();
    $data['content'] = $CI->load->view($view, $data, TRUE);
    $CI->load->view('layouts/main', $data);
}
