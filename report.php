<?php
$php_self = $_SERVER['PHP_SELF'];
//start sessions
session_start();
//check for session
if (!isset($_SESSION['user'])) {
//redirect to index page
    header("Location: index.php");
//exit
    exit(0);
}
// session data
$value_session = $_SESSION['user'];
$user_id = $value_session[0];
$user_name = $value_session[1];

$group = "";
if(isset($_GET['group'])){
   
    $group =$_GET['group'];
	require_once("includes/connection.php"); 
	//create a data base access object
	$rea = mysql_query("select gr_p_name from gr_p where gr_p_id ='{$group}' ");
      //declare an array
       $g_name ="";
       while ($row = mysql_fetch_array($rea)) {
        $g_name = $row['gr_p_name'];}}?>

<html>
	<head>
		<title>Report</title>
        <!-- page data -->
        <!--css-->
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<link href='http://fonts.googleapis.com/css?family=PT+Serif+Caption:400,400italic' rel='stylesheet' type='text/css'>
<!--js-->
<script type="text/javascript" src="js/jquery-1.7.1.min.js" ></script>
<script type="text/javascript" src="js/superfish.js"></script>
<script type="text/javascript" src="js/forms.js"></script>
<script type="text/javascript">
    $(function(){
	 $('#contact-form').forms({
	  ownerEmail:'#'
	 })
	})
</script>
        <!-- page data ends-->
		<link class="include" rel="stylesheet" type="text/css" href="css/jquery.jqplot.min.css" />             
        <script class="include" type="text/javascript" src="js/jquery-1.9.1.js"></script>
        <!-- Don't touch this! -->
		<script class="include" type="text/javascript" src="js/jquery.jqplot.min.js"></script>
        <script class="include" type="text/javascript" src="js/syntaxhighlighter/scripts/shCore.min.js"></script>
        <script class="include" type="text/javascript" src="js/syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
        <script class="include" type="text/javascript" src="js/syntaxhighlighter/scripts/shBrushXml.min.js"></script>
  	    <!-- Additional plugins go here -->    
		<script class="include" type="text/javascript" src="js/plugins/jqplot.barRenderer.min.js"></script>
        <script class="include" type="text/javascript" src="js/plugins/jqplot.pieRenderer.min.js"></script>
        <script class="include" type="text/javascript" src="js/plugins/jqplot.categoryAxisRenderer.min.js"></script>
        <script class="include" type="text/javascript" src="js/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
        <script class="include" type="text/javascript" src="js/plugins/jqplot.canvasTextRenderer.min.js"></script>
		<script class="include" type="text/javascript" src="js/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
        <script class="include" type="text/javascript" src="js/plugins/jqplot.pointLabels.min.js"></script>
        <script class="include" type="text/javascript" src="js/plugins/jqplot.dateAxisRenderer.min.js"></script>
	</head>
<body>

<!--==============================header=================================-->
<header>
  <div class="line-top"></div>
  <div class="main">
    <div class="row-top">
      <h1><a href="index.html"><img alt="" src="images/logo.png"></a></h1>
      <nav>
        <ul class="sf-menu">
          <li><a href="index.php">Home</a></li>
           <li><a href="recipes.html">Recipes</a> </li>
           <li><a href="chefs.html">Chefs</a> </li>
          <li class="active"><a href="contact.html">Contacts</a> </li>
		 <li><a href="signup.php"><font color ="blue"><blink>SignUp/SignIn</blink></font></a></li>
        </ul>
      </nav>
      <div class="Title"><br/><font color="#0066FF"><h1>A GRAPH SHOWING TOTAL RECIPE MARKS IN <a href="Recipe_group.php?id=<?php echo $group;?>"> GROUP :<?php echo $g_name;?></a></h1></font></div>
      <div class="clear"></div>
    </div>
  </div>
</header>
<!------------------------------------ content starts here---------------------------------------------------------->

<?php	
	//get a list of health centers 
	//load into memory the database access file only once
    require_once("includes/connection.php"); 
	//create a data base access object
	$res = mysql_query("select * from recipe_tb where gr_p_id ='{$group}' ");
	$gradeslist = "";
	$recipeslist = "";
	while($row = mysql_fetch_array($res)){
		$res2 = mysql_query("select * from grade_tb where recipe_id = ".$row['recipe_id']);
		$tot = 0;
		while($row2 = mysql_fetch_array($res2)){
			$tot = $tot + $row2['grade_mark'];
		}
		 
		$gradeslist .= $tot .","; 
		$recipeslist .= $row['recipe_id'] .","; 
		
	}
	$gradeslist = substr($gradeslist,0,strlen($gradeslist)-1);
	$recipeslist = substr($recipeslist,0,strlen($recipeslist)-1);
	echo '<input type="hidden" value="'.$recipeslist.'"  id="graph1ticks" /> 
	      <input type="hidden" value="'.$gradeslist.'" id="graph1s1" />';
?>
<div id="chart1" style="margin-top:20px; margin-left:20px; width:800px; height:400px; margin-bottom:100px"></div>
<script class="code" type="text/javascript">
	$(document).ready(function(){
        $.jqplot.config.enablePlugins = true;
		var s1Input = $("#graph1s1").val();
		var graphticks = $("#graph1ticks").val();
		//alert(s1Input);
        var s1Data = s1Input.split(",");//;
		var s1 = new Array();
		for(var i = 0 ; i < s1Data.length ; i++){
			s1[i] = parseInt(s1Data[i]);
		}
        var ticks = graphticks.split(",");//['a', 'b', 'c', 'd'];
        //alert(s1Input);
        plot1 = $.jqplot('chart1', [s1], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
			series:[{renderer:$.jqplot.BarRenderer}],
            axes: {
                xaxis: {
					tickOptions:{
						angle: -30
				  	},
					tickRenderer:$.jqplot.CanvasAxisTickRenderer,
					label:'Recipe',
				  	labelOptions:{
						fontFamily:'Helvetica',
						fontSize: '14pt'
				  	},
				  	labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks
                },
				yaxis:{
					renderer:$.jqplot.LogAxisRenderer,
					tickOptions:{
						labelPosition: 'middle',
						angle:-30
					},
					tickRenderer:$.jqplot.CanvasAxisTickRenderer,
					labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
					labelOptions:{
						fontFamily:'Helvetica',
						fontSize: '14pt'
					},
					label:'Total mark'
				 }
            },
            highlighter: { show: true }
        });
    
        $('#chart1').bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
    });
</script>
<!--==============================footer=================================-->
<footer><center><h> Graph Key </h></center>
<?php	
	//get a list of health centers 
	//load into memory the database access file only once
    require_once("includes/connection.php"); 
	//create a data base access object
	$res = mysql_query("select * from recipe_tb where gr_p_id ='{$group}' ");
	     echo "<center>ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 &nbsp;&nbsp;&nbsp;&nbsp;Recipe Name</center>";
	while($row = mysql_fetch_array($res)){
		?> <div class="main">
        <?php 
		echo "<center>".$row['recipe_id']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row['recipe_name']."</center><br/>";
		?>
           </div>
		<?php
		
		
	}
	
?>
 
  <div class="clear"></div>
</footer>
</body>
</html>
