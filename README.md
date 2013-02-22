# Select2 for Yii

Wrapper Widget to use jQuery Select2 in Yii application.

Select2 script:
https://github.com/ivaynberg/select2

## Example:
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
```
Or this

```php
    ...
    $this->widget('ext.select2.Select2', array(
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