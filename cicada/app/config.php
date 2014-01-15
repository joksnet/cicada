<?php
/*
 *  Copyright 2013 Christian Grobmeier
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *  http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing,
 *  software distributed under the License is distributed
 *  on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
 *  either express or implied. See the License for the specific
 *  language governing permissions and limitations under the License.
 */
use Cicada\Auth\FileUserProvider;
use Cicada\Configuration;

$configuration = Configuration::getInstance();

$configuration->add('routes', array(APP_DIR.'routes.php'));
$configuration->add('userProvider', new FileUserProvider(APP_DIR.'roles.php', APP_DIR.'users.php'));
$configuration->add('cicada.templates.base', '../templates/');

