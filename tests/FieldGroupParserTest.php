<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class FieldGroupParserTest extends TestCase
{
    /**
     * @dataProvider fieldGroupArrayProvider
     */
    public function testDoesReturnFieldGroupObject(array $fieldGroupArray): void
    {
        $fieldGroupParser = new App\Parsers\FieldGroupParser();
        $fieldGroup = $fieldGroupParser->parse($fieldGroupArray);

        $this->assertInstanceOf(App\Models\FieldGroup::class, $fieldGroup);
    }

    /**
     * @depends testDoesReturnFieldGroupObject
     * @dataProvider fieldGroupArrayProvider
     */
    public function testCanParseKeyField(array $fieldGroupArray): void
    {
        $fieldGroupParser = new App\Parsers\FieldGroupParser();
        $fieldGroup = $fieldGroupParser->parse($fieldGroupArray);

        $this->assertEquals($fieldGroup->getKey(), $fieldGroupArray['key']);
    }

    /**
     * @depends testDoesReturnFieldGroupObject
     * @depends testCanParseKeyField
     * @dataProvider fieldGroupArrayProvider
     */
    public function testCanParseEmptyKeyField(array $fieldGroupArray): void
    {
        $fieldGroupArray['key'] = '';

        $fieldGroupParser = new App\Parsers\FieldGroupParser();
        $fieldGroup = $fieldGroupParser->parse($fieldGroupArray);

        $this->assertNull($fieldGroup->getKey());
    }

    /**
     * @depends testDoesReturnFieldGroupObject
     * @depends testCanParseKeyField
     * @dataProvider fieldGroupArrayProvider
     */
    public function testCanParseWithoutKeyField(array $fieldGroupArray): void
    {
        unset($fieldGroupArray['key']);

        $fieldGroupParser = new App\Parsers\FieldGroupParser();
        $fieldGroup = $fieldGroupParser->parse($fieldGroupArray);

        $this->assertNull($fieldGroup->getKey());
    }

    /**
     * @depends testDoesReturnFieldGroupObject
     * @dataProvider fieldGroupArrayProvider
     */
    public function testCanParseTitleField(array $fieldGroupArray): void
    {
        $fieldGroupParser = new App\Parsers\FieldGroupParser();
        $fieldGroup = $fieldGroupParser->parse($fieldGroupArray);

        $this->assertEquals($fieldGroup->getTitle(), $fieldGroupArray['title']);
    }

    /**
     * @depends testDoesReturnFieldGroupObject
     * @depends testCanParseTitleField
     * @dataProvider fieldGroupArrayProvider
     */
    public function testExceptionOnEmptyTitleField(array $fieldGroupArray): void
    {
        unset($fieldGroupArray['title']);
        $this->expectException(OutOfBoundsException::class);

        $fieldGroupParser = new App\Parsers\FieldGroupParser();
        $fieldGroup = $fieldGroupParser->parse($fieldGroupArray);

        $this->assertEquals($fieldGroup->getTitle(), $fieldGroupArray['title']);
    }

    /**
     * @depends testDoesReturnFieldGroupObject
     * @dataProvider fieldGroupArrayProvider
     */
    public function testCanParseCorrectAmountOfOptions(array $fieldGroupArray): void
    {
        $fieldGroupParser = new App\Parsers\FieldGroupParser();
        $fieldGroup = $fieldGroupParser->parse($fieldGroupArray);

        $this->assertCount(9, $fieldGroup->getOptions());
    }

    /**
     * @depends testDoesReturnFieldGroupObject
     * @depends testCanParseCorrectAmountOfOptions
     * @dataProvider fieldGroupArrayProvider
     */
    public function testCanParseZeroOptions(array $fieldGroupArray): void
    {
        $fieldGroupArray['fields'] = [];

        $fieldGroupParser = new App\Parsers\FieldGroupParser();
        $fieldGroup = $fieldGroupParser->parse($fieldGroupArray);

        $this->assertNotNull($fieldGroup->getFields());
        $this->assertCount(0, $fieldGroup->getFields());
    }

    /**
     * @depends testDoesReturnFieldGroupObject
     * @dataProvider fieldGroupArrayProvider
     */
    public function testCanParseCorrectAmountOfFields(array $fieldGroupArray): void
    {
        $fieldGroupParser = new App\Parsers\FieldGroupParser();
        $fieldGroup = $fieldGroupParser->parse($fieldGroupArray);

        $this->assertCount(2, $fieldGroup->getFields());
    }

    /**
     * @depends testDoesReturnFieldGroupObject
     * @depends testCanParseCorrectAmountOfFields
     * @dataProvider fieldGroupArrayProvider
     */
    public function testCanParseZeroFields(array $fieldGroupArray): void
    {
        $fieldGroupArray['fields'] = [];

        $fieldGroupParser = new App\Parsers\FieldGroupParser();
        $fieldGroup = $fieldGroupParser->parse($fieldGroupArray);

        $this->assertNotNull($fieldGroup->getFields());
        $this->assertCount(0, $fieldGroup->getFields());
    }

    public function fieldGroupArrayProvider(): array
    {
        return [
            [
                // array() syntax, as it comes from export file
                array (
                    'key' => 'group_5890806ca5bd0',
                    'title' => 'Courses',
                    'fields' => array (
                        array (
                            'key' => 'field_589080989511c',
                            'label' => 'Group Title',
                            'name' => 'group_title',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array (
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'readonly' => 0,
                            'disabled' => 0,
                        ),
                        array (
                            'key' => 'field_589080989521c',
                            'label' => 'Group Slug',
                            'name' => 'group_slug',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array (
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'readonly' => 0,
                            'disabled' => 0,
                        ),
                    ),
                    'location' => array (
                        array (
                            array (
                                'param' => 'page_template',
                                'operator' => '==',
                                'value' => 'templates/courses.php',
                            ),
                        ),
                    ),
                    'menu_order' => 0,
                    'position' => 'normal',
                    'style' => 'default',
                    'label_placement' => 'top',
                    'instruction_placement' => 'label',
                    'hide_on_screen' => '',
                    'active' => 1,
                    'description' => '',
                )
            ]
        ];
    }
}
