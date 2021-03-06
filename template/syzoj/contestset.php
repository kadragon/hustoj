<?php $show_title="$OJ_NAME"; ?>
<?php include("template/$OJ_TEMPLATE/header.php");?>

<?php
  function reformat($times) {
    $a = explode(":", explode(" ", $times)[1]);
    $b = explode("-", explode(" ", $times)[0]);
    return sprintf("%s-%s / %s:%s", $b[1], $b[2], $a[0], $a[1]);
  }
?>

<div class="padding">
<div class="ui grid" style="margin-bottom: 10px; ">
    <div class="row" style="white-space: nowrap; ">
      <div class="seven wide column">
          <form method=post action=contest.php >
            <div class="ui search" style="width: 280px; height: 28px; margin-top: -5.3px; ">
              <div class="ui left icon input" style="width: 100%; ">
                <input class="prompt" style="width: 100%; " type="text" value="" placeholder="검색어" name="keyword">
                <i class="search icon"></i>
              </div>
              <div class="results" style="width: 100%; "></div>
            </div>
          </form>

      </div>

      <div class="nine wide right aligned column">
        <a class="ui button" href="https://oj.kadragon.dev/contest.php?keyword=전체공개">전체공개</a>
        <a class="ui button orange" href="https://oj.kadragon.dev/contest.php?keyword=월-2">월-2</a>
        <a class="ui button yellow" href="https://oj.kadragon.dev/contest.php?keyword=화-3">화-3</a>
        <a class="ui button olive" href="https://oj.kadragon.dev/contest.php?keyword=화-6">화-6</a>
        <a class="ui button green" href="https://oj.kadragon.dev/contest.php?keyword=화-7">화-7</a>
        <a class="ui button teal" href="https://oj.kadragon.dev/contest.php?keyword=수-6">수-6</a>
        <a class="ui button blue" href="https://oj.kadragon.dev/contest.php?keyword=목-1">목-1</a>
        <a class="ui button violet" href="https://oj.kadragon.dev/contest.php?keyword=금-2">금-2</a>
        <a class="ui button purple" href="https://oj.kadragon.dev/contest.php?keyword=금-6">금-6</a>
        
      </div>
    </div>
  </div>

      <div style="margin-bottom: 30px; ">
    
    <?php
      if (!isset($page)) {
          $page=1;
      }
      $page=intval($page);
      $section=8;
      $start=$page>$section?$page-$section:1;
      $end=$page+$section>$view_total_page?$view_total_page:$page+$section;
    ?>
<!-- <div style="text-align: center; ">
  <div class="ui pagination menu" style="box-shadow: none; ">
    <a class="<?php if ($page==1) {
        echo "disabled ";
    } ?>icon item" href="<?php if ($page<>1) {
        echo "contest.php?page=".($page-1);
    } ?>" id="page_prev">  
      <i class="left chevron icon"></i>
    </a>
    <?php
      for ($i=$start;$i<=$end;$i++) {
          echo "<a class=\"".($page==$i?"active ":"")."item\" href=\"contest.php?page=".$i."\">".$i."</a>";
      }
    ?>
    <a class="<?php if ($page==$view_total_page) {
        echo "disabled ";
    } ?> icon item" href="<?php if ($page<>$view_total_page) {
        echo "contest.php?page=".($page+1);
    } ?>" id="page_next">
    <i class="right chevron icon"></i>
    </a>  
  </div>
</div> -->

</div>
    <table class="ui very basic table">
      <thead>
        <tr class="center aligned">
          <!-- <th>ID</th> -->
          <th>대회명</th>
          <th></th>
          <th>기간</th>
          <!-- <th>종료</th> -->
          
          <!-- <th>주최</th> -->
          <!-- <th></th> -->
        </tr>
      </thead>
      <tbody>
          <?php
            $now_time = date("Y-m-d H:i:s");
            $p = ["red", "green", ""];
            $msg = ["종료됨", "진행중", "대기중"];

            foreach ($view_contest as $row) {
              $set = 1;
              if ($now_time < $row[7]) {
                $set = 2;
              } else if ($now_time > $row[8]) {
                $set = 0;
              }
              ?>
                <tr>
                <!-- <td><?=$row[0]?></td> -->
                <td><?=$row[1]?></td>
                <td class="center aligned"><button class='ui mini button <?=$p[$set]?>'><?=$msg[$set]?></button></td>
                <td class="center aligned"><?=reformat($row[7])?> ~ <?=reformat($row[8])?></td>
                </tr>
          <?php
            }
          ?>
          <?php
          // echo "<tr>";
          //       foreach ($row as $table_cell) {
          //           echo "<td>";
          //           echo "\t".$table_cell;
          //           echo "</td>";
          //       }
          //       echo "</tr>";
          ?>
          <!-- <td><a href="<%= syzoj.utils.makeUrl(['contest', contest.id]) %>"><%= contest.title %> <%- tag %></a></td>
          <td><%= syzoj.utils.formatDate(contest.start_time) %></td>
          <td><%= syzoj.utils.formatDate(contest.end_time) %></td>
          <td class="font-content"><%- contest.subtitle %></td> -->
      </tbody>
    </table>
</div>

<?php include("template/$OJ_TEMPLATE/footer.php");?>