              <?php
              use yii\helpers\Html;
              use yii\widgets\ActiveForm;
              
              ?>

              <div class="modal-body">
                  <?php $form = ActiveForm::begin(['action' => ['site/rate', 'id' => $model->id]]); ?>

                  <?= $form->field($ratingModel, 'rate')->widget(\kartik\rating\StarRating::class, [
                                'name' => 'rating_21',
                                'pluginOptions' => [
                                    'min' => 0,
                                    'max' => 5,
                                    'step' => 1,
                                    'size' => 'lg',
                                    'starCaptions' => [
                                        1 => 'Very Bad',
                                        2 => 'Bad',
                                        3 => 'Average',
                                        4 => 'Good',
                                        5 => 'Excellent',
                                    ],
                                    'starCaptionClasses' => [
                                        1 => 'text-danger',
                                        2 => 'text-warning',
                                        3 => 'text-info',
                                        4 => 'text-primary',
                                        5 => 'text-success',
                                    ],
                                ],
                            ])->label('Rate this campo') ?>

                  <?= $form->field($ratingModel, 'comment')->textarea(['rows' => 3])->label('Comment') ?>

                  <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>

                  <?php ActiveForm::end(); ?>
              </div>
              </div>
              </div>
              </div>