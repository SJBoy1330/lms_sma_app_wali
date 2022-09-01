<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function parse_raw_http_request(array &$a_data)
{
  // read incoming data
  $input = file_get_contents('php://input');

  // grab multipart boundary from content type header
  preg_match('/boundary=(.*)$/', $_SERVER['CONTENT_TYPE'], $matches);
  $boundary = $matches[1];

  // split content by boundary and get rid of last -- element
  $a_blocks = preg_split("/-+$boundary/", $input);
  array_pop($a_blocks);

  // loop data blocks
  foreach ($a_blocks as $id => $block) {
    if (empty($block))
      continue;

    // you'll have to var_dump $block to understand this and maybe replace \n or \r with a visibile char

    // parse uploaded files
    if (strpos($block, 'application/octet-stream') !== FALSE) {
      // match "name", then everything after "stream" (optional) except for prepending newlines 
      preg_match("/name=\"([^\"]*)\".*stream[\n|\r]+([^\n\r].*)?$/s", $block, $matches);
    }
    // parse all other fields
    else {
      // match "name" and optional value in between newline sequences
      preg_match('/name=\"([^\"]*)\"[\n|\r]+([^\n\r].*)?\r$/s', $block, $matches);
    }
    $a_data[$matches[1]] = $matches[2];
  }
}

function http_parse_headers($header)
{
  $retVal = array();
  $fields = explode("\r\n", preg_replace('/\x0D\x0A[\x09\x20]+/', ' ', $header));
  foreach ($fields as $field) {
    if (preg_match('/([^:]+): (.+)/m', $field, $match)) {
      $match[1] = preg_replace('/(?<=^|[\x09\x20\x2D])./e', 'strtoupper("\0")', strtolower(trim($match[1])));
      if (isset($retVal[$match[1]])) {
        $retVal[$match[1]] = array($retVal[$match[1]], $match[2]);
      } else {
        $retVal[$match[1]] = trim($match[2]);
      }
    }
  }
  return $retVal;
}

function arrWeekDay($key = "")
{
  $arr = array(
    0 => 'Min',
    1 => 'Sen',
    2 => 'Sel',
    3 => 'Rab',
    4 => 'Kam',
    5 => 'Jum',
    6 => 'Sab'
  );

  if ($key) {
    return $arr[$key];
  } else {
    return $arr;
  }
}

function reformatDate($date, $from_format = 'd/m/Y', $to_format = 'Y-m-d')
{
  $date_aux = date_create_from_format($from_format, $date);
  return date_format($date_aux, $to_format);
}


function breadcrumb($parent, $arrchild = array())
{

  //arrchild => $arrchild[] = array('name' => 'namanya', 'link' => urlnya);


  $str = '<div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: \'#kt_content_container\', \'lg\': \'#kt_toolbar_container\'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
          <!--begin::Title-->
          <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 mb-0">' . $parent . '</h1>
          <!--end::Title-->
          <!--begin::Separator-->
              <span class="h-20px border-gray-200 border-start mx-4"></span>
          <!--end::Separator-->
          <!--begin::Breadcrumb-->

          <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 pt-1">';

  if (is_array($arrchild) && count($arrchild) > 0) {

    $cnt = count($arrchild);

    $i = 1;

    foreach ($arrchild as $arrval) {

      if ($i == $cnt) {
        $arrstr[] = '<!--begin::Item-->
          <li class="breadcrumb-item">' . $arrval['name'] . '</li>
          <!--end::Item-->
          ';
      } else {
        $arrstr[] = '<!--begin::Item-->
              <li class="breadcrumb-item text-muted">
                <a href="' . $arrval['link'] . '" class="text-muted text-hover-primary">' . $arrval['name'] . '</a>
              </li>
              <!--end::Item-->';
      }
      $i++;
    }

    $str .= implode('<li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>', $arrstr);
  }
  $str .= '</ul>
        <!--end::Breadcrumb-->
      </div>';

  return $str;
}

function setmenuactive($current_url, $class)
{
  if ($current_url == $class) {
    return "active";
  } else {
    if ($current_url == $class . "/index") {
      return "active";
    }
    return "";
  }
}

function set_active($uri1, $controller, $uri2 = "", $arrtarget = array())
{

  if ($uri1 == $controller) {
    if ($uri2 != "") {
      if (in_array($uri2, $arrtarget)) {
        return "active";
      }
    } else {
      return "active";
    }
  }
}

