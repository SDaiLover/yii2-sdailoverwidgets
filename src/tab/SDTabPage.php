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

namespace sdailover\yii\widgets\tab;
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
use yii\base\BaseObject;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * SDaiLover Tab Page class.
 * 
 * @author    : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.stephanusdai.web.id
 */
class SDTabPage extends BaseObject
{
    public $id;

    public $label;

    public $encodeLabel = true;

    public $options = [];

    public $content;

    public $tabControl;

    public $toggle = true;

    public $visible = true;

    public $active = false;

    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        } else {
            $this->id = $this->options['id'];
        }
        
        $this->options['role'] = 'tabpanel';
        
        if($this->toggle!==false) {
            $this->options['aria-labelledby'] = $this->id . '-navtab';
        }

        if (!isset($this->options['class']) || empty($this->options['class'])) {
            Html::addCssClass($this->options, [
                'widget' => 'tab-pane',
                'animation' => 'fade'
            ]);
        } else {
            Html::addCssClass($this->options, ['widget' => 'tab-pane']);
        }
    }

    public function getId()
    {
        if ($this->id===null) {
            $id = preg_replace('/[^A-Za-z0-9\-]/s','',  $this->label);
            $this->id='tab' . str_replace(' ', '', $id);
        }
        return $this->id;
    }

    public function renderPage()
    {
        if ($this->active!==false) {
            Html::addCssClass($this->options, ['display' => 'show', 'active']);
        }

        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        return Html::tag($tag, $this->content, $options);
    }

    public function renderNavTab()
    {
        return $this->tabControl->insertTab($this);
    }
}