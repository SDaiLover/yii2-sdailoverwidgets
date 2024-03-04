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
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use sdailover\yii\widgets\tab\SDTabWindowAsset;

/**
 * SDaiLover Tab Window class.
 * 
 * @author    : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.stephanusdai.web.id
 */
class SDTabWindow extends \yii\bootstrap5\Widget
{
    public $tabPageClass;

    public $navbarOptions = ['class' => 'nav'];

    public $navButtons = [];

    public $navButtonOptions = ['class' => 'nav-link'];

    public $contentOptions = ['class' => 'tab-content'];

    public $options = ['class' => 'tab-window'];

    public $pages = [];

    public $newPageLabel;

    public $newPageUrl = false;

    public $newPageButtonCssClass = 'nav-link';

    public $newPageContentCssClass = 'fade ';

    public $newPageContent;

    public $addPageButtonLabel;

    public $addPageButtonOptions = ['class' => 'nav-link'];

    public $closePageButtonLabel;

    public $closePageButtonCssClass = 'nav-button ms-1';

    public $enableAddPageButton = true;

    public $enableClosePageButton = true;

    public $enableAjaxContent = false;
    
    public $enableConfirmOnWindowClosed = true;

    public $messagePromptPageClose;
    
    public $_defaultPageId;

    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }

        if (!isset($this->addPageButtonOptions['id'])) {
            $this->addPageButtonOptions['id'] = 'addTabPageButton';
        }

        if (!isset($this->contentOptions['id'])) {
            $this->contentOptions['id'] = $this->options['id'] . 'tabContent';
        }

        if ($this->addPageButtonLabel===null) {
            $this->addPageButtonLabel = '<span class="bi bi-plus-square-fill"></span>';
        }

        if ($this->closePageButtonLabel===null) {
            $this->closePageButtonLabel = '<span class="bi bi-x-circle-fill"></span>';
        }

        if ($this->messagePromptPageClose===null) {
            $this->messagePromptPageClose = "Are you sure to remove this page?\nPlease save setting before continue!";
        }

        Html::addCssClass($this->navbarOptions, ['navbar' => 'nav-tabs']);
        
        if (empty($this->newPageContentCssClass) && $this->newPageContentCssClass===null) {
            $this->newPageContentCssClass = 'tab-pane';
        } else {
            $this->newPageContentCssClass .= ' tab-pane';
        }

        if ($this->newPageLabel===null) {
            $this->newPageLabel = 'New Page';
        }

        $this->initTabPages();
    }

    public function run()
    {
        $view = $this->getView();
        SDTabWindowAsset::register($view);
        $this->renderItems();
        $id = $this->options['id'];
        $options = Json::htmlEncode(array_merge($this->getClientOptions(), ['enableAjaxContent' => $this->enableAjaxContent]));
        $view->registerJs("jQuery('#$id').sdailoverTabWindow($options);");
    }

    public function renderItems()
    {
        $content = preg_replace_callback('/{\\w+}/', function ($matches) {
            $content = $this->renderSection($matches[0]);

            return $content === false ? $matches[0] : $content;
        }, "{navbar}\n{contents}");

        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        echo Html::tag($tag, $content, $options);        
    }

    public function renderSection($name)
    {
        switch ($name) {
            case '{navbar}':
                return $this->renderNavbar();
            case '{contents}':
                return $this->renderContents();
            default:
                return false;
        }
    }

    public function renderNavbar()
    {
        $navButtons = [];
        foreach ($this->pages as $i => $page) {
            $navButtons[] = $page->renderNavTab();
        }

        if ($this->enableAddPageButton)
            $navButtons[] = $this->renderAddPageButton();
        $options = $this->navbarOptions;
        $options['role'] = 'tablist';
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        return Html::tag($tag, implode("\n", $navButtons), $options);
    }

    public function renderContents()
    {
        $contents = [];
        foreach ($this->pages as $i => $page) {
            $contents[] = $page->renderPage();
        }

        $options = $this->contentOptions;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        return Html::tag($tag, implode("\n", $contents), $options);
    }

    public function renderAddPageButton()
    {
        $btnLabel = $this->addPageButtonLabel;
        $options = $this->addPageButtonOptions;
        return Html::button(
            $btnLabel,
            ArrayHelper::merge($options, [
                'type' => 'button',
                'role' => 'tab'
            ])
        );
    }

    public function renderClosePageButton()
    {
        $btnLabel = $this->closePageButtonLabel;
        $options = ['class'=>$this->closePageButtonCssClass];
        Html::addCssClass($options, ['navclose' => 'nav-close']);
        return Html::a($btnLabel, '#',
            ArrayHelper::merge($options, [
                'type' => 'button'
            ])
        );
    }

    public function insertTab($page)
    {
        $option = $this->navButtonOptions;
        $navPageLabel = $page->label;
        
        if ($page->encodeLabel) {
            $navPageLabel = Html::encode($navPageLabel);
        }

        if ($page->toggle!==false) {
            $option['data-bs-toggle'] = 'tab';
            $option['data-bs-target'] = '#'.$page->id;
            $option['aria-controls'] = $page->id;
        }
        
        if ($page->active!==false) {
            $option['aria-selected'] = 'true';
            $this->_defaultPageId = $page->id;
            Html::addCssClass($option, 'active');
        } else {
            $option['aria-selected'] = 'false';
            if ($this->enableClosePageButton) {
                $navPageLabel .= $this->renderClosePageButton();
            }
        }

        return Html::button(
            $navPageLabel,
            ArrayHelper::merge($option, [
                'id' => $page->id . '-navtab',
                'type' => 'button',
                'role' => 'tab'
            ])
        );
    }

    protected function getClientOptions()
    {
        $id = $this->options['id'];
        $tabPageSelector = "#$id .nav-tabs button, #$id .nav-tabs .nav-close";

        $clientOptions = [
            'defaultPageId' => $this->_defaultPageId,
            'newPageLabel' => $this->newPageLabel,
            'addTabButton' => $this->addPageButtonOptions['id'],
            'closeTabButtonCaption' => $this->closePageButtonLabel,
            'closeTabButtonCssClass' => $this->closePageButtonCssClass,
            'enableCloseTabButton' => $this->enableClosePageButton,
            'promptPageClose' => $this->messagePromptPageClose,
            'tabContentId' =>$this->contentOptions['id'],
            'tabPageSelector' => $tabPageSelector,
            'newPageCssClass' => $this->newPageContentCssClass,
            'navbarButtonCssClass' => $this->newPageButtonCssClass,
            'enableConfirmOnWindowClosed' => $this->enableConfirmOnWindowClosed
        ];

        if ($this->newPageUrl)
            $clientOptions['newPageUrl'] = $this->newPageUrl;
        else
        {
            $newPageContent = $this->newPageContent===null ? '' :$this->newPageContent;
            $clientOptions['newPageContent'] = $newPageContent;
        }

        return $clientOptions;
    }

    protected function initTabPages()
    {
        if (empty($this->pages)) {
            if ($this->defaultNewPage===null)
                $this->pages[] = 'Main Page';
            else
            {
                $this->pages[] = [
                    'label' => 'New Page 1',
                    'content' => $this->defaultNewPage
                ];
            }
        }

        foreach ($this->pages as $i => $page) {
            if (is_string($page))
                $page = $this->createTabPage($page);
            else
            {
                $page = Yii::createObject(array_merge([
                    'class' => $this->tabPageClass ?: SDTabPage::className(),
                    'tabControl' => $this
                ], $page));
            }

            if (!$page->visible) {
                unset($this->pages[$i]);
                continue;
            }

            if ($i===0) {
                $page->active = true;
            }

            $this->pages[$i] = $page;
        }
    }

    protected function createTabPage($text)
    {
        return Yii::createObject([
            'class' => $this->tabPageClass ?: SDTabPage::className(),
            'tabControl' => $this,
            'label' => $text
        ]);      
    }
}