function encrypt_path($filename)
{

  /**
   * Make sure the downloads are *not* in a publically accessible path, otherwise, people
   * are still able to download the files directly.
   */
  //$filename = '/the/path/to/your/files/' . basename( $_GET['filename'] );

  /**
   * You can do a check here, to see if the user is logged in, for example, or if 
   * the current IP address has already downloaded it, the possibilities are endless.
   */


  if (file_exists($filename)) {
    /** 
     * Send some headers indicating the filetype, and it's size. This works for PHP >= 5.3.
     * If you're using PHP < 5.3, you might want to consider installing the Fileinfo PECL
     * extension.
     */
    $finfo = finfo_open(FILEINFO_MIME);
    header('Content-Disposition: attachment; filename= ' . basename($filename));
    header('Content-Type: ' . finfo_file($finfo, $filename));
    header('Content-Length: ' . filesize($filename));
    header('Expires: 0');
    finfo_close($finfo);

    /**
     * Now clear the buffer, read the file and output it to the browser.
     */
    ob_clean();
    flush();
    readfile($filename);
    exit;
  }

  header('HTTP/1.1 404 Not Found');

  echo "<h1>File not found</h1>";
  exit;
}

function setencrypt($string)
{
  $stringenc = base64_encode($string);
  $stringenc = str_replace("=", "", $stringenc);
  return $stringenc;
}
function base64url_encode($data)
{
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
function base64url_decode($data)
{
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}
function image_access($path, $filename)
{

  $filepath = $path . $filename;
  // $tmp = explode(".", $filename);
  $extfile = pathinfo($filepath, PATHINFO_EXTENSION);

  if ($filename != '' && file_exists($filepath)) {
    $im = file_get_contents($filepath);
    header("Content-type: image/" . $extfile);
    echo $im;
  }
}
function audio_access($path, $filename)
{

  $filepath = $path . $filename;
  // $tmp = explode(".", $filename);
  $extfile = pathinfo($filepath, PATHINFO_EXTENSION);

  if ($filename != '' && file_exists($filepath)) {
    $im = file_get_contents($filepath);
    header("Content-type: audio/" . $extfile);
    echo $im;
  }
}
function image_access_svg($path, $filename)
{

  $filepath = $path . $filename;

  if ($filename != '' && file_exists($path . $filename)) {
    $im = file_get_contents($path . $filename);
    header("Content-type: image/svg+xml");
    echo $im;
  }
}

function get_range_date($date1, $date2)
{

  $arr = array();
  $date2 = date('Y-m-d', strtotime($date2 . "+1 DAYS"));
  $begin = new DateTime($date1);
  $end = new DateTime($date2);

  if ($date1 == $date2) {
    $arr[] = $date1;
  } else {
    $interval = DateInterval::createFromDateString('1 day');
    $period = new DatePeriod($begin, $interval, $end);
    foreach ($period as $dt) {
      $arr[] = $dt->format('Y-m-d');
    }
  }
  return $arr;
}

function bytes($bytes, $force_unit = NULL, $format = NULL, $si = TRUE)
{
  // Format string
  $format = ($format === NULL) ? '%01.2f %s' : (string) $format;

  // IEC prefixes (binary)
  if ($si == FALSE or strpos($force_unit, 'i') !== FALSE) {
    $units = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB');
    $mod   = 1024;
  }
  // SI prefixes (decimal)
  else {
    $units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB');
    $mod   = 1000;
  }

  // Determine unit to use
  if (($power = array_search((string) $force_unit, $units)) === FALSE) {
    $power = ($bytes > 0) ? floor(log($bytes, $mod)) : 0;
  }

  return sprintf($format, $bytes / pow($mod, $power), $units[$power]);
}

function reverse_date($date)
{
  list($y, $m, $d) = explode("-", $date);
  $newdate = $d . "-" . $m . "-" . $y;
  return $newdate;
}

function reverse_fulldate($date)
{
  list($date, $time) = explode(" ", $date);
  $newdate = reverse_date($date);
  return $newdate . " " . $time;
}

function getNamaHari($number)
{
  $arrHari = array('0' => 'Minggu', '1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat', '6' => 'Sabtu');
  return $arrHari[$number];
}

function rupiah($angka, $format = "Rp. ")
{
  $hasil_rupiah = "$format" . number_format($angka, 0, ',', '.');
  return $hasil_rupiah;
}

function ifnull($value = NULL, $ganti = NULL)
{
  if (isset($value) == NULL) {
    if ($ganti != NULL) {
      $data = $ganti;
    } else {
      $data = 0;
    }
  } else {
    $data = $value;
  }

  return $data;
}


function obj_to_array($d)
{
  if (is_object($d)) {
    // Gets the properties of the given object
    // with get_object_vars function
    $d = get_object_vars($d);
  }
  if (is_array($d)) {
    /*
      * Return array converted to object
      * Using __FUNCTION__ (Magic constant)
      * for recursive call
      */
    return array_map(__FUNCTION__, $d);
  } else {
    // Return array
    return $d;
  }
}


function mydate($date, $format)
{
  if ($format == 1) {
    $dt = date_create($date);
    $tanggal = date('Y-m-d', $dt);
    $jam = date('H:i:s', $dt);
    $date_format = $tanggal . 'T' . $jam;
  } else {
    $dt = date_create($date);
    $date_format = date_format($dt, $format);
  }
  return $date_format;
}

function get_id_sekolah($kode)
{
  $ci = &get_instance();
  $result = $ci->db->get_where('sekolah', ['kode' => $kode])->row();
  return $result->id_sekolah;
}

function hash_my_password($id_sekolah, $username, $password)
{
  $data = hash('sha256', $id_sekolah . $username . $password);
  return $data;
}

function is_logged_in()
{

  $obj = &get_instance();

  $base_url = $obj->config->item('base_url');

  $ci = get_instance();

  if ($ci->session->userdata('lms_wali_id_wali')) {
    if ($ci->session->userdata('lms_wali_role') != 'wali') {
      redirect('auth/login');
    }
  } else {
    redirect('auth/login');
  }
}
function video_access($path, $filename = 'kosong', $default = NULL)
{

  $filepath = $path . $filename;

  $tmp = explode(".", $filename);
  $video_default = explode(".", $default);
  $extfile = $tmp[1];

  if ($filename != 'kosong' || $filename != NULL) {
    if (file_exists($path . $filename)) {
      $im = file_get_contents($path . $filename);
      header("Content-type: video/mp4");
      echo $im;
    }
  } else {
    echo 'not-found';
  }
}

function tampil_text($str, $tampil)
{
  $hasil = substr($str, 0, $tampil);
  if (strlen($str) > $tampil) {
    return $hasil . '...';
  } else {
    return $hasil;
  }
}
function nice_title($str, $limit = 75)
{
  $tmp = array();
  $tmp2 = array();
  $tmp3 = array();
  if ($str != '') {
    $tmp = explode(' ', $str);
    foreach ($tmp as $key => $value) {
      $tmp2[] = $value;
      if (strlen(implode(' ', $tmp2)) < $limit) {
        $tmp3[] = $value;
      } else {
        break;
      }
    }
    $tmp = implode(' ', $tmp3);
    if (strlen($tmp) < strlen($str)) {
      return $tmp . '...';
    } else {
      return $tmp;
    }
  }

  // $tmp = implode(' ', $e);
  // return strlen($tmp);
}
function nice_time($date)
{
  if (empty($date)) {
    return false;
  }

  $periods         = array("detik", "menit", "jam", "hari", "minggu", "bulan", "tahun", "dekade");
  $lengths         = array("60", "60", "24", "7", "4.35", "12", "10");

  $now             = time();
  $unix_date       = strtotime($date);

  // check validity of date
  if (empty($unix_date)) {
    return false;
  }
  // is it future date or past date
  if ($now > $unix_date) {
    $difference     = $now - $unix_date;
    $tense         = "yang lalu";
  } else {
    $difference     = $unix_date - $now;
    $tense         = "dari sekarang";
  }

  for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
    $difference /= $lengths[$j];
  }

  $difference = round($difference);

  if ($difference != 1) {
    //$periods[$j].= "s";
  }

  return "$difference $periods[$j] {$tense}";
}
function nice_date($format, $tanggal = "now")
{
  $en = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Jan", "Feb",  "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
  $id = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu",  "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",  "Oktober", "November", "Desember");

  return str_replace($en, $id, date($format, strtotime($tanggal)));
}

