              <?php
              use yii\helpers\Html;
              use yii\widgets\ActiveForm;
              
              ?>
              <div class="modal" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="ratingModalLabel">Rate this campo</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
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