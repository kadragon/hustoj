<?php $show_title="$OJ_NAME"; ?>
<?php include("template/$OJ_TEMPLATE/header.php");?>



<?php
  function reformat($times) {
    $a = explode(":", explode(" ", $times)[1]);
    $b = explode("-", explode(" ", $times)[0]);
    return sprintf("%s-%s / %s:%s", $b[1], $b[2], $a[0], $a[1]);
  }
?>
<script src="https://cdnjs.loli.net/ajax/libs/textfit/2.3.1/textFit.min.js"></script>
<div class="padding">

  <!-- <form action="" class="ui mini form" method="get" role="form" id="form"> -->
  <form id=simform class="ui mini form" action="status.php" method="get">
    <div class="inline fields" style="margin-bottom: 25px; white-space: nowrap; ">
      <label style="font-size: 1.2em; margin-right: 1px; ">문제번호: </label>
      <div class="field"><input name="problem_id" style="width: 100px; " type="text" value="<?php echo  htmlspecialchars($problem_id, ENT_QUOTES) ?>"></div>
        <label style="font-size: 1.2em; margin-right: 1px; ">ID： </label>
        <div class="field"><input name="user_id" style="width: 100px; " type="text" value="<?php echo  htmlspecialchars($user_id, ENT_QUOTES) ?>"></div>

        <label style="font-size: 1.2em; margin-right: 1px; ">언어: </label>
        <select class="form-control" size="1" name="language" style="width: 110px;font-size: 1em ">
          <option value="-1">All</option>
          <?php
          if(isset($_GET['language'])){
            $selectedLang=intval($_GET['language']);
          }else{
            $selectedLang=-1;
          }
          $lang_count=count($language_ext);
          $langmask=$OJ_LANGMASK;
          $lang=(~((int)$langmask))&((1<<($lang_count))-1);
          for($i=0;$i<$lang_count;$i++){
            if($lang&(1<<$i))
            echo"<option value=$i ".( $selectedLang==$i?"selected":"").">
            ".$language_name[$i]."
            </option>";
          }
          ?>
        </select>
        <label style="font-size: 1.2em; margin-right: 1px;margin-left: 10px; ">채점상황: </label>
        <select class="form-control" size="1" name="jresult" style="width: 110px;">
          <?php if (isset($_GET['jresult'])) $jresult_get=intval($_GET['jresult']);
          else $jresult_get=-1;
          if ($jresult_get>=12||$jresult_get<0) $jresult_get=-1;
          if ($jresult_get==-1) echo "<option value='-1' selected>All</option>";
          else echo "<option value='-1'>All</option>";
          for ($j=0;$j<12;$j++){
          $i=($j+4)%12;
          if ($i==$jresult_get) echo "<option value='".strval($jresult_get)."' selected>".$jresult[$i]."</option>";
          else echo "<option value='".strval($i)."'>".$jresult[$i]."</option>";
          }
          echo "</select>";
          ?>
          <?php 
          // if(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'source_browser'])){
          //   if(isset($_GET['showsim']))
          //   $showsim=intval($_GET['showsim']);
          //   else
          //   $showsim=0;
          //   echo "<label style=\"font-size: 1.2em; margin-right: 1px;margin-left: 10px; \">相似度：</label>";
          // echo "
          // <select id=\"appendedInputButton\" class=\"form-control\" name=showsim onchange=\"document.getElementById('simform').submit();\" style=\"width: 110px;\">
          // <option value=0 ".($showsim==0?'selected':'').">All</option>
          // <option value=50 ".($showsim==50?'selected':'').">50</option>
          // <option value=60 ".($showsim==60?'selected':'').">60</option>
          // <option value=70 ".($showsim==70?'selected':'').">70</option>
          // <option value=80 ".($showsim==80?'selected':'').">80</option>
          // <option value=90 ".($showsim==90?'selected':'').">90</option>
          // <option value=100 ".($showsim==100?'selected':'').">100</option>
          // </select>";
          // }
          ?>
      <button class="ui labeled icon mini button" type="submit" style="margin-left: 20px;">
        <i class="search icon"></i>
        검색
      </button>
    </div>
  </form>

  <table id="vueAppFuckSafari" class="ui very basic structured table striped compact" style="white-space: nowrap; " id="table">
    <thead>
      <tr>
		    <th></th>
		    <th class="center aligned">ID</th>
        <th class="center aligned">문제</th>
        <th class="center aligned">결과</th>
        <th class="center aligned">메모리</th>
        <th class="center aligned">시간</th>
        <th class="center aligned">언어</th>
        <th class="center aligned">길이</th>
        <th class="center aligned">제출시간</th>
        <!-- <th>判题机</th> -->
      </tr>
    </thead>
    <tbody>
      <!-- <tr v-for="item in items" :config="displayConfig" :show-rejudge="false" :data="item" is='submission-item'>
	  </tr> -->
    <?php
    foreach($view_status as $row){
      ?>
      <tr>
        <td class="center aligned"><b><?=$row[0]?></b></td>
        <td class="center aligned"><?=$row[1]?></td>
        <td class="center aligned"><?=$row[2]?></td>
        <td class="aligned"><b><?=$row[3]?></b></td>
        <td class="right aligned"><?=$row[4]?></td>
        <td class="right aligned"><?=$row[5]?></td>
        <td class="center aligned"><?=$row[6]?></td>
        <td class="right aligned"><?=explode(" ",$row[7])[0]?>B</td>
        <td class="center aligned"><?=reformat($row[8])?></td>
      </tr>
    
    <?php
    }
    ?>

    <!-- $i=0;
    echo "<tr>";
    foreach($row as $table_cell){
      if ($i == 9)
        break;
      else if($i>3&&$i!=8)
        // echo "<td class='hidden-xs'><b>";
        echo "<td class='mobile hidden'><b>";
      else
        echo "<td><b>";
      echo $table_cell;
      echo "</b></td>";
      $i++;
    }
    echo "</tr>\n"; -->

    </tbody>
  </table>
  <div style="margin-bottom: 30px; ">
  
  <div style="text-align: center; ">
	<div class="ui pagination menu" style="box-shadow: none; ">
	  <a class="icon item" href="<?php echo "status.php?".$str2;?>" id="page_prev">  
    처음
	  </a>
	  <?php
      if (isset($_GET['prevtop']))
      echo "<a class=\"item\" href=\"status.php?".$str2."&top=".intval($_GET['prevtop'])."\">이전</a>";
      else
      echo "<a class=\"item\" href=\"status.php?".$str2."&top=".($top+20)."\">이전</a>";

      ?>
      
	  <a class="icon item" href="<?php echo "status.php?".$str2."&top=".$bottom."&prevtop=$top"; ?>" id="page_next">
	    다음
	  </a>  
	</div>
  </div>
</div>

	<script src="template/<?php echo $OJ_TEMPLATE?>/auto_refresh.js?v=0.35" ></script>

<?php include("template/$OJ_TEMPLATE/footer.php");
