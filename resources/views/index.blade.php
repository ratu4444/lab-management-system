<!DOCTYPE html>
<html lang="en">


<!-- index.blade.php  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title> DJL-Construction </title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
<!-- ION SIGN-->
  <link rel="stylesheet" href="assets/bundles/ionicons/css/ionicons.min.css">
    <script src="../../js/frappe-gantt.js"></script>
    <link rel="stylesheet" href="../../css/frappe-gantt.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/default/DJL-Construction_Light.png' />

  <style>
    .matrix-title {
      min-height: 50px;
    }

    .logo-size {
      max-height: 200px;
      width: auto;
    }
  </style>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
<!--            <li>-->
<!--              <form class="form-inline mr-auto">-->
<!--                <div class="search-element">-->
<!--                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">-->
<!--                  <button class="btn" type="submit">-->
<!--                    <i class="fas fa-search"></i>-->
<!--                  </button>-->
<!--                </div>-->
<!--              </form>-->
<!--            </li>-->
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
<!--          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"-->
<!--              class="nav-link nav-link-lg message-toggle"><i data-feather="mail"></i>-->
<!--              <span class="badge headerBadge1">-->
<!--                6 </span> </a>-->
<!--            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">-->
<!--              <div class="dropdown-header">-->
<!--                Messages-->
<!--                <div class="float-right">-->
<!--                  <a href="#">Mark All As Read</a>-->
<!--                </div>-->
<!--              </div>-->
<!--              <div class="dropdown-list-content dropdown-list-message">-->
<!--                <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar-->
<!--											text-white"> <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle">-->
<!--                  </span> <span class="dropdown-item-desc"> <span class="message-user">John-->
<!--                      Deo</span>-->
<!--                    <span class="time messege-text">Please check your mail !!</span>-->
<!--                    <span class="time">2 Min Ago</span>-->
<!--                  </span>-->
<!--                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">-->
<!--                    <img alt="image" src="assets/img/users/user-2.png" class="rounded-circle">-->
<!--                  </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah-->
<!--                      Smith</span> <span class="time messege-text">Request for leave-->
<!--                      application</span>-->
<!--                    <span class="time">5 Min Ago</span>-->
<!--                  </span>-->
<!--                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">-->
<!--                    <img alt="image" src="assets/img/users/user-5.png" class="rounded-circle">-->
<!--                  </span> <span class="dropdown-item-desc"> <span class="message-user">Jacob-->
<!--                      Ryan</span> <span class="time messege-text">Your payment invoice is-->
<!--                      generated.</span> <span class="time">12 Min Ago</span>-->
<!--                  </span>-->
<!--                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">-->
<!--                    <img alt="image" src="assets/img/users/user-4.png" class="rounded-circle">-->
<!--                  </span> <span class="dropdown-item-desc"> <span class="message-user">Lina-->
<!--                      Smith</span> <span class="time messege-text">hii John, I have upload-->
<!--                      doc-->
<!--                      related to task.</span> <span class="time">30-->
<!--                      Min Ago</span>-->
<!--                  </span>-->
<!--                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">-->
<!--                    <img alt="image" src="assets/img/users/user-3.png" class="rounded-circle">-->
<!--                  </span> <span class="dropdown-item-desc"> <span class="message-user">Jalpa-->
<!--                      Joshi</span> <span class="time messege-text">Please do as specify.-->
<!--                      Let me-->
<!--                      know if you have any query.</span> <span class="time">1-->
<!--                      Days Ago</span>-->
<!--                  </span>-->
<!--                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">-->
<!--                    <img alt="image" src="assets/img/users/user-2.png" class="rounded-circle">-->
<!--                  </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah-->
<!--                      Smith</span> <span class="time messege-text">Client Requirements</span>-->
<!--                    <span class="time">2 Days Ago</span>-->
<!--                  </span>-->
<!--                </a>-->
<!--              </div>-->
<!--              <div class="dropdown-footer text-center">-->
<!--                <a href="#">View All <i class="fas fa-chevron-right"></i></a>-->
<!--              </div>-->
<!--            </div>-->
<!--          </li>-->
<!--          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"-->
<!--              class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i>-->
<!--            </a>-->
<!--            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">-->
<!--              <div class="dropdown-header">-->
<!--                Notifications-->
<!--                <div class="float-right">-->
<!--                  <a href="#">Mark All As Read</a>-->
<!--                </div>-->
<!--              </div>-->
<!--              <div class="dropdown-list-content dropdown-list-icons">-->
<!--                <a href="#" class="dropdown-item dropdown-item-unread"> <span-->
<!--                    class="dropdown-item-icon bg-primary text-white"> <i class="fas-->
<!--												fa-code"></i>-->
<!--                  </span> <span class="dropdown-item-desc"> Template update is-->
<!--                    available now! <span class="time">2 Min-->
<!--                      Ago</span>-->
<!--                  </span>-->
<!--                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="far-->
<!--												fa-user"></i>-->
<!--                  </span> <span class="dropdown-item-desc"> <b>You</b> and <b>Dedik-->
<!--                      Sugiharto</b> are now friends <span class="time">10 Hours-->
<!--                      Ago</span>-->
<!--                  </span>-->
<!--                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-success text-white"> <i-->
<!--                      class="fas-->
<!--												fa-check"></i>-->
<!--                  </span> <span class="dropdown-item-desc"> <b>Kusnaedi</b> has-->
<!--                    moved task <b>Fix bug header</b> to <b>Done</b> <span class="time">12-->
<!--                      Hours-->
<!--                      Ago</span>-->
<!--                  </span>-->
<!--                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-danger text-white"> <i-->
<!--                      class="fas fa-exclamation-triangle"></i>-->
<!--                  </span> <span class="dropdown-item-desc"> Low disk space. Let's-->
<!--                    clean it! <span class="time">17 Hours Ago</span>-->
<!--                  </span>-->
<!--                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="fas-->
<!--												fa-bell"></i>-->
<!--                  </span> <span class="dropdown-item-desc"> Welcome to Otika-->
<!--                    template! <span class="time">Yesterday</span>-->
<!--                  </span>-->
<!--                </a>-->
<!--              </div>-->
<!--              <div class="dropdown-footer text-center">-->
<!--                <a href="#">View All <i class="fas fa-chevron-right"></i></a>-->
<!--              </div>-->
<!--            </div>-->
<!--          </li>-->
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="assets/img/user.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello Sarah Smith</div>
              <a href="" class="dropdown-item has-icon"> <i class="far fa-user"></i> Profile</a>
