<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\widgets;
use yii\web\View;
/**
 * Alert widget renders a message from session flash. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:
 *
 * ```php
 * \Yii::$app->session->setFlash('error', 'This is the message');
 * \Yii::$app->session->setFlash('success', 'This is the message');
 * \Yii::$app->session->setFlash('info', 'This is the message');
 * ```
 *
 * Multiple messages could be set as follows:
 *
 * ```php
 * \Yii::$app->session->setFlash('error', ['Error 1', 'Error 2']);
 * ```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @author Alexander Makarov <sam@rmcreative.ru>
 */
class Toastr extends \yii\bootstrap\Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - $key is the name of the session flash variable
     * - $value is the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $toastrTypes = [
        'error'   => 'toast toast-just-text toast-error',
        'danger'  => 'toast toast-just-text toast-danger',
        'success' => 'toast toast-just-text toast-success',
        'info'    => 'toast toast-just-text toast-info',
        'warning' => 'toast toast-just-text toast-warning'
    ];

    /**
     * @var array the options for rendering the close button tag.
     */
    public $closeButton = [];

    public function init()
    {
        parent::init();

        $session = \Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $appendCss = isset($this->options['class']) ? ' ' . $this->options['class'] : '';

        foreach ($flashes as $type => $data) {
            if (isset($this->toastrTypes[$type])) {
                $data = (array) $data;
                foreach ($data as $i => $message) {
                    /* initialize css class for each alert box */
                    $this->options['class'] = $this->toastrTypes[$type] . $appendCss;

                    /* assign unique id to each alert box */
                    $this->options['id'] = $this->getId() . '-' . $type . '-' . $i;

                   
				
				
				echo '<div id="toast-top-right" class="toast-top-right" aria-live="polite" role="alert"><div class="'.$this->options['class'].'" style="display: block;">
				<button class="toast-close-button" aria-label="Close" type="button" role="button">
                        <span class="toastclose" aria-hidden="true">x</span>
                      </button>
				<div class="toast-message">'.$message.'
				</div></div></div>';
                }
				/*echo '<div class="toast-example" id="exampleToastrInfo" aria-live="polite" data-plugin="toastr"
                  data-message="Head This alert needs your attention, but its not super important"
                  data-container-id="toast-top-right" data-position-class="toast-top-right"
                  data-icon-class="toast-just-text toast-info" role="alert"><div class="toast toast-just-text toast-info">
                      <button class="toast-close-button" aria-label="Close" type="button" role="button">
                        <span aria-hidden="true">×</span>
                      </button>
                      <div class="toast-message">
                        <strong>Heads up!</strong> This alert needs your attention, but
                        its not super important.</div>
                    </div></div>';
			}*/

                $session->removeFlash($type);
            }
        }
    }
}


?>