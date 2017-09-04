<?php
/**
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *     http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

require_once __DIR__ . '/../vendor/autoload.php';
define('AVRO_TEST_HELPER_DIR', __DIR__);

define(
    'TEST_TEMP_DIR',
    implode(
        DIRECTORY_SEPARATOR,
        [AVRO_TEST_HELPER_DIR, 'tmp']
    )
);
$tz = ini_get('date.timezone');
if (empty($x)) {
    date_default_timezone_set('America/New_York');
}

/*
 * This is needed for the InterOpTest, which was included in the wikimedia implementation,
 * but did not work. Obviously, some files of the original apache implementation are needed, and file pathes have to be fixed
 *
 */
/*

define('AVRO_BASE_DIR', dirname(dirname(dirname(AVRO_TEST_HELPER_DIR))));
define(
    'AVRO_SHARE_DIR',
    implode(
        DIRECTORY_SEPARATOR,
        [AVRO_BASE_DIR, 'share']
    )
);
define(
    'AVRO_BUILD_DIR',
    implode(
        DIRECTORY_SEPARATOR,
        [AVRO_BASE_DIR, 'build']
    )
);
define(
    'AVRO_BUILD_DATA_DIR',
    implode(
        DIRECTORY_SEPARATOR,
        [AVRO_BUILD_DIR, 'interop', 'data']
    )
);
define(
    'AVRO_TEST_SCHEMAS_DIR',
    implode(
        DIRECTORY_SEPARATOR,
        [AVRO_TEST_HELPER_DIR, 'schemas']
    )
);
define(
    'AVRO_INTEROP_SCHEMA',
    implode(
        DIRECTORY_SEPARATOR,
        [AVRO_TEST_SCHEMAS_DIR, 'interop.avsc']
    )
);

$data_file = implode(DIRECTORY_SEPARATOR, [TEST_TEMP_DIR, 'php.avro']);
if (!file_exists($data_file)) {
    $datum = ['nullField'   => null,
              'boolField'   => true,
              'intField'    => -42,
              'longField'   => (int)2147483650,
              'floatField'  => 1234.0,
              'doubleField' => -5432.6,
              'stringField' => 'hello avro',
              'bytesField'  => "\x16\xa6",
              'arrayField'  => [5.0, -6.0, -10.5],
              'mapField'    => ['a' => ['label' => 'a'],
                                'c' => ['label' => '3P0']],
              'unionField'  => 14.5,
              'enumField'   => 'C',
              'fixedField'  => '1019181716151413',
              'recordField' => ['label'    => 'blah',
                                'children' => [
                                    ['label'    => 'inner',
                                     'children' => []]]]];

    $schema_json = file_get_contents(AVRO_INTEROP_SCHEMA);
    $io_writer = AvroDataIO::open_file($data_file, 'w', $schema_json);
    $io_writer->append($datum);
    $io_writer->close();
}
*/
