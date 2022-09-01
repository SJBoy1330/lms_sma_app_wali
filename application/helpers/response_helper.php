<?php

/*** response for alert and remote  call procedure ***/



function alert_show($judul, $text = NULL, $icon = NULL, $image = NULL)
{



  // - success

  // - error

  // - warning

  // - info

  // - Question



  $data = '';

  if ($judul != NULL) {

    $data .= '<div class="flash-data" ';

    $data .= 'data-icon="' . $icon . '"';

    $data .= 'data-judul="' . $judul . '"';

    $data .= 'data-message="' . $text . '"';

    $data .= 'data-image="' . $image . '">';

    $data .= '</div>';
  }

  return $data;
}



function alert_question($judul, $text = NULL, $icon = NULL, $image = NULL)
{

  $data = '';

  if ($judul != NULL) {

    $data .= 'data-judul="' . $judul . '"';

    $data .= 'data-message="' . $text . '"';

    $data .= 'data-icon="' . $icon . '"';

    $data .= 'data-image="' . $image . '"';
  }

  return $data;
}



function alert_balok($text, $color, $icon)
{

  $data = '';

  if ($text != NULL) {

    $data .= '<div class="alert alert-' . $color . ' d-flex align-items-center" role="alert">';

    if ($icon == 'in') {

      $data .= '

        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi flex-shrink-0 me-3 bi-box-arrow-in-right" viewBox="0 0 16 16">

          <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>

          <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>

        </svg>

      ';
    } elseif ($icon == 'out') {

      $data .= '

        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi flex-shrink-0 me-3 bi-box-arrow-in-left" viewBox="0 0 16 16">

          <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>

          <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>

        </svg>

      ';
    } elseif ($icon == 'warning') {

      $data .= '

        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi flex-shrink-0 me-3 bi-exclamation-triangle-fill" viewBox="0 0 16 16" role="img" aria-label="Warning:">

          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>

        </svg>

      ';
    } elseif ($icon == 'info') {

      $data .= '

        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi flex-shrink-0 me-3 bi-info-circle-fill" viewBox="0 0 16 16">

          <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>

        </svg>

      ';
    } elseif ($icon == 'success') {

      $data .= '

        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" fill="currentColor" class="bi flex-shrink-0 me-3 bi-check-circle-fill" viewBox="0 0 16 16">

          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>

        </svg>

      ';
    } elseif ($icon == 'time') {

      $data .= '

        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi flex-shrink-0 me-3 bi-clock-history" viewBox="0 0 16 16">

          <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>

          <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>

          <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>

        </svg>

      ';
    } else {
      $data .= '<i class="' . $icon . '"></i>';
    }

    $data .= '<div>';

    $data .= $text;

    $data .= '</div>';

    $data .= '</div>';
  }

  return $data;
}
