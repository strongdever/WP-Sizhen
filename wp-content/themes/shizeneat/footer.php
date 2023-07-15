  <!-- END  #top -->
    <footer id="footer">
        <div class="container">
            <div class="footer-logo">
                <a href="<?php echo HOME; ?>">
                    <img src="<?php echo T_DIRE_URI; ?>/assets/img/footer-logo.png" alt="<?php echo bloginfo('name'); ?>">
                </a>
            </div>
            <div class="footer-nav">
                <ul class="nav-menu">
                    <li>
                        <a href="<?php echo HOME . 'merit/'; ?>" class="menu-link">
                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/menu-1.png" alt="農業体験のメリット">
                            <span>農業体験のメリット</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo HOME . 'plan-search/'; ?>" class="menu-link">
                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/menu-2.png" alt="募集中の体験プラン">
                            <span>募集中の体験プラン</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo HOME . 'usage/'; ?>" class="menu-link">
                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/menu-3.png" alt="活用方法">
                            <span>活用方法</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo HOME . '#terms'; ?>" class="menu-link">
                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/menu-4.png" alt="ご利用方法">
                            <span>ご利用方法</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo HOME . 'contact/'; ?>" class="menu-link">
                            <img src="<?php echo T_DIRE_URI; ?>/assets/img/menu-5.png" alt="お問い合わせ">
                            <span>お問い合わせ</span>
                        </a>
                    </li>
                </ul>
                <ul class="subnav-menu">
                    <li>
                        <a href="<?php echo HOME . 'terms/'; ?>" class="menu-link">
                            <span>利用規約</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo HOME . 'privacypolicy/'; ?>" class="menu-link">
                            <span>プライバシーポリシー</span>
                        </a>
                    </li>
                </ul>
            </div>
            <p class="copyright">Copyright © 2023 自然を食べよう！ <br class="sp">All rights reserved.</p>
        </div>
    </footer>

    <?php wp_footer(); ?>

</body>

</html>