<nav class="nav">
  <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"></a>
  <span id="btn-burger" class="btn-burger">
    <i></i>
    <i></i>
    <i></i>
  </span>
  <span id="menu-mob" class="menu-mob">Меню</span>
  <span id="menu-close" class="menu-close">&Cross;</span>
  <?php wp_nav_menu( ['theme_location' => 'header-menu'] ); ?>
  <ul class="menu-footer">
    <li><a class="white_txt" href="#">Политика конфиденциальности</a></li>
    <li><a class="white_txt" href="#">Согласие на обработку данных</a></li>
    <li>
      <div class="copyright white_txt">© 2012-2020</div>
    </li>
  </ul>
</nav>