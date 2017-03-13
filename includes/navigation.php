<div id="search">
</div>
<nav id="sidebar" class="hidden-print">		

    <ul id="main-nav" class="open-active">			

        <li class="active">				
            <a href="index.php?page=dashboard">
                <i class="fa fa-dashboard"></i>
                Dashboard
            </a>				
        </li>
       
        <?php
        if ($_SESSION['jermadmin_role'] == 'Administrator'):
            ?>
            <li class="dropdown">
                <a href="javascript:;">
                    <i class="fa fa-money"></i>
                    Demographics
                    <span class="caret"></span>
                </a>

                <ul class="sub-nav">
                    <li>
                        <a href="index.php?page=demographics">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            List Pregnant Girls
                        </a>
                    </li>		

                </ul>	

            </li>
            <li class="dropdown">
                <a href="javascript:;">
                    <i class="fa fa-money"></i>
                    Follow Up
                    <span class="caret"></span>
                </a>

                <ul class="sub-nav">
                    <li>
                        <a href="index.php?page=vht_follow">

                            <i class="fa fa-arrow-circle-o-right"></i> 
                            VHT
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
                    <i class="fa fa-money"></i>
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
                    <i class="fa fa-file-text-o"></i>
                    Drivers
                    <span class="caret"></span>
                </a>

                <ul class="sub-nav">
                    <li>
                        <a href="index.php?page=ambulance_drivers">
                            <i class="fa fa-unlock"></i> 
                            Ambulance Driver
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
                            <i class="fa fa-unlock"></i> 
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
                            <i class="fa fa-group"></i> 
                            New User
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=list_users">
                            <i class="fa fa-reorder"></i> 
                            List Users
                        </a>
                    </li>

                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:;">
                    <i class="fa fa-money"></i>
                    SMS
                    <span class="caret"></span>
                </a>

                <ul class="sub-nav">
                    <li>
                        <a href="#">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Send Appointment Reminders
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=send_reminder_missed">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Send Missed Appointment
                        </a>
                    </li>

                </ul>	

            </li>
            <li class="dropdown">
                <a href="javascript:;">
                    <i class="fa fa-money"></i>
                    Reports
                    <span class="caret"></span>
                </a>

                <ul class="sub-nav">
                    <li>
                        <a href="#">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Send Appointment Reminders
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=send_reminder_missed">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Send Missed Appointment
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
                        <a href="#">
                            <i class="fa fa-arrow-circle-o-right"></i> 
                            Change Password
                        </a>
                    </li>

                </ul>
            </li>
            <?php
        endif;
        ?>
    </ul>

</nav> <!-- #sidebar -->