<?php

namespace app\controllers;

use app\models\Alquileres;
use app\models\Campos;
use app\models\Comments;
use app\models\Rates;
use app\models\Socios;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends GeneralController
{
    /**
     * {@inheritdoc}
     */

     
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $campos=Campos::find()->all();

        return $this->render('index',["campos"=>$campos]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionRegister()
{
    $model = new Socios();

    if (Yii::$app->request->isPost) {
        $postData = Yii::$app->request->post();
        
        $model->load($postData);

        if ($model->validate() && $model->save()) {
            // Registration successful, redirect to a success page or perform additional actions
            return $this->redirect(['site/success']);
        }
    }

    return $this->render('register', ['model' => $model]);
}
public function actionSuccess()
{
    return $this->render('success');
}
public function actionViewcampo($id)
{
    $campo = Campos::findOne($id);
    $comments=Comments::find()->where(['postId'=>$id])->all();
    $ratingModel = new Rates(); // Create an instance of the Rates model for the rating form

    return $this->render('campoDetails', [
        'model' => $campo,
        'ratingModel' => $ratingModel, // Pass the rating model to the view
        'comments'=>$comments,
    ]);
}

 /**
     * Creates a new Alquileres model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
public function actionReserve($id, $userid)
{
    
    if (Yii::$app->user->isGuest) {
        return $this->redirect(['site/login']);
    }
    
    $model = new Alquileres();
    $campo = Campos::findOne($id);
    $socio = Socios::findOne($userid);
    $fechas = Alquileres::find()
    ->select('fechaHora')->where(["idCampo"=>$id])
    ->asArray()
    ->column();


    
    if (!$campo || !$socio) {
        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    $model->idSocio = $socio->id;
    $model->idCampo = $campo->id;
    
    if ($this->request->isPost) {
        if ($model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['/site/reserved', 'id' => $model->id]);
        }
    } else {
        $model->loadDefaultValues();
    }

    return $this->render('reserve', [
        'model' => $model,"campo"=> $campo,"socio"=>$socio,"fechas"=>$fechas
    ]);
}
public function actionReserved($id){
$model=Alquileres::findOne($id);
return $this->render('reservationCard', ['model' => $model]);
}
public function actionMyreservations($id){
    $model=Alquileres::find()->where(["idSocio"=>$id])->all();
    return $this->render('myreservation', ['model' => $model]);
}
public function actionDelete($id)
{
    $model = Alquileres::findOne($id);

    if ($model !== null) {
        $currentTime = time();  // Current Unix timestamp
        $deleteTime = strtotime($model->fechaHora);  // Assuming 'delete_time' is a field in the Alquileres model representing the deletion time

        if (($deleteTime - $currentTime) > (24 * 60 * 60)) {
            $model->delete();
        } else {
            throw new \Exception('The item cannot be deleted as the delete time has already passed.');
        }
    } else {
        throw new NotFoundHttpException('The requested item does not exist.');
    }

    return $this->redirect(['/site/myreservations', 'id' => Yii::$app->user->id]);
}


public function actionUpdate($id)
{
    $model = Alquileres::findOne($id);
     $fechas = Alquileres::find()
    ->select('fechaHora')
    ->asArray()
    ->column();


    if ($model !== null) {
        $currentTime = time();  // Current Unix timestamp
        $updateTime = strtotime($model->fechaHora);  // Assuming 'update_time' is a field in the Alquileres model representing the update time

        if (($updateTime - $currentTime) <= (24 * 60 * 60)) {
            Yii::$app->session->setFlash('error', 'The item cannot be updated as the update time has already passed.');
            return $this->redirect(['/site/myreservations', 'id' => Yii::$app->user->id]);
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['/site/myreservations', 'id' => Yii::$app->user->id]);
        }
    } else {
        throw new NotFoundHttpException('The requested item does not exist.');
    }

    return $this->render('update', [
        'model' => $model,"fechas"=>$fechas
    ]);
}
public function actionRate($id)
{
    $rateModel = new Rates();
    $rateModel->idCampo = $id;
    $rateModel->userId = Yii::$app->user->id;

    if (Yii::$app->request->isPost) {
        $postData = Yii::$app->request->post();

        if ($rateModel->load($postData) && $rateModel->validate()) {
            $rateModel->save();

            // If the comment is not empty, save it in the Comments table
            if (!empty($rateModel->comment)) {
                $commentModel = new Comments();
                $commentModel->postId = $id;
                $commentModel->userId = Yii::$app->user->id;
                $commentModel->comment = $rateModel->comment;
                $commentModel->save();
            }

            // Calculate and update the average rate for the corresponding campo
            $campo = Campos::findOne($id);
            $campo->rate = $campo->getAverage();
            $campo->save();
        }

        return $this->redirect(['viewcampo', 'id' => $id]);
    }

    return $this->render('rate', ['rateModel' => $rateModel]);
}

 public function actionSearch()
    {
        $searchModel = new Campos();
        $searchQuery = Yii::$app->request->get('search_query');

         $dataProvider = new ActiveDataProvider([
        'query' => Campos::find()
            ->where(['or', ['like', 'nombre', $searchQuery], ['like', 'direccion', $searchQuery]]),
    ]);

        return $this->render('search_results', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}