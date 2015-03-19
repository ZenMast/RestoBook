
<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
$this->title = Yii::t('app', Yii::$app->name);

?>
<div class="site-index">
    <div class="row1">
        <div class="col-lg-4">
            <div class="city">
                <select type="text" name="action" size="1" style="width: 120px">
                <option value="" >--City--</option>
                <option value="Tartu">Tartu</option>
                <option value="Tallinn">Tallinn</option>
                <option value="Narva">Narva</option>
                </select>
            </div>
            <br>
            <div class="restaurant">
                <select type="text" name="action" size="1" style="width: 120px">
                <option value="" >--Restaurant--</option>
                <option value="Pierre">Pierre</option>
                <option value="Volga">Volga</option>
                <option value="Kapriis">Kapriis</option>
                </select>
            </div>
            <br>
            <div class="kitchen">
                <select type="text" name="action" size="1" style="width: 120px">
                <option value="" >--Kitchen--</option>
                <option value="italian">italian</option>
                <option value="asian">asian</option>
                <option value="european">european</option>
                </select>
            </div>
            <br>
            <div class="Data">            
                <?= DatePicker::widget(['name' => 'attributeName']) ?>

            </div>
            <br>
            <div class="Guests number">            
                <p>Guests: <input type="number" id="guests" min="1" max="30" style="width: 67px"></p>
            </div>

    
        </div>
        <div class="col-lg-8">    
            <h1>Sup?</h1>
            <p class="lead">This is going to be University of Tartu 2015 Spring semester Web Application Development course project developed by Olga Stepanova, Julia Sannikova and Roman Shumailov using Yii2 framework</p>
            <p><a class="btn btn-lg btn-success" href="https://github.com/ZenMast/RestoBook/wiki">Project Wiki</a></p>           
         </div>
    </div>
    


    <div class="body-content">
        <div class="row">
            <div class="col-lg-3">
                <h3>Yii documentation</h3>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                <h3>Yii forum</h3>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                <h3>Yii extensions</h3>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                <h3>Freetuts.org</h3>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.freetuts.org/">Freetuts.org &raquo;</a></p>
            </div>
        </div>

    </div>
</div>