<!--              <a href="timeline.html" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>-->
<!--                Activities-->
<!--              </a> -->
<!--              <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>-->
<!--                Settings-->
<!--              </a>-->
              <div class="dropdown-divider"></div>
              <a href="" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href=""> <img alt="image" src="assets/default/DJL-Construction_Dark.png" class="header-logo" /> <span
                class="logo-name">DJL</span>
            </a>
          </div>

          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown active">
              <a href="" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
          </ul>

        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row ">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card h-90">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content ">
                          <h5 class="font-15 matrix-title"> Project Completion </h5>
                        </div>
                        <div>
                          <h2 class="font-18"></h2>
<!--                          <p class="mb-0"><span class="col-green font-20">09%</span></p>-->
                        </div>
<!--                          PROGRESS BAR -->
                          <div class="progress-text col-green font-20">50%</div>
                          <div class="progress" data-height="6">
                            <div class="progress-bar bg-success" data-width="50%"></div>
                          </div>

                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/3.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

<!--            FINAL BUDGET-->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card h-90">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15 matrix-title"> Final Budget </h5>
                          <div>
                            <h2 class="font-18">100000$</h2>
                            <p class="col-orange mb-0"><span class="col-orange font-20">18%</span>
                              Increase
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/4.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

<!--            PAYMENT COMPLETION-->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card h-90">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content ">
                          <h5 class="font-15 matrix-title">Payment Completion</h5>
                        </div>
                        <div>
                          <h2 class="font-18">42000$</h2>
                          <p class="mb-0"><span class="col-green font-20">42%</span></p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/4.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
              <div class="card">
                <div class="card-header"><h4>Gantt Chart</h4></div>
                <div class="card-body">
                  <div class="recent-report__chart">
                    <div id="gantt"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>


