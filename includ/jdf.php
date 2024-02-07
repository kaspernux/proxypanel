<?php /* В свободу мы верим*/

/**
 * @name: Hijri_Shamsi,Solar(Jalali) Date and Time Functions
 * @Author : Proxygram & WebSite : http://proxygram.io
 * @License: GNU/LGPL _ Open Source & Free : [all functions]
 */

/*	F	*/
function jdate($format, $timestamp = '', $none = '', $time_zone = 'Europe/Moscow', $tr_num = 'ru') {
  $T_sec = 0;

  if ($time_zone != 'local') date_default_timezone_set(($time_zone === '') ? 'Europe/Moscow' : $time_zone);
  $ts = $T_sec + (($timestamp === '') ? time() : tr_num($timestamp));
  $date = explode('_', date('H_i_j_n_O_P_s_w_Y', $ts));
  $j_y = $date[8];
  $j_m = $date[3];
  $j_d = $date[2];
  $doy = ($j_m < 7) ? (($j_m - 1) * 31) + $j_d - 1 : (($j_m - 7) * 30) + $j_d + 185;
  $kab = (((($j_y + 12) % 33) % 4) == 1) ? 1 : 0;
  $sl = strlen($format);
  $out = '';
  for ($i = 0; $i < $sl; $i++) {
      $sub = substr($format, $i, 1);
      if ($sub == '\\') {
          $out .= substr($format, ++$i, 1);
          continue;
      }
      switch ($sub) {

          case 'E':
          case 'R':
          case 'x':
          case 'X':
              $out .= 'http://jdf.scr.ir';
              break;

          case 'B':
          case 'e':
          case 'g':
          case 'G':
          case 'h':
          case 'I':
          case 'T':
          case 'u':
          case 'Z':
              $out .= date($sub, $ts);
              break;

          case 'a':
              $out .= ($date[0] < 12) ? 'дп' : 'пп';
              break;

          case 'A':
              $out .= ($date[0] < 12) ? 'до полудня' : 'после полудня';
              break;

          case 'b':
              $out .= (int) ($j_m / 3.1) + 1;
              break;

          case 'c':
              $out .= $j_y . '/' . $j_m . '/' . $j_d . ' ،' . $date[0] . ':' . $date[1] . ':' . $date[6] . ' ' . $date[5];
              break;

          case 'C':
              $out .= (int) (($j_y + 99) / 100);
              break;

          case 'd':
              $out .= ($j_d < 10) ? '0' . $j_d : $j_d;
              break;

          case 'D':
              $out .= jdate_words(array('kh' => $date[7]), ' ');
              break;

          case 'f':
              $out .= jdate_words(array('ff' => $j_m), ' ');
              break;

          case 'F':
              $out .= jdate_words(array('mm' => $j_m), ' ');
              break;

          case 'H':
              $out .= $date[0];
              break;

          case 'i':
              $out .= $date[1];
              break;

          case 'j':
              $out .= $j_d;
              break;

          case 'J':
              $out .= jdate_words(array('rr' => $j_d), ' ');
              break;

          case 'k';
              $out .= tr_num(100 - (int) ($doy / ($kab + 365.24) * 1000) / 10, $tr_num);
              break;

          case 'K':
              $out .= tr_num((int) ($doy / ($kab + 365.24) * 1000) / 10, $tr_num);
              break;

          case 'l':
              $out .= jdate_words(array('rh' => $date[7]), ' ');
              break;

          case 'L':
              $out .= $kab;
              break;

          case 'm':
              $out .= ($j_m > 9) ? $j_m : '0' . $j_m;
              break;

          case 'M':
              $out .= jdate_words(array('km' => $j_m), ' ');
              break;

          case 'n':
              $out .= $j_m;
              break;

          case 'N':
              $out .= $date[7] + 1;
              break;

          case 'o':
              $jdw = ($date[7] == 6) ? 0 : $date[7] + 1;
              $dny = 364 + $kab - $doy;
              $out .= ($jdw > ($doy + 3) and $doy < 3) ? $j_y - 1 : (((3 - $dny) > $jdw and $dny < 3) ? $j_y + 1 : $j_y);
              break;

          case 'O':
              $out .= $date[4];
              break;

          case 'p':
              $out .= jdate_words(array('mb' => $j_m), ' ');
              break;

          case 'P':
              $out .= $date[5];
              break;

          case 'q':
              $out .= jdate_words(array('sh' => $j_y), ' ');
              break;

          case 'Q':
              $out .= $kab + 364 - $doy;
              break;

          case 'r':
              $key = jdate_words(array('rh' => $date[7], 'mm' => $j_m));
              $out .= $date[0] . ':' . $date[1] . ':' . $date[6] . ' ' . $date[4] . ' ' . $key['rh'] . '، ' . $j_d . ' ' . $key['mm'] . ' ' . $j_y;
              break;

          case 's':
              $out .= $date[6];
              break;

          case 'S':
              $out .= 'ام';
              break;

          case 't':
              $out .= ($j_m != 12) ? (31 - (int) ($j_m / 6.5)) : ($kab + 29);
              break;

          case 'U':
              $out .= $ts;
              break;

          case 'v':
              $out .= jdate_words(array('ss' => ($j_y % 100)), ' ');
              break;

          case 'V':
              $out .= jdate_words(array('ss' => $j_y), ' ');
              break;

          case 'w':
              $out .= ($date[7] == 6) ? 0 : $date[7] + 1;
              break;

          case 'W':
              $avs = (($date[7] == 6) ? 0 : $date[7] + 1) - ($doy % 7);
              if ($avs < 0) $avs += 7;
              $num = (int) (($doy + $avs) / 7);
              if ($avs < 4) {
                  $num++;
              } elseif ($num < 1) {
                  $num = ($avs == 4 or $avs == ((((($j_y % 33) % 4) - 2) == ((int) (($j_y % 33) * 0.05))) ? 5 : 4)) ? 53 : 52;
              }
              $aks = $avs + $kab;
              if ($aks == 7) $aks = 0;
              $out .= (($kab + 363 - $doy) < $aks and $aks < 3) ? '01' : (($num < 10) ? '0' . $num : $num);
              break;

          case 'y':
              $out .= substr($j_y, 2, 2);
              break;

          case 'Y':
              $out .= $j_y;
              break;

          case 'z':
              $out .= $doy;
              break;

          default:
              $out .= $sub;
      }
  }
  // Convert the timestamp to Gregorian format using the date() function
  $gregorian_time = date($format, $ts);

  // If $tr_num is not 'en', convert $gregorian_time using tr_num() function
  return ($tr_num != 'en') ? tr_num($gregorian_time, 'ru', '.') : $gregorian_time;
}


