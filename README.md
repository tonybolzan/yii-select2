# Select2 for Yii

Wrapper Widget to use jQuery Plugin Select2 in Yii application.

Select2 script:
https://github.com/ivaynberg/select2

## Installation
Download or clone this repository and paste in `/protected/extensions/select2`

## Usage
In your source code
```php
Yii::import('ext.select2.Select2');
```
Or in config
```php
    ...
    'import' => array(
        ...
        'ext.select2.Select2',
        ...
    ),
    ...
```

## Example:
You can replace the <br>
`CHtml::dropDownList()` by `Select2::dropDownList()` <br>
`CHtml::activeDropDownList()` by `Select2::activeDropDownList()`

Or
```php
    ...
    echo Select2::multiSelect("test", null, array('test1','test2'), array(
        'required' => 'required',
        'placeholder' => 'This is a placeholder',
        'select2Options' => array(
            'maximumSelectionSize' => 2,
        ),
    ));
    ...
    echo Select2::activeMultiSelect($model, "attr", array('test1','test2'), array(
        'placeholder' => 'This is a placeholder',
    ));
    ...
```
Or this

```php
    ...
    $this->widget('Select2', array(
       'name' => 'inputName',
       'value' => 2,
       'data' => array(
           1 => 'Option 1',
           2 => 'Option 2',
           3 => 'Option 3',
           4 => 'Option 4',
        ),
    ));
    ...
```
