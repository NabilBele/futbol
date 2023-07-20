<?php

namespace app\controllers;

use app\models\Campos;
use app\models\Likes;
use Yii;
use app\models\Comments;
use app\models\Replies;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * CommentsController implements the CRUD actions for Comments model.
 */
class CommentsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Comments models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Comments::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comments model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Comments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
public function actionAdd($postId)
{
    if (Yii::$app->request->isAjax) {
        $newComment = new Comments();
        $userId = Yii::$app->user->id;
    


        // Load the submitted form data
        if ($newComment->load(Yii::$app->request->post())) {
        $newComment->userId = $userId;
        $newComment->postId = $postId;
            if ($newComment->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
        $fetchCommentsUrl = Url::to(['/site/fetchcomments', 'postId' => $postId]);
        return Json::encode(['success' => true, 'fetchCommentsUrl' => $fetchCommentsUrl]);
               
            }else{
                print_r("Error");exit;
            }
        }
    }
    return false; // In case of non-AJAX requests or form data not loaded
}


    /**
     * Updates an existing Comments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Comments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
public function actionDeletecomment($id)
{
    // Step 1: Delete associated replies for the comment
    Replies::deleteAll(['commentId' => $id]);

    // Step 2: Delete associated likes for the comment
    Likes::deleteAll(['commentId' => $id]);

    // Step 3: Find the comment model by its ID and delete it
    $comment = $this->findModel($id);
    $comment->delete();

    // Step 4: Return a JSON response indicating successful deletion
    Yii::$app->response->format = Response::FORMAT_JSON;
    return ['success' => true];
}


    /**
     * Finds the Comments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Comments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comments::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}