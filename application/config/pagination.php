<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['per_page'] = 5;
$config['use_page_numbers'] = TRUE;
$config['full_tag_open'] = '<nav aria-label="Images pages" class="pagination-container"><ul class="pagination justify-content-end">';
$config['full_tag_close'] = '</nav>';


$config['first_link'] = 'First Page';
$config['first_tag_open'] = '<span class="firstlink">';
$config['first_tag_close'] = '</span>';

$config['last_link'] = 'Last Page';
$config['last_tag_open'] = '<span class="lastlink">';
$config['last_tag_close'] = '</span>';

$config['next_link'] = 'Next Page';
$config['next_tag_open'] = '<span class="nextlink">';
$config['next_tag_close'] = '</span>';

$config['prev_link'] = 'Prev Page';
$config['prev_tag_open'] = '<span class="prevlink">';
$config['prev_tag_close'] = '</span>';

$config['cur_tag_open'] = '<span class="curlink">';
$config['cur_tag_close'] = '</span>';

$config['num_tag_open'] = '<span class="numlink">';
$config['num_tag_close'] = '</span>';