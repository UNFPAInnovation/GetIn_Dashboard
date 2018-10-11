<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

        <title>Girl Demographics</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="">
        <meta name="author" content="" />

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,800italic,400,600,800" type="text/css">
        <link rel="stylesheet" href="./css/font-awesome.min.css" type="text/css" />		
        <link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css" />	
        <link rel="stylesheet" href="./js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.css" type="text/css" />			

        <link rel="stylesheet" href="./js/plugins/icheck/skins/minimal/blue.css" type="text/css" />

        <link rel="stylesheet" href="./css/App.css" type="text/css" />

        <link rel="stylesheet" href="./css/custom.css" type="text/css" />

    </head>

    <body>

        <div id="wrapper">
            <?php include 'includes/headerone.php'; ?>


            <div id="sidebar-wrapper" class="collapse sidebar-collapse">
                <?php
                include 'includes/navigation.php';
                ?>

            </div> <!-- /#sidebar-wrapper -->



            <div id="content">		
                <?php
                    $district = Session::getActiveDistrict();
                ?>
                <div id="content-header">
                    <h1>Demographics</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="portlet">
                                    <?php
                                        $grp = Input::get("grp", '0');
                                        $vgrp = Input::get("vgrp", '0');
                                        $where = array(array("district", "LIKE", "'$district->name'"));
                                    ?>
                                <img src="img/excel.png" alt="excel"/> 
                                    <?php
                                        echo '<a href="index.php?page=download_excel&vgrp='.$vgrp.'"  target="_blank">'
                                    ?>        
                                        <label class="label label-success">Download Excel</label>
                                    </a>
                                <div class="portlet-header">

                                    <h3>
                                        <i class="fa fa-list"></i>
                                        List Mapped Girl Demographics
                                    </h3>

                                </div> <!-- /.portlet-header -->

                                <div class="portlet-content">						
                                        <?php
                                            switch ($vgrp) {
                                                case '0':
                                                  break;
                                                case '1':
                                                  $where[] = array("COALESCE(system_id, '')","=", "''");
                                                  break;
                                                case '2':
                                                  $where[] = array("COALESCE(system_id, '')", "!=", "''");
                                                  break;
                                                case '3':
                                                  $where[] = array("system_id", "LIKE", "'HBBH%'");
                                                  break;
                                                case '4':
                                                  $where[] = array("system_id",  "LIKE", "'FPUG%'");
                                                  break;
                                                case '5':
                                                  $where[] = array("system_id",  "LIKE", "'SMA%'");
                                                  break;
                                                case '6':
                                                  $where[] = array("system_id",  "LIKE", "'LKUP%'");
                                                  break;
                                                default:
                                                  break;
                                              }
                                          ?>
                                          <form action="" method="post">
                                        <label for="id_grp">Age group</label>
                                        <select name="grp" id="id_grp" >
                                            <?php
                                                $groups = array(
                                                    "All",
                                                    "15-19 years old",
                                                    "20-24 years old",
                                                    "25-30 years old"
                                                    );
                                                foreach($groups as $key => $group){
                                                    $selected = ($key == $grp)? "selected":""; 
                                                    echo "<option value=\"$key\" $selected>$group</option>";
                                                }
                                                $range = NULL;
                                                switch ($grp){
                                                    case '0':
                                                        // Everyone no age filter
                                                        break;
                                                    case '1':
                                                        // 15-19
                                                        $range = ageRange("15 years", "19 years");
                                                        break;
                                                    case '2':
                                                        // 20 - 24
                                                        $range = ageRange("20 years", "24 years");
                                                        break;
                                                    case '3':
                                                        // 25-30
                                                        $range = ageRange("25 years", "30 years");
                                                        break;
                                                    default:
                                                        break;
                                                };
                                                if(!empty($range)){
                                                    $safeDates = array_map(quoteStr, $range);
                                                    $where[] = [
                                                            "dob",
                                                            "BETWEEN",
                                                            implode(" AND ", $safeDates)
                                                        ];
                                                }
                                                
                                        ?>
                                        </select>
                                        <label for="id_vgrp">Voucher Program</label>
                                        <?php
                                            echo('<select name="vgrp" id="id_vgrp" value="'.$vgrp.'">');
                                                $voucher_options = array(
                                                    "All pregnant girls",
                                                    "No voucher program",
                                                    "All voucher programs",
                                                    "Reproductive Health Voucher Programme (Marie Stoppes Int)",
                                                    "Family Planning (Marie Stoppes)",
                                                    "Social Marketing Activity (UHMG - Uganda Health Marketing Group)",
                                                    "Young People and Key Populations (Marie Stoppes)");
                                                $count = sizeof($voucher_options);
                                                for($i = 0; $i < $count; $i++){
                                                    $selected = ($vgrp==$i)? 'selected':'';
                                                    echo('<option value="'.$i.'" '.$selected.'>'.$voucher_options[$i].'</option>');
                                                }
                                            ?>
                                        </select>
                                        <input type="submit" name="submit" value="Go"/>
                                    </form>
                                    <div class="table-responsive">
                                        <table 
                                            class="table table-striped table-bordered table-hover table-highlight table-checkable" 
                                            data-provide="datatable" 
                                            data-display-rows="10"
                                            data-info="true"
                                            data-search="true"
                                            data-length-change="true"
                                            data-paginate="true"
                                            >
                                            <thead>
                                                <tr>
                                                    <th data-filterable="true" data-sortable="true" data-direction="desc">Full Name</th>
                                                    <th data-direction="asc" data-filterable="true" data-sortable="true">DOB</th>
                                                    <th data-filterable="true" data-sortable="true">Phone-Girl</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Phone-Holder</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Girl Location</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">LMD</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Marital Status</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Education Level</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Voucher ID</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">EDD</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $age_query = isset($grp)? $grp:"";
                                                $filter_id = true;
                                                $whereStrs = array();
                                                foreach($where as $w){
                                                    $whereStrs[] = ($w[1] == "BETWEEN")? "(".implode(" ", $w).")": implode(" ", $w);
                                                }
                                                //echo "<p>WHERE=>\"".implode(" AND ", $whereStrs)."\"</p>";
                                                $patient_list = NULL;
                                                $sql = array("SELECT * FROM core_patients");
                                                if(!empty($whereStrs)){
                                                    $sql[] = "WHERE";
                                                    $sql[] = implode(" AND ", $whereStrs);
                                                }
                                                $queryStr = implode(" ", $sql);
                                                //echo "<p>$queryStr</p>";
                                                $query = DB::getInstance()->query($queryStr);
                                                foreach ($query->results() as $patient_list) {
                                                    echo "<tr>";
                                                    echo "<td>".$patient_list->given_name." " . $patient_list->family_name."</td>";
                                                    echo "<td>".streamline_date($patient_list->dob)."</td>";
                                                    echo "<td>".$patient_list->pnumber."</td>";
                                                    echo "<td class=\"hidden-xs hidden-sm\">".$patient_list->holder_pnumber."</td>";
                                                    echo "<td class=\"hidden-xs hidden-sm\">".$patient_list->location."</td>"; 
                                                    echo "<td class=\"hidden-xs hidden-sm\">".streamline_date($patient_list->lmd)."</td>";
                                                    echo "<td class=\"hidden-xs hidden-sm\">".$patient_list->marital_status."</td>";
                                                    echo "<td class=\"hidden-xs hidden-sm\">".$patient_list->education_level."</td>";
                                                    echo "<td class=\"hidden-xs hidden-sm\">".$patient_list->system_id."</td>";
                                                    echo "<td class=\"hidden-xs hidden-sm\">".addMonthsToDate(9, $patient_list->lmd)."</td>";
                                                    echo "<td><form action=\"index.php?page=demograhics_details\" method=\"post\">";
                                                    echo "<input name=\"patient_id\" value=\"".$patient_list->subject_ptr_id."\" type=\"hidden\"/>";
                                                    echo "<button class=\"btn btn-xs btn-success\" type=\"submit\">View Details</button>";
                                                    echo "</form></td>";
                                                    echo "</tr>";   
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div> <!-- /.table-responsive -->

                                </div> <!-- /.portlet-content -->

                            </div> <!-- /.portlet -->

                        </div> <!-- /.col -->

                    </div> <!-- /.row -->

                </div> <!-- /#content-container -->

            </div> <!-- #content -->

        </div> <!-- #wrapper -->

        <?php
        include 'includes/footer.php';
        include 'includes/footerjs.php';
        include 'includes/datatablejs.php';
        include 'includes/appjs.php';
        ?>            

    </body>
</html>