<header>
  <div class="top-bar stacked-for-large">
    <div class="top-bar-left">
      <ul class="dropdown menu" data-dropdown-menu>
        <li class="menu-text">
          <a href="/">
            Laravel + Foundation</li>
          </a>
        <li>
          <a href="#">Item 1</a>
          <ul class="menu">
            <li><a href="#">Item 1A</a></li>
            <li><a href="#">Item 1B</a></li>
            <li><a href="#">Item 1C</a></li>
          </ul>
        </li>
        <li><a href="#">Item 2</a></li>
        <li><a href="#">Item 3</a>
          <ul class="vertical menu">
            <li>
              <a href="#">Item 1A</a>
              <ul class="vertical menu">
                <li><a href="#">Item 1A</a></li>
                <li><a href="#">Item 1B</a></li>
                <li><a href="#">Item 1C</a></li>
                <li><a href="#">Item 1D</a></li>
                <li><a href="#">Item 1E</a></li>
              </ul>
            </li>
            <li><a href="#">Item 1B</a></li>
          </ul>
        </li>
        <li><a href="#">Item 4</a></li>
      </ul>
    </div>

    <div class="top-bar-right" id="login">
      @include('block.login')
    </div>
  </div>
</header>
