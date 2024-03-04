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
use yii\grid\GridView;
use yii\grid\GridViewAsset;
use yii\helpers\Json;
use yii\helpers\Html;

/**
 * SDaiLover Grid View class.
 * 
 * @author    : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.stephanusdai.web.id
 */
class SDGridView extends GridView
{
    public $dataColumnClass;
    public $options = ['class' => 'grid-view grid-responsive'];
    public $tableOptions = [];
    public $layout = "{items}\n<div class=\"row\"><div class=\"col-sm-12 col-md-5\">{summary}</div>\n<div class=\"col-sm-12 col-md-7\">{pager}</div></div>";

    public function init()
    {
        if ($this->dataColumnClass===null)
            $this->dataColumnClass = SDDataColumn::classname();
        if (!isset($this->tableOptions['class']))
            Html::addCssClass($this->tableOptions, 'table table-striped table-bordered');
        if (!isset($this->pager['class']))
            $this->pager['class'] = SDLinkPager::className();
        parent::init();
    }

    public function run()
    {
        $id = $this->options['id'];
        $options = Json::htmlEncode($this->getClientOptions());
        $view = $this->getView();
        GridViewAsset::register($view);
        $view->registerJs("SDaiLover.setPlugin('yiiGridView',{'filterUrl':function(){jQuery('#$id').yiiGridView($options)}});");
        parent::run();
    }
}