/*	F	*/
function jstrftime($format, $timestamp = '', $none = '', $time_zone = 'Europe/Moscow', $tr_num = 'ru') {
  $T_sec = 0;
  if ($time_zone != 'local') date_default_timezone_set(($time_zone === '') ? 'Europe/Moscow' : $time_zone);
  $ts = $T_sec + (($timestamp === '') ? time() : tr_num($timestamp));
  $date = explode('_', date('h_H_i_j_n_s_w_Y', $ts));
  $doy = date('z', $ts) + 1;
  $kab = (((((date('Y', $ts) + 12) % 33) % 4) == 1) ? 1 : 0);
  $sl = strlen($format);
  $out = '';

  for ($i = 0; $i < $sl; $i++) {
      $sub = substr($format, $i, 1);
      if ($sub == '%') {
          $sub = substr($format, ++$i, 1);
      } else {
          $out .= $sub;
          continue;
      }
      switch ($sub) {
          // Day
          case 'a':
              $out .= jdate_words(array('kh' => $date[6]), ' ');
              break;

          case 'A':
              $out .= jdate_words(array('rh' => $date[6]), ' ');
              break;

          case 'd':
              $out .= ($date[3] < 10) ? '0' . $date[3] : $date[3];
              break;

          case 'e':
              $out .= ($date[3] < 10) ? ' ' . $date[3] : $date[3];
              break;

          case 'j':
              $out .= str_pad($doy, 3, '0', STR_PAD_LEFT);
              break;

          case 'u':
              $out .= $date[6] + 1;
              break;

          case 'w':
              $out .= ($date[6] == 6) ? 0 : $date[6] + 1;
              break;

          // Week
          case 'U':
              $avs = (($date[6] < 5) ? $date[6] + 2 : $date[6] - 5) - ($doy % 7);
              if ($avs < 0) $avs += 7;
              $num = (int) (($doy + $avs) / 7) + 1;
              if ($avs > 3 or $avs == 1) $num--;
              $out .= ($num < 10) ? '0' . $num : $num;
              break;

          case 'V':
              $avs = (($date[6] == 6) ? 0 : $date[6] + 1) - ($doy % 7);
              if ($avs < 0) $avs += 7;
              $num = (int) (($doy + $avs) / 7);
              if ($avs < 4) {
                  $num++;
              } elseif ($num < 1) {
                  $num = ($avs == 4 or $avs == ((((($date[7] % 33) % 4) - 2) == ((int) (($date[7] % 33) * 0.05))) ? 5 : 4)) ? 53 : 52;
              }
              $aks = $avs + $kab;
              if ($aks == 7) $aks = 0;
              $out .= (($kab + 363 - $doy) < $aks and $aks < 3) ? '01' : (($num < 10) ? '0' . $num : $num);
              break;

          case 'W':
              $avs = (($date[6] == 6) ? 0 : $date[6] + 1) - ($doy % 7);
              if ($avs < 0) $avs += 7;
              $num = (int) (($doy + $avs) / 7) + 1;
              if ($avs > 3) $num--;
              $out .= ($num < 10) ? '0' . $num : $num;
              break;

          // Month
          case 'b':
          case 'h':
              $out .= jdate_words(array('km' => $date[4]), ' ');
              break;

          case 'B':
              $out .= jdate_words(array('mm' => $date[4]), ' ');
              break;

          case 'm':
              $out .= ($date[4] > 9) ? $date[4] : '0' . $date[4];
              break;

          // Year
          case 'C':
              $tmp = (int) ($date[7] / 100);
              $out .= ($tmp > 9) ? $tmp : '0' . $tmp;
              break;

          case 'g':
              $jdw = ($date[6] == 6) ? 0 : $date[6] + 1;
              $dny = 364 + $kab - $doy;
              $out .= substr(($jdw > ($doy + 3) and $doy < 3) ? $date[7] - 1 : (((3 - $dny) > $jdw and $dny < 3) ? $date[7] + 1 : $date[7]), 2, 2);
              break;

          case 'G':
              $jdw = ($date[6] == 6) ? 0 : $date[6] + 1;
              $dny = 364 + $kab - $doy;
              $out .= ($jdw > ($doy + 3) and $doy < 3) ? $date[7] - 1 : (((3 - $dny) > $jdw and $dny < 3) ? $date[7] + 1 : $date[7]);
              break;

          case 'y':
              $out .= substr($date[7], 2, 2);
              break;

          case 'Y':
              $out .= $date[7];
              break;

          // Time
          case 'H':
              $out .= $date[1];
              break;

          case 'I':
              $out .= $date[0];
              break;

          case 'l':
              $out .= ($date[0] > 9) ? $date[0] : ' ' . (int) $date[0];
              break;

          case 'M':
              $out .= $date[2];
              break;

          case 'p':
              $out .= ($date[1] < 12) ? 'до полудня' : 'после полудня';
              break;

          case 'P':
              $out .= ($date[1] < 12) ? 'дп' : 'пп';
              break;

          case 'r':
              $out .= $date[0] . ':' . $date[2] . ':' . $date[5] . ' ' . (($date[1] < 12) ? 'до полудня' : 'после полудня');
              break;

          case 'R':
              $out .= $date[1] . ':' . $date[2];
              break;

          case 'S':
              $out .= $date[5];
              break;

          case 'T':
              $out .= $date[1] . ':' . $date[2] . ':' . $date[5];
              break;

          case 'X':
              $out .= $date[0] . ':' . $date[2] . ':' . $date[5];
              break;

          case 'z':
              $out .= date('O', $ts);
              break;

          case 'Z':
              $out .= date('T', $ts);
              break;

          // Time and Date Stamps
          case 'c':
              $key = jdate_words(array('rh' => $date[6], 'mm' => $date[4]));
              $out .= $date[1] . ':' . $date[2] . ':' . $date[5] . ' ' . date('P', $ts) . ' ' . $key['rh'] . '، ' . $date[3] . ' ' . $key['mm'] . ' ' . $date[7];
              break;

          case 'D':
              $out .= substr($date[7], 2, 2) . '/' . (($date[4] > 9) ? $date[4] : '0' . $date[4]) . '/' . (($date[3] < 10) ? '0' . $date[3] : $date[3]);
              break;

          case 'F':
              $out .= $date[7] . '-' . (($date[4] > 9) ? $date[4] : '0' . $date[4]) . '-' . (($date[3] < 10) ? '0' . $date[3] : $date[3]);
              break;

          case 's':
              $out .= $ts;
              break;

          case 'x':
              $out .= substr($date[7], 2, 2) . '/' . (($date[4] > 9) ? $date[4] : '0' . $date[4]) . '/' . (($date[3] < 10) ? '0' . $date[3] : $date[3]);
              break;

          // Miscellaneous
          case 'n':
              $out .= "\n";
              break;

          case 't':
              $out .= "\t";
              break;

          case '%':
              $out .= '%';
              break;

          default:
              $out .= $sub;
      }
  }
  
  // Convert the timestamp to Gregorian format using the date() function
  $gregorian_time = date($format, $ts);

  // If $tr_num is not 'en', convert $gregorian_time using tr_num() function
  return ($tr_num != 'en') ? tr_num($gregorian_time, 'ru', '.') : $gregorian_time;
}


