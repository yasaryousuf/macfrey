
<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="{{asset('admin')}}/images/faces/face1.jpg" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">Richard V.Welsh</p>
                  <div>
                    <small class="designation text-muted">Manager</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
            </div>
          </li>

          <li class="nav-item {{Request::is('admin/') ? ' active' : ''}}">
            <a class="nav-link" href="index.html">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item {{Request::is('admin/news*') ? ' active' : ''}}">
            <a class="nav-link" data-toggle="collapse" href="#admin-news-menu" aria-expanded="false" aria-controls="admin-news-menu">
              <i class="menu-icon mdi mdi-newspaper"></i>
              <span class="menu-title">News</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{Request::is('admin/news*') ? ' show' : ''}}" id="admin-news-menu">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                <a class="nav-link {{Request::is('admin/news/create') ? ' active' : ''}}" href="/admin/news/create">Add News</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{Request::is('admin/news') ? ' active' : ''}}" href="/admin/news/">All News</a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item {{Request::is('admin/service*') ? ' active' : ''}}">
            <a class="nav-link" data-toggle="collapse" href="#admin-service-menu" aria-expanded="false" aria-controls="admin-service-menu">
              <i class="menu-icon mdi mdi-message-settings-variant"></i>
              <span class="menu-title">Service</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{Request::is('admin/service*') ? ' show' : ''}}" id="admin-service-menu">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                <a class="nav-link {{Request::is('admin/service/create') ? ' active' : ''}}" href="/admin/service/create">Add Service</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{Request::is('admin/service') ? ' active' : ''}}" href="/admin/service/">All Service</a>
                </li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item {{Request::is('admin/contact') ? ' active' : ''}}">
            <a class="nav-link" href="/admin/contact">
              <i class="menu-icon mdi mdi-contact-mail"></i>
              <span class="menu-title">Contact </span>
            </a>
          </li>


        </ul>
      </nav>