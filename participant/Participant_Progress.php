<html>
<head>
</head>
<body>
<svg width="580" height="120" xmlns="http://www.w3.org/2000/svg">
 <!-- Created with Method Draw - http://github.com/duopixel/Method-Draw/ -->
<?
  ini_set('display_errors', 1);
  error_reporting(~0);
  include('../config/database_conn.php');
  $Business_GUID = $_GET["business_key"];
  $GETstatSQL = "EXEC questionee.get_status '".$Business_GUID."'";
  $GETstatQuery = sqlsrv_query($objCon, $GETstatSQL);
  $GETstatResult = sqlsrv_fetch_array($GETstatQuery);


?><?
  if($GETstatResult['PercentAnsw'] == 1)
  {echo "#5fbf00";}
  else
  {echo "#0f93ff";}
  ?>
 <g>
  <title>background</title>
  <rect x="-1" y="-1" width="582" height="122" id="canvas_background" fill="#fff"/>
  <g id="canvasGrid" display="none">
   <rect id="svg_3" width="100%" height="100%" x="0" y="0" stroke-width="0" fill="url(#gridpattern)"/>
  </g>
 </g>
 <g>
  <title>Layer 1</title>
  <rect stroke="#5fbf00" fill="#5fbf00" stroke-width="1.5" x="30" y="29.01827" width="102.19178" height="61.50685" id="svg_2"/>
  <ellipse stroke="#5fbf00" ry="55" rx="55" id="svg_4" cy="60" cx="57" stroke-width="1.5" fill="#5fbf00"/>
  <ellipse stroke="#5fbf00" ry="55" rx="55" id="svg_5" cy="59.54338" cx="173" stroke-width="1.5" fill="#5fbf00"/>
  <ellipse stroke="<?
  if($GETstatResult['PercentAnsw'] > 0)
  {
    echo "#5fbf00";
  }
  else
  {
    echo "#0f93ff";
  }
  ?>" ry="55" rx="55" id="svg_6" cy="59.91324" cx="289" stroke-opacity="null" stroke-width="1.5" fill="<?
  if($GETstatResult['PercentAnsw'] > 0)
  {
    echo "#5fbf00";
  }
  else
  {
    echo "#0f93ff";
  }
  ?>"/>
  <ellipse stroke="#0f93ff" ry="55" rx="55" id="svg_7" cy="60" cx="407" stroke-opacity="null" stroke-width="1.5" fill="#0f93ff"/>
  <ellipse stroke="#0f93ff" ry="55" rx="55" id="svg_8" cy="59.54338" cx="522.91324" stroke-opacity="null" stroke-width="1.5" fill="#0f93ff"/>


  <text font-weight="bold" stroke="#0f93ff" transform="matrix(0.85230863609479,0,0,0.8508158326148987,-24.36432331616981,2.6736599998548627) " xml:space="preserve" text-anchor="start" font-family="Junction, sans-serif" font-size="24" id="svg_10" y="43.40069" x="63.05956" stroke-opacity="null" stroke-width="0" fill="#ffffff">Step 1</text>
  <text font-weight="bold" stroke="#0f93ff" transform="matrix(0.85230863609479,0,0,0.8508158326148987,-24.36432331616981,2.6736599998548627) " xml:space="preserve" text-anchor="start" font-family="Junction, sans-serif" font-size="24" id="svg_11" y="46.92671" x="194.46735" stroke-opacity="null" stroke-width="0" fill="#ffffff">Step 2</text>
  <text font-weight="bold" stroke="#0f93ff" transform="matrix(0.85230863609479,0,0,0.8508158326148987,-24.36432331616981,2.6736599998548627) " xml:space="preserve" text-anchor="start" font-family="Junction, sans-serif" font-size="24" id="svg_12" y="48.00008" x="334.08814" stroke-opacity="null" stroke-width="0" fill="#ffffff">Step 3</text>
  <text font-weight="bold" stroke="#0f93ff" transform="matrix(0.85230863609479,0,0,0.8508158326148987,-24.36432331616981,2.6736599998548627) " xml:space="preserve" text-anchor="start" font-family="Junction, sans-serif" font-size="24" id="svg_13" y="48.10205" x="469.01578" stroke-opacity="null" stroke-width="0" fill="#ffffff">Step 4</text>
  <text font-weight="bold" stroke="#0f93ff" transform="matrix(0.85230863609479,0,0,0.8508158326148987,-24.36432331616981,2.6736599998548627) " xml:space="preserve" text-anchor="start" font-family="Junction, sans-serif" font-size="24" id="svg_14" y="47.56536" x="606.18821" stroke-opacity="null" stroke-width="0" fill="#ffffff">Step 5</text>
  <text fill="#ffffff" stroke-width="0" stroke-opacity="null" fill-opacity="null" x="-15.45137" y="56.50234" id="svg_15" font-size="24" font-family="Junction, sans-serif" text-anchor="start" xml:space="preserve" transform="matrix(0.48091913443357814,0,0,0.6097797469428556,20.249798460543346,29.93573471627064) " stroke="#0f93ff">Written Application</text>
  <text fill="#ffffff" stroke-width="0" stroke-opacity="null" fill-opacity="null" x="206.08978" y="57.25117" id="svg_16" font-size="24" font-family="Junction, sans-serif" text-anchor="start" xml:space="preserve" transform="matrix(0.48091913443357814,0,0,0.6097797469428556,20.249798460543346,29.93573471627064) " stroke="#0f93ff">Telephonic Interview</text>
  <text fill="#ffffff" stroke-width="0" stroke-opacity="null" fill-opacity="null" x="448.24405" y="59.49766" id="svg_17" font-size="24" font-family="Junction, sans-serif" text-anchor="start" xml:space="preserve" transform="matrix(0.48091913443357814,0,0,0.6097797469428556,20.249798460543346,29.93573471627064) " stroke="#0f93ff">Under Consideration</text>
  <text fill="#ffffff" stroke-width="0" stroke-opacity="null" fill-opacity="null" x="716.48042" y="58" id="svg_18" font-size="24" font-family="Junction, sans-serif" text-anchor="start" xml:space="preserve" transform="matrix(0.48091913443357814,0,0,0.6097797469428556,20.249798460543346,29.93573471627064) " stroke="#0f93ff">Vision Workshop</text>
  <text fill="#ffffff" stroke-width="0" stroke-opacity="null" fill-opacity="null" x="952.86363" y="34.29206" id="svg_19" font-size="24" font-family="Junction, sans-serif" text-anchor="start" xml:space="preserve" transform="matrix(0.5047568455602885,0,0,0.6097797469428557,15.916558440408405,44.935734716270645) " stroke="#0f93ff">Shortlisted</text>
  <path stroke="#000" id="svg_9" d="m530.32898,92.78899c-1.62237,-0.66696 -2.27017,-2.49998 -2.27017,-2.49998s-0.73093,0.41519 -0.73093,-0.75088s0.73093,0.75088 1.46185,-3.75145c0,0 2.02653,-0.58451 1.62237,-5.4181l-0.48728,0c0,0 1.21678,-5.16781 0,-6.91839c-1.21821,-1.75058 -1.70406,-2.91665 -4.38269,-3.75145s-1.70263,-0.66843 -3.65033,-0.58303c-1.9477,0.08392 -3.57151,1.16607 -3.57151,1.7491c0,0 -1.21678,0.08392 -1.70263,0.58451c-0.48728,0.50059 -1.29847,2.83272 -1.29847,3.41723s0.40559,4.50232 0.81118,5.33565l-0.48298,0.16637c-0.40559,4.83359 1.62237,5.4181 1.62237,5.4181c0.72949,4.50232 1.46042,2.58538 1.46042,3.75145s-0.73093,0.75088 -0.73093,0.75088s-0.6478,1.83303 -2.27017,2.49998c-1.62237,0.66548 -10.62853,4.24909 -11.36089,4.99997c-0.73236,0.75235 -0.64923,4.25203 -0.64923,4.25203l38.62014,0c0,0 0.08456,-3.49968 -0.6478,-4.25203c-0.73379,-0.75088 -9.73995,-4.33448 -11.36232,-4.99997l0,0.00001zm-17.87187,-0.25324c-0.14189,-0.26502 -0.21211,-0.45642 -0.21211,-0.45642s-0.61914,0.35188 -0.61914,-0.63604s0.61914,0.63604 1.23828,-3.17872c0,0 1.71839,-0.4947 1.37443,-4.59214l-0.41276,0c0,0 0.20495,-0.87014 0.33967,-1.96406c-0.00573,-0.45347 0.0086,-0.93639 0.05303,-1.46642l0.05446,-0.6272c-0.0301,-0.72438 -0.15335,-1.3825 -0.44715,-1.80505c-1.0319,-1.48262 -1.44465,-2.47201 -3.71339,-3.17872c-2.26874,-0.70671 -1.44465,-0.56684 -3.09426,-0.4947c-1.65103,0.07067 -3.0269,0.98792 -3.0269,1.48409c0,0 -1.0319,0.07067 -1.44465,0.4947c-0.38839,0.399 -1.0104,2.15252 -1.08492,2.7753l0,0.41372c0.06736,0.96142 0.36976,3.60569 0.67217,4.22848l-0.40989,0.14134c-0.34253,4.09744 1.37443,4.59214 1.37443,4.59214c0.61914,3.81476 1.23828,2.1908 1.23828,3.17872s-0.61914,0.63604 -0.61914,0.63604s-0.54891,1.55623 -1.92477,2.11865c-0.08742,0.03534 -0.19921,0.08245 -0.3325,0.13545l0,7.70607l0.82408,0c-0.04156,-1.88161 0.11036,-4.30945 1.06916,-5.29148c0.51022,-0.52267 2.18275,-1.3825 9.10362,-4.21375l-0.00003,0zm32.00311,-13.33324c-0.05733,-0.55653 -0.18202,-1.0527 -0.41849,-1.39281c-1.03046,-1.48409 -1.44465,-2.47201 -3.71196,-3.17872c-2.27017,-0.70671 -1.44465,-0.56684 -3.09569,-0.4947c-1.6496,0.07067 -3.02546,0.98792 -3.02546,1.48409c0,0 -1.03046,0.07067 -1.44465,0.4947c-0.38839,0.40047 -1.01613,2.16724 -1.08636,2.78414l0.0473,0l0.11466,1.34422c0.02866,0.3401 0.03153,0.64193 0.0387,0.94964c0.12899,0.98056 0.30097,1.98762 0.47295,2.3395l-0.40989,0.14134c-0.34253,4.09744 1.37586,4.59214 1.37586,4.59214c0.61914,3.81476 1.23684,2.1908 1.23684,3.17872s-0.61914,0.63604 -0.61914,0.63604s-0.07596,0.20907 -0.23361,0.49764c6.83631,2.79739 8.49451,3.65133 8.99899,4.17253c0.96024,0.98203 1.11072,3.4084 1.06916,5.29148l0.68793,0l0,-7.81208c-0.02293,-0.00883 -0.05446,-0.02208 -0.07453,-0.03092c-1.37443,-0.56389 -1.92477,-2.11865 -1.92477,-2.11865s-0.62057,0.35188 -0.62057,-0.63604s0.62057,0.63604 1.23828,-3.17872c0,0 1.15228,-0.33716 1.38016,-2.71052l0,-1.80652c-0.00143,-0.0265 -0.00143,-0.04859 -0.0043,-0.07509l-0.41419,0c0,0 0.30814,-1.31036 0.41849,-2.73997l0,-1.73144l0.0043,0l-0.00001,0z" fill-opacity="null" stroke-opacity="null" stroke-width="0" fill="#fff"/>
  <path stroke="#000" id="svg_20" d="m424.01397,86.9271c2.84448,-2.92883 3.41624,-6.92568 1.86885,-10.28701l-5.71054,5.96377l-5.62919,-0.98014l-1.86523,-4.85618l5.6961,-5.94992c-3.91811,-0.88279 -8.23468,0.18297 -11.06663,3.10022c-2.98665,3.07549 -3.47542,7.33444 -1.62684,10.78986l-14.88504,15.32941c-1.58384,1.62978 -1.39089,4.10168 0.42898,5.51954c1.81987,1.41687 4.57948,1.24562 6.16278,-0.38418l14.86761,-15.31429c4.09261,1.18134 8.7587,0.15839 11.75917,-2.93108l0,0l-0.00002,0z" fill-opacity="null" stroke-opacity="null" stroke-width="0" fill="#fff"/>
  <path stroke="null" d="m191.62957,98.31762c-1.30527,-2.72045 -5.83731,-5.67023 -6.03687,-5.79922c-0.58243,-0.3655 -1.19021,-0.55899 -1.75899,-0.55899c-0.8457,0 -1.53798,0.42713 -1.95725,1.20399c-0.66304,0.87433 -1.48533,1.89628 -1.68489,2.05466c-1.54578,1.15454 -2.7542,1.02411 -4.09197,-0.45078l-7.4663,-8.23158c-1.32932,-1.46557 -1.45153,-2.81505 -0.41017,-4.50924c0.14561,-0.22216 1.07191,-1.12874 1.86495,-1.85973c0.50573,-0.33181 0.85285,-0.82416 1.0043,-1.42902c0.20281,-0.80481 0.0533,-1.75152 -0.42382,-2.6753c-0.11246,-0.21213 -2.788,-5.20941 -5.25553,-6.64775c-0.46022,-0.26875 -0.9783,-0.41065 -1.49898,-0.41065c-0.85675,0 -1.66279,0.36836 -2.26862,1.03557l-1.64849,1.81817c-2.60924,2.87525 -3.55439,6.13534 -2.8088,9.68783c0.62143,2.96125 2.43243,6.1124 5.38359,9.36605l9.55876,10.53851c3.18127,3.50735 6.23513,5.53693 9.10244,6.06296c-0.69879,1.79523 -2.31737,3.05585 -4.19922,3.05585c-2.03266,0 -3.791,-1.44264 -4.37473,-3.58904l-0.58763,-2.16001c-0.11636,-0.42641 -0.46607,-0.71236 -0.86975,-0.71236s-0.75339,0.28595 -0.86975,0.71308l-1.08101,3.97102l-1.08036,-3.97102c-0.11636,-0.42641 -0.46607,-0.71236 -0.86975,-0.71236s-0.75339,0.28595 -0.86975,0.71308l-1.08036,3.97031l-1.08036,-3.97102c-0.11636,-0.42641 -0.46607,-0.71236 -0.86975,-0.71236c-0.40367,0 -0.75339,0.28595 -0.86975,0.71308l-1.08036,3.97031l-1.08036,-3.97102c-0.11636,-0.42641 -0.46607,-0.71236 -0.86975,-0.71236s-0.75339,0.28595 -0.86975,0.71308l-1.08036,3.97031l-1.08036,-3.97102c-0.11636,-0.4257 -0.46607,-0.71236 -0.86975,-0.71236s-0.75339,0.28595 -0.86975,0.71308l-1.70309,6.2586c-0.10271,0.3784 0.0923,0.77829 0.43617,0.89224c0.0624,0.02078 0.12546,0.03082 0.18656,0.03082c0.28016,0 0.53823,-0.19995 0.62273,-0.51098l1.32737,-4.87832l1.08036,3.97102c0.11636,0.42641 0.46607,0.71236 0.86975,0.71236s0.75339,-0.28595 0.86975,-0.71308l1.08036,-3.97031l1.08036,3.97102c0.11636,0.42641 0.46607,0.71236 0.86975,0.71236s0.75339,-0.28595 0.86975,-0.71308l1.08036,-3.97031l1.08036,3.97102c0.11636,0.42641 0.46607,0.71236 0.86975,0.71236s0.75339,-0.28595 0.86975,-0.71308l1.08036,-3.97031l1.08036,3.97102c0.11636,0.42641 0.46607,0.71236 0.86975,0.71236s0.75339,-0.28595 0.86975,-0.71308l1.08036,-3.97102l0.21191,0.77901c0.75014,2.75844 3.00901,4.611 5.6202,4.611c2.56244,0 4.7407,-1.82318 5.53895,-4.35157c0.0468,0.00072 0.09491,0.00573 0.14171,0.00573c0.00065,0 0,0 0.00065,0c2.41878,0 4.67245,-1.13304 6.69926,-3.3676l1.64914,-1.81745c1.0017,-1.10581 1.22987,-2.77492 0.56683,-4.15449l-0.00002,0l0,0.00001z" id="svg_22" fill="#ffffff"/>
  <path fill="#ffffff" stroke="null" id="svg_21" d="m292.28865,106.41625c0,-0.42599 0.3557,-0.76977 0.79805,-0.76977l2.74468,0c1.15397,0.7459 2.45733,1.26281 3.84217,1.50425c-0.05799,0.01287 -0.11037,0.0328 -0.17073,0.0328l-6.41634,0c-0.44214,0.00145 -0.79784,-0.34378 -0.79784,-0.76728l0.00001,0zm-1.95073,-6.15234l1.42214,0c-0.1509,-0.50571 -0.26128,-1.01743 -0.32422,-1.53829l-1.09792,0c-0.44106,0 -0.79892,0.34503 -0.79892,0.76977s0.35785,0.76852 0.79892,0.76852zm-5.87676,-19.42443c-0.97978,-0.634 -1.65453,-1.88996 -1.65453,-3.01867c0,-1.59351 1.34022,-2.88664 2.99604,-2.88664c1.65582,0 2.99604,1.29312 2.99604,2.88664c0,1.12891 -0.67604,2.38467 -1.65733,3.01867c2.34846,0.57318 4.08749,2.53829 4.08749,3.99188c0,1.71911 -10.85177,1.71911 -10.85177,0c-0.00086,-1.4538 1.73968,-3.41746 4.08404,-3.99188l0.00002,0zm-0.18108,3.81875l1.5213,1.46252l1.5226,-1.46252l-1.28051,-2.98005l0.01186,0l0.49754,-0.54743c-0.2423,0.08159 -0.48827,0.13203 -0.75149,0.13203c-0.26041,0 -0.50919,-0.05065 -0.75149,-0.13452l0.49625,0.54992l0.01315,0l-1.27921,2.98005zm20.05461,25.49477l0.0028,-0.00249l-0.03816,-0.06456c-0.01983,0 -0.03686,0.00477 -0.05519,0.00477l-27.81311,0c-1.43788,0 -2.60758,-1.12621 -2.60758,-2.51047l0,-33.48351c0,-1.38363 1.1697,-2.50985 2.60758,-2.50985l27.81332,0c1.43745,0 2.60693,1.12621 2.60693,2.50985l0,15.32522c0.62365,0.37928 1.21303,0.81025 1.73925,1.31471l0,-16.63993c0,-2.30765 -1.94922,-4.18349 -4.34618,-4.18349l-27.81332,0c-2.39761,0 -4.34704,1.87585 -4.34704,4.18349l0,33.48372c0,2.30682 1.94922,4.18287 4.34683,4.18287l27.81332,0c0.33867,0 0.66699,-0.04692 0.98582,-0.11875l-0.89528,-1.49158l0.00001,0zm-23.16103,-13.39436l10.24212,0c0.0485,-0.51463 0.1371,-1.0276 0.27162,-1.5385l-10.51245,0c-0.44106,0 -0.79741,0.34378 -0.79741,0.76873c-0.00129,0.42723 0.35505,0.76977 0.79611,0.76977l0.00001,0zm0,-7.0093l14.35204,0c0.28348,-0.19846 0.57903,-0.38613 0.8873,-0.55802c0.78253,-0.43492 1.62241,-0.7623 2.49031,-0.98152l-17.72965,0c-0.44106,0 -0.79741,0.34461 -0.79741,0.77039s0.35634,0.76915 0.79741,0.76915zm0,3.50403l11.26718,0c0.28111,-0.54349 0.6118,-1.05791 0.98991,-1.53829l-12.25709,0c-0.44106,0 -0.79741,0.34503 -0.79741,0.76977s0.35634,0.76852 0.79741,0.76852zm27.28172,0.46792c2.22623,3.71391 0.90045,8.48179 -2.95875,10.62336c-3.85532,2.14261 -8.80554,0.87211 -11.03177,-2.84678c-2.22752,-3.71266 -0.90045,-8.47971 2.95358,-10.62398c3.8592,-2.14468 8.81071,-0.86859 11.03694,2.8474zm-1.15655,0.64459c-1.86019,-3.09963 -5.99101,-4.16522 -9.20845,-2.37927c-3.22003,1.7926 -4.32915,5.76559 -2.4653,8.86916c1.85609,3.09942 5.98584,4.16751 9.20565,2.37761c3.21895,-1.79384 4.32419,-5.76808 2.4681,-8.8675zm0.2298,9.50088l-3.47203,1.93169l2.67398,4.45711l3.47074,-1.92899l-2.67268,-4.4598l-0.00001,-0.00001zm3.03485,5.0664l-3.47462,1.93024c0.55661,0.92671 1.78279,1.24018 2.7408,0.70915c0.95952,-0.53352 1.28892,-1.71662 0.73381,-2.63939l0.00001,0z"/>
  <path stroke="null" fill="#ffffff" id="svg_1" d="m70.55121,73l-29.36441,0c-0.58985,0 -1.0678,0.4273 -1.0678,0.95422l0,35.82856c0,0.52692 0.47795,0.95422 1.0678,0.95422l29.36441,0c0.58985,0 1.0678,-0.4273 1.0678,-0.95422l0,-35.82856c0,-0.52692 -0.47816,-0.95422 -1.0678,-0.95422zm-15.20884,4.07606l9.93051,0c0.58985,0 1.0678,0.4273 1.0678,0.95422c0,0.52692 -0.47795,0.95422 -1.0678,0.95422l-9.93051,0c-0.58985,0 -1.0678,-0.4273 -1.0678,-0.95422c0,-0.52692 0.47795,-0.95422 1.0678,-0.95422zm0,4.91424l9.93051,0c0.58985,0 1.0678,0.4273 1.0678,0.95422c0,0.52692 -0.47795,0.95422 -1.0678,0.95422l-9.93051,0c-0.58985,0 -1.0678,-0.4273 -1.0678,-0.95422c0,-0.52692 0.47795,-0.95422 1.0678,-0.95422zm-8.149,-1.4424c-0.40171,-0.26375 -0.66396,-0.68742 -0.66396,-1.16587l0,-0.8588c0,-0.79792 0.72653,-1.44717 1.61963,-1.44717s1.61942,0.64925 1.61942,1.44717l0,0.8588c0,0.47845 -0.26225,0.90231 -0.66396,1.16587c1.25957,0.26241 2.2018,1.27179 2.2018,2.47621c0,0.52692 -0.47795,0.95422 -1.0678,0.95422l-4.17914,0c-0.58985,0 -1.0678,-0.4273 -1.0678,-0.95422c0,-1.20442 0.94222,-2.2138 2.2018,-2.47621zm-1.15557,6.35665l19.23486,0c0.58985,0 1.0678,0.4273 1.0678,0.95422c0,0.52692 -0.47795,0.95422 -1.0678,0.95422l-19.23486,0c-0.58985,0 -1.0678,-0.4273 -1.0678,-0.95422c0,-0.52692 0.47816,-0.95422 1.0678,-0.95422zm0,4.91424l19.23486,0c0.58985,0 1.0678,0.4273 1.0678,0.95422c0,0.52692 -0.47795,0.95422 -1.0678,0.95422l-19.23486,0c-0.58985,0 -1.0678,-0.4273 -1.0678,-0.95422c0,-0.52692 0.47816,-0.95422 1.0678,-0.95422zm0,4.91424l19.23486,0c0.58985,0 1.0678,0.4273 1.0678,0.95422c0,0.52692 -0.47795,0.95422 -1.0678,0.95422l-19.23486,0c-0.58985,0 -1.0678,-0.4273 -1.0678,-0.95422c0,-0.52692 0.47816,-0.95422 1.0678,-0.95422zm5.39237,8.75842l-5.39237,0c-0.58985,0 -1.0678,-0.4273 -1.0678,-0.95422c0,-0.52692 0.47795,-0.95422 1.0678,-0.95422l5.39237,0c0.58985,0 1.0678,0.4273 1.0678,0.95422c0,0.52711 -0.47795,0.95422 -1.0678,0.95422zm14.26982,0l-5.39237,0c-0.58985,0 -1.0678,-0.4273 -1.0678,-0.95422c0,-0.52692 0.47795,-0.95422 1.0678,-0.95422l5.39237,0c0.58985,0 1.0678,0.4273 1.0678,0.95422c0,0.52711 -0.47795,0.95422 -1.0678,0.95422z"/>
 </g>
</svg>
</body>
</html>