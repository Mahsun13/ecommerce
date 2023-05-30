<?php  

 

if (isset($_POST['updateid'])){  
 // require_once ("include/initialize.php");
     echo '<script>totalprice();</script>';
    $max=count($_SESSION['fixnmix_cart']);
    for($i=0;$i<$max;$i++){

      $pid=$_SESSION['fixnmix_cart'][$i]['productid'];
 
      $qty=intval(isset($_GET['QTY'.$pid]) ? $_GET['QTY'.$_POST['updateid']] : "");
       $price=(double)(isset($_GET['subTOT'.$pid]) ? $_GET['subTOT'.$_POST['updateid']] : "");


       $sql = "SELECT * FROM `tblproducts` WHERE `PRODUCTID` ='" . $pid. "'";
       $result = mysql_query($sql) or die(mysql_error());
       while ($row = mysql_fetch_array($result)) {
        # code...
         
     if($row['PRICE']< 50){
           $fixedqty=round(50 /$row['PRICE']) ;
      
             // echo "<script> alert('".$fixedqty. ' ' .$row['PRICE']."') </script>";
         
          if($qty>=$fixedqty  && $qty<=999){
            // la pa natapos... price

            $_SESSION['fixnmix_cart'][$i]['qty']=$qty;
            $_SESSION['fixnmix_cart'][$i]['price']=$price;
          }
        }else{
          if($qty>0  && $qty<=999){
            // la pa natapos... price

            $_SESSION['fixnmix_cart'][$i]['qty']=$qty;
            $_SESSION['fixnmix_cart'][$i]['price']=$price;
          }

        }
       }
    }
  
  } else{
     echo '<script>totalprice();</script>';
     require_once ('headnav.php'); 
 
  }
 
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body onload="totalprice()">
<div id="cart"> 
 <form action="" method="post">
