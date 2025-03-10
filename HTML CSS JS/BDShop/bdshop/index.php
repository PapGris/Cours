<?php

require_once $_SERVER['DOCUMENT_ROOT']. "/include/connect.php";

$sql="SELECT * FROM table_product ORDER BY 
    product_serie ASC, product_name ASC 
    LIMIT 0,48"; 
$stmt=$db->prepare($sql);                   // requete préparée pour afficher les BD's 
$stmt->execute();
$recordset=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/include/header.php";?>
    <nav class="navRight">
        <h2>🛒 Panier</h2>
        <ul id="cart" class="cart-list"></ul>
    </nav>
    <main class="container">
        <div class="row">
            <?php foreach($recordset as $row){ ?>
                <article class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <h3>
                        <?= $row['product_serie'];?>               
                        <?= $row['product_name'];?> 
                    </h3> 
                    <?php if(!empty($row['product_image'])){ ?>
                    <img src="/upload/md_<?=$row['product_image'];?>" 
                        class="img-fluid"
                        alt="Illustration de la couverture de la BD <?= $row['product_name'];?> de la serie <?= $row['product_serie'];?> ">
                    <?php } else { ?>
                        <img src="/images/default.jpg" class="img-fluid" alt="">
                    <?php } ?>
                    <button class="btn btn-dark addToCart" data-id="<?=$row['product_id'];?>"> 
                        Add to cart
                    </button> 
                </article>
            <?php } ?>
        </div>


    </main>
    <?php include_once $_SERVER['DOCUMENT_ROOT']."/include/footer.php";?>
</body>
</html>
