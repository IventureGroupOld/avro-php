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

/**
 * Class NameExample
 */
class NameExample
{
    public $is_valid;
    public $name;
    public $namespace;
    public $default_namespace;
    public $expected_fullname;

    /**
     * NameExample constructor.
     *
     * @param      $name
     * @param      $namespace
     * @param      $default_namespace
     * @param      $is_valid
     * @param null $expected_fullname
     */
    public function __construct($name, $namespace, $default_namespace, $is_valid,
                                $expected_fullname = null)
    {
        $this->name = $name;
        $this->namespace = $namespace;
        $this->default_namespace = $default_namespace;
        $this->is_valid = $is_valid;
        $this->expected_fullname = $expected_fullname;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return var_export($this, true);
    }
}

/**
 * Class NameTest
 */
class NameTest extends PHPUnit\Framework\TestCase
{

    /**
     * @return array
     */
    public function fullname_provider()
    {
        $examples = array(new NameExample('foo', null, null, true, 'foo'),
            new NameExample('foo', 'bar', null, true, 'bar.foo'),
            new NameExample('bar.foo', 'baz', null, true, 'bar.foo'),
            new NameExample('_bar.foo', 'baz', null, true, '_bar.foo'),
            new NameExample('bar._foo', 'baz', null, true, 'bar._foo'),
            new NameExample('3bar.foo', 'baz', null, false),
            new NameExample('bar.3foo', 'baz', null, false),
            new NameExample('b4r.foo', 'baz', null, true, 'b4r.foo'),
            new NameExample('bar.f0o', 'baz', null, true, 'bar.f0o'),
            new NameExample(' .foo', 'baz', null, false),
            new NameExample('bar. foo', 'baz', null, false),
            new NameExample('bar. ', 'baz', null, false)
        );
        $exes = array();
        foreach ($examples as $ex)
            $exes [] = array($ex);
        return $exes;
    }

    /**
     * @dataProvider fullname_provider
     *
     * @param $ex
     */
    public function test_fullname($ex)
    {
        try {
            $name = new AvroName($ex->name, $ex->namespace, $ex->default_namespace);
            $this->assertTrue($ex->is_valid);
            $this->assertEquals($ex->expected_fullname, $name->fullname());
        } catch (AvroSchemaParseException $e) {
            $this->assertFalse($ex->is_valid, sprintf("%s:\n%s",
                $ex,
                $e->getMessage()));
        }
    }

    /**
     * @return array
     */
    public function name_provider()
    {
        return array(array('a', true),
            array('_', true),
            array('1a', false),
            array('', false),
            array(null, false),
            array(' ', false),
            array('Cons', true));
    }

    /**
     * @dataProvider name_provider
     *
     * @param $name
     * @param $is_well_formed
     */
    public function test_name($name, $is_well_formed)
    {
        $this->assertEquals(AvroName::is_well_formed_name($name), $is_well_formed, $name);
    }
}
