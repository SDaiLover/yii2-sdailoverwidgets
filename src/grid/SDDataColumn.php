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
use yii\grid\DataColumn;
use yii\helpers\Html;

/**
 * SDaiLover Data Column Grid class.
 * 
 * @author    : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.stephanusdai.web.id
 */
class SDDataColumn extends DataColumn
{
    public $expandLabel;
    public $expandOptions = ['class'=>'grid-expand'];
    public $headerOptions = ['scope'=>'col'];

    public function init()
    {
        parent::init();
        if (!isset($this->expandOptions['class']))
            $this->expandOptions['class'] = 'grid-expand';
        if ($this->expandLabel===null)
            $this->expandLabel = '<span class="bi bi-caret-down-square-fill"></span>';

    }

    public function renderDataCell($model, $key, $index)
    {
        if ($this->contentOptions instanceof Closure) {
            $options = call_user_func($this->contentOptions, $model, $key, $index, $this);
        } else {
            $options = $this->contentOptions;
        }
        if (!isset($options['data-header']))
            $options['data-header'] = $this->getHeaderCellLabel();
        $content = $this->renderDataCellContent($model, $key, $index);
        if (isset($options['class'])) {
            if ($options['class'] === 'title') {
                $content .= Html::a($this->expandLabel, '#', $this->expandOptions);
            }
        }
        return Html::tag('td', $content, $options);
    }

    protected function renderHeaderCellContent()
    {
        $label = $this->getHeaderCellLabel();

        if ($this->attribute !== null && $this->enableSorting &&
            ($sort = $this->grid->dataProvider->getSort()) !== false && $sort->hasAttribute($this->attribute)) {
            $class = 'sorting ';
            if (($direction = $sort->getAttributeOrder($this->attribute)) !== null) {
                $class .= $direction === SORT_DESC ? 'sorting_desc' : 'sorting_asc';
            }
            Html::addCssClass($this->sortLinkOptions, $class);
            return $sort->link($this->attribute, array_merge($this->sortLinkOptions, ['label' => $label]));
        }

        return parent::renderHeaderCellContent();
    }
}