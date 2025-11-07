<?php
/**
 * Footer template
 */
?>

<!-- FOOTER -->
<section id="footer">
    <div class="container">
        <div class="row text-center text-xs-center text-sm-left text-md-left">

            <?php
            $pages = ['home'=>'Home', 'about'=>'About', 'faq'=>'FAQ', 'get-started'=>'Get Started', 'videos'=>'Videos'];

            // Lặp 3 cột giống nhau
            for ($i=0; $i<3; $i++): ?>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <h5>Quick links</h5>
                    <ul class="list-unstyled quick-links">
                        <?php foreach ($pages as $slug => $title):
                            $p = get_page_by_path($slug);
                            ?>
                            <li><a href="<?php echo $p ? get_permalink($p) : '#'; ?>"><i class="fa fa-angle-double-right"></i><?php echo $title; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endfor; ?>

        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                <ul class="list-unstyled list-inline social text-center">
                    <?php
                    $socials = [
                        'facebook'=>'https://facebook.com',
                        'twitter'=>'https://twitter.com',
                        'instagram'=>'https://instagram.com',
                        'google-plus'=>'https://plus.google.com',
                        'envelope'=>'mailto:example@gmail.com',
                        'comment'=>'https://zalo.me',
                        'youtube'=>'https://youtube.com',
                        'linkedin'=>'https://linkedin.com',
                        'music'=>'https://tiktok.com'
                    ];
                    foreach($socials as $icon=>$url):
                        ?>
                        <li class="list-inline-item"><a href="<?php echo $url; ?>"><i class="fa fa-<?php echo $icon; ?>"></i></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <hr>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                <p><u><a href="#">National Transaction Corporation</a></u> is a Registered MSP/ISO of Elavon, Inc. Georgia [a wholly owned subsidiary of U.S. Bancorp, Minneapolis, MN]</p>
                <p class="h6">© All right Reserved.<a class="text-green ml-2" href="#" target="_blank">Sunlimetech</a></p>
            </div>
            <hr>
        </div>
    </div>
</section>
<!-- ./FOOTER -->

<?php wp_footer(); ?>
</body>
</html>