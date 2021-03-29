<?php include("template/$OJ_TEMPLATE/header.php");?>
<div class="padding">
  <h1>개인정보변경</h1>
  <div class="ui error message" id="error" data-am-alert hidden>
    <p id="error_info"></p>
  </div>
          <form action="modify.php" method="post" role="form" class="ui form">
                <div class="field">
                    <label for="username">ID</label>
                    <input class="form-control" placeholder="ID"  disabled="disabled" type="text" value="<?php echo $_SESSION[$OJ_NAME.'_'.'user_id']?>">
                </div>
                <?php require_once('./include/set_post_key.php');?>
                <div class="field">
                    <label for="username">Nickname*</label>
                    <input name="nick" placeholder="请输入昵称" type="text" value="<?php echo htmlentities($row['nick'],ENT_QUOTES,"UTF-8")?>">
                </div>
                <div class="field">
                    <label class="ui header">비밀번호*</label>
                      <input name="opassword" placeholder="비밀번호" type="password">
                    </div>
                <div class="two fields">
                    <div class="field">
                    <label class="ui header">비밀번호 변경</label>
                      <input name="npassword" placeholder="" type="password">
                    </div>
                    <div class="field">
                      <label class="ui header">비밀번호 변경 확인</label>
                      <input name="rptpassword" placeholder="" type="password">
                    </div>
                </div>
                <div class="field">
                    <label for="username">소속</label>
                    <input name="school" placeholder="한민고등학교" type="text" value="<?php echo htmlentities($row['school'],ENT_QUOTES,"UTF-8")?>">
                </div>
                <div class="field">
                    <label for="email">Email*</label>
                    <input name="email" placeholder="@hanmin.hs.kr" type="text" value="<?php echo htmlentities($row['email'],ENT_QUOTES,"UTF-8")?>">
                </div>
                <?php if($OJ_VCODE){?>
                  <div class="field">
                    <label for="email">验证码*</label>
                    <input name="vcode" class="form-control" placeholder="请输入验证码" type="text">
                    <img alt="click to change" src="vcode.php" onclick="this.src='vcode.php?'+Math.random()" height="30px">
                  </div>
                <?php }?>
                <button name="submit" type="submit" class="ui button">변경</button>
                <button name="submit" type="reset" class="ui button">초기화</button>
            </form>
</div>
<?php include("template/$OJ_TEMPLATE/footer.php");?>
