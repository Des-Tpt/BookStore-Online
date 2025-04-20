<?php
	include_once "config.php";
	
	include_once "header.php";

    $featured_result = mysqli_query($connect, "SELECT * FROM books ORDER BY RAND() LIMIT 3") or die("Lỗi truy vấn featured: " . mysqli_error($connect));;
    $slide_result = mysqli_query($connect,"SELECT * FROM books WHERE category_id = 2 ORDER BY RAND() LIMIT 7") or die("Lỗi truy vấn featured: " . mysqli_error($connect));;
    $science_result = mysqli_query($connect, "SELECT * FROM books WHERE category_id = 1 ORDER BY RAND() LIMIT 7") or die("Lỗi truy vấn featured: " . mysqli_error($connect));;
    $childrens_book_result = mysqli_query($connect,"SELECT * FROM books WHERE category_id = 4 ORDER BY RAND() LIMIT 7") or die("Lỗi truy vấn featured: " . mysqli_error($connect));;
    $all_result = mysqli_query($connect,"SELECT * FROM books ORDER BY RAND() LIMIT 7") or die("Lỗi truy vấn featured: " . mysqli_error($connect));;
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Việt Anh</title>
        <link rel="stylesheet" href="css/index.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    </head>

    <body>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out',
            once: true 
        });
    </script>
        <section class="banner">
            <a href="#"><img src="Image/banner.jpg" alt="banner" class="banner-image" width="1202px"></a>
        </section>
        <div class="featured-background">
        <div class="featured-text">
            <h1>Có thể bạn sẽ thích...</h1>
        </div>
        <section class="featured" data-aos="fade-up">
        <?php while ($row = mysqli_fetch_assoc($featured_result)) { ?>
            <div class="book-card">
                <img src="<?= $row['image'] ?>" alt="<?= $row['title'] ?>" class="book-img">
                <div class="book-info">
                    <h3 class="title-book"><?= $row['title'] ?></h3>
                    <p>của <?= $row['author'] ?></p>
                    <ul>
                        <li><?= $row['description'] ?></li>
                    </ul>
                    <a href="book_detail.php?id=<?= $row['book_id'] ?>" class="btn small">Xem chi tiết...</a>
                </div>
            </div>
        <?php 
        } ?>
        </section>
        </div>
        
        <div class="swiper-container">
        <div class="swiper-text">
            <h1>Văn học</h1>
            <a href="categories.php?category=2">Xem thêm...</a>
        </div>
        <div class="swiper mySwiper">         <!-- mySwiper là 1 biến được dùng để khai báo với thư viện Swiper, nó được dùng ở line 93-->
            <div class="swiper-wrapper">
                <?php while($row = $slide_result -> fetch_assoc()): ?>

                    <?php
                        $original_price = $row['price']; 
                        $discount_percent = $row['discount_percent'];
                        $discounted_price = $original_price * (100 - $discount_percent) / 100;
                    ?>
                    <div class="swiper-slide">
                        <div class="book-item">
                            <img src="<?= $row['image'] ?>" alt="<?= $row['title'] ?>" class ="book-image">
                            <a href="book_detail.php?id= <?= $row['book_id'] ?>" class="book-overlay">
                            <span>Xem chi tiết</span>
                            </a>
                            <div class="book-title"><?= $row['title'] ?></div>
                            <div class="book-pricing">
                            <?php if ($original_price > $discounted_price): ?>
                                <del><?= number_format($original_price) ?>₫</del>
                                <span class="discounted"><?= number_format($discounted_price) ?>₫</span>
                                <span class="discount-tag">-<?= $discount_percent ?>%</span>
                                <?php else: ?>
                                <span class="discounted"><?= number_format($original_price) ?>₫</span>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        </div>

        
        <div class="swiper-container">
        <div class="swiper-text">
            <h1>Khoa học</h1>
            <a href="categories.php?category=1">Xem thêm...</a>
        </div>
        <div class="swiper mySwiper">       
            <div class="swiper-wrapper">
                <?php while($row = $science_result -> fetch_assoc()): ?>

                    <?php
                        $original_price = $row['price']; 
                        $discount_percent = $row['discount_percent'];
                        $discounted_price = $original_price * (100 - $discount_percent) / 100;
                    ?>

                    <div class="swiper-slide">
                        <div class="book-item">
                            <img src="<?= $row['image'] ?>" alt="<?= $row['title'] ?>" class ="book-image">

                            <a href="book_detail.php?id=<?= $row['book_id'] ?>" class="book-overlay">
                                <span>Xem chi tiết</span>
                            </a>

                            <div class="book-title"><?= $row['title'] ?></div>
                            <div class="book-pricing">
                            <?php if ($original_price > $discounted_price): ?>
                                <del><?= number_format($original_price) ?>₫</del>
                                <span class="discounted"><?= number_format($discounted_price) ?>₫</span>
                                <span class="discount-tag">-<?= $discount_percent ?>%</span>
                                <?php else: ?>
                                <span class="discounted"><?= number_format($original_price) ?>₫</span>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        </div>

                
        <div class="swiper-container">
        <div class="swiper-text">
            <h1>Thiếu nhi</h1>
            <a href="categories.php?category=4">Xem thêm...</a>
        </div>
        <div class="swiper mySwiper">        
            <div class="swiper-wrapper">
                <?php while($row = $childrens_book_result -> fetch_assoc()): ?>

                    <?php
                        $original_price = $row['price']; 
                        $discount_percent = $row['discount_percent'];
                        $discounted_price = $original_price * (100 - $discount_percent) / 100;
                    ?>

                    <div class="swiper-slide">
                        <div class="book-item">
                            <img src="<?= $row['image'] ?>" alt="<?= $row['title'] ?>" class ="book-image">

                            <a href="book_detail.php?id=<?= $row['book_id']?>" class="book-overlay">
                                <span>Xem chi tiết</span>
                            </a>

                            <div class="book-title"><?= $row['title'] ?></div>
                            <div class="book-pricing">
                            <?php if ($original_price > $discounted_price): ?>
                                <del><?= number_format($original_price) ?>₫</del>
                                <span class="discounted"><?= number_format($discounted_price) ?>₫</span>
                                <span class="discount-tag">-<?= $discount_percent ?>%</span>
                                <?php else: ?>
                                <span class="discounted"><?= number_format($original_price) ?>₫</span>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        </div>

        <div class="swiper-container">
        <div class="swiper-text">
            <h1>Mọi thể loại...</h1>
            <a href="categories.php?">Xem thêm...</a>
        </div>
        <div class="swiper mySwiper">        
            <div class="swiper-wrapper">
                <?php while($row = $all_result -> fetch_assoc()): ?>

                    <?php
                        $original_price = $row['price']; 
                        $discount_percent = $row['discount_percent'];
                        $discounted_price = $original_price * (100 - $discount_percent) / 100;
                    ?>

                    <div class="swiper-slide">
                        <div class="book-item">
                            <img src="<?= $row['image'] ?>" alt="<?= $row['title'] ?>" class ="book-image">

                            <a href="#" class="book-overlay">
                                <span>Xem chi tiết</span>
                            </a>

                            <div class="book-title"><?= $row['title'] ?></div>
                            <div class="book-pricing">
                            <?php if ($original_price > $discounted_price): ?>
                                <del><?= number_format($original_price) ?>₫</del>
                                <span class="discounted"><?= number_format($discounted_price) ?>₫</span>
                                <span class="discount-tag">-<?= $discount_percent ?>%</span>
                                <?php else: ?>
                                <span class="discounted"><?= number_format($original_price) ?>₫</span>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 5,
                spaceBetween: 20,
                navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
                },
            loop: true,
            });
        </script>

    </body>

    <footer>
        <?php
            include 'footer.php';
        ?>
    </footer>
</html>