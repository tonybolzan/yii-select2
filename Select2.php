<?php

/**
 * Wrapper Widget to use jQuery Select2 in Yii application.
 *
 * Select2 script:
 * @link https://github.com/ivaynberg/select2
 *
 * @author Tonin R. Bolzan <admin@tonybolzan.com>
 */
class Select2 extends CInputWidget {

    /** @var string Path to assets directory published in init() */
    private $assetsDir;

    /** @var array Chosen script settings passed to $.fn.chosen() */
    private $settings = array();

    /** @var bool Multiple or single item should be selected */
    public $multiple = false;

    /** @var array See CHtml::listData() */
    public $data;

    /** Publish assets and set default values for properties */
    public function init() {
        $dir = dirname(__FILE__) . '/assets';
        $this->assetsDir = Yii::app()->assetManager->publish($dir);

        if ($this->multiple) {
            $this->htmlOptions['multiple'] = true;
        } elseif (isset($this->htmlOptions['multiple'])) {
            $this->multiple = true;
        }

        if (isset($this->htmlOptions['placeholder'])) {
            $this->settings['placeholder'] = $this->htmlOptions['placeholder'];
        } elseif (isset($this->htmlOptions['data-placeholder'])) {
            $this->settings['placeholder'] = $this->htmlOptions['data-placeholder'];
        }

        // Default Messages
        $this->settings = CMap::mergeArray(array(
            'formatNoMatches'       => 'js:function () { return "' . Yii::t('Select2.core', "No matches found") . '"; }',
            'formatInputTooShort'   => 'js:function (input, min) { var n = min - input.length; return "' . Yii::t('Select2.core', "Please enter") . '" + " " + n + " " + "' . Yii::t('Select2.core', "more character") . '" + (n == 1? "" : "' . Yii::t('Select2.core', "s") . '"); }',
            'formatInputTooLong'    => 'js:function (input, max) { var n = input.length - max; return "' . Yii::t('Select2.core', "Please enter") . '" + " " + n + " " + "' . Yii::t('Select2.core', "less character") . '" + (n == 1? "" : "' . Yii::t('Select2.core', "s") . '"); }',
            'formatSelectionTooBig' => 'js:function (limit) { return "' . Yii::t('Select2.core', "You can only select") . '" + " " + limit + " " + "' . Yii::t('Select2.core', "item") . '" + (limit == 1 ? "" : "' . Yii::t('Select2.core', "s") . '"); }',
            'formatLoadMore'        => 'js:function (pageNumber) { return "' . Yii::t('Select2.core', "Loading more results...") . '"; }',
            'formatSearching'       => 'js:function () { return "' . Yii::t('Select2.core', "Searching...") . '"; }',
        ), $this->settings);

        if (isset($this->htmlOptions['select2Options'])) {
            $this->settings = CMap::mergeArray($this->settings, $this->htmlOptions['select2Options']);
            unset($this->htmlOptions['select2Options']);
        }
    }

    /** Render widget html and register client scripts */
    public function run() {
        list($name, $id) = $this->resolveNameID();

        if (isset($this->htmlOptions['id'])) {
            $id = $this->htmlOptions['id'];
        } else {
            $this->htmlOptions['id'] = $id;
        }

        if (isset($this->htmlOptions['name'])) {
            $name = $this->htmlOptions['name'];
        }

        if (isset($this->model)) {
            echo CHtml::dropDownList($name, $this->model->{$this->attribute}, $this->data, $this->htmlOptions);
        } else {
            echo CHtml::dropDownList($name, $this->value, $this->data, $this->htmlOptions);
        }

        $this->registerScripts($id);
    }

    /** Register client scripts */
    private function registerScripts($id) {
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');

        if (YII_DEBUG) {
            $cs->registerScriptFile($this->assetsDir . '/select2.js');
            $cs->registerCssFile($this->assetsDir . '/select2.css');
        } else {
            $cs->registerScriptFile($this->assetsDir . '/select2.min.js');
            $cs->registerCssFile($this->assetsDir . '/select2.min.css');
        }

        $settings = CJavaScript::encode($this->settings);
        $cs->registerScript("{$id}_select2", "$('#{$id}').select2({$settings});");
    }

    /** Single item select */
    public static function dropDownList($name, $select, $data, $htmlOptions = array()) {
        return Yii::app()->getController()->widget(__CLASS__, array(
                    'name'  => $name,
                    'value' => $select,
                    'data'  => $data,
                    'htmlOptions' => $htmlOptions,
               ), true);
    }

    public static function activeDropDownList($model, $attribute, $data, $htmlOptions = array()) {
        return self::dropDownList(CHtml::activeName($model, $attribute), CHtml::value($model, $attribute), $data, $htmlOptions);
    }

    /** Multiple items select */
    public static function multiSelect($name, $select, $data, $htmlOptions = array()) {
        return Yii::app()->getController()->widget(__CLASS__, array(
                    'name' => $name,
                    'value' => $select,
                    'data' => $data,
                    'htmlOptions' => $htmlOptions,
                    'multiple' => true,
               ), true);
    }

    public static function activeMultiSelect($model, $attribute, $data, $htmlOptions = array()) {
        return self::multiSelect(CHtml::activeName($model, $attribute).'[]', CHtml::value($model, $attribute), $data, $htmlOptions);
    }

}
