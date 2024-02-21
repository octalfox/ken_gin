<?php
defined('BASEPATH') or exit('No direct script access allowed');
$autoload['helper'] = array(
	"ci",
	"cookie",
	"curl",
	"templates",
	"time",
	"url",
);
$autoload['packages'] = array();
$autoload['libraries'] = array();
$autoload['drivers'] = array();
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('MemberModel', 'LanguageModel');