/*	F	*/
function jmktime($h = '', $m = '', $s = '', $jm = '', $jd = '', $jy = '', $none = '', $timezone = 'Europe/Moscow') {
  if ($timezone != 'local') date_default_timezone_set($timezone);
  if ($h === '') {
      return time();
  } else {
      list($h, $m, $s, $jm, $jd, $jy) = explode('_', tr_num($h . '_' . $m . '_' . $s . '_' . $jm . '_' . $jd . '_' . $jy));
      if ($m === '') {
          return mktime($h);
      } else {
          if ($s === '') {
              return mktime($h, $m);
          } else {
              if ($jm === '') {
                  return mktime($h, $m, $s);
              } else {
                  // Convert Jalali date to Gregorian date using mktime()
                  $gy = date('Y');
                  $gm = $jm;
                  $gd = $jd;
                  if ($jd === '') {
                      // If only month is provided, set the day to 1
                      $gd = 1;
                  }
                  if ($jy === '') {
                      // If year is not provided, use the current year
                      $jdate = explode('_', jdate('Y_j', '', '', $timezone, 'en'));
                      $jy = $jdate[0];
                  }
                  // Convert Jalali date to Gregorian date
                  list($gy, $gm, $gd) = explode('_', date('Y_n_j', mktime($h, $m, $s, $gm, $gd, $jy)));
                  return mktime($h, $m, $s, $gm, $gd, $gy);
              }
          }
      }
  }
}



