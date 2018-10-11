<div id="search">
</div>
<nav id="sidebar" class="hidden-print">		

    <ul id="main-nav" class="open-active">			

        <li class="active">				
            <a href="index.php?page=dashboard">
                <i class="fa fa-home"></i>
                Dashboard
            </a>				
        </li>

        <?php
        if ($_SESSION['getin_role'] == 'dho' || $_SESSION['getin_role'] == 'admin'):
            ?>
            <li class="dropdown">
                <a href="javascript:;">
                    <i class="fa fa-list"></i>
                    Demographics
                    <span class="caret"></span>
                </a>

                <ul class="sub-nav">
                    <li>
                        <a href="index.php?page=demographics">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Mapped Girls
                        </a>
                    </li>		

                </ul>	

            </li>
            <li class="dropdown">
                <a href="javascript:;">
                    <i class="fa fa-archive"></i>
                    Follow Up
                    <span class="caret"></span>
                </a>

                <ul class="sub-nav">
                    <li>
                        <a href="index.php?page=vht_follow">

                            <i class="fa fa-arrow-circle-o-right"></i> 
                            CHEW
                        </a>
                    </li>		
                    <li>
                        <a href="index.php?page=midwife_follow">

                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Midwife
                        </a>
                    </li>
                </ul>	

            </li>
            <li class="dropdown">
                <a href="javascript:;">
                    <i class="fa fa-hospital"></i>
                    Visits
                    <span class="caret"></span>
                </a>

                <ul class="sub-nav">
                    <li>
                        <a href="index.php?page=scheduled_appointments">

                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Scheduled Visits
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=expected_visits">

                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Expected Today
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=attended_today">

                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Attended 
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=missed_attendance">

                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Missed 
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=completed_visits">

                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Completed 
                        </a>
                    </li>
                </ul>	

            </li>

            <li class="dropdown">
                <a href="javascript:;">
                    <i class="fa fa-user"></i>
                    Medical Personnel
                    <span class="caret"></span>
                </a>

                <ul class="sub-nav">
                    <li>
                        <a href="index.php?page=new_driver">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            New Driver
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=ambulance_drivers">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Ambulance Drivers
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=midwives_count">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Mid Wives
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=vht_count">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            VHT
                        </a>
                    </li>

                </ul>
            </li>


            <li class="dropdown">
                <a href="javascript:;">
                    <i class="fa fa-file-text-o"></i>
                    Closed User Groups
                    <span class="caret"></span>
                </a>

                <ul class="sub-nav">
                    <li>
                        <a href="index.php?page=cug">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            List Closed User Groups
                        </a>
                    </li>

                </ul>
            </li>

            <li class="dropdown">
                <a href="javascript:;">
                    <i class="fa fa-group"></i>
                    Users
                    <span class="caret"></span>
                </a>

                <ul class="sub-nav">
                    <li>
                        <a href="index.php?page=users">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            New User
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=list_users">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            List Users
                        </a>
                    </li>

                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:;">
                    <i class="fa fa-envelope"></i>
                    Messages
                    <span class="caret"></span>
                </a>

                <ul class="sub-nav">
                    <li>
                        <a href="index.php?page=sms_number">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            SMS to Number
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=sms_group">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            SMS a Group
                        </a>
                    </li>
<!--                    <li>
                        <a href="index.php?page=broadcast_message">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            SMS Patients
                        </a>
                    </li>-->
                    <li>
                        <a href="index.php?page=messages">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Compose/Edit Reminder SMS
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=override_messages">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Send Message Now
                        </a>
                    </li>

                </ul>	

            </li>
            <li class="dropdown">
                <a href="javascript:;">
                    <i class="fa fa-book"></i>
                    Reports
                    <span class="caret"></span>
                </a>

                <ul class="sub-nav">
                    <li>
                        <a href="index.php?page=demographics">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Mapped Girls
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=demographics_statistics">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Demographical Statistics
                        </a>
                    </li>

                </ul>	

            </li>
            <li class="dropdown">
                <a href="javascript:;">
                    <i class="fa fa-gears"></i>
                    Settings
                    <span class="caret"></span>
                </a>

                <ul class="sub-nav">
                    <li>
                        <a href="index.php?page=change_password">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Change Password
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="index.php?page=logout">
                    <i class="fa fa-lock"></i>
                    Logout
                </a>

            </li>
            <?php
        endif;
        ?>
    </ul>

</nav> <!-- #sidebar -->