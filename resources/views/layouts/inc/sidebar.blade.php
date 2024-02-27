<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <div class="logo"><a href="#" class="simple-text logo-normal">
      My blog
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item {{Request::is('home') ? 'active':''}}  ">
            <a class="nav-link" href="{{url('home')}}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item {{Request::is('categories') ? 'active':''}}">
            <a class="nav-link" href="{{url('categories')}}">
            <i class="nav-icon fa fa-tags"></i>
              <p>Categories</p>
            </a>
          </li>
         
          <li class="nav-item {{Request::is('tags') ? 'active':''}}">
            <a class="nav-link" href="{{url('tags')}}">
              <i class="material-icons">person</i>
              <p>Tags</p>
            </a>
          </li>
          <li class="nav-item {{Request::is('posts') ? 'active':''}}">
            <a class="nav-link" href="{{url('posts')}}">
              <i class="material-icons">person</i>
              <p>Posts</p>
            </a>
          </li>
         
    
        </ul>
      </div>
    </div>