<!--          PAYMENT HISTORY-->
          <div class="row">
              <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Payment History</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                          <th>#</th>
                          <th>Task Name</th>
                          <th>Dependency</th>
                          <th>Date</th>
                          <th>Payment Method</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                          <td>1</td>
                          <td>Payment 1 </td>
                          <td>Demolition</td>
                          <td>2023-08-20</td>
                          <td>NEFT</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Payment 2 </td>
                          <td>Concrete</td>
                          <td>2023-09-16</td>
                          <td>Cash</td>
                        </tr>

                        <tr>
                          <td>3</td>
                          <td>Payment 3 </td>
                          <td>Framing</td>
                          <td>2023-10-01</td>
                          <td>PayPal</td>
                        </tr>

                        <tr>
                          <td>4</td>
                          <td>Payment 4</td>
                          <td>Roofing</td>
                          <td>2023-10-08</td>
                          <td>Cash</td>
                        </tr>

                        <tr>
                          <td>5</td>
                          <td>Payment 5 </td>
                          <td>Mechanical</td>
                          <td>2023-10-15</td>
                          <td>Cash</td>
                        </tr>

                        <tr>
                          <td>6</td>
                          <td>Payment 6 </td>
                          <td>Electrical</td>
                          <td>2023-10-22</td>
                          <td>NEFT</td>
                        </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

<!--          TASK DETAILS-->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Schedules</h4>
                  <div class="card-header-form">
<!--                    <form>-->
<!--                      <div class="input-group">-->
<!--                        <input type="text" class="form-control" placeholder="Search">-->
<!--                        <div class="input-group-btn">-->
<!--                          <button class="btn btn-primary"><i class="fas fa-search"></i></button>-->
<!--                        </div>-->
<!--                      </div>-->
<!--                    </form>-->
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tr>
                        <th class="p-0 text-center">Task Name</th>
                        <th>Task Status</th>
                        <th>Assigh Date</th>
                        <th>Due Date</th>
                        <th>Dependency</th>
                        <th>Action</th>
                      </tr>
                      <tr>
                        <td class="p-0 text-center">Contract Review</td>
                        <td class="align-middle">
                          <div class="progress-text">50%</div>
                          <div class="progress" data-height="6">
                            <div class="progress-bar bg-success" data-width="50%"></div>
                          </div>
                        </td>
                        <td>2023-08-12</td>
                        <td>2023-08-12</td>
                        <td></td>
                        <td><a href="#" class="btn btn-outline-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td class="p-0 text-center">Mobilization</td>
                        <td class="align-middle">
                          <div class="progress-text">40%</div>
                          <div class="progress" data-height="6">
                            <div class="progress-bar bg-danger" data-width="40%"></div>
                          </div>
                        </td>
                        <td>2023-08-15</td>
                        <td>2023-08-15</td>
                        <td>
                         Contract Review
                        </td>
                        <td><a href="#" class="btn btn-outline-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td class="p-0 text-center">Demolition</td>
                        <td class="align-middle">
                          <div class="progress-text">55%</div>
                          <div class="progress" data-height="6">
                            <div class="progress-bar bg-purple" data-width="55%"></div>
                          </div>
                        </td>
                        <td>2023-08-16</td>
                        <td>2023-08-19</td>
                        <td>
                          Mobilization
                        </td>
                        <td><a href="#" class="btn btn-outline-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td class="p-0 text-center">Earth Work</td>
                        <td class="align-middle">
                          <div class="progress-text">70%</div>
                          <div class="progress" data-height="6">
                            <div class="progress-bar" data-width="70%"></div>
                          </div>
                        </td>
                        <td>2023-08-22</td>
                        <td>2019-07-31</td>
                        <td>
                          Demolition
                        </td>
                        <td><a href="#" class="btn btn-outline-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td class="p-0 text-center">Utility Connections</td>
                        <td class="align-middle">
                          <div class="progress-text">45%</div>
                          <div class="progress" data-height="6">
                            <div class="progress-bar bg-cyan" data-width="45%"></div>
                          </div>
                        </td>
                        <td>2023-08-24</td>
                        <td>2018-09-26</td>
                        <td>
                         Mobilization
                        </td>
                        <td><a href="#" class="btn btn-outline-primary">Detail</a></td>
                      </tr>
                      <tr>
                        <td class="p-0 text-center">Concrete</td>
                        <td class="align-middle">
                          <div class="progress-text">30%</div>
                          <div class="progress" data-height="6">
                            <div class="progress-bar bg-orange" data-width="30%"></div>
                          </div>
                        </td>
                        <td>2023-09-01</td>
                        <td>2023-09-15</td>
                        <td>
                          Earth Work
                        </td>
                        <td><a href="#" class="btn btn-outline-primary">Detail</a></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

