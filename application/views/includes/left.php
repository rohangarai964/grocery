<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$controller = $this->router->fetch_class();
$method = $this->router->fetch_method();
$login_cred = $this->session->userdata('login_cred'); ?>

<style>
    img {
        width: 100%;
        height: auto;
    }

    /* ul.list-unstyled li img {
        width: 100%;
        padding: 5px 20px 10px 20px;
    } */
    .shrinked ul li img {
        width: 60% !important;
    }

    
    #sidebar ul li img {
        width: 25%;
    }

    .sub_menu {
        margin: -5px 0 0 0;
        text-align: center;
    }

    .sub_menu li {
        font-size: 12px;
        padding: 5px 0px;
        background-color: #f6f8fa;
        border-bottom: 1px solid #cdcdcd;
    }

    .sub_menu li.active:hover {
        background-color: #fff;
        color: #fff;
    }

    nav#sidebar li li.active>a:hover {
        background-color: transparent;
        color: #fff;
    }

    .sub_menu li a:hover {
        color: #db4e18 !important;
    }

    /* .hide{
        display: none;
    }
    .show{
        display: block;
    } */
    .shrinked .hides {
        display: none;
    }

    .menu_name {
        position: absolute;
        bottom: 15%;
        left: 40%;
    }
    [data-title]:hover:after {
            visibility: visible;
        }
          
        [data-title]:after {
            content: attr(data-title);
            background-color: #4b9c2c;    
            color: #ffffff;
            font-size: 150%;
            position: absolute;
            padding: 4px 8px 4px 8px;
            visibility: hidden;
        }
        
</style>

