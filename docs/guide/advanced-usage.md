Advanced Usage
==============

In this guide we'll show how to use SDaiLover Widgets in advanced cases.

## Use SDTabWindow and SDGridView

### SDTabWindow
Use syntax to called SDTabWindow at `view` file:

```php
use yii\helpers\Url;
use sdailover\yii\widgets\tab\SDTabWindow;

SDTabWindow::widget([
    'id' => 'tabWindowManage',
    'newPageLabel' => 'Form', // The name label of new tab page
    'enableAddPageButton' => true, // Set visible or hidden of Add Tab Button
    // Label for Add Tab Button
    'addPageButtonLabel' => '<span class="bi bi-plus-square-fill"></span> Create',
    /**
     * Link route for new page's tab or can be use if static page:
     * 
     * 'newPageUrl' => $this->render('_newpage')
     */
    'newPageUrl' => Url::to(['newpage']),
    'pages' => [
        [
            'label' => 'Manage', // Label first tab or default tab
            'content' => $this->render('_gridview', [
                // This same id of SDTabWindow
                'tabId' => 'tabWindowManage',
                // Return dataProvider to partial render file
                'dataProvider' => $dataProvider 
            ])
        ]
    ]
])

```

### SDGridView

If use SDGridView under SDTabWindow, please make `partial` rendered file:

```php
use sdailover\yii\widgets\grid\SDGridView;

SDGridView::widget([
    'id' => 'datagridview',
    'dataProvider' => $dataProvider,
    'options' => ['class' => 'grid-view grid-manager grid-responsive', 'sd-tab'=>isset($tabId)?$tabId:''],
    'tableOptions' => ['id' => 'dataGridItems'],
    'columns' => [
        //....
    ]
]);

```

To show checkbox at SDGridView:

```php
//....
    'columns' => [
        ['class' => 'sdailover\widgets\grid\SDCheckboxColumn'],

        //....
    ]
//....
```

To use item options of SDGridView:

```php
//....
    'columns' => [
        //....

        [
            'class' => 'sdailover\widgets\grid\SDActionColumn',
            'template' => '{edit}{clear}',
            'buttons' => [
                'view' => function($url, $model) {
                    return Html::a('<span class="bi bi-eye-fillll"></span>', 
                        ['view', 'pkAttribute' => $model['pkAttribute']], 
                        ['title' => 'View', 'class' => 'btn btn-primary text-white btn-sm btn-icon view']
                    );
                },
                'edit' => function($url, $model) {
                    return Html::a('<span class="bi bi-pencil-square"></span>', 
                        ['edit', 'pkAttribute' => $model['pkAttribute']], 
                        ['title' => 'Edit', 'class' => 'btn btn-primary text-white btn-sm btn-icon update']
                    );
                },
                'clear' => function($url, $model) {
                    return Html::a('<span class="bi bi-file-earmark-x-fill"></span>', 
                        ['clear', 'pkAttribute' => $model['pkAttribute']], 
                        [
                            'title' => 'Clear', 
                            'class' => 'btn btn-danger text-white btn-sm btn-icon delete', 
                            'data' => [
                                'confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.',
                                'method' => 'post', 
                                'data-pjax' => false
                            ]
                        ]
                    );
                }
            ]
        ]
    ]
//....
```