<!--          PIE CHART-->
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
              <div class="card">
                <div class="card-header"><h4>Pie Chart</h4></div>
                <div class="card-body">
                  <div class="recent-report__chart">
                    <div id="pieChart"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

<!--         PROJECT TIMELINE-->

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Project Timeline</h4>
                </div>
                <div class="card-body"></div>

                <div class="ml-5 mb-4"><h5>Project Name</h5></div>
                  <div class="row">
            <div class="col-12 px-5" >
              <div class="activities">

                <!--                FIRST ACTIVITY-->
                <div class="activity">
                  <div class="activity-icon bg-success text-white">
                    <i class="fas fa-check"></i>
                  </div>
                  <div class="activity-detail width-per-50"><div>
                    <p class="text-success">Completed</p>
                  </div>
                    <div class="mb-2">
                      <span class="text-job ">Deadline 2023-08-12 </span>
                      <span class="bullet"></span>
                      <a class="text-job" href="#">View</a>
                    </div>
                    <p><b class="col-black">Contract Review.</b><a href="#"></a></p>
                  </div>
                </div>

                <!--                  SECOND ACTIVITY-->
                <div class="activity">
                  <div class="activity-icon bg-success text-white">
                    <i class="fas fa-check"></i>
                  </div>
                  <div class="activity-detail width-per-50"><div>
                    <p class="text-success">Completed</p>
                  </div>
                    <div class="mb-2">
                      <span class="text-job ">Deadline 2023-08-15</span>
                      <span class="bullet"></span>
                      <a class="text-job" href="#">View</a>
                    </div>
                    <p><b class="col-black">Mobilization.</b><a href="#"></a></p>
                  </div>
                </div>

                <!--               THIRD ACTIVITY-->
                <div class="activity">
                  <div class="activity-icon bg-orange text-white">
                    <i class="ion-android-checkmark-circle"></i>
                  </div>
                  <div class="activity-detail width-per-50"><div>
                    <p class="col-orange">In Progress</p>
                  </div>
                    <div class="mb-2">
                      <span class="text-job ">Deadline 2023-08-19</span>
                      <span class="bullet"></span>
                      <a class="text-job" href="#">View</a>
                    </div>
                    <p><b class="col-black">Demolition.</b><a href="#"></a></p>
                  </div>
                </div>

                <!--                  FOURTH ACTIVITY-->
                <div class="activity">
                  <div class="activity-icon bg-orange text-white">
                    <i class="ion-android-checkmark-circle"></i>
                  </div>
                  <div class="activity-detail width-per-50"><div>
                    <p class="col-orange">In Progress</p>
                  </div>
                    <div class="mb-2">
                      <span class="text-job ">Deadline 2023-08-31</span>
                      <span class="bullet"></span>
                      <a class="text-job" href="#">View</a>
                    </div>
                    <p><b class="col-black">Earth Work.</b><a href="#"></a></p>
                  </div>
                </div>

                <!--                  FIFTH ACTIVITY-->
                <div class="activity">
                  <div class="activity-icon bg-danger text-white">
                    <i class="ion-android-time"></i>
                  </div>
                  <div class="activity-detail width-per-50"><div>
                    <p class="text-danger">Pending</p>
                  </div>
                    <div class="mb-2">
                      <span class="text-job ">Deadline 2023-08-26</span>
                      <span class="bullet"></span>
                      <a class="text-job" href="#">View</a>
                    </div>
                    <p><b class="col-black">Utility Connections.</b><a href="#"></a></p>
                  </div>
                </div>

                <!--                  SIXTH ACTIVITY-->
                <div class="activity">
                  <div class="activity-icon bg-danger text-white">
                    <i class="ion-android-time"></i>
                  </div>
                  <div class="activity-detail width-per-50"><div>
                    <p class="text-danger">Pending</p>
                  </div>
                    <div class="mb-2">
                      <span class="text-job ">Deadline 2023-09-15</span>
                      <span class="bullet"></span>
                      <a class="text-job" href="#">View</a>
                    </div>
                    <p><b class="col-black">Concrete.</b><a href="#"></a></p>
                  </div>
                </div>

                <!--                  SEVENT ACTIVITY-->
                <div class="activity">
                  <div class="activity-icon bg-danger text-white">
                    <b class="ion-android-time"></b>
                  </div>
                  <div class="activity-detail width-per-50"><div>
                    <p class="text-danger">Pending</p>
                  </div>
                    <div class="mb-2">
                      <span class="text-job ">Deadline 2023-09-30</span>
                      <span class="bullet"></span>
                      <a class="text-job" href="#">View</a>
                    </div>
                    <p><b class="col-black">Framing.</b><a href="#"></a></p>
                  </div>
                </div>

              </div>
            </div>
          </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

  <script>
    var tasks = [
      {
        id: 'Task 1',
        name: 'Contract Review',
        start: '2023-08-12',
        end: '2023-08-12',
        progress: 20,
        // dependencies: 'Task 2, Task 3',
        // custom_class: 'bar-milestone' // optional
      },
      {
        id: 'Task 2',
        name: 'Mobilization',
        start: '2023-08-15',
        end: '2023-08-15',
        progress: 50,
        // dependencies: 'Task 2, Task 3',
        // custom_class: 'bar-milestone' // optional
      },
      {
        id: 'Task 3',
        name: 'Demolition',
        start: '2023-08-16',
        end: '2023-08-19',
        progress: 25,
        // dependencies: 'Task 2, Task 3',
        // custom_class: 'bar-milestone' // optional
      },

      {
        id: 'Task 4',
        name: 'Earth Work',
        start: '2023-08-22',
        end: '2023-08-31',
        progress: 29,
        // dependencies: 'Task 2, Task 3',
        // custom_class: 'bar-milestone' // optional
      },

      {
        id: 'Task 5',
        name: 'Utility Connections',
        start: '2023-08-24',
        end: '2023-08-26',
        progress: 75,
        // dependencies: 'Task 2, Task 3',
        // custom_class: 'bar-milestone' // optional
      }

    ]
    var gantt = new Gantt("#gantt", tasks);
    gantt.change_view_mode('Week');
  </script>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