<!-- Sidebar Navigation-->
<!-- class="shrinked" -->
<nav id="sidebar" class="shrinked">

    <ul class="list-unstyled">

        <li class="<?= $controller == 'dashboard' ? 'active' : '' ?>"><a href="<?= base_url();  ?>" title="Home"> <img src="assets/img/pwc_dashboard.png" data-toggle="popover" ><span class="menu_name hides">Home</span></a></li>
        <? if (have_access('user')) { ?>
            <li>
                <a class="<?= $controller == 'user' ? '' : 'collapsed' ?>" href="#user" aria-expanded="<?= $controller == 'user' ? 'true' : ($controller == 'credit_promo_code' ? 'parent open' : ($controller == 'sms_promo_code' ? 'true' : 'false')) ?>" data-toggle="collapse">
                    <img src="assets/img/user.png" data-toggle="popover" title="User"> <span class="menu_name hides">User</span>
                </a>
                <ul id="user" class="sub_menu collapse list-unstyled <?= $controller == 'user' ? 'show' : '' ?>" data-parent="#sidebar">
                    <? if (have_access_method('user', 'add')) { ?>
                       <!-- <li class="<?= ((($method == 'add' || $method == 'edit') && $controller == 'user') ? 'active' : ''); ?>"><a href="<?= base_url('user/add'); ?>">Add user</a></li>-->
                    <? }
                    if (have_access_method('user', array('index', 'get_users'))) { ?>
                        <li class="<?= (($method == 'index' && $controller == 'user') ? 'active' : ''); ?>"><a href="<?= base_url('user/'); ?>">Manage User</a></li>
                    <? } ?>
                </ul>
            </li>
        <? } ?>


        <?php if (have_access('client')) { ?>
            <li>
                <a class="<?= $controller == 'client' ? '' : 'collapsed' ?>" href="#client" aria-expanded="<?= $controller == 'client' ? 'true' : ($controller == 'credit_promo_code' ? 'parent open' : ($controller == 'sms_promo_code' ? 'true' : 'false')) ?>" data-toggle="collapse">
                    <img src="assets/img/men.png" data-toggle="popover" title="Client"> <span class="menu_name hides">Client</span>
                </a>
                <ul id="client" class="sub_menu collapse list-unstyled <?= $controller == 'client' ? 'show' : '' ?>" data-parent="#sidebar">

                    <?php if (have_access_method('client', array('index', 'get_client'))) { ?>
                        <li class="sub_menu<?= (($method == 'index' && $controller == 'client') ? 'active' : ''); ?>">
                            <a href="<?= base_url('client/'); ?>">Manage client</a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>



        <? if (have_access('project_controller')) { ?>
            <li><a class="<?= $controller == 'project_controller' ? '' : 'collapsed' ?>" href="#project" aria-expanded="<?= $controller == 'project_controller' ? 'true' : ($controller == 'credit_promo_code' ? 'parent open' : ($controller == 'sms_promo_code' ? 'true' : 'false')) ?>" data-toggle="collapse"> <img src="assets/img/project.png" data-toggle="popover" title="Project"> <span class="menu_name hides">Project</span> </a>
                <ul id="project" class="sub_menu collapse list-unstyled <?= $controller == 'project_controller' ? 'show' : '' ?>" data-parent="#sidebar">
                <?php //if (have_access_method('project_controller', 'add')) { ?>
                
               <!-- <li class="<?= ($method == 'add' ? 'active' : ''); ?>"><a href="<?= base_url('project_controller/add'); ?>">Add Project</a></li>-->
                   <?php// }?>
                <li class="<?= (($method == 'index' && $controller == 'project_controller') ? 'active' : ''); ?>"><a href="<?= base_url('project_controller/'); ?>">Manage Project</a></li>
                </ul>
            </li>
        <? } ?>


        <? if (have_access('task_controller')) { ?>
            <li><a class="<?= $controller == 'task_controller' ? '' : 'collapsed' ?>" href="#task" aria-expanded="<?= $controller == 'task_controller' ? 'true' : ($controller == 'credit_promo_code' ? 'parent open' : ($controller == 'sms_promo_code' ? 'true' : 'false')) ?>" data-toggle="collapse"> <img src="assets/img/notepad.png" data-toggle="popover" title="task"><span class="menu_name hides">Task</span></a>
                <ul id="task" class="sub_menu collapse list-unstyled <?= $controller == 'task_controller' ? 'show' : '' ?>" data-parent="#sidebar">
                    <li class="<?= (($method == 'index' && $controller == 'task_controller') ? 'active' : ''); ?>"><a href="<?= base_url('task_controller/'); ?>">Manage Task</a></li>
                </ul>
            </li>
        <? } ?>


        <!-- <? if (have_access('ProjectLeadController')) { ?>
            <li><a class="<?= $controller == 'ProjectLeadController' ? '' : 'collapsed' ?>" href="#task" aria-expanded="<?= $controller == 'ProjectLeadController' ? 'true' : ($controller == 'credit_promo_code' ? 'parent open' : ($controller == 'sms_promo_code' ? 'true' : 'false')) ?>" data-toggle="collapse"> <img src="assets/img/notepad.png" data-toggle="popover" title="Project Lead"></a>
                <ul id="task" class="sub_menu collapse list-unstyled <?= $controller == 'task_controller' ? 'show' : '' ?>" data-parent="#sidebar">
                   <li class="<? //= ($method=='add' ? 'active' : '');?>"><a href="<?//=base_url('task_controller/add'); ?>">Add Activities</a></li>
                    <li class="<?= (($method == 'index' && $controller == 'ProjectLeadController') ? 'active' : ''); ?>"><a href="<?= base_url('ProjectLeadController/add_project_lead'); ?>">Add Lead</a></li>
                    <li class="<?= (($method == 'index' && $controller == 'ProjectLeadController') ? 'active' : ''); ?>"><a href="<?= base_url('ProjectLeadController/'); ?>">Manage Lead</a></li>
                </ul>
            </li>
        <? } ?> -->


        <!-- <li>
            <a class="<?= $controller == 'task_controller' ? '' : 'collapsed' ?>" href="#task" aria-expanded="<?= $controller == 'task_controller' ? 'true' : ($controller == 'credit_promo_code' ? 'parent open' : ($controller == 'sms_promo_code' ? 'true' : 'false')) ?>" data-toggle="collapse"> <img src="assets/img/notification.png" data-toggle="popover" title="Notification"></a>
        </li> -->
        <!-- <li>
            <img src="assets/img/search.png" data-toggle="popover" title="Search">
        </li> -->
        <!-- <li>
            <img src="assets/img/questionMark.png" data-toggle="popover" title="Query">
        </li>

        <li>
            <img src="assets/img/alphabet.png">
        </li> -->

    </ul>
    <!--<span class="heading">Reports</span>
        <ul class="list-unstyled">-->
    <!--<li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>-->
    <!--<li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>-->
    <!--<li> <a href="#"> <i class="icon-chart"></i>Demo </a></li>-->
    <!-- </ul>-->
</nav>
<!-- Sidebar Navigation end-->
<div class="page-content">