function nice_date_time($tanggal = "now")
{
  $en = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Jan", "Feb",  "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
  $id = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu",  "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",  "Oktober", "November", "Desember");
  $format = 'D, j M Y H:i';

  $date_formated = date($format, strtotime($tanggal));
  return str_replace($en, $id, $date_formated);
}

function month_from_number($nomor = NULL)
{
  switch ($nomor) {
    case 1:
      return "Januari";
    case 2:
      return "Februari";
    case 3:
      return "Maret";
    case 4:
      return "April";
    case 5:
      return "Mei";
    case 6:
      return "Juni";
    case 7:
      return "Juli";
    case 8:
      return "Agustus";
    case 9:
      return "September";
    case 10:
      return "Oktober";
    case 11:
      return "November";
    case 12:
      return "Desember";
    default:
      return array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
  }
}

function day_from_number($nomor = NULL)
{
  switch ($nomor) {
    case 1:
      return "Senin";
    case 2:
      return "Selasa";
    case 3:
      return "Rabu";
    case 4:
      return "Kamis";
    case 5:
      return "Jumat";
    case 6:
      return "Sabtu";
    case 7:
      return "Minggu";
    default:
      return array(1 => "Senin", 2 => "Selasa", 3 => "Rabu", 4 => "Kamis", 5 => "Jumat", 6 => "Sabtu", 7 => "Minggu");
  }
}


