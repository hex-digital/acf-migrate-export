<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class FieldFactoryTest extends TestCase
{
    /**
     * @dataProvider fieldDataProvider
     */
    public function testDoesReturnAbstractFieldObject(array $fieldDataFromParser): void
    {
        $fieldObject = App\Models\AbstractField::createField(
            $fieldDataFromParser['key'],
            $fieldDataFromParser['label'],
            $fieldDataFromParser['type'],
            $fieldDataFromParser['sub_fields'],
            $fieldDataFromParser['options']
        );

        $this->assertInstanceOf(App\Models\AbstractField::class, $fieldObject);
    }

    /**
     * @depends testDoesReturnAbstractFieldObject
     * @dataProvider allFieldsDataProvider
     */
    public function testDoesReturnCorrectConcreteField(array $fieldDataFromParser): void
    {
        $fieldObject = App\Models\AbstractField::createField(
            $fieldDataFromParser['key'],
            $fieldDataFromParser['label'],
            $fieldDataFromParser['type'],
            $fieldDataFromParser['sub_fields'],
            $fieldDataFromParser['options']
        );

        switch ($fieldDataFromParser['type']) {
            case 'checkbox':
                $this->assertInstanceOf(App\Models\FieldTypes\CheckBox::class, $fieldObject);
                break;
            case 'color_picker':
                $this->assertInstanceOf(App\Models\FieldTypes\ColorPicker::class, $fieldObject);
                break;
            case 'date_picker':
                $this->assertInstanceOf(App\Models\FieldTypes\DatePicker::class, $fieldObject);
                break;
            case 'date_time_picker':
                $this->assertInstanceOf(App\Models\FieldTypes\DateTimePicker::class, $fieldObject);
                break;
            case 'email':
                $this->assertInstanceOf(App\Models\FieldTypes\Email::class, $fieldObject);
                break;
            case 'file':
                $this->assertInstanceOf(App\Models\FieldTypes\File::class, $fieldObject);
                break;
            case 'flexible_content':
                $this->assertInstanceOf(App\Models\FieldTypes\FlexibleContent::class, $fieldObject);
                break;
            case 'gallery':
                $this->assertInstanceOf(App\Models\FieldTypes\Gallery::class, $fieldObject);
                break;
            case 'google_map':
                $this->assertInstanceOf(App\Models\FieldTypes\GoogleMap::class, $fieldObject);
                break;
            case 'image':
                $this->assertInstanceOf(App\Models\FieldTypes\Image::class, $fieldObject);
                break;
            case 'layout':
                $this->assertInstanceOf(App\Models\FieldTypes\Layout::class, $fieldObject);
                break;
            case 'message':
                $this->assertInstanceOf(App\Models\FieldTypes\Message::class, $fieldObject);
                break;
            case 'number':
                $this->assertInstanceOf(App\Models\FieldTypes\Number::class, $fieldObject);
                break;
            case 'oembed':
                $this->assertInstanceOf(App\Models\FieldTypes\Oembed::class, $fieldObject);
                break;
            case 'page_link':
                $this->assertInstanceOf(App\Models\FieldTypes\PageLink::class, $fieldObject);
                break;
            case 'password':
                $this->assertInstanceOf(App\Models\FieldTypes\Password::class, $fieldObject);
                break;
            case 'post_object':
                $this->assertInstanceOf(App\Models\FieldTypes\PostObject::class, $fieldObject);
                break;
            case 'radio':
                $this->assertInstanceOf(App\Models\FieldTypes\Radio::class, $fieldObject);
                break;
            case 'relationship':
                $this->assertInstanceOf(App\Models\FieldTypes\Relationship::class, $fieldObject);
                break;
            case 'repeater':
                $this->assertInstanceOf(App\Models\FieldTypes\Repeater::class, $fieldObject);
                break;
            case 'select':
                $this->assertInstanceOf(App\Models\FieldTypes\Select::class, $fieldObject);
                break;
            case 'tab':
                $this->assertInstanceOf(App\Models\FieldTypes\Tab::class, $fieldObject);
                break;
            case 'taxonomy':
                $this->assertInstanceOf(App\Models\FieldTypes\Taxonomy::class, $fieldObject);
                break;
            case 'text':
                $this->assertInstanceOf(App\Models\FieldTypes\Text::class, $fieldObject);
                break;
            case 'textarea':
                $this->assertInstanceOf(App\Models\FieldTypes\TextArea::class, $fieldObject);
                break;
            case 'time_picker':
                $this->assertInstanceOf(App\Models\FieldTypes\TimePicker::class, $fieldObject);
                break;
            case 'true_false':
                $this->assertInstanceOf(App\Models\FieldTypes\TrueFalse::class, $fieldObject);
                break;
            case 'url':
                $this->assertInstanceOf(App\Models\FieldTypes\Url::class, $fieldObject);
                break;
            case 'user':
                $this->assertInstanceOf(App\Models\FieldTypes\User::class, $fieldObject);
                break;
            case 'wysiwyg':
                $this->assertInstanceOf(App\Models\FieldTypes\Wysiwyg::class, $fieldObject);
                break;
        }

    }

    public function fieldDataProvider(): array
    {
        return [
            'Minimal test, text field' => [
                [
                    'key' => 'field_589080989511c',
                    'label' => 'Group Title',
                    'type' => 'text',
                    'sub_fields' => [],
                    'options' => [],
                ]
            ],
        ];
    }

    public function allFieldsDataProvider(): array
    {
        return [
            'Default text field' => [
                [
                    'key' => 'field_5aa26e4dd40e4',
                    'label' => 'Text',
                    'type' => 'text',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ]
                ],
            ],
            'Default textarea field' => [
                [
                    'key' => 'field_5aa26e5cd40e5',
                    'label' => 'Text Area',
                    'type' => 'textarea',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'text_area',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'maxlength' => '',
                        'rows' => '',
                        'new_lines' => 'wpautop',
                        'readonly' => 0,
                        'disabled' => 0,
                    ]
                ],
            ],
            'Default number field' => [
                [
                    'key' => 'field_5aa26ec2d40e6',
                    'label' => 'Number',
                    'type' => 'number',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ]
                ],
            ],
            'Default email field' => [
                [
                    'key' => 'field_5aa26ecad40e7',
                    'label' => 'Email',
                    'type' => 'email',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'email',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ]
                ],
            ],
            'Default url field' => [
                [
                    'key' => 'field_5aa26ecfd40e8',
                    'label' => 'Url',
                    'type' => 'url',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'url',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                    ]
                ],
            ],
            'Default password field' => [
                [
                    'key' => 'field_5aa26ed4d40e9',
                    'label' => 'Password',
                    'type' => 'password',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'password',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ]
                ],
            ],
            'Default wysiwyg field' => [
                [
                    'key' => 'field_5aa26ed9d40ea',
                    'label' => 'Wysiwyg Editor',
                    'type' => 'wysiwyg',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'wysiwyg_editor',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 1,
                    ]
                ],
            ],
            'Default oembed field' => [
                [
                    'key' => 'field_5aa26ee1d40eb',
                    'label' => 'oEmbed',
                    'name' => 'oembed',
                    'type' => 'oembed',
                    'sub_fields' => [],
                    'options' => [
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'width' => '',
                        'height' => '',
                    ]
                ],
            ],
            'Default image field' => [
                [
                    'key' => 'field_5aa26ee6d40ec',
                    'label' => 'Image',
                    'type' => 'image',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
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
                    ]
                ],
            ],
            'Default file field' => [
                [
                    'key' => 'field_5aa26eead40ed',
                    'label' => 'File',
                    'type' => 'file',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'file',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'return_format' => 'array',
                        'library' => 'all',
                        'min_size' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ]
                ],
            ],
            'Default gallery field' => [
                [
                    'key' => 'field_5aa26eeed40ee',
                    'label' => 'Gallery',
                    'type' => 'gallery',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'gallery',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
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
                    ]
                ],
            ],
            'Default select field' => [
                [
                    'key' => 'field_5aa26ef4d40ef',
                    'label' => 'Select',
                    'type' => 'select',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'choices' => [],
                        'default_value' => [],
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'placeholder' => '',
                        'disabled' => 0,
                        'readonly' => 0,
                    ]
                ],
            ],
            'Default checkbox field' => [
                [
                    'key' => 'field_5aa26ef9d40f0',
                    'label' => 'Checkbox',
                    'type' => 'checkbox',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'checkbox',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'choices' => [],
                        'default_value' => [],
                        'layout' => 'vertical',
                        'toggle' => 0,
                    ]
                ],
            ],
            'Default radio field' => [
                [
                    'key' => 'field_5aa26f00d40f1',
                    'label' => 'Radio Button',
                    'type' => 'radio',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'radio_button',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'choices' => [],
                        'allow_null' => 0,
                        'other_choice' => 0,
                        'save_other_choice' => 0,
                        'default_value' => '',
                        'layout' => 'vertical',
                    ]
                ],
            ],
            'Default true_false field' => [
                [
                    'key' => 'field_5aa26f05d40f2',
                    'label' => 'True / False',
                    'type' => 'true_false',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'message' => '',
                        'default_value' => 0,
                    ]
                ],
            ],
            'Default post_object field' => [
                [
                    'key' => 'field_5aa26f0cd40f3',
                    'label' => 'Post Object',
                    'type' => 'post_object',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'post_object',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'post_type' => [],
                        'taxonomy' => [],
                        'allow_null' => 0,
                        'multiple' => 0,
                        'return_format' => 'object',
                        'ui' => 1,
                    ]
                ],
            ],
            'Default page_link field' => [
                [
                    'key' => 'field_5aa26f1cd40f4',
                    'label' => 'Page Link',
                    'type' => 'page_link',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'page_link',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'post_type' => [],
                        'taxonomy' => [],
                        'allow_null' => 0,
                        'multiple' => 0,
                    ]
                ],
            ],
            'Default relationship field' => [
                [
                    'key' => 'field_5aa26f23d40f5',
                    'label' => 'Relationship',
                    'type' => 'relationship',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'relationship',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'post_type' => [],
                        'taxonomy' => [],
                        'filters' => [
                            0 => 'search',
                            1 => 'post_type',
                            2 => 'taxonomy',
                        ],
                        'elements' => '',
                        'min' => '',
                        'max' => '',
                        'return_format' => 'object',
                    ]
                ],
            ],
            'Default taxonomy field' => [
                [
                    'key' => 'field_5aa26f29d40f6',
                    'label' => 'Taxonomy',
                    'type' => 'taxonomy',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'taxonomy',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'taxonomy' => 'category',
                        'field_type' => 'checkbox',
                        'allow_null' => 0,
                        'add_term' => 1,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'return_format' => 'id',
                        'multiple' => 0,
                    ]
                ],
            ],
            'Default user field' => [
                [
                    'key' => 'field_5aa26f2fd40f7',
                    'label' => 'User',
                    'type' => 'user',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'user',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'role' => '',
                        'allow_null' => 0,
                        'multiple' => 0,
                    ]
                ],
            ],
            'Default google_map field' => [
                [
                    'key' => 'field_5aa26f34d40f8',
                    'label' => 'Google Map',
                    'type' => 'google_map',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'google_map',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'center_lat' => '',
                        'center_lng' => '',
                        'zoom' => '',
                        'height' => '',
                    ]
                ],
            ],
            'Default date_picker field' => [
                [
                    'key' => 'field_5aa26f39d40f9',
                    'label' => 'Date Picker',
                    'type' => 'date_picker',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'date_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'display_format' => 'd/m/Y',
                        'return_format' => 'd/m/Y',
                        'first_day' => 1,
                    ]
                ],
            ],
            'Default date_time_picker field' => [
                [
                    'key' => 'field_5aa26f3ed40fa',
                    'label' => 'Date Time Picker',
                    'type' => 'date_time_picker',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'date_time_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'display_format' => 'd/m/Y g:i a',
                        'return_format' => 'd/m/Y g:i a',
                        'first_day' => 1,
                    ]
                ],
            ],
            'Default time_picker field' => [
                [
                    'key' => 'field_5aa26f46d40fb',
                    'label' => 'Time Picker',
                    'type' => 'time_picker',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'time_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'display_format' => 'g:i a',
                        'return_format' => 'g:i a',
                    ]
                ],
            ],
            'Default color_picker field' => [
                [
                    'key' => 'field_5aa26f4ed40fc',
                    'label' => 'Color Picker',
                    'type' => 'color_picker',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'color_picker',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                    ]
                ],
            ],
            'Default message field' => [
                [
                    'key' => 'field_5aa26f53d40fd',
                    'label' => 'Message',
                    'type' => 'message',
                    'sub_fields' => [],
                    'options' => [
                        'name' => '',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'message' => '',
                        'new_lines' => 'wpautop',
                        'esc_html' => 0,
                    ]
                ],
            ],
            'Default tab field' => [
                [
                    'key' => 'field_5aa26f5ad40fe',
                    'label' => 'Tab',
                    'type' => 'tab',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'placement' => 'top',
                        'endpoint' => 0,
                    ]
                ],
            ],
            'Default repeater field' => [
                [
                    'key' => 'field_5aa26f5fd40ff',
                    'label' => 'Repeater',
                    'type' => 'repeater',
                    'sub_fields' => [],
                    'options' => [
                        'name' => 'repeater',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'collapsed' => '',
                        'min' => '',
                        'max' => '',
                        'layout' => 'table',
                        'button_label' => 'Add Row'
                    ]
                ],
            ],
            // 'Default flexible_content field' => [
            //     [
            //         'key' => 'field_5aa26f65d4100',
            //         'label' => 'Flexible Content',
            //         'type' => 'flexible_content',
            //         'sub_fields' => [],
            //         'options' => [
            //             'name' => 'flexible_content',
            //             'instructions' => '',
            //             'required' => '',
            //             'conditional_logic' => '',
            //             'wrapper' => [
            //                 'width' => '',
            //                 'class' => '',
            //                 'id' => '',
            //             ],
            //             'button_label' => 'Add Row',
            //             'min' => '',
            //             'max' => '',
            //             'layouts' => [
            //                 [
            //                     'key' => '5aa26f68c36cf',
            //                     'name' => '',
            //                     'label' => '',
            //                     'display' => 'block',
            //                     'sub_fields' => [],
            //                     'min' => '',
            //                     'max' => '',
            //                 ],
            //             ],
            //         ]
            //     ],
            // ]
        ];
    }
}