<!--  FOR PIE CHART-->
  <script src="assets/bundles/amcharts4/core.js"></script>
  <script src="assets/bundles/amcharts4/charts.js"></script>
  <script src="assets/bundles/amcharts4/animated.js"></script>
  <script src="assets/bundles/amcharts4/worldLow.js"></script>
  <script src="assets/bundles/amcharts4/maps.js"></script>

<!--  ION SIGN-->
  <script src="assets/js/page/ion-icons.js"></script>
  <!-- Page Specific JS File -->

  <script>
    $(function () {
        pieChart();
    });

    function pieChart() {
      // Themes begin
      am4core.useTheme(am4themes_animated);
      // Themes end

      // Create chart instance
      var chart = am4core.create("pieChart", am4charts.PieChart);

      // Add data
      chart.data = [{
        "country": "Contract Review",
        "litres": 501.9
      }, {
        "country": "Mobilization",
        "litres": 301.9
      }, {
        "country": "Demolition",
        "litres": 201.1
      }, {
        "country": "Earth Work",
        "litres": 165.8
      }, {
        "country": "Utility Connections",
        "litres": 139.9
      }, {
        "country": "Concrete",
        "litres": 128.3
      }, {
        "country": "Framing",
        "litres": 99
      }, {
        "country": "Windows",
        "litres": 60
      }, {
        "country": "Roofing",
        "litres": 50
      }];

      // Add and configure Series
      var pieSeries = chart.series.push(new am4charts.PieSeries());
      pieSeries.dataFields.value = "litres";
      pieSeries.dataFields.category = "country";
      pieSeries.slices.template.stroke = am4core.color("#fff");
      pieSeries.slices.template.strokeWidth = 2;
      pieSeries.slices.template.strokeOpacity = 1;
      pieSeries.labels.template.fill = am4core.color("#9aa0ac");

      // This creates initial animation
      pieSeries.hiddenState.properties.opacity = 1;
      pieSeries.hiddenState.properties.endAngle = -90;
      pieSeries.hiddenState.properties.startAngle = -90;
    }
  </script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/index.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>

</body>


<!-- index.blade.php  21 Nov 2019 03:47:04 GMT -->
</html>
