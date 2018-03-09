<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class FieldParserTest extends TestCase
{
    /**
     * @dataProvider fieldArrayProvider
     */
    public function testDoesReturnAbstractFieldObject(array $fieldArray): void
    {
        $fieldParser = new App\Parsers\FieldParser();
        $field = $fieldParser->parse($fieldArray);

        $this->assertInstanceOf(App\Models\AbstractField::class, $field);
    }

    /**
     * @depends testDoesReturnAbstractFieldObject
     * @dataProvider allFieldTypesProvider
     */
    public function testCanParseAllFieldTypes(array $fieldArray): void
    {
        $fieldParser = new App\Parsers\FieldParser();
        $field = $fieldParser->parse($fieldArray);

        $this->assertInstanceOf(App\Models\AbstractField::class, $field);
    }

    /**
     * @depends testDoesReturnAbstractFieldObject
     * @dataProvider fieldArrayProvider
     */
    public function testCanParseKeyField(array $fieldArray): void
    {
        $fieldParser = new App\Parsers\FieldParser();
        $field = $fieldParser->parse($fieldArray);

        $this->assertEquals($field->getKey(), $fieldArray['key']);
    }

    /**
     * @depends testDoesReturnAbstractFieldObject
     * @depends testCanParseKeyField
     * @dataProvider fieldArrayProvider
     */
    public function testCanParseEmptyKeyField(array $fieldArray): void
    {
        $fieldArray['key'] = '';

        $fieldParser = new App\Parsers\FieldParser();
        $field = $fieldParser->parse($fieldArray);

        $this->assertNull($field->getKey());
    }

    /**
     * @depends testDoesReturnAbstractFieldObject
     * @depends testCanParseKeyField
     * @dataProvider fieldArrayProvider
     */
    public function testCanParseWithoutKeyField(array $fieldArray): void
    {
        unset($fieldArray['key']);

        $fieldParser = new App\Parsers\FieldParser();
        $field = $fieldParser->parse($fieldArray);

        $this->assertNull($field->getKey());
    }

    /**
     * @depends testDoesReturnAbstractFieldObject
     * @dataProvider fieldArrayProvider
     */
    public function testCanParseLabelField(array $fieldArray): void
    {
        $fieldParser = new App\Parsers\FieldParser();
        $field = $fieldParser->parse($fieldArray);

        $this->assertEquals($field->getLabel(), $fieldArray['label']);
    }

    /**
     * @depends testDoesReturnAbstractFieldObject
     * @depends testCanParseLabelField
     * @dataProvider fieldArrayProvider
     */
    public function testExceptionOnEmptyLabelField(array $fieldArray): void
    {
        unset($fieldArray['label']);
        $this->expectException(OutOfBoundsException::class);

        $fieldParser = new App\Parsers\FieldParser();
        $field = $fieldParser->parse($fieldArray);

        $this->assertEquals($field->getLabel(), $fieldArray['label']);
    }

    /**
     * @depends testDoesReturnAbstractFieldObject
     * @dataProvider fieldArrayProvider
     */
    public function testCanParseCorrectAmountOfSubFields(array $fieldArray): void
    {
        $count = isset($fieldArray['sub_fields']) ? $fieldArray['sub_fields'] : 0;

        $fieldParser = new App\Parsers\FieldParser();
        $field = $fieldParser->parse($fieldArray);

        $this->assertCount($count, $field->getSubFields());
    }

    /**
     * @depends testDoesReturnAbstractFieldObject
     * @depends testCanParseCorrectAmountOfSubFields
     * @dataProvider fieldArrayProvider
     */
    public function testCanParseEmptySubFields(array $fieldArray): void
    {
        $fieldArray['sub_fields'] = [];

        $fieldParser = new App\Parsers\FieldParser();
        $field = $fieldParser->parse($fieldArray);

        $this->assertCount(0, $field->getSubFields());
    }

    /**
     * @depends testDoesReturnAbstractFieldObject
     * @depends testCanParseCorrectAmountOfSubFields
     * @dataProvider fieldArrayProvider
     */
    public function testCanParseWithoutSubFields(array $fieldArray): void
    {
        unset($fieldArray['sub_fields']);

        $fieldParser = new App\Parsers\FieldParser();
        $field = $fieldParser->parse($fieldArray);

        $this->assertCount(0, $field->getSubFields());
    }

    /**
     * @depends testDoesReturnAbstractFieldObject
     * @dataProvider fieldArrayProvider
     */
    public function testCanParseCorrectAmountOfOptions(array $fieldArray): void
    {
        $fieldParser = new App\Parsers\FieldParser();
        $field = $fieldParser->parse($fieldArray);

        $non_option_fields = ['key', 'label', 'type', 'sub_fields', 'layouts'];

        $optionFields = array_filter($fieldArray, function($value, $key) use ($non_option_fields) {
            return (!in_array($key, $non_option_fields));
        }, ARRAY_FILTER_USE_BOTH);

        $this->assertCount(count($optionFields), $field->getOptions());
    }

    /**
     * @depends testDoesReturnAbstractFieldObject
     * @depends testCanParseCorrectAmountOfOptions
     * @dataProvider fieldArrayProvider
     */
    public function testCanParseZeroOptions(array $fieldArray): void
    {
        $keysToKeep = ['key', 'label', 'type', 'sub_fields', 'layouts'];
        $fieldArray = array_filter($fieldArray, function($value, $key) use ($keysToKeep) {
            return (in_array($key, $keysToKeep));
        }, ARRAY_FILTER_USE_BOTH);

        $fieldParser = new App\Parsers\FieldParser();
        $field = $fieldParser->parse($fieldArray);

        $this->assertNotNull($field->getOptions());
        $this->assertCount(0, $field->getOptions());
    }

    public function fieldArrayProvider(): array
    {
        return [
            // array() syntax used below, as it comes from export file
            'Some Field' => [
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
            ]
        ];
    }

    public function allFieldTypesProvider(): array
    {
        return [
            'Default Text Field' => [
                array (
                    'key' => 'field_5aa26e4dd40e4',
                    'label' => 'Text',
                    'name' => 'text',
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
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                    'readonly' => 0,
                    'disabled' => 0,
                ),
            ],
            'Default textarea field' => [
                array (
                    'key' => 'field_5aa26e5cd40e5',
                    'label' => 'Text Area',
                    'name' => 'text_area',
                    'type' => 'textarea',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'maxlength' => '',
                    'rows' => '',
                    'new_lines' => 'wpautop',
                    'readonly' => 0,
                    'disabled' => 0,
                ),
            ],
            'Default number field' => [
                array (
                    'key' => 'field_5aa26ec2d40e6',
                    'label' => 'Number',
                    'name' => 'number',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => '',
                    'readonly' => 0,
                    'disabled' => 0,
                ),
            ],
            'Default email field' => [
                array (
                    'key' => 'field_5aa26ecad40e7',
                    'label' => 'Email',
                    'name' => 'email',
                    'type' => 'email',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
            ],
            'Default url field' => [
                array (
                    'key' => 'field_5aa26ecfd40e8',
                    'label' => 'Url',
                    'name' => 'url',
                    'type' => 'url',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                ),
            ],
            'Default password field' => [
                array (
                    'key' => 'field_5aa26ed4d40e9',
                    'label' => 'Password',
                    'name' => 'password',
                    'type' => 'password',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'readonly' => 0,
                    'disabled' => 0,
                ),
            ],
            'Default wysiwyg field' => [
                array (
                    'key' => 'field_5aa26ed9d40ea',
                    'label' => 'Wysiwyg Editor',
                    'name' => 'wysiwyg_editor',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                ),
            ],
            'Default oembed field' => [
                array (
                    'key' => 'field_5aa26ee1d40eb',
                    'label' => 'oEmbed',
                    'name' => 'oembed',
                    'type' => 'oembed',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'width' => '',
                    'height' => '',
                ),
            ],
            'Default image field' => [
                array (
                    'key' => 'field_5aa26ee6d40ec',
                    'label' => 'Image',
                    'name' => 'image',
                    'type' => 'image',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                    'preview_size' => 'thumbnail',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ),
            ],
            'Default file field' => [
                array (
                    'key' => 'field_5aa26eead40ed',
                    'label' => 'File',
                    'name' => 'file',
                    'type' => 'file',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                    'library' => 'all',
                    'min_size' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ),
            ],
            'Default gallery field' => [
                array (
                    'key' => 'field_5aa26eeed40ee',
                    'label' => 'Gallery',
                    'name' => 'gallery',
                    'type' => 'gallery',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'min' => '',
                    'max' => '',
                    'preview_size' => 'thumbnail',
                    'insert' => 'append',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ),
            ],
            'Default select field' => [
                array (
                    'key' => 'field_5aa26ef4d40ef',
                    'label' => 'Select',
                    'name' => 'select',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array (
                    ),
                    'default_value' => array (
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'placeholder' => '',
                    'disabled' => 0,
                    'readonly' => 0,
                ),
            ],
            'Default checkbox field' => [
                array (
                    'key' => 'field_5aa26ef9d40f0',
                    'label' => 'Checkbox',
                    'name' => 'checkbox',
                    'type' => 'checkbox',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array (
                    ),
                    'default_value' => array (
                    ),
                    'layout' => 'vertical',
                    'toggle' => 0,
                ),
            ],
            'Default radio field' => [
                array (
                    'key' => 'field_5aa26f00d40f1',
                    'label' => 'Radio Button',
                    'name' => 'radio_button',
                    'type' => 'radio',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array (
                    ),
                    'allow_null' => 0,
                    'other_choice' => 0,
                    'save_other_choice' => 0,
                    'default_value' => '',
                    'layout' => 'vertical',
                ),
            ],
            'Default true_false field' => [
                array (
                    'key' => 'field_5aa26f05d40f2',
                    'label' => 'True / False',
                    'name' => 'true_false',
                    'type' => 'true_false',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'message' => '',
                    'default_value' => 0,
                ),
            ],
            'Default post_object field' => [
                array (
                    'key' => 'field_5aa26f0cd40f3',
                    'label' => 'Post Object',
                    'name' => 'post_object',
                    'type' => 'post_object',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'post_type' => array (
                    ),
                    'taxonomy' => array (
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'return_format' => 'object',
                    'ui' => 1,
                ),
            ],
            'Default page_link field' => [
                array (
                    'key' => 'field_5aa26f1cd40f4',
                    'label' => 'Page Link',
                    'name' => 'page_link',
                    'type' => 'page_link',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'post_type' => array (
                    ),
                    'taxonomy' => array (
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                ),
            ],
            'Default relationship field' => [
                array (
                    'key' => 'field_5aa26f23d40f5',
                    'label' => 'Relationship',
                    'name' => 'relationship',
                    'type' => 'relationship',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'post_type' => array (
                    ),
                    'taxonomy' => array (
                    ),
                    'filters' => array (
                        0 => 'search',
                        1 => 'post_type',
                        2 => 'taxonomy',
                    ),
                    'elements' => '',
                    'min' => '',
                    'max' => '',
                    'return_format' => 'object',
                ),
            ],
            'Default taxonomy field' => [
                array (
                    'key' => 'field_5aa26f29d40f6',
                    'label' => 'Taxonomy',
                    'name' => 'taxonomy',
                    'type' => 'taxonomy',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'taxonomy' => 'category',
                    'field_type' => 'checkbox',
                    'allow_null' => 0,
                    'add_term' => 1,
                    'save_terms' => 0,
                    'load_terms' => 0,
                    'return_format' => 'id',
                    'multiple' => 0,
                ),
            ],
            'Default user field' => [
                array (
                    'key' => 'field_5aa26f2fd40f7',
                    'label' => 'User',
                    'name' => 'user',
                    'type' => 'user',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'role' => '',
                    'allow_null' => 0,
                    'multiple' => 0,
                ),
            ],
            'Default google_map field' => [
                array (
                    'key' => 'field_5aa26f34d40f8',
                    'label' => 'Google Map',
                    'name' => 'google_map',
                    'type' => 'google_map',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'center_lat' => '',
                    'center_lng' => '',
                    'zoom' => '',
                    'height' => '',
                ),
            ],
            'Default date_picker field' => [
                array (
                    'key' => 'field_5aa26f39d40f9',
                    'label' => 'Date Picker',
                    'name' => 'date_picker',
                    'type' => 'date_picker',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'display_format' => 'd/m/Y',
                    'return_format' => 'd/m/Y',
                    'first_day' => 1,
                ),
            ],
            'Default date_time_picker field' => [
                array (
                    'key' => 'field_5aa26f3ed40fa',
                    'label' => 'Date Time Picker',
                    'name' => 'date_time_picker',
                    'type' => 'date_time_picker',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'display_format' => 'd/m/Y g:i a',
                    'return_format' => 'd/m/Y g:i a',
                    'first_day' => 1,
                ),
            ],
            'Default time_picker field' => [
                array (
                    'key' => 'field_5aa26f46d40fb',
                    'label' => 'Time Picker',
                    'name' => 'time_picker',
                    'type' => 'time_picker',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'display_format' => 'g:i a',
                    'return_format' => 'g:i a',
                ),
            ],
            'Default color_picker field' => [
                array (
                    'key' => 'field_5aa26f4ed40fc',
                    'label' => 'Color Picker',
                    'name' => 'color_picker',
                    'type' => 'color_picker',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                ),
            ],
            'Default message field' => [
                array (
                    'key' => 'field_5aa26f53d40fd',
                    'label' => 'Message',
                    'name' => '',
                    'type' => 'message',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'message' => '',
                    'new_lines' => 'wpautop',
                    'esc_html' => 0,
                ),
            ],
            'Default tab field' => [
                array (
                    'key' => 'field_5aa26f5ad40fe',
                    'label' => 'Tab',
                    'name' => 'tab',
                    'type' => 'tab',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'placement' => 'top',
                    'endpoint' => 0,
                ),
            ],
            'Default repeater field' => [
                array (
                    'key' => 'field_5aa26f5fd40ff',
                    'label' => 'Repeater',
                    'name' => 'repeater',
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'collapsed' => '',
                    'min' => '',
                    'max' => '',
                    'layout' => 'table',
                    'button_label' => 'Add Row',
                    'sub_fields' => array (
                    ),
                ),
            ],
            // 'Default flexible_content field' => [
            //     array (
            //         'key' => 'field_5aa26f65d4100',
            //         'label' => 'Flexible Content',
            //         'name' => 'flexible_content',
            //         'type' => 'flexible_content',
            //         'instructions' => '',
            //         'required' => '',
            //         'conditional_logic' => '',
            //         'wrapper' => array (
            //             'width' => '',
            //             'class' => '',
            //             'id' => '',
            //         ),
            //         'button_label' => 'Add Row',
            //         'min' => '',
            //         'max' => '',
            //         'layouts' => array (
            //             array (
            //                 'key' => '5aa26f68c36cf',
            //                 'name' => '',
            //                 'label' => '',
            //                 'display' => 'block',
            //                 'sub_fields' => array (
            //                 ),
            //                 'min' => '',
            //                 'max' => '',
            //             ),
            //         ),
            //     ),
            // ]
        ];
    }
}
