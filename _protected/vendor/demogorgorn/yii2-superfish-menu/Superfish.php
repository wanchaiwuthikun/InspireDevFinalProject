<?php

namespace demogorgorn\superfish;

use Yii;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use demogorgorn\superfish\SuperfishAssets;

/**
 * Yii2 widget for Superfish jQuery menu.
 *
 * Multi level menu example example:
 * ```php
 * echo \demogorgorn\superfish\Superfish::widget([
 *   'options' => [
 *       'class' => 'uk-float-right',
 *   ],
 *   'items' => [
 *       ['label' => 'First level menu item', 'url' => ['/site/index']],
 *       ['label' => 'First level menu item', 'url' => ['/site/preimushestva']],
 *       ['label' => 'First level menu item', 'url' => ['/site/juridicheskie-uslugi']],
 *       ['label' => 'First level menu item', 'url' => ['/site/tarify']],
 *       ['label' => 'First level menu item', 'url' => ['/site/publikacii']],
 *       [
 *           'label' => 'First level menu item', 
 *           'url' => ['/site/kontakty'],
 *           'items' => [
 *               [
 *                   'label' => 'Second level menu item', 
 *                   'url' => ['/site/index'],
 *                   'items' => [
 *                       ['label' => 'Third level menu item', 'url' => ['/site/index']],
 *                       ['label' => 'Third level menu item', 'url' => ['/site/preimushestva']],
 *                       ['label' => 'Third level menu item', 'url' => ['/site/juridicheskie-uslugi']],
 *                       ['label' => 'Third level menu item', 'url' => ['/site/tarify']],
 *                       ['label' => 'Third level menu item', 'url' => ['/site/publikacii']],
 *                   ],
 *               ],
 *               ['label' => 'Second level menu item', 'url' => ['/site/preimushestva']],
 *               [
 *                  'label' => 'Second level menu item', 
 *                  'url' => ['/site/juridicheskie-uslugi'],
 *                  'options' => ['class' => 'li tag options'],
 *                  'linkOptions' => ['class' => 'link optionts'],   
 *               ],
 *               ['label' => 'Second level menu item', 'url' => ['/site/tarify']],
 *               ['label' => 'Second level menu item', 'url' => ['/site/publikacii']],
 *           ],
 *       ],
 *   ],
 * ]); 
 * ```
 *
 *
 * @author Oleg Martemjanov <demogorgorn@gmail.com>
 */

class Superfish extends \yii\base\Widget {

    /**
     * @var array list of items in the nav widget. Each array element represents a single
     * menu item which can be either a string or an array with the following structure:
     *
     * - label: string, required, the nav item label.
     * - url: optional, the item's URL. Defaults to "#".
     * - visible: boolean, optional, whether this menu item is visible. Defaults to true.
     * - linkOptions: array, optional, the HTML attributes of the item's link.
     * - options: array, optional, the HTML attributes of the item container (LI).
     * - active: boolean, optional, whether the item should be on active state or not.
     * - items: array|string, optional, the configuration array for creating a [[Dropdown]] widget,
     *   or a string representing the dropdown menu. Note that Bootstrap does not support sub-dropdown menus.
     *
     */
    public $items = [];

    /**
     * @var array of the slider options
     * @see homepage of superfish menu
     */
    public $configuration = [];

    /**
     * @var array the HTML attributes for the widget container tag.
     */
    public $options = [];

    /**
     * @var string the route used to determine if a menu item is active or not.
     * If not set, it will use the route of the current request.
     * @see params
     * @see isItemActive
     */
    public $route;

    /**
     * @var array the parameters used to determine if a menu item is active or not.
     * If not set, it will use `$_GET`.
     * @see route
     * @see isItemActive
     */
    public $params;

        /**
     * @var boolean whether the nav items labels should be HTML-encoded.
     */
    public $encodeLabels = false;

    /**
     * Initializes the widget.
     */
    public function init() {
        
        parent::init();

        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }

        if ($this->params === null) {
            $this->params = $_GET;
        }

        if (!isset($this->options['id'])) {
            $this->options['id'] = 'sf-menu';
        }

        SuperfishAssets::register($this->view);

        Html::addCssClass($this->options, 'sf-menu');
              
        // render js
        $this->getView()->registerJs("
            $('#".$this->options['id']."').superfish(" . $this->getConfiguration() . ");
		");
    }

    /**
     * Renders the widget.
     */
    public function run() {

        echo $this->createMenu($this->items, $this->options);
    }

    public function getConfiguration() {
        return $configs = \yii\helpers\Json::encode($this->configuration);
    }

    public function createMenu($items, $options = []) {
        $htmlTree = Html::beginTag('ul', $options);

        foreach ($items as $item) {
            $htmlTree .= $this->renderItem($item);
        }
        $htmlTree .= Html::endTag('ul');

        return $htmlTree;
    }

    public function renderItem($item)
    {
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }

        $label = $this->encodeLabels ? Html::encode($item['label']) : $item['label'];
        $options = ArrayHelper::getValue($item, 'options', []);
        $url = ArrayHelper::getValue($item, 'url', false);
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);

        if (isset($item['active'])) {
            $active = ArrayHelper::remove($item, 'active', false);
        } else {
            $active = $this->isItemActive($item);
        }

        if ($active) {
            Html::addCssClass($options, 'current-menu-item');
        }

        $link = Html::a($label, $url, $linkOptions);

        if (isset($item['items']) and !empty($item['items']))
            $items = $this->createMenu($item['items']);

        return Html::tag('li', $link . $items, $options);
    }

    /**
     * Checks whether a menu item is active.
     * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
     * When the `url` option of a menu item is specified in terms of an array, its first element is treated
     * as the route for the item and the rest of the elements are the associated parameters.
     * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
     * be considered active.
     * @param array $item the menu item to be checked
     * @return boolean whether the menu item is active
     */
    protected function isItemActive($item)
    {
        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = $item['url'][0];
            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }
            if (ltrim($route, '/') !== $this->route) {
                return false;
            }
            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                foreach (array_splice($item['url'], 1) as $name => $value) {
                    if (!isset($this->params[$name]) || $this->params[$name] != $value) {
                        return false;
                    }
                }
            }
            return true;
        }
        return false;
    }

}