<!-- <div class="container"> -->
  <div  class="col-md-9"> 
  <?php check_message(); ?>
      <div class="">
        <div class="panel panel-default">
          <div class="panel-body">  
            <fieldset>  
              <legend><h2 class="text-left">Список корзин</h2></legend>
          <div>.</div>
      <div class="table-responsive">
       <div  class="fixnmix_scroll_carttwo" >
          <table  class="table fixnmix-table" id="table" >
             <thead>
               <tr>
                  <th width="5px">#</th>
                  <th>Товар</th>
                  <th>Описание</th>
                  <th>Цена</th>
                  <th>Количество</th>
                  <th>Итого</th>
                  <th>Активность</th>
               </tr>
             </thead>  
             
                                     
         <tbody > 
        

               <?php 
              if (!empty($_SESSION['fixnmix_cart'])){ 

                echo '<script>totalprice();</script>';
                    $count_cart = count($_SESSION['fixnmix_cart']);
                    for ($i=0; $i < $count_cart  ; $i++) { 
                    $query = "SELECT * FROM `tblproducts` p , `tblcategory` c 
                      WHERE  p.`CATEGORYID`=c.`CATEGORYID` and PRODUCTID='".$_SESSION['fixnmix_cart'][$i]['productid']."'";
                      $mydb->setQuery($query);
                      $cur = $mydb->loadResultList();
                      foreach ($cur as $result){ 
            ?>
                      <tr>
                        <td></td>
                        <td><img src="<?php echo web_root.'admin/modules/product/'.$result->IMAGES; ?>"   width="50px" height="50px"></td>
                        <td><?php echo $result->PRODUCTNAME ?></td>
                        <td>UZS <?php echo number_format($result->PRICE,2) ?></td>
                        <td><input type="NUMBER" data-id="<?php echo $result->PRODUCTID;  ?>" class="cusqty" name="QTY<?php echo $result->PRODUCTID;  ?>" id="QTY<?php echo $result->PRODUCTID; ?>"  value="<?php echo $_SESSION['fixnmix_cart'][$i]['qty'] ?>"/>
                        <td>UZS <output id="Osubtot<?php echo $result->PRODUCTID ?>"><?php echo   $_SESSION['fixnmix_cart'][$i]['price'] ; ?></output>

                        <!-- hidden textbox -->
                        <input type="hidden" name="TOT<?php echo $result->PRODUCTID;  ?>" id="TOT<?php echo $result->PRODUCTID; ?>"  value="<?php echo $_SESSION['fixnmix_cart'][$i]['price'] ?>"/></td>
                        <input type="hidden" name="PRICE<?php echo $result->PRODUCTID;  ?>" id="PRICE<?php echo $result->PRODUCTID; ?>"  value="<?php echo $_SESSION['fixnmix_cart'][$i]['price'] ?>"/></td>
                         <input type="hidden" name="originalPRICE<?php echo $result->PRODUCTID;  ?>" id="originalPRICE<?php echo $result->PRODUCTID; ?>"  value="<?php echo  $result->PRICE ?>"/></td>
                         <input type="hidden" name="originalqty<?php echo $result->PRODUCTID;  ?>" id="originalqty<?php echo $result->PRODUCTID; ?>"  value="<?php echo  $result->QTY ?>"/></td>

                        <!-- end -->
                        <td>   <a href="cart/controller.php?action=delete&id=<?php echo $result->PRODUCTID; ?>"  data-id="<?php echo $result->PRODUCTID ?>"   class="delete btn btn-danger btn-xs">Удалть</a></td> 
                      </tr>
            <?php
              }

            }
          }

        ?>
                         
                            
                  </tbody>
                  </table>
                  </div>
                  <table  >
                  <tfoot >
                     <strong><h1 align="right">Итоговая цена : UZS <span style="margin-right:3%"  id="sum">0.00</span></h1></strong></td>
         
                  </tfoot>
                  </table> 
                 </div>
                       
                </form>    
                        <?php    
                

                              echo  '<form action="index.php?page=7" method="post">';
                             echo '<a href="index.php?page=2" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<strong>Добавить ещё товар</strong></a>';
                                $countcart =isset($_SESSION['fixnmix_cart'])? count($_SESSION['fixnmix_cart']) : "0";
                                 if ($countcart > 0){
                
                                if (isset($_SESSION['cus_id'])){  
                             
                                  echo '<button type="submit"  name="proceed" id="proceed" class="btn btn_fixnmix pull-right"   ><strong>Продолжить и отправить</strong><span class="glyphicon glyphicon-chevron-right"></button>';
                               
                                 }else{
                                   echo   '<button type="button" class="btn btn_fixnmix pull-right" data-target="#myModal" data-toggle="modal" name="btnorder"><strong>Продолжить и отправить</strong><span class="glyphicon glyphicon-chevron-right"></button>';
                                } 
                              }
                                  echo '</form>'; 

             ?>
       </fieldset>
          </div>    
        </div>
      </div>
   </div>
 <!-- </div> -->

  <?php if (isset($_POST['updateid'])){;
    require_once ('sidebar.php');
     echo '<script>totalprice();</script>';
    echo "</div>";
     }else{
 echo '<script>totalprice();</script>';
       require_once ('sidebar.php');
    
   
}?>
 </div>
 <!-- </div> -->
 <div class="modal fade" id="smyModal" tabindex="-1"> 
 </div>
 <div class="modal fade" id="myModal" tabindex="-1"> 
            <div class="modal-dialog"  style="width:50%">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal" type=
                  "button">×</button>

                  <h4 class="modal-title" id="myModalLabel">Уже есть аккаутнт?</h4>
                </div>
 
                  <div class="modal-body" > 

                <ul class="nav nav-tabs" id="myTab">
                  <li class="active"><a href="#home" data-toggle="tab">Войти</a></li> 
                  <li><a href="#settings" data-toggle="tab">Зарегистрироваться</a></li>
                </ul>
                    <!-- <h2>Login</h2> -->
                    <div class="tab-content"> 
                      <div class="tab-pane active" id="home">
                      <form action="login.php"  onsubmit="return validatepasswords()"  method="post">
                          <div class="modal-body">
                              <div class="col-md-12">
                              <div class="form-group"> 
                              <label for="first_name">Имя пользователя</label>
                              <input   id="user_email" name="user_email" placeholder="Имя пользователя" type="text" class="form-control input-sm" > 
                              </div>
                              <div class="form-group"> 
                              <label for="first_name">Пароль</label>
                              <input name="user_pass2" id="user_pass2" placeholder="Пароль" type="password" class="form-control">
                              </div>
                              </div>
                              <div class="modal-footer">
                              <p align="left">&copy; Система заказа</p>
                              <button class="btn btn-default"   data-dismiss="modal" type=
                              "button">Закрыть</button>  
                              <button class="btn btn_fixnmix"
                              name="MbtnLogin" type="submit">Войти</button>
                            </div>
                            
                          </div>

                      
                        </form>
                            
                    </div><!--/tab-pane-->
            
                       <div class="tab-pane" id="settings"><br/><br/>
                <form  class="form-horizontal span6" action="customer/controller.php?action=add" onsubmit="return  validatecustomer()" name="personal" method="POST" enctype="multipart/form-data">
                           <?php 
              // echo isset($_POST['FIRSTNAME'])? 'yes' : '';
              $autonum = New Autonumber();
              $res = $autonum->single_autonumber(1);

               ?> 
                  
                <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4 control-label" for=
                      "FIRSTNAME">Имя:</label>
                      <input  id="CUSTOMERID" name="CUSTOMERID"  type="HIDDEN" value="<?php echo $res->AUTO; ?>"> 
                      <div class="col-md-8">
                         <input class="form-control input-sm" id="FIRSTNAME" name="FIRSTNAME" placeholder=
                            "Имя" type="text" value="">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4 control-label" for=
                      "LASTNAME">Фамилия:</label>

                      <div class="col-md-8">
                         <input class="form-control input-sm" id="LASTNAME" name="LASTNAME" placeholder=
                            "Фамилия" type="text" value="">
                      </div>
                    </div>
                  </div>

                  
                <div class="panel panel-default">
                <div class="panel-head" style="margin-left:3%"><h3>Адрес</h3></div>
                    <div class="panel-body">
                      <div class="form-group">
                        <div class="col-md-10">
                          <label class="col-md-4 control-label" for=
                          "HOMENUMBER">Тел номер:</label>

                          <div class="col-md-8">
                             <input class="form-control input-sm" id="HOMENUMBER" name="HOMENUMBER" placeholder=
                                "Тел номер" type="text" value="">
                          </div>
                        </div>
                      </div>

                       <div class="form-group">
                        <div class="col-md-10">
                          <label class="col-md-4 control-label" for=
                          "STREET">Горол\Улица :</label>

                          <div class="col-md-8">
                             <input class="form-control input-sm" id="STREET" name="STREET" placeholder=
                                "Улица" type="text" value="">
                          </div>
                        </div>
                      </div>

                       <div class="form-group">
                        <div class="col-md-10">


                          <label class="col-md-4 control-label" for=
                          "BARANGGY">Самарканд:</label>

                          <div class="col-md-8">
                             <input class="form-control input-sm" id="BARANGGY" name="BARANGGY" placeholder=
                                "Samarkand" type="text" value="">
                          </div>
                        </div>
                      </div>
                       <div class="form-group">
                        <div class="col-md-10">
                          <label class="col-md-4 control-label" for=
                          "CITYADDRESS">Город:</label>

                          <div class="col-md-8">
                             <input class="form-control input-sm" id="CITYADDRESS" name="CITYADDRESS" placeholder=
                                "Адрес" type="text" value="">
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                       
                 <!--  <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4 control-label" for=
                      "EMAIL">Email Address:</label>

                      <div class="col-md-8">
                         <input class="form-control input-sm" id="UEMAIL" name="UEMAIL" placeholder=
                            "Email Address" type="text" value="">
                      </div>
                    </div>
                  </div> -->

                  <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4 control-label" for=
                      "USERNAME">Логин:</label>

                      <div class="col-md-8">
                         <input class="form-control input-sm" id="USERNAME" name="USERNAME" placeholder=
                            "Логин" type="text" value="">
                      </div>
                    </div>
                  </div> 
                  
                   <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4 control-label" for=
                      "PASS">Пароль:</label>

                      <div class="col-md-8">
                         <input class="form-control input-sm" id="PASS" name="PASS" placeholder=
                            "Пароль" type="password" value=""><span></span>
                      </div>
                    </div>
                  </div>

                    <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4 control-label" for=
                      "PASS"></label>

                      <div class="col-md-8">
                      <p>Заметка</p>
                      Пароль должен содержать не менее 8-15 символов. Буквой должны быть только буква, цифровые цифры, символ подчеркивания и первый символ.
                      </div> 
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4 control-label" for=
                      "CONTACTNUMBER">Контактный номер:</label>

                      <div class="col-md-8">
                         <input class="form-control input-sm" id="CONTACTNUMBER" name="CONTACTNUMBER" placeholder=
                            "Contact Number" type="text" value="">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4 control-label" for=
                      "ZIPCODE">Zip Код:</label>

                      <div class="col-md-8">
                         <input class="form-control input-sm" id="ZIPCODE" name="ZIPCODE" placeholder=
                            "Zip Code" type="number" value="">
                      </div>
                    </div>
                  </div>
 
                  <div class="form-group">
                    <div class="col-md-10">
                      <label class="col-md-4" align = "right"for=
                      "image">Загрузить фото:</label>

                      <div class="col-md-8">
                      <input type="file" name="image" value="" id="image"/>
                      </div>
                    </div>
                  </div>
                  
                   <div class="form-group">
                    <div class="col-md-10">
                       <label class="col-md-4" align = "right"for=
                      "image"></label>
                      <div class="col-md-8">
                    <p>
                    <!-- <input type="checkbox" name="condition" value="checkbox" /> -->
                      <small>Соглашаюсь с  <a class="toggle-modal"  onclick=" OpenPopupCenter('terms.php','Terms And Codition','600','600')"  ><b>правилами и условиями</b></a> E-builder</small>
                      
                      </div>
                    </div>
                  </div>
 
                  <div class="modal-footer"><p align="left">&copy;система заказов</p>
                    <button class="btn btn-default" data-dismiss="modal" type=
                    "button">Закрыть</button> 
                    <button type="submit"  name="savecustomer"   class="submit btn btn_fixnmix" >Зарегистрироваться</button> 
                    <!-- <button class="btn btn_fixnmix"
                    name="btnsignup" type="submit" onclick="return personalInfo();" >Sign Up</button>  -->
                  </div> 
         
                        </form>
                      </div>
                  </div> <!-- /.modal-body -->
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
  </div> 
 <script language="javascript" type="text/javascript">
        function OpenPopupCenter(pageURL, title, w, h) {
            var left = (screen.width - w) / 2;
            var top = (screen.height - h) / 4;  // for 25% - devide by 4  |  for 33% - devide by 3
            var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
        } 
    </script>
</body>
</html>
 