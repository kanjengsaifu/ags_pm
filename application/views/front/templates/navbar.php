<div class="header navbar">
  <div class="header-container">
    <ul class="nav-left">
      <li>
        <a class="sidebar-toggle is-collapsed" href="javascript:void(0);" id="sidebar-toggle"><i class="ti-menu"></i></a>
      </li>
    </ul>
    <ul class="nav-right">
      <!-- <li class="notifications dropdown">
        <span class="counter bgc-red">3</span> <a class="dropdown-toggle no-after" data-toggle="dropdown" href="#"><i class="ti-bell"></i></a>
        <ul class="dropdown-menu">
          <li class="pX-20 pY-15 bdB"><i class="ti-bell pR-10"></i> <span class="fsz-sm fw-600 c-grey-900">Notifications</span></li>
          <li>
            <ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm">
              <li>
                <a class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100" href="#">
                <div class="peer mR-15"><img alt="" class="w-3r bdrs-50p" src="../../../randomuser.me/api/portraits/men/1.jpg"></div>
                <div class="peer peer-greed">
                  <span><span class="fw-500">John Doe</span> <span class="c-grey-600">liked your <span class="text-dark">post</span></span></span>
                  <p class="m-0"><small class="fsz-xs">5 mins ago</small></p>
                </div></a>
              </li>
              <li>
                <a class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100" href="#">
                <div class="peer mR-15"><img alt="" class="w-3r bdrs-50p" src="../../../randomuser.me/api/portraits/men/2.jpg"></div>
                <div class="peer peer-greed">
                  <span><span class="fw-500">Moo Doe</span> <span class="c-grey-600">liked your <span class="text-dark">cover image</span></span></span>
                  <p class="m-0"><small class="fsz-xs">7 mins ago</small></p>
                </div></a>
              </li>
              <li>
                <a class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100" href="#">
                <div class="peer mR-15"><img alt="" class="w-3r bdrs-50p" src="../../../randomuser.me/api/portraits/men/3.jpg"></div>
                <div class="peer peer-greed">
                  <span><span class="fw-500">Lee Doe</span> <span class="c-grey-600">commented on your <span class="text-dark">video</span></span></span>
                  <p class="m-0"><small class="fsz-xs">10 mins ago</small></p>
                </div></a>
              </li>
            </ul>
          </li>
          <li class="pX-20 pY-15 ta-c bdT"><span><a class="c-grey-600 cH-blue fsz-sm td-n" href="#">View All Notifications <i class="ti-angle-right fsz-xs mL-10"></i></a></span></li>
        </ul>
      </li> -->
      <li class="dropdown">
        <a class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown" href="#">
        <div class="peer mR-10">
          <?=img('theme/adminator/randomuser.me/api/portraits/men/Whitehat.png', array('class'=>'w-2r bdrs-50p'))?>
        </div>
        <div class="peer">
          <span class="fsz-sm c-grey-900"><?=$this->session->userdata('name')?></span>
        </div></a>
        <ul class="dropdown-menu fsz-sm">
          <li>
            <a class="d-b td-n pY-5 bgcH-grey-100 c-grey-700" href="#"><i class="ti-settings mR-10"></i> <span>Setting</span></a>
          </li>
          <li>
            <a class="d-b td-n pY-5 bgcH-grey-100 c-grey-700" href="#"><i class="ti-user mR-10"></i> <span>Profile</span></a>
          </li>
          <li class="divider" role="separator"></li>
          <li>
            <a class="d-b td-n bgcH-grey-100 c-grey-700" href="<?=site_url('logout')?>"><i class="ti-power-off mR-10"></i> <span>Logout</span></a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</div>
