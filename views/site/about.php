<?php
use yii\helpers\Html;
?>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<style>
.cv-card {
    background-color: #f2f2f2;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.cv-card img {
    max-width: 30%;
    border-radius: 8px;
    margin-bottom: 10px;
}

.cv-card h2 {
    margin-top: 0;
}

.cv-card p {
    margin: 5px 0;
}

.cv-card a {
    color: #0000ff;
    text-decoration: none;
}

.skills>p {
    display: flex;
    gap: 10px;
}

ion-icon {
    font-size: x-large;
}
</style>



<div class="cv-card">
    <?= Html::img('@web/imgs/profile.jpg',['class'=>"rounded-circle"]) ?>
    <h2>NABIL MAHMOUD BADAWI</h2>
    <p>NATIONALITY: SYRIA</p>
    <p>DATE OF BIRTH: 06/12/1993</p>
    <p>PHONE: 641550012</p>
    <p>EMAIL: NABIL.BELE.SY@GMAIL.COM</p>
    <p>GITHUB: <a href="https://github.com/NabilBele">NabilBele</a></p>
    <p>ADDRESS: SPAIN, SANTANDER</p>
</div>

<div class="cv-card info">
    <div class="skills">
        <h2>SKILLS</h2>
        <p>HTML <ion-icon name="logo-html5"></ion-icon>
        </p>
        <p>
            CSS <ion-icon name="logo-css3"></ion-icon>
        </p>
        <p>JAVASCIPT<ion-icon name="logo-javascript"></ion-icon>
        </p>
        <p>REACT<ion-icon name="logo-react"></ion-icon>
        </p>
        <p>LARAVEL<ion-icon name="logo-laravel"></ion-icon>
        </p>
        <p>YII2<ion-icon name="code-working-outline"></ion-icon>
        </p>
    </div>

    <div class="cv-card">
        <h2>EXPERIMENTS</h2>
        <p>Software & Hardware phones, laptops from 2015 to 2022</p>
        <p>A CNC designer and operator for wood cutting and engraving machines from 2018 to 2021</p>
        <p>Internet network installation and maintenance (freelancing)</p>
    </div>