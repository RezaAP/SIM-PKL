<?php

if(!function_exists('validate'))
{
    function validate($rules = array(),$alias = array())
    {

        $CI =& get_instance();
        $ruleData = [];
        foreach($rules as $key => $rule)
        {
            $ruleData[] = [
                'field' => $key,
                'label' => ucwords(str_replace('_',' ',$key)),
                'rules' => $rule
            ];
        }

        $CI->form_validation->set_rules($ruleData);
        return $CI->form_validation->run();
    }
}

if(!function_exists('error'))
{
    function error($prefix)
    {
        echo form_error($prefix);
    }
}

if(!function_exists('old'))
{
    function old($prefix)
    {
        echo set_value($prefix);
    }
}

if(!function_exists('set_alert'))
{
    function set_alert($key,$value = '')
    {
        $CI =& get_instance();

        if(!is_array($key) && $value)
        {
            $CI->session->set_flashdata($key, $value);
        }
        if(is_array($key))
        {
            foreach($key as $k => $v){
                $CI->session->set_flashdata($k, $v);
            }
        }
    }
}

if(!function_exists('alert'))
{
    function alert($key,$class = '')
    {
        $CI =& get_instance();

        if(!is_array($key) && $class)
        {
            if($CI->session->flashdata($key))
            {
                $content = "<div class=\"alert alert-{$class}\">";
                $content .= $CI->session->flashdata($key);
                $content .= '</div>';
                return $content;
            }
        }
        if(is_array($key))
        {
            $content = '';
            foreach($key as $k => $v){
                if($CI->session->flashdata($k))
                {
                    $content = "<div class=\"alert alert-{$v}\">";
                    $content .= $CI->session->flashdata($k);
                    $content .= '</div>';
                }
            }
            return $content;
        }

        return '';
    }
}

if(!function_exists('modal_session'))
{
    function modal_session($modalId)
    {
        $CI =& get_instance();

        $CI->session->set_flashdata('modal-session', $modalId);
    }
}

if(!function_exists('show_modal'))
{
    function show_modal()
    {
        $CI =& get_instance();

        $modalSess = $CI->session->flashdata('modal-session');
        if($modalSess)
        {
            echo "<script>$('#{$modalSess}').modal('show')</script>";
        }

    }
}

if(!function_exists('dump_json'))
{
    function dump_json(...$data)
    {
        echo json_encode($data);die;
    }
}

if(!function_exists('toIdr'))
{
    function toIdr($num)
    {
        return number_format($num,0,',','.');
    }
}

if(!function_exists('segment'))
{
    function segment($segment)
    {
        $CI =& get_instance();
        return $CI->uri->segment($segment);
    }
}

if(!function_exists('file_store'))
{

    function file_store_filename($filename) {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $random_name = uniqid() . '_' . mt_rand(1000, 9999) . '.' . $extension;

        return $random_name;
    }

    function file_store($name,$newPath = '')
    {

        $CI =& get_instance();

        @mkdir(FCPATH.'/assets/uploads/'.($newPath? $newPath.'/' : ''),0777,true);

        $uploadFullPath = '/assets/uploads/'.($newPath? $newPath.'/' : '');

        $config['upload_path'] = '.'.$uploadFullPath;
        $config['allowed_types'] = '*';
        $config['max_size'] = 8000;

        $CI->load->library('upload', $config);

        $files = $_FILES[$name];
        $fileName = $files['name'];
        $resultData = [];
        if(is_array($fileName) && count($fileName) > 1)
        {
            for($i = 0;$i < count($fileName);$i++){
                $_FILES[$name]['name'] = $files['name'][$i];
                $_FILES[$name]['type'] = $files['type'][$i];
                $_FILES[$name]['tmp_name'] = $files['tmp_name'][$i];
                $_FILES[$name]['error'] = $files['error'][$i];
                $_FILES[$name]['size'] = $files['size'][$i];
                if($CI->upload->do_upload($name))
                {  

                    $upload_data = $CI->upload->data();

                    $new_filename = file_store_filename($upload_data['file_name']);

                    // Rename the uploaded file with the random filename
                    rename($upload_data['full_path'], $upload_data['file_path'] . $new_filename);

                    $resultData[] = [
                        'name' => $files['name'][$i],
                        'hash_name' => $new_filename,
                        'full_path' => $uploadFullPath.$new_filename
                    ];
                }
            }
            if(count($resultData))
            {
                return [
                    'status' => true,
                    'data' => $resultData,
                    'full_path' => $uploadFullPath.$new_filename
                ];
            }
            goto output;
        }

        if($CI->upload->do_upload($name))
        {  

            $upload_data = $CI->upload->data();

            $new_filename = file_store_filename($upload_data['file_name']);

            // Rename the uploaded file with the random filename
            rename($upload_data['full_path'], $upload_data['file_path'] . $new_filename);

            $resultData = [
                'name' => $fileName,
                'hash_name' => $new_filename,
                'full_path' => $uploadFullPath.$new_filename
            ];

            return [
                'status' => true,
                'data' => $resultData
            ];
        }

        output:
        return [
            'status' => false,
            'message' => $CI->upload->display_errors()
        ];
    }
}

if(!function_exists('get_file_extension'))
{
    function get_file_extension($filename)
    {
        return pathinfo($filename, PATHINFO_EXTENSION);
    }
}

if(!function_exists('upload_url'))
{
    function upload_url($filename,$path)
    {
        return base_url('assets/uploads/'.$path.'/'.$filename);
    }
}

if(!function_exists('render_tahun'))
{

    function getTahun()
    {
        $yearNow = date('Y');
        $tahun = [];
        $tahun[] = $yearNow;
        $tahun[] = $yearNow - 1;
        return $tahun;
    }

    function render_tahun($currentYear = '')
    {
        $yearNow = date('Y');
        $content = '';
        for ($i = $yearNow - 1; $i <= $yearNow; $i++) {
            $selected = ($i == ($currentYear? $currentYear : $yearNow)) ? 'selected' : '';
            $content .= "<option value=\"$i\" $selected>$i</option>";
        }
        return $content;
    }
}

if(!function_exists('dd'))
{
    function dd($data)
    {
        echo json_encode($data);die;
    }
}

if(!function_exists('thumbnail_lowongan'))
{
    function thumbnail_lowongan($gambar,$index = 0,$local = false)
    {
        if($local)
        {
            $path = $gambar? FCPATH.$gambar : ($index % 2 == '0'? FCPATH.'assets/img/lowongan-1.jpg' : FCPATH.'assets/img/lowongan-2.jpg');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $file = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $file;
        }else{
            return $gambar? base_url($gambar) : ($index % 2 == '0'? base_url('assets/img/lowongan-1.jpg') : base_url('assets/img/lowongan-2.jpg'));
        }
    }
}


if(!function_exists('slugify')) {
    function slugify($text)
    {
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    
      $text = preg_replace('~[^-\w]+~', '', $text);
    
      $text = trim($text, '-');
    
      $text = preg_replace('~-+~', '-', $text);
      
      $text = strtolower($text);
      
      return $text;
    }
}