<?php
/**
 * SDaiLover Widgets for Yii2 Framework.
 * 
 * A package of UI Elements to display and use in View files. 
 * The package in it is integrated with Bootstrap & jQuery.
 * 
 * @link      https://www.sdailover.com
 * @email     teams@sdailover.com
 * @copyright Copyright (c) ID 2024 SDaiLover. All rights reserved.
 * @license   https://www.sdailover.com/license.html
 * This software using Yii Framework has released under the terms of the BSD License.
 */

namespace sdailover\yii\widgets\grid;
/**
 * Copyright (c) ID 2024 SDaiLover (https://www.sdailover.com).
 * All rights reserved.
 *
 * Licensed under the Clause BSD License, Version 3.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.sdailover.com/license.html
 *
 * This software is provided by the SDAILOVER and
 * CONTRIBUTORS "AS IS" and Any Express or IMPLIED WARRANTIES, INCLUDING,
 * BUT NOT LIMITED TO, the implied warranties of merchantability and
 * fitness for a particular purpose are disclaimed in no event shall the
 * SDaiLover or Contributors be liable for any direct,
 * indirect, incidental, special, exemplary, or consequential damages
 * arising in anyway out of the use of this software, even if advised
 * of the possibility of such damage.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
use Yii;
use yii\grid\CheckboxColumn;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * SDaiLover Checkbox Column Grid class.
 * 
 * @author    : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.stephanusdai.web.id
 */
class SDCheckboxColumn extends CheckboxColumn
{
    public $headerOptions = ['scope'=>'col', 'style'=>'width:40px', 'class'=>'column-primary'];
    public $contentOptions = ['scope'=>'row'];
    public $cssClass = 'form-check-input';

    public function renderDataCell($model, $key, $index)
    {
        if ($this->contentOptions instanceof Closure) {
            $options = call_user_func($this->contentOptions, $model, $key, $index, $this);
        } else {
            $options = $this->contentOptions;
        }
        return Html::tag('th', $this->renderDataCellContent($model, $key, $index), $options);
    }

    protected function renderDataCellContent($model, $key, $index)
    {
        if ($this->content !== null) {
            return parent::renderDataCellContent($model, $key, $index);
        }
        if ($this->checkboxOptions instanceof Closure) {
            $options = call_user_func($this->checkboxOptions, $model, $key, $index, $this);
        } else {
            $options = $this->checkboxOptions;
        }
        if (!isset($options['value'])) {
            $options['value'] = is_array($key) ? Json::encode($key) : $key;
        }
        if ($this->cssClass !== null) {
            Html::addCssClass($options, $this->cssClass);
        }
      
        $checkbox = Html::checkbox($this->name, !empty($options['checked']), $options);
        $checkbox .= Html::tag('span', '', ['class'=>'form-check-label']);
        return '<div class="custom-control custom-checkbox">' . $checkbox . '</div>';
    }
    
    protected function renderHeaderCellContent()
    {
        if ($this->header !== null || !$this->multiple) {
            return parent::renderHeaderCellContent();
        }
        $checkbox = Html::checkbox($this->getHeaderCheckBoxName(), false, ['class' => 'form-check-input select-on-check-all']);
        $checkbox .= Html::tag('label', '', ['class'=>'form-check-label']);
        return '<div class="custom-control custom-checkbox">' . $checkbox . '</div>';
    }

    public function registerClientScript()
    {
        $id = $this->grid->options['id'];
        $options = Json::encode([
            'name' => $this->name,
            'class' => $this->cssClass,
            'multiple' => $this->multiple,
            'checkAll' => $this->grid->showHeader ? $this->getHeaderCheckBoxName() : null,
        ]);
        $this->grid->getView()->registerJs("SDaiLover.setPlugin('yiiGridView',{'selectionColumn':function(){jQuery('#$id').yiiGridView('setSelectionColumn',$options)}});");
        parent::registerClientScript();
    }
}