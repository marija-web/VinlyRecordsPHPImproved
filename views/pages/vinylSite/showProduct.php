<?php
    if(!isset($_GET['id'])){
        header('location: modals/404Page.php?notFound');
    }
    else{
        $id=$_GET['id'];
        $returnProduct=returnProduct($id);
?>
    <div class="row tm-gallery">
                    <div  class="tm-gallery-page">
                        <article class="col-6 mt-5 mx-auto">
                            <figure>
                                <a href="index.php?page=showProduct&id=<?=$returnProduct->id_products?>"><img src="assets/img/gallery/<?=$returnProduct->picture_src?>" alt="<?=$returnProduct->name_products?>" class="img-fluid tm-gallery-img"/></a>
                                <figcaption>
                                    <h4 class="tm-gallery-title"><?=$returnProduct->name_products?></h4>
                                    <p><?=$returnProduct->description?></p>
                                    <p class="mt-2 tm-gallery-title">Artist - <?=$returnProduct->name_artist?></p>
                                    <p class="tm-gallery-title"><?=$returnProduct->name_cat?></p>
                                    <hr>
                                    <?php
                                        if($returnProduct->delivery):
                                    ?>
                                        <p class="text-secondary">Free delivery</p>
                                    <?php
                                    endif;
                                    ?>
                                    <p class="tm-gallery-price">$<?=$returnProduct->price_now?> 
                                    <?php
                                        if($returnProduct->price_old!=null):
                                    ?>
                                        $<del><?=$returnProduct->price_old?></del>
                                    <?php
                                        endif;
                                    ?>
                                    </p>
                                </figcaption>
                            </figure>
                        </article>
                        <a href="index.php?page=shop" class="tm-btn tm-btn-success my-auto">Back</a>
                    </div>
    </div>
<?php
    }
?>