/*	F	*/
function jgetdate($timestamp = '', $none = '', $timezone = 'Europe/Moscow', $tn = 'en') {
  $ts = ($timestamp === '') ? time() : tr_num($timestamp);
  $date = getdate($ts);
  $gregorian_ts = date('U', $ts); // Convert timestamp to Gregorian format
  return array(
      'seconds' => tr_num($date['seconds'], $tn),
      'minutes' => tr_num($date['minutes'], $tn),
      'hours' => $date['hours'],
      'mday' => $date['mday'],
      'wday' => $date['wday'],
      'mon' => $date['mon'],
      'year' => $date['year'],
      'yday' => $date['yday'],
      'weekday' => $date['weekday'],
      'month' => $date['month'],
      0 => tr_num($gregorian_ts, $tn) // Return Gregorian timestamp
  );
}



/*	F	*/
function jcheckdate($jm, $jd, $jy) {
  list($jm, $jd, $jy) = explode('_', tr_num($jm . '_' . $jd . '_' . $jy));
  return checkdate($jm, $jd, $jy);
}


/*	F	*/
function tr_num($str, $mod = 'en', $mf = '٫') {
  $num_a = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.');
  $key_a = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', $mf);
  return ($mod == 'ru') ? str_replace($num_a, $key_a, $str) : str_replace($key_a, $num_a, $str);
}

