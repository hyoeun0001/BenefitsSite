<?php

  require "dbcon.php";

  $sql="select * from benefit";  //전체 혜택 가져오기

  $result=oci_parse($db,$sql); 
  oci_execute($result); 

  $res = array();
  $row_num = oci_fetch_all($result, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

?>
  

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>공공혜택사업</title>
    <link rel="stylesheet" href="css/allBenefit_css.css">
  </head>
  <body>
    <div id="container">
      <header>
        <div id="logo">
          <a href="index.php">
            <h1>공공혜택사업</h1>
          </a>
        </div>
        <nav>
          <ul id="topMenu">
          <?php if(isset($_SESSION['ID']))  { ?>
            <li><a href="logout.php">로그아웃</a></li>
            <li><a href="signout.php">회원탈퇴</a></li>
            <li><a href="mypage.php">마이페이지</a></li>
            <li><a href="allBenefit.php">전체혜택</a></li>
            <?php } else {?>
            <li><a href="login_view.php">로그인</a></li>
            <li><a href="register_view.php">회원가입</a></li>
            <li><a href="mypage.php">마이페이지</a></li>
            <li><a href="allBenefit.php">전체혜택</a></li>
            <?php }
          ;?>
          </ul>
        </nav>
      </header>
      <main class="contents">
        <h1>진행중인 공공혜택사업 목록</h1>
        <hr style="border: 0; margin-left: 70px; width: 1000px; height: 2px; background-color: #44546A;">
        <div class="board_info">
          <span id="notice_allcount">- 총 게시물 : <?php echo $row_num; ?>건</span>
        </div>
        <table class="benefit_table">
          <colgroup>
            <col style="width:200px;"/>
            <col>
            <col style="width:200px;"/>
            <col style="width:240px;"/>
          </colgroup>
          <thead>
            <tr>
              <th>사업번호</th>
              <th>혜택이름</th>
              <th>부서</th>
              <th>진행기간</th>
            </tr>
          </thead>
          <tbody>
            <!--*질문 세로로 입력 가능??-->
            
            <!--불러온 디비 for문으로 출력-->
            <?php 
              for($i=0; $i<$row_num; $i++ ){
                echo('
                <tr>
                  <td> '.$res[$i]["BN"].' </td>
                  <td>
                  <div class="benefit_subject">
                    <a href="">
                    <span>  '.$res[$i]["BENEFITNAME"].' </span>
                    </a>
                  </div>
                  </td>
                  <td> '.$res[$i]["DIC"].' </td>
                  <td> '.$res[$i]["PERIOD"].'  </td>
                </tr>
                ');            
              }
            
            ?>
            <!--
            <tr>
              <td>2</td>
              <td>
                <div class="benefit_subject">
                  <a href="">
                    <span>국가장학금 2유형(대학연계지원형)</span>
                  </a>
                </div>
              </td>
              <td>국가장학부</td>
              <td>2022. 8. 17 ~ 2022. 9 15</td>
            </tr>
            <tr>
              <td>3</td>
              <td>
                <div class="benefit_subject">
                  <a href="">
                    <span>학자금대출</span>
                  </a>
                </div>
              </td>
              <td>국가장학부</td>
              <td>2022. 8. 17 ~ 2022. 9 15</td>
            </tr>
            -->
          </tbody>
        </table>
        <div class="pagination">
          <div class="page">
            <span class="page_link-group">
              <strong title="현재 1페이지" class="page_link active">
                "1"
              </strong>
              <a href="" title="2페이지 이동" class="page_link">2</a>
              <a href="" title="3페이지 이동" class="page_link">3</a>
              <a href="" title="4페이지 이동" class="page_link">4</a>
              <a href="" title="5페이지 이동" class="page_link">5</a>
            </span>
          </div>
        </div>
      </main>
      <footer>
        <section id="bottomMenu">
          <ul id="bottomMenu_list">
            <li>C087031 최효은</li>
            <li>C089020 김지연</li>
            <li>C089075 문상준</li>
          </ul>
        </section>
      </footer>
    </div>
  </body>
</html>
<!-- 디비 연결 닫기 -->
<?php
oci_free_statement($result);
oci_close($db);

?>