function get_tipe_notif($num = NULL)
{
  switch ($num) {
    case 1:
      return "Presensi";
    case 2:
      return "Spp";
    case 3:
      return "Tugas";
    case 4:
      return "Kbm";
    case 5:
      return "Pengumuman";
    case 6:
      return "Berita";
    case 7:
      return "Jadwal Ujian";
    case 8:
      return "Pesan Balasan";
    case 9:
      return "Broadcast";
    case 10:
      return "Surat Ijin";
    default:
      return array(1 => "Presensi", 2 => "Spp", 3 => "Tugas", 4 => "Kbm", 5 => "Pengumuman", 6 => "Berita", 7 => "Jadwal Ujian", 8 => "Pesan Balasan", 9 => "Broadcast", 10 => "Surat Ijin");
  }
}


function convert_link($link)
{
  if (strpos('a' . $link, "|*|")) {
    $link_fix_sub = str_replace('|*|', base_url(), $link);
  } else {
    $link_fix_sub = $link;
  }

  return $link_fix_sub;
}
function data_url($path = null, $id_sekolah = true)
{
  $ci = &get_instance();
  $uri = 'https://sd.klasq.id/linker/';
  if ($path != null) {
    $uri .= $path;
  }
  if ($id_sekolah == true) {
    $uri .= '/' . base64url_encode($ci->session->userdata('lms_wali_id_sekolah'));
  }
  return $uri;
}



function vector_default($image, $judul = 'Tidak ada data', $text = 'Tidak terdapat record data. Hubungi admin jika terdapat kesalahan', $id = NULL, $status = 0)
{
  if ($id != NULL) {
    $idfix = 'id="' . $id . '"';
  } else {
    $idfix = NULL;
  }

  if ($status > 0) {
    $stts = 'hiding';
  } else {
    $stts = NULL;
  }
  $html  = '<div ' . $idfix . ' class="row mb-4 ' . $stts . '">';
  $html .= '<div class="col-12 d-flex justify-content-center align-items-center flex-wrap" style="margin-top: 50px;"><div class="image-kosong">';
  $html .= '  <img src="' . data_url('img_default/' . base64url_encode('vector') . '/' . base64url_encode($image), FALSE) . '" width="275" alt="">';
  $html .= '</div><h5 class="fw-medium mb-2">' . $judul . '</h5>';
  $html .= '<p class="fw-normal text-secondary text-center size-14">' . $text . '</p>';
  $html .= '</div></div>';

  return $html;
}


function send_notification($array = array())
{

  /**

    array (

    fcm_key, 

    priority, 

    title,

    substitle,

    body,

    organization

    )

   **/



  $payload = array(

    'to' => $array['fcm_key'],

    'priority' => $array['data']['priority'],

    'title' => $array['title'],

    'body' => $array['body'],

    'mutable_content' => true,

    'data' => $array['data']

  );

  $headers = array(

    "Authorization:key=AAAAEWT74Yc:APA91bEpHSWLIT1k9Dv5fncpAWIsw5nmTENIZftsh5q-nmmpgLbq3IerUMtFq7A3LRvk78thCX0OWhJlI2JEdGL8p0VPT6tjOvhi5t-Fva1zsz1tQUkZYYWwrTj0eSJGQwpmMbZwqe0F",

    'Content-Type: application/json'

  );

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

  curl_setopt($ch, CURLOPT_POST, true);

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

  $result = curl_exec($ch);

  curl_close($ch);

  var_dump($result);
}

function sendNotif($fcm_token, $title, $message, $id = null, $action = null)
{

  $url = "https://fcm.googleapis.com/fcm/send";
  $header = [
    'authorization: key=AAAAEWT74Yc:APA91bEpHSWLIT1k9Dv5fncpAWIsw5nmTENIZftsh5q-nmmpgLbq3IerUMtFq7A3LRvk78thCX0OWhJlI2JEdGL8p0VPT6tjOvhi5t-Fva1zsz1tQUkZYYWwrTj0eSJGQwpmMbZwqe0F',
    'content-type: application/json'
  ];

  $notification = [
    'title' => $title,
    'body' => $message,
    'image' => 'https://sd.klasq.id/linker/img_siswa/NjJjZDE1ZGQ2MzEwZS5qcGc/MQ'
  ];
  $extraNotificationData = ["message" => $notification, "id" => $id, 'action' => $action];

  $fcmNotification = [
    'to'        => $fcm_token,
    'notification' => $notification,
    'data' => $extraNotificationData
  ];

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
  curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

  $result = curl_exec($ch);
  curl_close($ch);

  return $result;
}
