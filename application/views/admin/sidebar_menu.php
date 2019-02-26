<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a <?php echo!empty($tabActive) && $tabActive == 'dashboard' ? 'class="active"' : ''; ?> href="<?php echo admin_url(); ?>">
                    <i class="fa fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a <?php echo!empty($tabActive) && $tabActive == 'banner' ? 'class="active"' : ''; ?> href="<?php echo admin_url('banner'); ?>">
                    <i class="fa fa-flag-checkered"></i>
                    <span>Banners</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="javascript:void(0)" <?php echo!empty($tabActive) && $tabActive == 'gallery' ? 'class="active"' : ''; ?> >
                    <i class="fa fa-picture-o"></i>
                    <span>Photo Gallery</span>
                </a>
                <ul class="sub">
                    <li <?php echo!empty($subTabActive) && $subTabActive == 'gallery_manage' ? 'class="active"' : ''; ?>><a href="<?php echo admin_url('gallery'); ?>">Manage Photo Gallery</a></li>
                    <li <?php echo!empty($subTabActive) && $subTabActive == 'gallery_add' ? 'class="active"' : ''; ?>><a href="<?php echo admin_url('gallery/add'); ?>">Add Photo Gallery</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:void(0)" <?php echo!empty($tabActive) && $tabActive == 'projects' ? 'class="active"' : ''; ?> >
                    <i class="fa fa-building"></i>
                    <span>Projects</span>
                </a>
                <ul class="sub">
                    <li <?php echo!empty($subTabActive) && $subTabActive == 'projects_manage' ? 'class="active"' : ''; ?>><a href="<?php echo admin_url('projects'); ?>">Manage Projects</a></li>
                    <li <?php echo!empty($subTabActive) && $subTabActive == 'projects_add' ? 'class="active"' : ''; ?>><a href="<?php echo admin_url('projects/add'); ?>">Add Projects</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:void(0)" <?php echo!empty($tabActive) && $tabActive == 'managementteam' ? 'class="active"' : ''; ?> >
                    <i class="fa fa-product-hunt"></i>
                    <span>Management Team</span>
                </a>
                <ul class="sub">
                    <li <?php echo!empty($subTabActive) && $subTabActive == 'managementteam_add' ? 'class="active"' : ''; ?>><a href="<?php echo admin_url('managementteam/update') ?>">Add</a></li>
                    <li <?php echo!empty($subTabActive) && $subTabActive == 'managementteam_director' ? 'class="active"' : ''; ?>><a href="<?php echo admin_url('managementteam'); ?>">Directors</a></li>
                    <li <?php echo!empty($subTabActive) && $subTabActive == 'managementteam_member' ? 'class="active"' : ''; ?>><a href="<?php echo admin_url('managementteam/member'); ?>">Member</a></li>
                </ul>
            </li>

            <li>
                <a <?php echo!empty($tabActive) && $tabActive == 'contact' ? 'class="active"' : ''; ?> href="<?php echo admin_url('contact'); ?>">
                    <i class="fa fa-user"></i>
                    <span>Contact Us</span>
                </a>
            </li>

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->