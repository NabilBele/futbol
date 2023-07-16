<style>
.search-form .input-group {
    position: relative;
}

.search-form .input-group .btn {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
}
</style>

<div class="search-form col-lg-6">
    <form action="<?= Yii::$app->urlManager->createUrl(['site/search']) ?>" method="get" class="input-group">
        <input type="text" class="form-control rounded-pill" name="search_query" placeholder="Search">
        <div class="input-group-append">
            <button type="submit" class="btn  rounded-pill">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </form>
</div>