/*	F	*/
function jdate_words($array, $mod = '') {
  foreach ($array as $type => $num) {
      $num = (int) tr_num($num);
      switch ($type) {
          case 'ss':
              $sl = strlen($num);
              $xy3 = substr($num, 2 - $sl, 1);
              $h3 = $h34 = $h4 = '';
              if ($xy3 == 1) {
                  $p34 = '';
                  $k34 = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
                  $h34 = $k34[substr($num, 2 - $sl, 2) - 10];
              } else {
                  $xy4 = substr($num, 3 - $sl, 1);
                  $p34 = ($xy3 == 0 or $xy4 == 0) ? '' : ' и ';
                  $k3 = array('', '', 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
                  $h3 = $k3[$xy3];
                  $k4 = array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять');
                  $h4 = $k4[$xy4];
              }
              $array[$type] = (($num > 99) ? str_replace(
                  array('12', '13', '14', '19', '20'),
                  array('тысяча двести', 'тысяча триста', 'тысяча четыреста', 'тысяча девятьсот', 'две тысячи'),
                  substr($num, 0, 2)
              ) . ((substr($num, 2, 2) == '00') ? '' : ' и ') : '') . $h3 . $p34 . $h34 . $h4;
              break;

          case 'mm':
              $key = array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
              $array[$type] = $key[$num - 1];
              break;

          case 'rr':
              $key = array(
                  'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять', 'десять', 'одиннадцать', 'двенадцать',
                  'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать', 'двадцать',
                  'двадцать один', 'двадцать два', 'двадцать три', 'двадцать четыре', 'двадцать пять', 'двадцать шесть', 'двадцать семь',
                  'двадцать восемь', 'двадцать девять', 'тридцать', 'тридцать один'
              );
              $array[$type] = $key[$num - 1];
              break;

          case 'rh':
              $key = array('Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье');
              $array[$type] = $key[$num];
              break;

          case 'sh':
              $key = array('Змееносец', 'Лошадь', 'Овца', 'Обезьяна', 'Петух', 'Собака', 'Свинья', 'Крыса', 'Корова', 'Тигр', 'Кролик', 'Кит');
              $array[$type] = $key[$num % 12];
              break;

          case 'mb':
              $key = array('Овен', 'Телец', 'Близнецы', 'Рак', 'Лев', 'Дева', 'Весы', 'Скорпион', 'Стрелец', 'Козерог', 'Водолей', 'Рыбы');
              $array[$type] = $key[$num - 1];
              break;

          case 'ff':
              $key = array('Весна', 'Лето', 'Осень', 'Зима');
              $array[$type] = $key[(int) ($num / 3.1)];
              break;

          case 'km':
              $key = array('Фрв', 'Ор', 'Хрш', 'Три', 'Мрд', 'Шه', 'Мه', 'Абн', 'Аذ', 'Ди', 'Бه', 'Ас');
              $array[$type] = $key[$num - 1];
              break;

          case 'kh':
              $key = array('Я', 'Д', 'С', 'Ч', 'П', 'Сб', 'В');
              $array[$type] = $key[$num];
              break;

          default:
              $array[$type] = $num;
      }
  }
  return ($mod === '') ? $array : implode($mod, $array);
}


/**  Gregorian & Jalali_RU (Hijri_Shamsi,Solar) Date Converter Functions
Author: PROXYGRAM =>> Download Full Version :  https://files.proxygram.io/jdf
License: GNU/LGPL _ Open Source & Free :: Version: 2.80 : [2020=1399]
---------------------------------------------------------------------
355746=361590-5844 & 361590=(30*33*365)+(30*8) & 5844=(16*365)+(16/4)
355666=355746-79-1 & 355668=355746-79+1 &  1595=605+990 &  605=621-16
990=30*33 & 12053=(365*33)+(32/4) & 36524=(365*100)+(100/4)-(100/100)
1461=(365*4)+(4/4) & 146097=(365*400)+(400/4)-(400/100)+(400/400)  */

/*	F	*/
function jalali_to_gregorian($jy, $jm, $jd, $mod = '') {
  list($jy, $jm, $jd) = explode('_', tr_num($jy . '_' . $jm . '_' . $jd));
  $jy += 1595;
  $days = -355668 + (365 * $jy) + (((int) ($jy / 33)) * 8) + ((int) ((($jy % 33) + 3) / 4)) + $jd + (($jm < 7) ? ($jm - 1) * 31 : (($jm - 7) * 30) + 186);
  $gy = 400 * ((int) ($days / 146097));
  $days %= 146097;
  if ($days > 36524) {
      $gy += 100 * ((int) (--$days / 36524));
      $days %= 36524;
      if ($days >= 365) $days++;
  }
  $gy += 4 * ((int) ($days / 1461));
  $days %= 1461;
  if ($days > 365) {
      $gy += (int) (($days - 1) / 365);
      $days = ($days - 1) % 365;
  }
  $gd = $days + 1;
  $sal_a = array(0, 31, (($gy % 4 == 0 and $gy % 100 != 0) or ($gy % 400 == 0)) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
  for ($gm = 0; $gm < 13 and $gd > $sal_a[$gm]; $gm++) $gd -= $sal_a[$gm];
  return ($mod == '') ? array($gy, $gm, $gd) : $gy . $mod . $gm . $mod . $gd;
}
