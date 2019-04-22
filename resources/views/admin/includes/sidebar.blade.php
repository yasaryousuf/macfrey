
<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="{{ Auth::user()->profile_image ? asset('/images/profile_image/'.Auth::user()->profile_image) : asset('/images/profile_image/avatar.png') }}" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{Auth::user()->name}}</p>
                  <div>
                    <small class="designation text-muted">{{Auth::user()->email}}</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
            </div>
          </li>

          <li class="nav-item {{Request::is('admin/home') ? ' active' : ''}}">
            <a class="nav-link" href="/admin/home">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          {{-- Component Category --}}
          <li class="nav-item {{Request::is('admin/component_category*') ? ' active' : ''}}">
            <a class="nav-link" data-toggle="collapse" href="#admin-component_category-menu" aria-expanded="false" aria-controls="admin-component_category-menu">
              <i class="menu-icon mdi mdi-message-settings-variant"></i>
              <span class="menu-title">Com. Category</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{Request::is('admin/component_category*') ? ' show' : ''}}" id="admin-component_category-menu">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                <a class="nav-link {{Request::is('admin/component_category/create') ? ' active' : ''}}" href="/admin/component_category/create">Add Com. Category</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{Request::is('admin/component_category') ? ' active' : ''}}" href="/admin/component_category/">All Com. Category</a>
                </li>
              </ul>
            </div>
          </li>
          {{-- Component Category Ends --}}      

          {{-- Component --}}
          <li class="nav-item {{Request::is('admin/component/create') ? ' active' : ''}}{{Request::is('admin/component') ? ' active' : ''}}">
            <a class="nav-link" data-toggle="collapse" href="#admin-component-menu" aria-expanded="false" aria-controls="admin-component-menu">
              <i class="menu-icon mdi mdi-message-settings-variant"></i>
              <span class="menu-title">Component</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{Request::is('admin/component/create') ? ' show' : ''}}{{Request::is('admin/component') ? ' active' : ''}}" id="admin-component-menu">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                <a class="nav-link {{Request::is('admin/component/create') ? ' active' : ''}}" href="/admin/component/create">Add Component</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{Request::is('admin/component') ? ' active' : ''}}" href="/admin/component/">All Component</a>
                </li>
              </ul>
            </div>
          </li>
          {{-- Component Ends --}}      
      

          <li class="nav-item {{Request::is('admin/profile*') ? ' active' : ''}}">
            <a class="nav-link" data-toggle="collapse" href="#admin-profile-menu" aria-expanded="false" aria-controls="admin-profile-menu">
              <i class="menu-icon mdi mdi-account"></i>
              <span class="menu-title">Profile</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{Request::is('admin/profile*') ? ' show' : ''}}" id="admin-profile-menu">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                <a class="nav-link {{Request::is('admin/profile/edit') ? ' active' : ''}}" href="/admin/profile/edit">Edit</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{Request::is('admin/profile/change-password') ? ' active' : ''}}" href="/admin/profile/change-password">Change Password</a>
                </li>
              </ul>
            </div>
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

          <li class="nav-item {{Request::is('admin/company*') ? ' active' : ''}}">
            <a class="nav-link" data-toggle="collapse" href="#admin-company-menu" aria-expanded="false" aria-controls="admin-company-menu">
              <i class="menu-icon mdi mdi-home"></i>
              <span class="menu-title">Company</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{Request::is('admin/company*') ? ' show' : ''}}" id="admin-company-menu">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                <a class="nav-link {{Request::is('admin/company/create') ? ' active' : ''}}" href="/admin/company/create">Add Company</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{Request::is('admin/company') ? ' active' : ''}}" href="/admin/company/">All Company</a>
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